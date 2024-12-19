<?php

require_once(ROOT_PATH . '/app/components/Controller.php');

class HomeController extends Controller {
  public function indexView() {
    $this->render('base_page', ['content' => (ROOT_PATH . '/app/views/home/index.php')]);
  }
}