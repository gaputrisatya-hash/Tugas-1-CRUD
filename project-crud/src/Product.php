<?php
// src/Product.php
class Product {
    public ?int $id = null;
    public string $name;
    public string $category;
    public float $price;
    public int $stock;
    public ?string $image_path = null;
    public string $status;
}
