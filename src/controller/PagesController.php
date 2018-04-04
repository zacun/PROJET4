<?php

require_once '../src/model/PostsManager.php';
require_once '../src/model/CommentsManager.php';
use projet4\core\Controller;

class PagesController extends Controller{

    public function home() {
        $postManager = new PostsManager();
        $lastAddedPosts = $postManager->lastAddedPosts();
        $this->render('home', compact('lastAddedPosts'));
    }

    public function allPosts() {
        $postsManager = new PostsManager();
        $allPosts = $postsManager->getAllPosts();
        $this->render('allPosts', compact('allPosts'));
    }

    public function singlePost() {
        $postsManager = new PostsManager();
        $commentsManager = new CommentsManager();
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $singlePost = $postsManager->getOnePost(htmlspecialchars($_GET['id']));
            $commentsByPost = $commentsManager->getCommentsByPost(htmlspecialchars($_GET['id']));
            $this->render('singlePost', compact('singlePost', 'commentsByPost'));
        } else {
            throw new Exception('Ce chapitre n\'existe pas.');
        }
    }

    public function newComment() {
        $commentsManager = new CommentsManager();
        if (isset($_GET['postid']) && $_GET['postid'] > 0) {
            if (!empty($_POST['comment-author']) && !empty($_POST['comment-content'])) {
                $newComment = $commentsManager->addComment(
                    htmlspecialchars($_GET['postid']),
                    htmlspecialchars(ucfirst($_POST['comment-author'])),
                    htmlspecialchars($_POST['comment-content'])
                );
                header('Location: ' . BASE_URL . '/chapitre?id=' . $_GET['postid']);
            } else {
                throw new Exception('Vous n\'avez pas rempli tous les champs.');
            }
        } else {
            throw new Exception('Ce chapitre n\'existe pas.');
        }
    }

    public function contact() {
        $this->render('contact');
    }

    public function connect() {
        $this->render('connect');
    }

    public static function getExcerpt($excerpt) {
        return substr($excerpt, 0, 150) . '...';
    }

}