<?php

spl_autoload_register(function ($class) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

$controller = $_GET['controller'] ?? 'index';

$routes = require_once __DIR__ . '/routes.php';

require_once $routes[$controller] ?? die('404');