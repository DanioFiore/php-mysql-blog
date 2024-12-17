<?php

require_once(ROOT_PATH . '/app/components/Controller.php');
require_once(ROOT_PATH . '/app/models/Post.php');

class PostsController extends Controller {

  public function index_view() {
    $posts = new Post;
    $posts = $posts->all();
    $this->render('posts/index', ['posts' => $posts]);
  }

  public function index() {
    echo "Posts index";
  }

  public function show($id) {
    echo "Posts show $id";
  }
}