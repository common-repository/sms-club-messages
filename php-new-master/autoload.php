<?php

require_once 'config.php';

spl_autoload_register(function($className) {
    $parts = explode('\\', $className);
    $fileName = __DIR__ . '\\src\\' . $parts[1] . '\\' . end($parts);
    $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $fileName);

    require_once $fileName . '.php';
});
