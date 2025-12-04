<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../src/ProductRepository.php';

$db = (new Database())->connect();
$repo = new ProductRepository($db);
$products = $repo->getAll();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand fw-bold">Manajemen Produk</span>
    </div>
</nav>

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Daftar Produk</h3>
        <a href="create.php" class="btn btn-primary">+ Tambah Produk</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                <tbody>
                <?php if (count($products) === 0): ?>
                    <tr>
                        <td colspan="8" class="text-center py-3">Tidak ada data.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($products as $p): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($p['name']) ?></td>
                            <td><?= htmlspecialchars($p['category']) ?></td>
                            <td>Rp <?= number_format($p['price'], 2, ',', '.') ?></td>
                            <td><?= $p['stock'] ?></td>
                            <td>
                                <img src="uploads/<?= $p['image_path'] ?>" width="60" class="rounded">
                            </td>
                            <td>
                                <span class="badge bg-<?= $p['status'] === 'active' ? 'success' : 'secondary' ?>">
                                    <?= $p['status'] ?>
                                </span>
                            </td>
                            <td>
                                <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="delete.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger"
                                   onclick="return confirm('Hapus produk ini?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>
</div>

</body>
</html>
