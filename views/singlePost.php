<?php
use projet4\core\Router;
?>
<div class="main-singlepost">
    <section class="singlepost-post">
        <h2><?= $singlePost['title']; ?></h2>
        <div><?= $singlePost['content'] ?></div>
    </section>
    <section class="singlepost-comments">
        <div class="comment-form">
            <form action="<?= Router::getUrl('addComment'); ?>?postid=<?= $_GET['id'] ?>" method="post">
                <h3>Ajouter un commentaire</h3>
                <p>
                    <label for="comment-author">Votre nom :</label><br>
                    <input type="text" name="comment-author" id="comment-author" required>
                </p>
                <p>
                    <label for="comment-content">Message :</label><br>
                    <textarea name="comment-content" id="comment-content" rows="7" cols="30" required></textarea>
                </p>
                <p>
                    <input type="submit" value="Envoyer le commentaire">
                </p>
            </form>
        </div>
        <div class="comments-container">
            <h3>Liste des commentaires</h3>
            <p>Les commentaires sont classés du plus récent au plus ancien.</p>
            <?php foreach ($commentsByPost as $comment): ?>
                <div>
                    <p><strong><?= $comment['author']; ?></strong>, <small>le <?= $comment['date_fr']; ?></small></p>
                    <p><?= $comment['content']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>