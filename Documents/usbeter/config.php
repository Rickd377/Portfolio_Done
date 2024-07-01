<?php

spl_autoload_register(function ($class_name) {
    $source = __DIR__ . '/';
    $dirs = [
        'extra/',
        'model/',
        'controller/',
        'view/',
    ];

    foreach ($dirs as $dir) {
        if (file_exists($source . $dir . $class_name . '.php')) {
            require $source . $dir . $class_name . '.php';
        }
    }
});