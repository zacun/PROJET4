<?php
namespace projet4\src\controller;

use projet4\core\Controller;
use projet4\src\model\UsersManager;
use projet4\core\Router;
use projet4\core\Alert;

class AuthController extends Controller {

    public function loginAdmin() {
        $usersManager = new UsersManager();
        $admin = $usersManager->getAdmin($_POST['pseudo'], $_POST['password']);
        if (empty($_POST['pseudo']) || empty($_POST['password']) || !$admin) {
            Alert::setAlert('Identifiants incorrects', 'error');
            header('Location: ' . Router::getUrl('connexion'));
            exit();
        }
        $_SESSION['admin'] = ['pseudo' => $admin['user'], 'role' => $admin['role']];
        header('Location: ' . Router::getUrl('admin'));
    }

    public function logout() {
        unset($_SESSION['admin']);
        header('Location: ' . Router::getUrl('accueil'));
    }

}