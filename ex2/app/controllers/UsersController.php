<?php

require_once(ROOT_PATH . '/app/components/Controller.php');
require_once(ROOT_PATH . '/app/components/Validator.php');
require_once(ROOT_PATH . '/app/models/User.php');
require_once(ROOT_PATH . '/bootstrap.php');


class UsersController extends Controller {
  public function signupView() {
    $this->render('base_page', ['content' => ROOT_PATH . '/app/views/users/signup.php', 'username' => '', 'email' => '', 'password' => '', 'passwordConf' => '']);
  }

  public function loginView() {
    $this->render('base_page', ['content' => ROOT_PATH . '/app/views/users/login.php', 'email' => '', 'password' => '']);
  }

  public function loginUser($user) {
    $_SESSION['id'] = $user->id;
    $_SESSION['email'] = $user->email;
    $_SESSION['admin'] = $user->admin;
    $_SESSION['msg'] = 'You are now logged in!';
    $_SESSION['type'] = 'success';

    $this->redirect('/');
  }

  public function logoutUser() {
    $_SESSION['id'] = null;
    $_SESSION['email'] = null;
    $_SESSION['admin'] = null;
    $_SESSION['msg'] = 'You are now logged out!';
    $_SESSION['type'] = 'success';

    $this->redirect('/');
  }

  public function login() {
    try {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = new User();
        $user = $user->where('email', $_POST['email'])->first();
        if ($user && password_verify($_POST['password'], $user->password)) {
          unset($_POST['login-btn']);
          $this->loginUser($user);
        } else {
          $this->render('base_page', ['content' => ROOT_PATH . '/app/views/users/login.php', 'status' => 'ko', 'message' => 'Invalid email or password', 'email' => $_POST['email'], 'password' => '']);
        }
      } else {
        $this->render('base_page', ['content' => ROOT_PATH . '/app/views/users/login.php']);
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/users/login.php', 'status' => 'ko', 'message' => $e->getMessage()]);
    }
  }

  public function store() {
    try {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate the data
        $validator = new Validator($_POST);
        $rules = [
          'email' => 'required|email|unique:users',
          'password' => 'required|string',
          'passwordConf' => 'required|same:password',
          'admin' => 'nullable|integer',
        ];
        
        if (!$validator->validate($rules)) {
          $errors = $validator->errors();
          $this->render('base_page', ['content' => ROOT_PATH . '/app/views/admin/posts/signup.php', 'status' => 'ko', 'errors' => $errors, 'email' => $_POST['email'], 'password' => $_POST['password'], 'passwordConf' => $_POST['passwordConf']]);
          exit();
        }

        // hash the password
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        unset($_POST['signup-btn'], $_POST['passwordConf']);
        $user = new User();
        $create_user = $user->insert($_POST);
        $this->loginUser($create_user);
      } else {
        $this->render('base_page', ['content' => ROOT_PATH . '/app/views/users/signup.php']);
        exit();
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/users/signup.php', 'status' => 'ko', 'message' => $e->getMessage()]);
    }
  }
}