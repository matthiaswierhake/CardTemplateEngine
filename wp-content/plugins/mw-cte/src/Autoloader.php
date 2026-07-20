<?php

declare(strict_types=1);

spl_autoload_register(static function (string $class): void {

    $prefix = 'CTE\\';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relative = substr($class, strlen($prefix));

    $file = __DIR__ . '/'
        . str_replace('\\', DIRECTORY_SEPARATOR, $relative)
        . '.php';

    if (is_file($file)) {
        require_once $file;
    }

});