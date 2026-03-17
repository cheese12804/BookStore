<?php

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../app/';

    if (str_starts_with($class, $prefix)) {
        $relative = substr($class, strlen($prefix));
        $file = $baseDir . str_replace('\\', '/', $relative) . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
});

use App\Controllers\HomeController;
use App\Core\Router;

$router = new Router();
$router->get('/', [HomeController::class, 'index']);

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
if ($basePath && $basePath !== '/') {
    $uri = '/' . ltrim(str_replace($basePath, '', $uri), '/');
}

$router->dispatch($_SERVER['REQUEST_METHOD'] ?? 'GET', $uri);
