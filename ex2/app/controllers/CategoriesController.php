<?php

require_once(ROOT_PATH . '/app/components/Controller.php');

class CategoriesController extends Controller {
  public function index() {
    echo "Categories index";
  }

  public function create() {
    echo "Categories create";
  }

  public function delete($id) {
    echo "Categories delete $id";
  }
}