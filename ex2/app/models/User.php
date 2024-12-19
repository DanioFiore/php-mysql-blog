<?php
require_once(ROOT_PATH . '/app/components/Model.php');

class User extends Model
{
  protected $table = 'users';
  public $id;
  public $email;
}
