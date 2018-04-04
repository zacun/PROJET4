<div class="main-newpost">
    <form action="<?= \projet4\core\Router::getUrl('addNewPost') ?>" method="post">
        <h1>Nouveau chapitre</h1>
        <p>
            <label for="newPostName">Titre du chapitre :</label><br>
            <input type="text" name="newPostName" id="newPostName" required>
        </p>
        <p><label for="newPostContent">Ecrivez votre chapitre :</label></p>
        <textarea name="newPostContent" id="newPostContent" rows="50"></textarea>
        <p><input type="submit" value="Ajouter le nouveau chapitre"></p>
    </form>
</div>
