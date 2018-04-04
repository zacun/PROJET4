<?php
use \projet4\core\Router;
?>
<div class="main-admin">
    <h1>Page principale d'administration</h1>
    <nav>
        <a href="<?= Router::getUrl('newPost') ?>"><i class="fas fa-plus"></i> Créer un nouveau chapitre</a>
        <a href="<?= Router::getUrl('reportedComments') ?>"><i class="fas fa-flag"></i> Voir les commentaires signalés</a>
    </nav>
    <section>
        <h2>Liste des chapitres</h2>
        <p>Les chapitres sont classés du plus récent au plus ancien</p>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date d'ajout</th>
                    <th>Titre du chapitre</th>
                    <th>Editer</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allPosts as $post): ?>
                <tr>
                    <td><?= $post['id'] ?></td>
                    <td><?= $post['date_fr'] ?></td>
                    <td><a href="<?= Router::getUrl('chapitre') . '?id=' . $post['id']; ?>"><?= $post['title'] ?></td>
                    <td><a href="<?= Router::getUrl('editPost'); ?>?postid=<?= $post['id']; ?>"><i class="fas fa-edit"></i></a></td>
                    <td><a href="<?= Router::getUrl('deletePost'); ?>?postid=<?= $post['id']; ?>"><i class="fas fa-trash"></i></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>