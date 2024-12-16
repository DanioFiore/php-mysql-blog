<?php
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/utilities.php");
include(ROOT_PATH . "/app/helpers/validators/validateUser.php");

// create variables to return the data from the form when validaiton fails, so the user can see the data that they entered
$errors = array();
$username = '';
$email = '';
$password = '';
$passwordConf = '';
$table = 'users'; // this is a users controller, so define the table name instead of hardcoding

function loginUser($user) {
  $_SESSION['id'] = $user['id'];
  $_SESSION['username'] = $user['username'];
  $_SESSION['admin'] = $user['admin'];
  $_SESSION['msg'] = 'You are now logged in!';
  $_SESSION['type'] = 'success';

  // redirect the user after logging in
  if ($_SESSION['admin']) {
    header('location: ' . BASE_URL . 'admin/dashboard.php');
  } else {
    header('location: ' . BASE_URL . 'index.php');
  }
}
// REGISTER USER
// from the front-end form of register.php we receive the data from the form based on the name attribute of the input fields, so here if we have a $_POST with register-btn key, we know that the form was submitted from register-btn
if (isset($_POST['register-btn'])) {
  // validation
  $errors = validateUser($_POST);
  
  if (empty($errors)) {
    // we unset the register-btn and passwordConf keys from the $_POST array and add admin to save only the data that we want to insert into the database
    unset($_POST['register-btn'], $_POST['passwordConf']);
    $_POST['admin'] = 0;
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
  
    $user_id = create($table, $_POST);
    $user = selectOne($table, ['id' => $user_id]);

    // logging in the user
    loginUser($user);
    exit(); // end the function script HERE
  } else {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
  }
}

// LOGIN USER
if (isset($_POST['login-btn'])) {
  // this is in validateUser.php
  $errors = validateLogin($_POST);

  if (empty($errors)) {
    $user = selectOne($table, ['email' => $_POST['email']]);

    if ($user && password_verify($_POST['password'], $user['password'])) {
      // logging in the user
      loginUser($user);
      exit(); // end the function script HERE
    } else {
      array_push($errors, 'Wrong credentials');
    }
  }
  $email = $_POST['email'];
  $password = $_POST['password'];
}



?>