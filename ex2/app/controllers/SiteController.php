<?php

require_once(ROOT_PATH . '/app/components/Controller.php');
require_once(ROOT_PATH . '/app/controllers/PostsController.php');

class SiteController extends Controller {

  public function home() {
    $this->render('base_page', ['content' => (ROOT_PATH . '/app/views/home/index.php')]);
  }

  public function signup() {
    $this->render('base_page', ['content' => ROOT_PATH . '/app/views/users/signup.php', 'username' => '', 'email' => '', 'password' => '', 'passwordConf' => '']);
  }

  public function login() {
    $this->render('base_page', ['content' => ROOT_PATH . '/app/views/users/login.php', 'email' => '', 'password' => '']);
  }

  public function indexPosts() {
    $postsController = new PostsController();
    $posts = $postsController->index();
    $this->render('base_page', ['content' => ROOT_PATH . '/app/views/posts/index.php', 'posts' => $posts]);
  }
}