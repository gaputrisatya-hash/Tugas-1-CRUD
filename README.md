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
1. Import `schema.sql` ke MySQL:
   - Bisa lewat phpMyAdmin
   - Atau melalui terminal:  
     `mysql -u root -p crud_db < schema.sql`

2. Sesuaikan konfigurasi database di `config/Database.php`:
   ```php
   private $host = "localhost";
   private $db   = "crud_db";
   private $user = "root";
   private $pass = "";
