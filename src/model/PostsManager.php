<?php

use projet4\core\Manager;

class PostsManager extends Manager {

    public function getAllPosts() {
        $req = $this->query(
            'SELECT id, title, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin\') AS date_fr
                        FROM posts 
                        ORDER BY post_date DESC 
                        ');
        return $req;
    }

    public function getOnePost($post_id) {
        $req = $this->prepare(
            'SELECT id, title, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin\') AS date_fr 
                        FROM posts
                        WHERE id = ?',
                        array($post_id), true, true
                        );
        return $req;
    }

    public function lastAddedPosts() {
        $req = $this->query(
            'SELECT id, title, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin\') AS date_fr 
                        FROM posts
                        ORDER BY post_date DESC
                        LIMIT 0, 2
                        ');
        return $req;
    }

}