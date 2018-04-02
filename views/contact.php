<div class="main-contact">
    <h2>Formulaire de contact</h2>
    <p>
        Pour me contacter, veuillez utiliser le formulaire ci-dessous.<br>
        Tous les champs sont obligatoires.
    </p>
    <form action="" method="post">
        <fieldset>
            <legend>Vos infos de contact</legend>
            <p>
                <label for="lastname">Votre nom* :</label><br>
                <input type="text" name="lastname" id="lastname" placeholder=" Nom" required>
            </p>
            <p>
                <label for="firstname">Votre prénom* :</label><br>
                <input type="text" name="firstname" id="firstname"placeholder=" Prénom" required>
            </p>
            <p>
                <label for="mail">Votre e-Mail* :</label><br>
                <input type="email" name="mail" id="mail" placeholder=" email@exemple.com" required>
            </p>
        </fieldset>
        <fieldset>
            <legend>Votre message</legend>
            <p>
                <label for="message">Ecrivez votre message* :</label><br>
                <textarea id="message" cols="100" rows="15" required></textarea>
            </p>
            <p>
                <input type="submit" value="Envoyer le message">
                <input type="reset" value="Effacer le formulaire">
            </p>
        </fieldset>
    </form>
</div>
