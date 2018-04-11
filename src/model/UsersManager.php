<?php
namespace projet4\src\manager;
use projet4\core\Manager;

class UsersManager extends Manager {

    public function getAdmin ($user_name) {
        $req = $this->prepare('SELECT * FROM users WHERE user = ?', array($user_name), true, true);
        return $req;
    }

}