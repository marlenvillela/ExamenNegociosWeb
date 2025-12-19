<?php

session_start();

spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/';
    $path = $baseDir . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

require_once __DIR__ . '/Utilities/Validators.php';

$page = $_GET['page'] ?? 'Productos';

$controllerClass = "Controllers\\{$page}";

if (!class_exists($controllerClass)) {
    http_response_code(404);
    die("Controlador no encontrado: " . htmlspecialchars($controllerClass));
}

$controller = new $controllerClass();
$controller->run();
