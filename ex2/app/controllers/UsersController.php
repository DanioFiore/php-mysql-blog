<?php

require_once(ROOT_PATH . '/app/components/Controller.php');

class UsersController extends Controller {
  public function signup_view() {
    $this->view('base_page', ['content' => ROOT_PATH . '/app/views/users/signup.php']);
  }

  public function login_view() {
    $this->view('base_page', ['content' => ROOT_PATH . '/app/views/users/login.php']);
  }

  public function store() {
    try {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate the data
        $validator = new Validator($_POST);
        $rules = [
          'email' => 'required|email|unique:users',
          'password' => 'required|string',
          'admin' => 'nullable|integer',
        ];
        
        if (!$validator->validate($rules)) {
          $errors = $validator->errors();
          $this->render('base_page', ['content' => ROOT_PATH . '/app/views/admin/posts/signup.php', 'status' => 'ko', 'errors' => $errors]);
          return;
        }

        $create_user = new User();
        $create_user->insert($_POST);
        $_SESSION['message'] = 'Successfully signed up';
        $_SESSION['status'] = 'ok';
        $this->redirect('');
      } else {
        $this->render('base_page', ['content' => ROOT_PATH . '/app/views/admin/posts/signup.php']);
        return;
      }
    } catch (Exception $e) {
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/admin/posts/signup.php', 'status' => 'ko', 'message' => $e->getMessage()]);
    }
  }
}