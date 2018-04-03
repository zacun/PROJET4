<?php

use projet4\core\Manager;

class CommentsManager extends Manager {

    public function getCommentsByPost($post_id) {
        $req = $this->prepare(
            'SELECT id, post_id, author, content, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS date_fr 
                        FROM comments
                        WHERE post_id = ?
                        ORDER BY comment_date DESC',
                        array($post_id)
                        );
        return $req;
    }

    public function addComment($post_id, $author, $content) {
        $req = $this->prepare(
            'INSERT INTO comments(post_id, author, content, comment_date) 
                        VALUES (?, ?, ?, NOW())',
                        array($post_id, $author, $content),
                        false
                        );
        return $req;
    }

    public function getAllComments() {

    }
}