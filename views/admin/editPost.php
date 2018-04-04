<div class="main-editpost">
    <form action="<?= \projet4\core\Router::getUrl('updatePost'); ?>?postid=<?= $_GET['postid']; ?>" method="post">
        <h1>Edition du chapitre</h1>
        <p>
            <label for="editPostName">Titre du chapitre :</label><br>
            <input type="text" name="editPostName" id="editPostName" value="<?= $editPost['title']; ?>" required>
        </p>
        <p><label for="editPostContent">Ecrivez votre chapitre :</label></p>
        <textarea name="editPostContent" id="editPostContent" rows="20">
            <?= $editPost['content']; ?>
        </textarea>
        <p><input type="submit" value="Sauvegarder les modifications"></p>
    </form>
</div>
