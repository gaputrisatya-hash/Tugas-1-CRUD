<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../src/ProductRepository.php';

$id = $_GET['id'] ?? 0;
$db = (new Database())->connect();
$repo = new ProductRepository($db);
$product = $repo->getById($id);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">
    <h3 class="fw-bold mb-4">Edit Produk</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="update.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $product['id'] ?>">

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control" value="<?= $product['name'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category" class="form-select" required>
                        <?php
                        $categories = ['Elektronik','Pakaian','Makanan','Minuman'];
                        foreach ($categories as $cat) {
                            $sel = $cat === $product['category'] ? "selected" : "";
                            echo "<option value='$cat' $sel>$cat</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" step="0.01" name="price"
                               class="form-control" value="<?= $product['price'] ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stock"
                               class="form-control" value="<?= $product['stock'] ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    <img src="uploads/<?= $product['image_path'] ?>" width="120" class="rounded mb-2">
                    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" <?= $product['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= $product['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <button class="btn btn-warning">Update</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>

            </form>

        </div>
    </div>

</div>

</body>
</html>
