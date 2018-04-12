<?php
namespace projet4\src\manager;

use projet4\core\Manager;

class CommentsManager extends Manager {

    public function getCommentsByPost($post_id) {
        $req = $this->prepare(
            'SELECT id, post_id, user_id, author, content, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS date_fr, reported 
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
                        array($post_id, $author, $content), false
        );
        return $req;
    }

    public function reportComment($comment_id) {
        $req = $this->prepare(
            'UPDATE comments 
                        SET reported = reported + 1
                        WHERE id = ?', array($comment_id), false
        );
        return $req;
    }

    public function removeReportedTag($comment_id) {
        $req = $this->prepare(
            'UPDATE comments 
                        SET reported = 0 
                        WHERE id = ?', array($comment_id), false
        );
        return $req;
    }

    public function getReportedComments() {
        $req = $this->query(
            'SELECT comments.id, comments.author, comments.content, comments.reported, 
                        DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS date_fr, 
                        posts.title AS linked_title,
                        posts.id AS linked_chapter
                        FROM comments
                        LEFT JOIN posts
                        ON comments.post_id = posts.id
                        WHERE comments.reported >= 1
                        ORDER BY comments.reported DESC'
        );
        return $req;
    }

    public function getAllComments() {
        $req = $this->query(
            'SELECT comments.id, comments.author, comments.content, 
                        DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS date_fr, 
                        posts.title AS linked_title,
                        posts.id AS linked_chapter
                        FROM comments
                        LEFT JOIN posts
                        ON comments.post_id = posts.id
                        ORDER BY comment_date DESC'
        );
        return $req;
    }

    public function deleteComment($comment_id) {
        $req = $this->prepare(
            'DELETE FROM comments WHERE id = ?',
            array($comment_id), false
        );
        return $req;
    }

}