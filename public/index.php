<?php declare(strict_types=1);
define('LARAVEL_START', microtime(true));
date_default_timezone_set('UTC');
$_SERVER['APPLICATION_ENV'] = 'development';

if (isset($_SERVER['APPLICATION_ENV']) && $_SERVER['APPLICATION_ENV'] === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set("display_startup_errors", '1');
    ini_set("log_errors", '1');
} else {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
    ini_set('display_errors', '0');
    ini_set("display_startup_errors", '0');
    ini_set("log_errors", '1');
}
chdir(dirname(__DIR__));

if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (is_string($path) && __FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// Composer autoloader
include __DIR__ . '/../vendor/autoload.php';

if (!class_exists(\Illuminate\Foundation\Application::class)) {
    throw new RuntimeException(
        "Unable to load application.\n"
        . "- Type `composer install` if you are developing locally.\n"
        . "- Type `vagrant ssh -c 'composer install'` if you are using Vagrant.\n"
        . "- Type `docker-compose run lamians composer install` if you are using Docker.\n"
    );
}
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$response->send();
$kernel->terminate($request, $response);
