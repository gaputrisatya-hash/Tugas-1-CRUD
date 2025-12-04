<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">
    <h3 class="fw-bold mb-4">Tambah Produk</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="store.php" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Pakaian">Pakaian</option>
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" step="0.01" name="price" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stock" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Gambar</label>
                    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <button class="btn btn-primary">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>

            </form>

        </div>
    </div>
</div>

</body>
</html>
