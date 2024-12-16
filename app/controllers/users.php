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

// from the front-end form of register.php we receive the data from the form based on the name attribute of the input fields, so here if we have a $_POST with register-btn key, we know that the form was submitted from register-btn
if (isset($_POST['register-btn'])) {
  // validation
  $errors = validateUser($_POST);
  
  if (empty($errors)) {
    // we unset the register-btn and passwordConf keys from the $_POST array and add admin to save only the data that we want to insert into the database
    unset($_POST['register-btn'], $_POST['passwordConf']);
    $_POST['admin'] = 0;
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
  
    $user_id = create('users', $_POST);
    $user = selectOne('users', ['id' => $user_id]);
  } else {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
  }
}
?>