<?php

use projet4\core\Manager;

class PostsManager extends Manager {

    public function getAllPosts() {
        $req = $this->query('SELECT id, title, content, post_date FROM posts ORDER BY post_date');
        return $req;
    }

}