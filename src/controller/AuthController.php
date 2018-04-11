<?php

require_once '../src/model/UsersManager.php';

use projet4\core\Controller;
use projet4\src\manager\UsersManager;
use projet4\core\Router;

class AuthController extends Controller {

    public function loginAdmin() {
        if (empty($_POST['pseudo']) || empty($_POST['password'])) {
            throw new Exception('Le pseudo et le mot de passe sont incorrects');
        }
        $usersManager = new UsersManager();
        $admin = $usersManager->getAdmin(htmlspecialchars($_POST['pseudo']));
        if (!$admin) {
            throw new Exception('Le pseudo et le mot de passe sont inccorects');
        }
        if (password_verify(htmlspecialchars($_POST['password']), $admin['password']) === false) {
            throw new Exception('Le pseudo et le mot de passe sont inccorects');
        }
        $_SESSION['admin'] = ['pseudo' => $admin['user'], 'role' => $admin['role']];
        header('Location: ' . Router::getUrl('admin'));
    }

    public static function loggedAdmin() {
        return isset($_SESSION['admin']);
    }

    public function logout() {
        session_destroy();
        header('Location: ' . Router::getUrl('accueil'));
    }

}