<?php

require_once(__DIR__ . './../components/Controller.php');

class PostsController extends Controller {
  public function index() {
    echo "Posts index";
  }

  public function show($id) {
    echo "Posts show $id";
  }
}