<?php
$title = 'Connexion';
use projet4\core\Router;
?>
<div class="main-connect">
    <h2>Connexion</h2>
    <p>Page de connexion pour les administrateurs.</p>
    <form action="<?= Router::getUrl('loginAdmin'); ?>" method="post">
        <p>
            <label for="pseudo">Pseudonyme :</label><br>
            <input type="text" name="pseudo" id="pseudo" />
        </p>
        <p>
            <label for="password">Mot de passe :</label><br>
            <input type="password" name="password" id="password" />
        </p>
        <p>
            <input type="submit" value="Se connecter" />
        </p>
    </form>
</div>