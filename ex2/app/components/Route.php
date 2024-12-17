<?php

class Route {
  private static $routes = [];

  /**
   * Define a GET route.
   *
   * @param string $uri The URI of the route.
   * @param callable|string $action The controller method or callback function.
   */
  public static function get($uri, $action)
  {
    self::addRoute('GET', $uri, $action);
  }

  /**
   * Define a POST route.
   *
   * @param string $uri The URI of the route.
   * @param callable|string $action The controller method or callback function.
   */
  public static function post($uri, $action)
  {
    self::addRoute('POST', $uri, $action);
  }

  /**
   * Add a route to the route list.
   *
   * @param string $method The HTTP method (GET, POST, etc.).
   * @param string $uri The URI of the route.
   * @param callable|string $action The controller method or callback function.
   */
  private static function addRoute($method, $uri, $action)
  {
    self::$routes[] = [
      'method' => $method,
      'uri' => trim($uri, '/'),
      'action' => $action
    ];
  }

  /**
   * Handle the incoming request.
   */
  public static function dispatch()
  {
    $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    foreach (self::$routes as $route) {
      if ($route['method'] === $requestMethod && $route['uri'] === $requestUri) {
        if (is_callable($route['action'])) {
          // If the action is a closure or callable, execute it
          return call_user_func($route['action']);
        } elseif (is_string($route['action'])) {
          // If the action is a string "Controller@method", resolve and call it
          return self::callControllerMethod($route['action']);
        }
      }
    }

    // If no route is matched, send a 404 response
    http_response_code(404);
    include ROOT_PATH . '/app/views/404.php';
    exit();
  }

  /**
   * Call the specified controller method.
   *
   * @param string $action The controller and method in the format "Controller@method".
   */
  private static function callControllerMethod($action)
  {
    list($controllerName, $method) = explode('@', $action);

    $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

    if (file_exists($controllerFile)) {
      require_once $controllerFile;
      $controller = new $controllerName();

      if (method_exists($controller, $method)) {
        return $controller->$method();
      }
    }

    die("Controller or method not found: $action");
  }
}
