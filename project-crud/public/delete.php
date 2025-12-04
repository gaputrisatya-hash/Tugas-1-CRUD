<?php
// public/delete.php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../src/ProductRepository.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$db = (new Database())->connect();
$repo = new ProductRepository($db);
$product = $repo->getById($id);
if (!$product) {
    die("Data tidak ditemukan. <a href='index.php'>Kembali</a>");
}

// Hapus file jika ada
$uploadDir = __DIR__ . '/uploads/';
if ($product['image_path'] && file_exists($uploadDir . $product['image_path'])) {
    @unlink($uploadDir . $product['image_path']);
}

// Hapus record DB
$ok = $repo->delete($id);
if ($ok) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus data. <a href='index.php'>Kembali</a>";
}
