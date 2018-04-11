<?php
require_once '../src/controller/AuthController.php';
use projet4\core\Router;
?>
<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="utf-8" />
    <link href="../public/css/style.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <title><?= 'Jean F. | ' . $title; ?></title>
</head>

<body>
    <header>
        <h1 class="header-name">Jean Forteroche</h1>
        <img class="header-photo" src="../public/images/portrait.png" alt="Photo de profil"/>
        <div class="header-biography">
            <p>Rêveur, voyageur et créatif depuis mon plus jeune âge, il était évident que je devienne écrivain afin de conter mes histoires et voyages.</p>
            <p>
                Retrouvez sur ce site, les chapitres de mon dernier livre :<br />
                <span class="book-name"><i>&laquo; Billet simple pour l'Alaska</i> &raquo;,</span><br />
                qui y seront ajoutés au fur et à mesure.
            </p>
        </div>
        <div class="header-social">
            <a href="https://twitter.com/"><i class="fab fa-twitter-square fa-3x"></i></a>
            <a href="https://www.facebook.com/"><i class="fab fa-facebook-square fa-3x"></i></a>
        </div>
    </header>
    <div class="site-content">
        <nav>
            <a href="<?= Router::getUrl('accueil'); ?>"><i class="fas fa-home"></i> Accueil</a>
            <a href="<?= Router::getUrl('chapitres'); ?>"><i class="fas fa-book"></i> Tous les chapitres</a>
            <a href="<?= Router::getUrl('contact'); ?>"><i class="fas fa-envelope-square"></i> Me contacter</a>
            <?php
            if (AuthController::loggedAdmin()) {
                echo '<a href="' . Router::getUrl('admin') . '"><i class="fas fa-cogs"></i> Administration</a>';
            }
            ?>
        </nav>
        <main>
            <?= $content; ?>
        </main>
        <footer>
            <div class="copyright">© 2018 Jean Forteroche</div>
            <?php
            if (AuthController::loggedAdmin()) {
                echo '<div class="connexion"><small><a href="' . Router::getUrl('logout') . '"><i class="fas fa-sign-out-alt"></i> Deconnexion</a></small></div>';
            } else {
                echo '<div class="connexion"><small><a href="' . Router::getUrl('connexion') . '"><i class="fas fa-sign-in-alt"></i> Connexion</a></small></div>';
            }
            ?>
        </footer>
    </div>
</body>
</html>