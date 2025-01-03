<?php
// session start allows us to access the session variables and login the user. We need to start the session in every file that we want to access the session variables but when we try to login, we will use the db, so we start the session in the db.php file to avoid import it in a lot of files
session_start();
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

function create($table_name, $data) {
  global $conn;

  $sql = "INSERT INTO $table_name SET ";
  $i = 0;
  foreach ($data as $key => $value) {
    if ($i === 0) {
      $sql .= "$key=?";
    } else {
      $sql .= ", $key=?";
    }
    $i++;
  }

  $statement = executeQuery($sql, $data);
  $id = $statement->insert_id;

  return $id;
}

function update($table_name, $record_id, $data) {
  global $conn;

  $sql = "UPDATE $table_name SET ";
  $i = 0;
  foreach ($data as $key => $value) {
    if ($i === 0) {
      $sql .= "$key=?";
    } else {
      $sql .= ", $key=?";
    }
    $i++;
  }

  $sql .= " WHERE id=?";
  // add the id to data array to update the correct record (if the id of the record is not included in the data array). This is to respect the bind_params.
  $data['id'] = $record_id;
  $statement = executeQuery($sql, $data);

  // if the query pass successfully, return the number of affected rows, else return -1
  return $statement->affected_rows;
}

function delete($table_name, $record_id) {
  global $conn;

  $sql = "DELETE FROM $table_name WHERE id=?";
  $statement = executeQuery($sql, ['id' => $record_id]);

  // if the query pass successfully, return the number of affected rows, else return -1
  return $statement->affected_rows;
}

?>