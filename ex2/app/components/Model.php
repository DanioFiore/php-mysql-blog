<?php

require_once(ROOT_PATH . '/bootstrap.php');

class Model {
  protected $connection;
  protected $table;
  protected $primaryKey = 'id';

  public function __construct() {
    $db = new Database();
    $this->connection = $db->conn;
  }

  /**
   * All records from a table.
   */
  public function all() {
    $stmt = $this->connection->query("SELECT * FROM {$this->table}");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Find a specific record.
   */
  public function find($id) {
    $stmt = $this->connection->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Insert new record.
   */
  public function insert(array $data) {
    $columns = implode(',', array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));
    $stmt = $this->connection->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");

    foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }

    return $stmt->execute();
  }

  /**
   * Update record.
   */
  public function update($id, array $data)
  {
    $fields = [];
    foreach ($data as $key => $value) {
      $fields[] = "$key = :$key";
    }
    $fields = implode(', ', $fields);

    $stmt = $this->connection->prepare("UPDATE {$this->table} SET $fields WHERE {$this->primaryKey} = :id");
    foreach ($data as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
  }

  /**
   * Delete record.
   */
  public function delete($id)
  {
    $stmt = $this->connection->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
}
