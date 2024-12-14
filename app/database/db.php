<?php
require('connect.php');

function executeQuery($sql, $data) {
  global $conn;

  $statement = $conn->prepare($sql);
  // transform the $data array into a list of values
  $values = array_values($data);
  // determine the type of the values, is not mandatory but it's a good practice
  $types = '';
  foreach ($values as $value) {
    if (is_int($value)) {
      $types .= 'i'; // integer
    } else if (is_double($value)) {
      $types .= 'd'; // double
    } else if (is_string($value)) {
      $types .= 's'; // string
    } else {
      $types .= 'b'; // blob and other types
    }
  }
  // bind the values to the statement
  $statement->bind_param($types, ...$values);
  $statement->execute();

  return $statement;
}

function selectAll($table_name, $conditions = []) {
  // if you want to use the $conn variable inside a function, you have to use the global keyword
  global $conn;

  $sql = "SELECT * FROM $table_name";

  // check for conditions
  if (!empty($conditions)) {
    $sql .= " WHERE ";
    $i = 0;
    foreach ($conditions as $key => $value) {
      if ($i === 0) {
        $sql .= "$key=?";
      } else {
        $sql .= " AND $key=?";
      }
      $i++;
    }
  }

  $statement = executeQuery($sql, $conditions);
  $records = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

  return $records;
}

function selectOne($table_name, $conditions = []) {
  // if you want to use the $conn variable inside a function, you have to use the global keyword
  global $conn;

  $sql = "SELECT * FROM $table_name";

  // check for conditions
  if (!empty($conditions)) {
    $sql .= " WHERE ";
    $i = 0;
    foreach ($conditions as $key => $value) {
      if ($i === 0) {
        $sql .= "$key=?";
      } else {
        $sql .= " AND $key=?";
      }
      $i++;
    }
  }

  $sql .= " LIMIT 1";

  $statement = executeQuery($sql, $conditions);
  $records = $statement->get_result()->fetch_assoc();

  return $records;
}

?>