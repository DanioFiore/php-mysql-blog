<?php

require_once(ROOT_PATH . '/app/components/Controller.php');
require_once(ROOT_PATH . '/app/models/Post.php');
require_once(ROOT_PATH . '/bootstrap.php');

class PostsController extends Controller {

  public function index() {
    try {
      $posts = new Post;
      $posts = $posts->all();

      return $posts;
    } catch (Exception $e) {
      echo $e->getMessage();
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/posts/index.php', 'posts' => [], 'status' => 'ko', 'message' => $e->getMessage()]);
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
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/posts/index.php', 'posts' => [], 'status' => 'ko', 'message' => $e->getMessage()]);
    }
  }

  public function show($id) {
    try {
      $post = new Post;
      $post = $post->find($id);
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/posts/show.php', 'post' => $post]);
    } catch (Exception $e) {
      echo $e->getMessage();
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/posts/index.php', 'post' => [], 'status' => 'ko', 'message' => $e->getMessage()]);
    }
  }

  public function store() {
    try {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_POST['user_id'] = $_SESSION['id'];
        // Validate the data
        $validator = new Validator($_POST);
        // TODO: images or image?
        $rules = [
          'title' => 'required|string|max:255',
          'content' => 'required|string',
          'images' => 'nullable|array',
        ];
        
        if (!$validator->validate($rules)) {
          $errors = $validator->errors();
          $this->render('base_page', ['content' => ROOT_PATH . '/app/views/posts/create.php', 'status' => 'ko', 'errors' => $errors]);
          return;
        }

        $create_post = new Post();
        $create_post->insert($_POST);
        $_SESSION['message'] = 'Post created successfully';
        $_SESSION['status'] = 'ok';
        $this->redirect('/admin/posts/index');
      } else {
        $this->render('base_page', ['content' => ROOT_PATH . '/app/views/posts/create.php']);
        return;
      }
    } catch (Exception $e) {
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/posts/create.php', 'status' => 'ko', 'message' => $e->getMessage()]);
    }
  }

  public function update($id) {
    try {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/posts/create.php', 'post' => [], 'status' => 'ko', 'message' => $e->getMessage()]);
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
      $this->render('base_page', ['content' => ROOT_PATH . '/app/views/posts/index.php', 'status' => 'ko', 'message' => $e->getMessage()]);
    }
  }
}