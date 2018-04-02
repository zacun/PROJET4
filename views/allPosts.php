<h1>All Posts</h1>

<?php foreach ($allPosts as $post): ?>
    <div>
        <h2><?= $post['title']; ?></h2>
        <small>Posté le <?= $post['post_date']; ?></small>
        <p><?= $post['content']; ?></p>
    </div>
<?php endforeach; ?>
