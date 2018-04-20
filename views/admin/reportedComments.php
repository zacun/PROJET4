<?php
use projet4\core\Router;
use projet4\core\Controller;
$title = 'Commentaires signalés';
?>
<div class="main-reported">
    <h2>Liste des commentaires signalés</h2>
    <p>Les commentaires signalés sont classés en fonction de leur nombre de signalements</p>
    <section>
        <table>
            <thead>
            <tr>
                <th>Nb signalements</th>
                <th>Auteur</th>
                <th>Contenu</th>
                <th>Chapitre lié</th>
                <th>Enlever<br>signalement</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($getReportedComments as $comment): ?>
                <tr>
                    <td><?= $comment['reported']; ?></td>
                    <td><?= $comment['author']; ?></td>
                    <td><?= Controller::getExcerpt($comment['content'], 100, false); ?></td>
                    <td><a href="<?= Router::getUrl('chapitre'); ?>?id=<?= $comment['linked_chapter']; ?>"><?= $comment['linked_title']; ?></a></td>
                    <td><a href="<?= Router::getUrl('removeReportedTag'); ?>?commentid=<?= $comment['id']; ?>"><i class="fas fa-times"></i></a></td>
                    <td><a href="<?= Router::getUrl('deleteComment'); ?>?commentid=<?= $comment['id']; ?>&reportpage=1"><i class="fas fa-trash"></i></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>
