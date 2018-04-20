<?php

use projet4\core\Router;

$title = 'Contact';
?>
<div class="main-contact">
    <h2>Formulaire de contact</h2>
    <p>
        Pour me contacter, veuillez utiliser le formulaire ci-dessous.<br>
        *Tous les champs sont obligatoires.
    </p>
    <form action="<?= Router::getUrl('getMailInfos') ?>" method="post">
        <fieldset>
            <legend>Vos infos de contact</legend>
            <p>
                <label for="lastname">Votre nom* :</label>
                <input type="text" name="name" id="name" placeholder=" Nom" value="<?= $name; ?>" required>
                <label for="mail">Votre e-Mail* :</label>
                <input type="email" name="mail" id="mail" placeholder=" email@exemple.com" value="<?= $mail; ?>" required>
            </p>
        </fieldset>
        <fieldset>
            <legend>Votre message</legend>
            <p>
                <label for="subject">Sujet* :</label><br>
                <input type="text" name="subject" id="subject" placeholder=" Sujet du message" value="<?= $subject; ?>" required>
            </p>
            <div>
                <label for="message">Ecrivez votre message* :</label><br>
                <textarea id="message" name="message" cols="100" rows="15" required><?= $message; ?></textarea>
            </div>
            <p>
                <input type="submit" value="Envoyer le message">
            </p>
        </fieldset>
    </form>
</div>
