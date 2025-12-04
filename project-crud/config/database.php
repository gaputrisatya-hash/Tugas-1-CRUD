<?php
// config/Database.php
class Database {
    private $host = "127.0.0.1";
    private $db   = "crud_db";
    private $user = "root";
    private $pass = "";
    public $conn;

    public function connect(): PDO {
        if ($this->conn) return $this->conn;
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";
        try {
            $this->conn = new PDO($dsn, $this->user, $this->pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            return $this->conn;
        } catch (PDOException $e) {
            // Stop execution dengan pesan jelas
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
