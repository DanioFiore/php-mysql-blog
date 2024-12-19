<?php

require_once(ROOT_PATH . '/app/components/Controller.php');
require_once(ROOT_PATH . '/app/models/Post.php');
require_once(ROOT_PATH . '/bootstrap.php');

class PostsController extends Controller {

  public function index() {
    try {
      $posts = new Post;
      $posts = $posts->all();
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/posts/index.php', 'posts' => $posts]);
    } catch (Exception $e) {
      echo $e->getMessage();
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/users/index.php', 'posts' => [], 'status' => 'ko', 'message' => $e->getMessage()]);
    }
  }

  public function showUserPosts() {
    try {
      $posts = new Post;
      // TODO: check if works
      $posts = $posts->where('user_id', $_SESSION['id'])->get();
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/posts/index.php', 'posts' => $posts]);
    } catch (Exception $e) {
      echo $e->getMessage();
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/users/index.php', 'posts' => [], 'status' => 'ko', 'message' => $e->getMessage()]);
    }
  }

  public function show($id) {
    try {
      $post = new Post;
      $post = $post->find($id);
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/posts/show.php', 'post' => $post]);
    } catch (Exception $e) {
      echo $e->getMessage();
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/users/index.php', 'post' => [], 'status' => 'ko', 'message' => $e->getMessage()]);
    }
  }

  public function store() {
    try {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_POST['user_id'] = $_SESSION['id'];
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

  public function update($id) {
    try {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/users/index.php', 'post' => [], 'status' => 'ko', 'message' => $e->getMessage()]);
    }
  }

  public function destroy($id) {
    try {
      $post = new Post;
      $post = $post->delete($id);
      $_SESSION['message'] = 'Post deleted successfully!';
      $_SESSION['status'] = 'ok';
      $this->redirect('/posts');
    } catch (Exception $e) {
      echo $e->getMessage();
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/users/signup.php', 'status' => 'ko', 'message' => $e->getMessage()]);
    }
  }
}