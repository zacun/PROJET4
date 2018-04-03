<?php
use projet4\core\Router;
?>
<div class="main-allposts">
    <h2>Liste des chapitres</h2>
    <p>Les chapitres sont classés du plus récent au plus ancien.</p>
    <div class="posts-container">
        <?php foreach ($allPosts as $post): ?>
            <div class="post">
                <div class="post-title"><p><?= $post['title']; ?></p></div>
                <div class="post-infos">
                    <div class="post-date"><small>Ajouté le<br> <?= $post['date_fr']; ?></small></div>
                    <div class="post-read"><a href="<?= Router::getUrl('chapitre') . '?id=' . $post['id'] ?>">Lire le chapitre</a></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>