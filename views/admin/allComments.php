<?php
use projet4\core\Router;
use projet4\core\Controller;
?>
<div class="main-allcomments">
    <h2>Liste des commentaires</h2>
    <p>Les commentaires sont classés du plus récent au plus ancien</p>
    <section>
        <table>
            <thead>
            <tr>
                <th>Date d'ajout</th>
                <th>Auteur</th>
                <th>Contenu</th>
                <th>Chapitre lié</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($allComments as $comment): ?>
                <tr>
                    <td><?= $comment['date_fr']; ?></td>
                    <td><?= $comment['author']; ?></td>
                    <td><?= Controller::getExcerpt($comment['content'], 100, false); ?></td>
                    <td><a href="<?= Router::getUrl('chapitre'); ?>?id=<?= $comment['linked_chapter']; ?>"><?= $comment['linked_title']; ?></a></td>
                    <td><a href="<?= Router::getUrl('deleteComment'); ?>?commentid=<?= $comment['id']; ?>"><i class="fas fa-trash"></i></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>
