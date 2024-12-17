<?php
require(__DIR__ . '/../bootstrap.php');

try {
  // check if the file is passed
  if ($argc < 2) {
    throw new Exception("Usage: php migrate.php <file.sql>");
  }

  // get the file name
  $sqlFile = $argv[1];

  // check if the file exists
  if (!file_exists(__DIR__ . "/scripts/$sqlFile")) {
    throw new Exception("$sqlFile doesn't exists.");
  }

  $db = new Database();
  $sql = file_get_contents(__DIR__ . "/scripts/$sqlFile");
  $db->conn->exec($sql);
  echo "Migrations completed!";
} catch (PDOException $e) {
  echo "Error during migration: " . $e->getMessage();
}
?>
