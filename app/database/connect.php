<?php

/**
 * Establishes a connection to the MySQL database using MySQL interface.
 *
 * Configuration:
 * - Host: localhost
 * - User: root
 * - Password: root
 * - Database: blog
 *
 * If the connection fails, the script will terminate and output an error message.
 *
 * @throws Exception if the database connection fails
 */

$host = 'db';
$user = 'root';
$pass = 'root';
$db = 'blog';

$conn = new MySQLi($host, $user, $pass, $db);

if ($conn->connect_error) {
  die('Database connection error: ' . $conn->connect_error);
}