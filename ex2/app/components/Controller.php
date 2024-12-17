<?php

class Controller {
  /**
   * Renders a view and passes data to it.
   *
   * @param string $view The name of the view file (without extension).
   * @param array $data Data to pass to the view.
   * @return void
   */
  protected function render($view, $data = []) {
    // Extract data as variables for the view
    extract($data);

    // Path to the view file
    $viewPath = __DIR__ . '/../views/' . $view . '.php';

    // Check if the view file exists
    if (file_exists($viewPath)) {
      require $viewPath;
    } else {
      die("The view '$view' was not found.");
    }
  }

  /**
   * Redirects to a different URL.
   *
   * @param string $url The destination URL.
   * @return void
   */
  protected function redirect($url) {
    header("Location: $url");
    exit;
  }

  /**
   * Retrieves data from an HTTP request (GET or POST).
   *
   * @param string $key The parameter key.
   * @param mixed $default The default value if the key is not found.
   * @return mixed
   */
  protected function input($key, $default = null)
  {
    return $_REQUEST[$key] ?? $default;
  }

  /**
   * Sets a flash message in the session.
   *
   * @param string $key The message key.
   * @param string $message The message content.
   * @return void
   */
  protected function setFlash($key, $message) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['flash'][$key] = $message;
  }

  /**
   * Retrieves a flash message from the session.
   *
   * @param string $key The message key.
   * @return string|null
   */
  protected function getFlash($key) {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    if (isset($_SESSION['flash'][$key])) {
      $message = $_SESSION['flash'][$key];
      unset($_SESSION['flash'][$key]); // Remove the message after reading it
      return $message;
    }
    return null;
  }

  /**
   * Checks if the current request is a POST request.
   *
   * @return bool
   */
  protected function isPost() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
  }

  /**
   * Checks if the current request is a GET request.
   *
   * @return bool
   */
  protected function isGet() {
    return $_SERVER['REQUEST_METHOD'] === 'GET';
  }

}
