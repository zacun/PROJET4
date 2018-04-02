<?php

use projet4\core\Manager;

class PostsManager extends Manager {

    public function getAllPosts() {
        $req = $this->query('SELECT id, title, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin\') AS date_fr
                                        FROM posts 
                                        ORDER BY post_date DESC 
                                        ');
        return $req;
    }

}