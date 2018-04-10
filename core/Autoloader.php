<?php
namespace projet4\core;

/**
 * Class Autoloader
 * Simple Autoloader.
 */
class Autoloader {

    static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class_name) {
        if (strpos($class_name, 'projet4\\') === 0) {
            $class_name = str_replace('projet4\\', '', $class_name);
            $class_name = str_replace('\\', '/', $class_name);
            require_once  __DIR__ . '/../' . $class_name . '.php';
        }
    }

}