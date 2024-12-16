<?php

class Database {
  private $host = "db";
  private $db_name = "blog-mvc";
  private $username = "root";
  private $password = "root";
  public $conn;

  public function __construct() {
    try {
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
      $this->conn->exec("set names utf8");
      echo "Connected successfully";
    } catch (PDOException $e) {
      echo "Connection error: " . $e->getMessage();
    }
  }
}