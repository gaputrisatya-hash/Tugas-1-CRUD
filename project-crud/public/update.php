<?php
// public/update.php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../src/ProductRepository.php';

function back($msg = null) {
    if ($msg) echo "<p>$msg</p>";
    echo '<p><a href="index.php">Kembali</a></p>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') back('Metode tidak diizinkan.');

$id = (int)($_POST['id'] ?? 0);
$name = trim($_POST['name'] ?? '');
$category = $_POST['category'] ?? '';
$price = $_POST['price'] ?? '';
$stock = $_POST['stock'] ?? '';
$status = $_POST['status'] ?? '';

$errors = [];
if ($name === '') $errors[] = "Nama wajib diisi.";
if (!is_numeric($price) || $price < 0) $errors[] = "Harga harus angka >= 0.";
if (!is_numeric($stock) || $stock < 0) $errors[] = "Stok harus angka >= 0.";

$db = (new Database())->connect();
$repo = new ProductRepository($db);
$product = $repo->getById($id);
if (!$product) back('Data tidak ditemukan.');

$uploadDir = __DIR__ . '/uploads/';
$newFilename = $product['image_path']; // default: pertahankan yang lama

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['image'];
    $allowedTypes = ['image/jpeg','image/png'];
    $maxSize = 2 * 1024 * 1024;
    if ($file['size'] > $maxSize) $errors[] = "Ukuran gambar > 2MB.";
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    if (!in_array($mime, $allowedTypes)) $errors[] = "Tipe gambar harus JPG/PNG.";

    if (!$errors) {
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newFilename = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
        $target = $uploadDir . $newFilename;
        if (!move_uploaded_file($file['tmp_name'], $target)) {
            $errors[] = "Gagal mengunggah file baru.";
        } else {
            // hapus file lama jika ada
            if ($product['image_path'] && file_exists($uploadDir . $product['image_path'])) {
                @unlink($uploadDir . $product['image_path']);
            }
        }
    }
}

if ($errors) {
    foreach ($errors as $e) echo "<p style='color:red'>" . htmlspecialchars($e) . "</p>";
    echo '<p><a href="edit.php?id=' . $id . '">Kembali</a></p>';
    exit;
}

// prepare data for update
$updateData = [
    'name' => $name,
    'category' => $category,
    'price' => number_format((float)$price, 2, '.', ''),
    'stock' => (int)$stock,
    'image_path' => $newFilename,
    'status' => $status
];

$ok = $repo->update($id, $updateData);
if ($ok) {
    header("Location: index.php");
    exit;
} else {
    back('Gagal mengupdate data.');
}
