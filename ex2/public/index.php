<?php

require_once '../routes.php';
require_once '../define.php';

// Dispatch the current request
Route::dispatch();


// require __DIR__ . '/../bootstrap.php';

// $request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
// $request = trim($request, '/');

// $routes = [
//   'GET' => [
//     '' => ['controller' => __DIR__ . '../app/controllers/PostsController.php', 'method' => 'index'],
//     'posts/show' => ['controller' => __DIR__ . '../app/controllers/PostsController.php', 'method' => 'show'],
//   ]
// ];

// $path = $request;
// $method = $_SERVER['REQUEST_METHOD'];

// foreach ($routes [$method] as $route => $info) {
//   $pattern = preg_replace('#/([0-9]+)#', '/([0-9]+)', $route);
//   if (preg_match("#^$pattern$#", $path, $matches)) {
//     $controller = $info['controller'];
//     $id = $matches[1] ?? null;
    
//     if ($method === 'POST' && $info['mehtod'] !== 'delete') {
//       $controller->{$info['method']}($_POST, $id);
//     } else {
//       $controller->{$info['method']}($id);
//     }
//     break;
//   }
// }

// if (!isset($controller)) {
//   http_response_code(404);
//   include __DIR__ . '/../app/views/404.php';
//   exit;
// }