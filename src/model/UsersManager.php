<?php
namespace projet4\src\model;
use projet4\core\Manager;

class UsersManager extends Manager {

    public function getAdmin ($user_name, $password) {
        $admin = $this->prepare('SELECT * FROM users WHERE user = ?', array($user_name), true, true);
        if (!password_verify($password, $admin['password'])) {
            return false;
        }
        return $admin;
    }

}