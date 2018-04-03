<?php
use projet4\core\Router;
?>
<div class="main-home">
    <section class="welcome-message">
        <h2>Bienvenue sur mon site !</h2>
        <p>Sur ce site, vous trouverez tous les chapitres de mon livre :</p>
        <h3>&laquo; <i>Billet simple pour l'Alaska</i> &raquo;</h3>
        <p>
            Le livre est en pleine écriture et les chapitres seront ajoutés dès qu'ils seront terminés.<br>
            Vous pourrez donc suivre l'histoire au fur et à mesure que je l'écris !!
        </p>
        <p>
            N'hésitez pas à commenter les chapitres pour me dire ce que vous en pensez !<br>
            Cela me donnera un premier feedback...Et si vous voyez des fautes, typos ou autres...n'hésitez pas non plus !
        </p>
        <p><strong>Bonne lecture !</strong></p>
    </section>
    <section class="last-posts">
        <h2>Derniers chapitres ajoutés</h2>
        <?php foreach ($lastAddedPosts as $lastPost): ?>
            <div class="post-excerpt">
                <div>
                    <p class="excerpt-title"><?= $lastPost['title']; ?></p>
                    <p><small><?= $lastPost['date_fr']; ?></small></p>
                </div>
                <div class="excerpt-content">
                    <p><?= PagesController::getExcerpt($lastPost['content']); ?></p>
                </div>
                <div class="excerpt-link-to-post">
                    <a href="<?= Router::getUrl('chapitre') . '?id=' . $lastPost['id']; ?>">Lire la suite</a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</div>