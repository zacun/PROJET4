<?php

define('BASE_URL', '/projet4/public');

use projet4\core\Autoloader;
use projet4\core\Router;

require_once '../core/Autoloader.php';
Autoloader::register();

$router = new Router();
$router->dispatch();