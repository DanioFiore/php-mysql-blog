<?php

require(__DIR__ . '/../bootstrap.php');

$db = new Database();

$query = "CREATE TABLE IF NOT EXISTS categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$db->conn->exec($query);
echo "Categories Table created successfully";