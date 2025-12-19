<?php

session_start();

// ============================
// AUTOLOAD GENERAL
// ============================
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/';
    $file = $baseDir . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// ============================
// UTILIDADES
// ============================
require_once __DIR__ . '/Utilities/Validators.php';

// ============================
// CONTROLADOR SOLICITADO
// ============================
$page = $_GET['page'] ?? 'Productos';

// Ruta REAL del archivo del controlador
$controllerFile = __DIR__ . '/Controllers/' . $page . '.php';
$controllerClass = 'Controllers\\' . $page;

// 🔴 ESTE ERA EL PROBLEMA: EL ARCHIVO NUNCA SE INCLUÍA
if (!file_exists($controllerFile)) {
    http_response_code(404);
    die("Controlador no encontrado (archivo): Controllers/$page.php");
}

require_once $controllerFile;

// ============================
// VALIDAR CLASE
// ============================
if (!class_exists($controllerClass)) {
    http_response_code(500);
    die("Controlador no encontrado (clase): $controllerClass");
}

// ============================
// EJECUTAR
// ============================
$controller = new $controllerClass();
$controller->run();
