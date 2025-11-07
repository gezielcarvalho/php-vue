<?php
use Core\Config;
use Core\Router;

spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);
    $file = $root . "/" . str_replace("\\", '/', $class) . ".php";
    if (is_readable($file)) {
        require $root . "/" . str_replace("\\", "/", $class) . ".php";
    }
});

(new Config(__DIR__ . '/.env'))->load();

/**
 * Error and Exception handling
 */
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Routing
 */
$router = new Router();

// Add the routes
$router->add('/', ['controller' => 'App\Controllers\HomeController', 'action' => 'index', 'request' => 'GET']);

// Get route from external URL
$url = $_SERVER['QUERY_STRING'];

// Check if route exists
if ($router->match($url)) {
    $router->dispatch();
} else {
    echo "No route found from URL $url";
}