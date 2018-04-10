<?php

// namespace projet4\src\controller;

require_once '../src/model/PostsManager.php';
require_once '../src/model/CommentsManager.php';

use projet4\core\Controller;
use projet4\src\manager\PostsManager;
use projet4\src\manager\CommentsManager;

class PagesController extends Controller{

    /**
     * Home page.
     */
    public function home() {
        $postManager = new PostsManager();
        $lastAddedPosts = $postManager->lastAddedPosts();
        $this->render('public/home', compact('lastAddedPosts'));
    }

    /**
     * All posts page
     */
    public function allPosts() {
        $postsManager = new PostsManager();
        $allPosts = $postsManager->getAllPosts();
        $this->render('public/allPosts', compact('allPosts'));
    }

    /**
     * Display a chosen post with the associated comments
     */
    public function singlePost() {
        $postsManager = new PostsManager();
        $commentsManager = new CommentsManager();
        if (!isset($_GET['id']) || $_GET['id'] <= 0) {
            throw new \Exception('Ce chapitre n\'existe pas.');
        }
        $singlePost = $postsManager->getOnePost(htmlspecialchars($_GET['id']));
        $commentsByPost = $commentsManager->getCommentsByPost(htmlspecialchars($_GET['id']));
        $this->render('public/singlePost', compact('singlePost', 'commentsByPost'));
    }

    /**
     * Create a new comment on the associated post.
     */
    public function newComment() {
        $commentsManager = new CommentsManager();
        if (!isset($_GET['postid']) && $_GET['postid'] <= 0) {
            throw new \Exception('Ce chapitre n\'existe pas.');
        }
        if (empty($_POST['comment-author']) && empty($_POST['comment-content'])) {
            throw new \Exception('Vous n\'avez pas rempli tous les champs.');
        }
        $commentsManager->addComment(
            htmlspecialchars($_GET['postid']),
            htmlspecialchars(ucfirst($_POST['comment-author'])),
            htmlspecialchars($_POST['comment-content'])
        );
        header('Location: ' . BASE_URL . '/chapitre?id=' . $_GET['postid']);
    }

    /**
     * Report a comment
     */
    public function reportComment() {
        $commentsManager = new CommentsManager();
        if (!isset($_GET['commentid']) && $_GET['commentid'] <= 0) {
            throw new \Exception('Le commentaire n\'existe pas');
        }
        $commentsManager->reportComment(htmlspecialchars($_GET['commentid']));
        header('Location: ' . BASE_URL . '/chapitre?id=' . $_GET['postid']);
    }

    public function contact() {
        $this->render('public/contact');
    }

    public function connect() {
        $this->render('public/connect');
    }

}