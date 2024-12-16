<?php
// this bootstrap our db connectivity
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define("BASE_DIR", __DIR__);
require_once(BASE_DIR . '/vendor/autoload.php');
require_once(BASE_DIR . '/config/db.php');