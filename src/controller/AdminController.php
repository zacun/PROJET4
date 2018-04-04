<?php

require_once '../src/model/PostsManager.php';
require_once '../src/model/CommentsManager.php';

use projet4\core\Controller;

class AdminController extends Controller {

    public function admin() {
        $postsManager = new PostsManager();
        $allPosts = $postsManager->getAllPosts();
        $this->renderAdmin('admin', compact('allPosts'));
    }

    /**
     * Add a new post into db
     */
    public function addNewPost() {
        $postsManager = new PostsManager();
        if (!empty($_POST['newPostName']) && !empty($_POST['newPostContent'])) {
            $newPost = $postsManager->addNewPost($_POST['newPostName'], $_POST['newPostContent']);
            header('Location: ' . \projet4\core\Router::getUrl('admin'));
        } else {
            throw new Exception('Impossible d\'ajouter le chapitre : informations manquantes');
        }
    }

    /**
     * Update a post
     */
    public function updatePost() {
        $postManager = new PostsManager();
        if (isset($_GET['postid']) && $_GET['postid'] > 0) {
            if (!empty($_POST['editPostName']) && !empty($_POST['editPostContent'])) {
                $editedPost = $postManager->updatePost(
                    $_POST['editPostName'],
                    $_POST['editPostContent'],
                    $_GET['postid']
                );
                header('Location: ' . BASE_URL . '/chapitre?id=' . $_GET['postid']);
            } else {
                throw new Exception('Des champs sont vides.');
            }
        } else {
            throw new Exception('Ce chapitre n\'existe pas');
        }
    }

    /**
     * Delete a post
     */
    public function deletePost() {
        $postsManager = new PostsManager();
        if (isset($_GET['postid']) && $_GET['postid'] > 0) {
            $postToDelete = $postsManager->deletePost(htmlspecialchars($_GET['postid']));
            header('Location: ' . \projet4\core\Router::getUrl('admin'));
        } else {
            throw new Exception('Le chapitre n\'existe pas.');
        }
    }

    /**
     * Go to reported comments
     */
    public function reportedComments() {
        $this->renderAdmin('reportedComments');
    }

    /**
     * Go to newPost page
     */
    public function newPost() {
        $this->renderAdmin('newPost');
    }

    /**
     * Go to edit post page with the right post to edit.
     */
    public function editPost() {
        $postsManager = new PostsManager();
        if (isset($_GET['postid']) && $_GET['postid'] > 0) {
            $editPost = $postsManager->getOnePost(htmlspecialchars($_GET['postid']));
            $this->renderAdmin('editPost', compact('editPost'));
        } else {
            throw new Exception('Impposible d\'éditer un chapitre qui n\'existe pas');
        }
    }

}