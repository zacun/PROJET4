<?php

namespace projet4\src\controller;

use projet4\core\Alert;
use projet4\core\Controller;
use projet4\core\Router;
use projet4\core\Auth;
use projet4\src\model\PostsManager;
use projet4\src\model\CommentsManager;

class AdminController extends Controller {


    /**
     * AdminController constructor.
     * With this, all following functions will only work if you're logged as an admin.
     */
    public function __construct(){
        if (!Auth::isLogged()) {
            Alert::setAlert('Accès interdit. Veuillez vous connecter.', 'error');
            header('Location: ' . Router::getUrl('connexion'));
            exit();
        }
    }

    /**
     * Main admin page
     */
    public function admin() {
        $postsManager = new PostsManager();
        $allPosts = $postsManager->getAllPosts();
        $this->render('admin/admin', compact('allPosts'));
    }

    /**
     * Go to newPost page
     */
    public function newPost() {
        $this->render('admin/newPost');
    }

    /**
     * Go to reported comments page
     */
    public function reportedComments() {
        $commentsManager = new CommentsManager();
        $getReportedComments = $commentsManager->getReportedComments();
        $this->render('admin/reportedComments', compact('getReportedComments'));
    }

    /**
     * Go to all comments page
     */
    public function allComments() {
        $commentsManager = new CommentsManager();
        $allComments = $commentsManager->getAllComments();
        $this->render('admin/allComments', compact('allComments'));
    }

    /**
     * Go to edit post page with the right post to edit.
     */
    public function editPost() {
        $postsManager = new PostsManager();
        $postExist = $postsManager->exist('posts', $_GET['postid']);
        if (empty($postExist)) {
            Alert::setAlert('Le chapitre n\'existe pas.', 'error');
            header('Location: ' . Router::getUrl('admin'));
            exit();
        }
        $editPost = $postsManager->getOnePost(htmlspecialchars($_GET['postid']));
        $this->render('admin/editPost', compact('editPost'));
    }

    /**
     * Add a new post into db
     */
    public function addNewPost() {
        $postsManager = new PostsManager();
        if (empty(trim($_POST['newPostName'])) || empty(trim($_POST['newPostContent']))) {
            Alert::setAlert('Tous les champs ne sont pas remplis.', 'error');
            header('Location: ' . Router::getUrl('newPost'));
            exit();
        }
        $postsManager->addNewPost($_POST['newPostName'], $_POST['newPostContent']);
        Alert::setAlert('Chapitre ajouté.', 'success');
        header('Location: ' . Router::getUrl('admin'));
    }

    /**
     * Update a post
     */
    public function updatePost() {
        $postsManager = new PostsManager();
        $postExist = $postsManager->exist('posts', $_GET['postid']);
        if (empty($postExist)) {
            Alert::setAlert('Le chapitre n\'existe pas.', 'error');
            header('Location: ' . Router::getUrl('admin'));
            exit();
        }
        if (empty(trim($_POST['editPostName'])) || empty(trim($_POST['editPostContent']))) {
            Alert::setAlert('Tous les champs ne sont pas remplis.', 'error');
            header('Location: ' . Router::getUrl('editPost') . '?postid=' . $_GET['postid']);
            exit();
        }
        $postsManager->updatePost(
            $_POST['editPostName'],
            $_POST['editPostContent'],
            $_GET['postid']
        );
        Alert::setAlert('Le chapitre a bien été mis à jour.', 'success');
        header('Location: ' . Router::getUrl('chapitre') . '?id=' . $_GET['postid']);
    }

    /**
     * Delete a post
     */
    public function deletePost() {
        $postsManager = new PostsManager();
        $postExist = $postsManager->exist('posts', $_GET['postid']);
        if (empty($postExist)) {
            Alert::setAlert('Le chapitre n\'existe pas.', 'error');
            header('Location: ' . Router::getUrl('admin'));
            exit();
        }
        $postsManager->deletePost(htmlspecialchars($_GET['postid']));
        Alert::setAlert('Le chapitre a bien été supprimé.', 'success');
        header('Location: ' . Router::getUrl('admin'));
    }

    /**
     * Delete a comment depending on whether you're deleting from all comments page or from reported comments page
     */
    public function deleteComment() {
        $commentsManager = new CommentsManager();
        $commentExist = $commentsManager->exist('comments', $_GET['commentid']);
        if (empty($commentExist)) {
            Alert::setAlert('Le commentaire n\'existe pas.', 'error');
            if (isset($_GET['reportpage'])) {
                header('Location: ' . Router::getUrl('reportedComments'));
            } else {
                header('Location: ' . Router::getUrl('allComments'));
            }
            exit();
        }
        $commentsManager->deleteComment($_GET['commentid']);
        Alert::setAlert('Commentaire supprimé.', 'success');
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
        $commentExist = $commentsManager->exist('comments', $_GET['commentid']);
        if (empty($commentExist)) {
            Alert::setAlert('Le commentaire n\'existe pas.', 'error');
            header('Location: ' . Router::getUrl('reportedComments'));
            exit();
        }
        $commentsManager->removeReportedTag($_GET['commentid']);
        Alert::setAlert('Le signalement a bien été enlevé.', 'success');
        header('Location: ' . Router::getUrl('reportedComments'));
    }

}