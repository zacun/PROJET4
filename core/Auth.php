<?php
namespace projet4\core;


class Auth {

    public static function isLogged() {
        return isset($_SESSION['admin']);
    }

}