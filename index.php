<?php
session_start();
require_once __DIR__ . '/config/index.php';
require_once __DIR__ . '/routes/web.php';

// Get and parse the URI
$fullPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = substr($fullPath, strlen($basePath));
$uri = ltrim($uri, '/'); // to remove any leading slash
$segments = explode('/', $uri);

// Build the route key from the segments
$routeKey = implode('/', array_slice($segments, 1)); // Get all segments except the first one
// var_dump($routeKey);
// exit();

// Flag to check if a route has been matched
$routeMatched = false;

// Check if the route key exists in the routes array
foreach ($routes as $routePattern => $route) {
    // Convert the route pattern to a regex
    $pattern = preg_replace('/\{(\w+)\}/', '([^/]+)', $routePattern);
    // var_dump("#^$pattern$#");
    // exit(); 
    if (preg_match("#^$pattern$#", $routeKey, $matches)) {
        array_shift($matches); // Remove the full match from the array
        $params = $matches; // Remaining matches are the parameters

        $controllerName = $route['controller'];
        $methodName = $route['method'];

        // Require the controller file
        require_once __DIR__ . "/app/controllers/$controllerName.php";

        // Instantiate the controller and call the method with parameters
        $controller = new $controllerName();
        call_user_func_array([$controller, $methodName], $params);
        
        $routeMatched = true; // Set the flag that a route was matched
        break; // Exit the loop once a match is found
    }
}

// If no route matches, show a 404 page
if (!$routeMatched) {
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found";
}