<?php

$app = new \Cilex\Application('Dave AI', '1.0.0');

/**
 * Recursively load all php files.
 *
 * @param string $root
 */
$load = function ($root) use (&$load, &$app, &$container) {
    $extension = 'php';
    foreach (glob($root . '/*') as $path) {
        if (is_file($path) && pathinfo($path, PATHINFO_EXTENSION) === $extension) {
            /** @noinspection PhpIncludeInspection */
            require_once $path;
        } elseif (is_dir($path)) {
            $load($path);
        }
    }
};

$load(__DIR__ . '/services');

/** Package Tools */
$app->command(new DaveAI\Say());

return $app;
