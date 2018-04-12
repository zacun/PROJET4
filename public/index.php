<?php
session_start();

define('BASE_URL', '/PROJET4');

use projet4\core\Autoloader;
use projet4\core\Router;

require_once '../core/Autoloader.php';
Autoloader::register();

$router = new Router();
$router->dispatch();