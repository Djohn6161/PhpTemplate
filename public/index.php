<?php
require_once __DIR__ . '/../config.php'; // Adjust the path accordingly

// Now you can use the config() function
$appName = config('app.name');
// echo $appName;
require_once __DIR__ . '/../vendor/autoload.php';
$routes = require_once __DIR__ . '/../routes/web.php';

$requestUri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if (array_key_exists($requestUri, $routes)) {
    list($controller, $action) = explode('@', $routes[$requestUri]);

    require_once __DIR__ . '/../app/Controllers/' . $controller . '.php';

    $controllerInstance = new $controller();
    $controllerInstance->$action();
} else {
    http_response_code(404);
    echo "404 - Not Found";
}