<?php
$title = 'Editer le chapitre';
use \projet4\core\Router;
?>
<div class="main-editpost">
    <form action="<?= Router::getUrl('updatePost'); ?>?postid=<?= $_GET['postid']; ?>" method="post">
        <h1>Edition du chapitre</h1>
        <p>
            <label for="editPostName">Titre du chapitre :</label><br>
            <input type="text" name="editPostName" id="editPostName" value="<?= $editPost['title']; ?>" required>
        </p>
        <p><label for="editPostContent">Ecrivez votre chapitre :</label></p>
        <textarea name="editPostContent" id="editPostContent" rows="50">
            <?= $editPost['content']; ?>
        </textarea>
        <p><input type="submit" value="Sauvegarder les modifications"></p>
    </form>
</div>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector:'textarea',
        resize: 'both'
    });
</script>
