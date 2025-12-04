# CRUD Produk (PHP 8 + PDO + MySQL)

## Deskripsi
Aplikasi back-end sederhana untuk mengelola data **Produk** (Create, Read, Update, Delete).  
Aplikasi ini dibuat menggunakan PHP native + PDO, dan data disimpan dalam database MySQL.  
File gambar produk disimpan di folder `public/uploads/`.

## Teknologi yang digunakan
- PHP 8.x
- MySQL / MariaDB
- PDO (PHP Data Objects)
- HTML dasar

## Struktur Folder
project-crud/
├── config/          -> Koneksi database (Database.php)
├── src/             -> Kelas dan repository (Product.php, ProductRepository.php)
├── public/          -> Halaman CRUD (index, create, edit, delete)
│   └── uploads/     -> Tempat penyimpanan file gambar
├── schema.sql       -> File SQL untuk membuat tabel
├── README.md        -> Dokumentasi aplikasi
└── .gitignore       -> File untuk mengabaikan folder/file tertentu

## Cara Menjalankan Aplikasi
1. Buat database (contoh nama `crud_db`) dan jalankan `schema.sql`:
   - `mysql -u root -p crud_db < schema.sql`
   - Atau import lewat phpMyAdmin.
2. Sesuaikan konfigurasi DB di `config/Database.php`.
3. Pastikan folder `public/uploads/` ada dan dapat ditulis oleh webserver (`chmod 755` atau `775`).
4. Jalankan server built-in PHP:
5. Buka: `http://localhost:8000/index.php`

## Validasi
- Field wajib diisi sesuai form.
- Harga & stok harus numerik (harga bisa desimal).
- Upload hanya menerima JPG/JPEG/PNG, maksimal 2 MB.
- Nama file upload dibuat unik (timestamp + random).

## File penting yang dikumpulkan
- Semua file source code (folder di atas)
- `schema.sql`
- `README.md`
- `.gitignore`

## Catatan pengumpulan
- Upload ke GitHub; sertakan commit history (jangan satu commit final saja).
- Sertakan link repo pada tugas.
