<?php

require_once(__DIR__ . './../components/Controller.php');
require_once(__DIR__ . './../components/Validator.php');

class AdminsController extends Controller {

  public function create_post_view() {
    $this->render('admin/posts/create');
  }

  public function store() {
    try {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate the data
        $validator = new Validator($_POST);
        $rules = [
          'title' => 'required|string|max:255',
          'content' => 'required|string',
          'category_id' => 'nullable|integer',
          'images' => 'nullable|array',
        ];
        
        if (!$validator->validate($rules)) {
          $errors = $validator->errors();
          $this->render('admin/posts/create', ['errors' => $errors]);
          return;
        }

        $this->redirect('/posts');
      } else {
        $this->render('admin/posts/create');
        return;
      }
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}