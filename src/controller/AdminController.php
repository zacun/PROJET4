<?php

require_once '../src/model/PostsManager.php';
require_once '../src/model/CommentsManager.php';

use projet4\core\Controller;
use projet4\core\Router;

class AdminController extends Controller {

    /**
     * Main admin page
     */
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
        if (empty($_POST['newPostName']) && empty($_POST['newPostContent'])) {
            throw new Exception('Impossible d\'ajouter le chapitre : informations manquantes');
        }
        $newPost = $postsManager->addNewPost($_POST['newPostName'], $_POST['newPostContent']);
        header('Location: ' . Router::getUrl('admin'));
    }

    /**
     * Update a post
     */
    public function updatePost() {
        $postManager = new PostsManager();
        if (!isset($_GET['postid']) && $_GET['postid'] <= 0) {
            throw new Exception('Ce chapitre n\'existe pas');
        }
        if (empty($_POST['editPostName']) && empty($_POST['editPostContent'])) {
                throw new Exception('Des champs sont vides.');
        }
        $editedPost = $postManager->updatePost(
            $_POST['editPostName'],
            $_POST['editPostContent'],
            $_GET['postid']
        );
        header('Location: ' . BASE_URL . '/chapitre?id=' . $_GET['postid']);
    }

    /**
     * Delete a post
     */
    public function deletePost() {
        $postsManager = new PostsManager();
        if (!isset($_GET['postid']) && $_GET['postid'] <= 0) {
            throw new Exception('Le chapitre n\'existe pas.');
        }
        $postToDelete = $postsManager->deletePost(htmlspecialchars($_GET['postid']));
        header('Location: ' . Router::getUrl('admin'));
    }

    /**
     * Go to reported comments
     */
    public function reportedComments() {
        $commentsManager = new CommentsManager();
        $getReportedComments = $commentsManager->getReportedComments();
        $this->renderAdmin('reportedComments', compact('getReportedComments'));
    }

    /**
     * Go to all comments
     */
    public function allComments() {
        $commentsManager = new CommentsManager();
        $allComments = $commentsManager->getAllComments();
        $this->renderAdmin('allComments', compact('allComments'));
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
        if (!isset($_GET['postid']) && $_GET['postid'] <= 0) {
            throw new Exception('Impposible d\'éditer un chapitre qui n\'existe pas');
        }
        $editPost = $postsManager->getOnePost(htmlspecialchars($_GET['postid']));
        $this->renderAdmin('editPost', compact('editPost'));
    }

    /**
     * Delete a comment depending on whether you're deleting from all comments page or from reported comments page
     */
    public function deleteComment() {
        $commentsManager = new CommentsManager();
        if (!isset($_GET['commentid']) && $_GET['commentid'] <= 0) {
            throw new Exception('Le commentaire n\'existe pas.');
        }
        $commentToDelete = $commentsManager->deleteComment($_GET['commentid']);
        if (isset($_GET['reportpage'])) {
            header('Location: ' . Router::getUrl('reportedComments'));
        } else {
            header('Location: ' . Router::getUrl('allComments'));
        }
    }

    /**
     * Remove a comment from the reported section
     */
    public function removeReportedTag() {
        $commentsManager = new CommentsManager();
        if (!isset($_GET['commentid']) && $_GET['commentid'] <= 0) {;
            throw new Exception('Le commentaire n\'existe pas.');
        }
        $commentToDelete = $commentsManager->removeReportedTag($_GET['commentid']);
        header('Location: ' . Router::getUrl('reportedComments'));
    }

}