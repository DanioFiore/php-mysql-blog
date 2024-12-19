<?php
class Route {
  private static $routes = [];

  public static function get($uri, $action) {
    self::addRoute('GET', $uri, $action);
  }

  public static function post($uri, $action) {
    self::addRoute('POST', $uri, $action);
  }

  public static function delete($uri, $action) {
    self::addRoute('DELETE', $uri, $action);
  }

  private static function addRoute($method, $uri, $action) {
    $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[a-zA-Z0-9_-]+)', trim($uri, '/'));
    self::$routes[] = [
      'method' => $method,
      'pattern' => '#^' . $pattern . '$#',
      'action' => $action,
    ];
  }

  public static function dispatch() {
    $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    foreach (self::$routes as $route) {
      if ($route['method'] === $requestMethod && preg_match($route['pattern'], $requestUri, $matches)) {
        array_shift($matches); // Remove the full match

        if (is_callable($route['action'])) {
          return call_user_func_array($route['action'], $matches);
        } elseif (is_string($route['action'])) {
          return self::callControllerMethod($route['action'], $matches);
        }
      }
    }

    http_response_code(404);
    include ROOT_PATH . '/app/views/404.php';
    exit();
  }

  private static function callControllerMethod($action, $parameters = []) {
    list($controllerName, $method) = explode('@', $action);
    $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

    if (file_exists($controllerFile)) {
      require_once $controllerFile;
      $controller = new $controllerName();

      if (method_exists($controller, $method)) {
        return call_user_func_array([$controller, $method], $parameters);
      }
    }

    die("Controller or method not found: $action");
  }
}
