<?php
// public/store.php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../src/ProductRepository.php';

function redirect($msg = null) {
    if ($msg) echo "<p>$msg</p>";
    echo '<p><a href="index.php">Kembali ke daftar</a></p>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('Metode tidak diizinkan.');
}

// Basic validation
$name = trim($_POST['name'] ?? '');
$category = $_POST['category'] ?? '';
$price = $_POST['price'] ?? '';
$stock = $_POST['stock'] ?? '';
$status = $_POST['status'] ?? '';

$errors = [];
if ($name === '') $errors[] = "Nama wajib diisi.";
if (!is_numeric($price) || $price < 0) $errors[] = "Harga harus angka >= 0.";
if (!is_numeric($stock) || $stock < 0) $errors[] = "Stok harus angka >= 0.";
$allowedTypes = ['image/jpeg','image/png'];
$maxSize = 2 * 1024 * 1024; // 2 MB

if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    $errors[] = "Gambar wajib diupload.";
} else {
    $file = $_FILES['image'];
    if ($file['size'] > $maxSize) $errors[] = "Ukuran gambar > 2MB.";
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    if (!in_array($mime, $allowedTypes)) $errors[] = "Tipe gambar harus JPG/PNG.";
}

if ($errors) {
    foreach ($errors as $e) echo "<p style='color:red'>" . htmlspecialchars($e) . "</p>";
    echo '<p><a href="create.php">Kembali</a></p>';
    exit;
}

// Upload file
$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
$filename = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
$target = $uploadDir . $filename;
if (!move_uploaded_file($file['tmp_name'], $target)) {
    redirect('Gagal mengunggah file.');
}

// Insert into DB
$db = (new Database())->connect();
$repo = new ProductRepository($db);

$data = [
    ':name' => $name,
    ':category' => $category,
    ':price' => number_format((float)$price, 2, '.', ''),
    ':stock' => (int)$stock,
    ':image_path' => $filename,
    ':status' => $status
];

// note: repository insert expects array keys without ':' in earlier code; adapt:
$insertData = [
    'name' => $data[':name'],
    'category' => $data[':category'],
    'price' => $data[':price'],
    'stock' => $data[':stock'],
    'image_path' => $data[':image_path'],
    'status' => $data[':status']
];

$ok = $repo->insert($insertData);
if ($ok) {
    header("Location: index.php");
    exit;
} else {
    redirect('Gagal menyimpan data.');
}
