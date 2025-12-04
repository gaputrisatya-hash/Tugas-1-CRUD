<?php
// src/ProductRepository.php
class ProductRepository {
    private PDO $conn;

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function getAll(): array {
        // UBAHAN: ASC supaya produk pertama muncul sebagai nomor 1
        $stmt = $this->conn->query("SELECT * FROM products ORDER BY id ASC");
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function insert(array $data): bool {
        $stmt = $this->conn->prepare("
            INSERT INTO products (name, category, price, stock, image_path, status)
            VALUES (:name, :category, :price, :stock, :image_path, :status)
        ");
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool {
        $data['id'] = $id;
        $stmt = $this->conn->prepare("
            UPDATE products SET
                name = :name,
                category = :category,
                price = :price,
                stock = :stock,
                image_path = :image_path,
                status = :status
            WHERE id = :id
        ");
        return $stmt->execute($data);
    }

    public function delete(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
