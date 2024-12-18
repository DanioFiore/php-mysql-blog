<?php

require_once(ROOT_PATH . '/app/components/Controller.php');

class HomeController extends Controller {
  public function index_view() {
    $this->render('base_page', ['title' => 'Home', 'content' => (ROOT_PATH . '/app/views/home/index.php')]);
  }
}