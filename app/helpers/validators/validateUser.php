<?php
// we can use selectOne because validateUser.php is included in the users.php file where we have the selectOne method
function validateUser($user) {
  $errors = array();

  if (empty($user['username'])) {
    array_push($errors, 'Username is required');
  }
  if (empty($user['email'])) {
    array_push($errors, 'Email is required');
  }
  if (empty($user['password'])) {
    array_push($errors, 'Password is required');
  }
  if ($user['password'] !== $user['passwordConf']) {
    array_push($errors, 'Passwords do not match');
  }

  $checkEmail = selectOne('users', ['email' => $user['email']]);
  if (isset($checkEmail)) {
    array_push($errors, 'Email already exists');
  }

  return $errors;
}

?>