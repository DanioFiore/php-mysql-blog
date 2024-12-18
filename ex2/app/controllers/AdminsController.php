<?php


require_once(ROOT_PATH . '/app/components/Controller.php');
require_once(ROOT_PATH . '/app/components/Validator.php');
require_once(ROOT_PATH . '/app/models/Post.php');

class AdminsController extends Controller {

  public function create_post_view() {
    $this->render('base_page', ['content' => ROOT_PATH . '/app/views/admin/posts/create.php']);
  }

  public function store() {
    try {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // TODO: make dynamic
        $_POST['user_id'] = 1;
        $_POST['category_id'] = $_POST['category_id'] ?: null;
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
          $this->render('base_page', ['content' => ROOT_PATH . '/app/views/admin/posts/create.php', 'status' => 'ko', 'errors' => $errors]);
          return;
        }

        $create_post = new Post();
        $create_post->insert($_POST);
        $_SESSION['message'] = 'Post created successfully';
        $_SESSION['status'] = 'ok';
        $this->redirect('/admin/posts/index');
      } else {
        $this->render('base_page', ['content' => ROOT_PATH . '/app/views/admin/posts/create.php']);
        return;
      }
    } catch (Exception $e) {
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/admin/posts/create.php', 'status' => 'ko', 'message' => $e->getMessage()]);
    }
  }
}