<?php

use projet4\core\Router;
use projet4\src\controller\Contact;

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
                <input type="text" name="name" id="name" placeholder=" Nom" value="<?php Contact::getValue('name'); ?>" required>
                <label for="mail">Votre e-Mail* :</label>
                <input type="email" name="mail" id="mail" placeholder=" email@exemple.com" value="<?php Contact::getValue('mail'); ?>" required>
            </p>
        </fieldset>
        <fieldset>
            <legend>Votre message</legend>
            <p>
                <label for="subject">Sujet* :</label><br>
                <input type="text" name="subject" id="subject" placeholder=" Sujet du message" value="<?php Contact::getValue('subject'); ?>" required>
            </p>
            <div>
                <label for="message">Ecrivez votre message* :</label><br>
                <textarea id="message" name="message" cols="100" rows="15" required><?php Contact::getValue('message'); ?></textarea>
            </div>
            <p>
                <input type="submit" value="Envoyer le message">
                <input type="reset" value="Effacer le formulaire">
            </p>
        </fieldset>
    </form>
</div>
