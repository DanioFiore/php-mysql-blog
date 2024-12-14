<?php
require('connect.php');

function selectAll($table_name) {
  // if you want to use the $conn variable inside a function, you have to use the global keyword
  global $conn;

  $sql = "SELECT * FROM $table_name";
  $statement = $conn->prepare($sql);
  $statement->execute();
  $records = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

  return $records;
}
?>