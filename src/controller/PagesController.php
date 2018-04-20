<?php
namespace projet4\src\controller;

use projet4\core\Controller;
use projet4\core\Alert;
use projet4\core\Mail;
use projet4\core\Router;
use projet4\src\model\PostsManager;
use projet4\src\model\CommentsManager;

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
     * Contact page
     */
    public function contact() {
        $name = '';
        $mail = '';
        $subject = '';
        $message = '';
        if (!empty($_POST)) {
            $name = trim($_POST['name']);
            $mail = trim($_POST['mail']);
            $subject = trim($_POST['subject']);
            $message = trim($_POST['message']);
            if (empty($name) || empty($mail) || empty($subject) || empty($message)) {
                Alert::setAlert('Tous les champs ne sont pas remplis.', 'error');
            } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                Alert::setAlert('L\'adresse e-mail renseignée n\'est pas valide.', 'error');
            } else {
                $subject = strip_tags($subject);
                $headers = 'FROM : ' . strip_tags($name) . ' - <' . strip_tags($mail) . '>';
                $message = strip_tags($message);
                $send = new Mail('batpaulin@gmail.com');
                $send->newMail($subject, $message, $headers);
                exit();
            }
        }
        $this->render('public/contact', compact('name', 'mail', 'subject', 'message'));
    }

    /**
     * Connect page
     */
    public function connect() {
        $this->render('public/connect');
    }

    /**
     * Display a chosen post with the associated comments
     */
    public function singlePost() {
        $postsManager = new PostsManager();
        $commentsManager = new CommentsManager();
        $postExist = $postsManager->exist('posts', $_GET['id']);
        if (empty($postExist)) {
            Alert::setAlert('Le chapitre n\'existe pas.', 'error');
            header('Location: ' . Router::getUrl('chapitres'));
            exit();
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
        $postExist = $commentsManager->exist('posts', $_GET['postid']);
        if (empty($postExist)) {
            Alert::setAlert('Le chapitre n\'existe pas.', 'error');
            header('Location: ' . Router::getUrl('chapitres'));
            exit();
        }
        if (empty(trim($_POST['comment-author'])) || empty(trim($_POST['comment-content']))) {
            Alert::setAlert('Tous les champs ne sont pas remplis.', 'error');
            header('Location: ' . Router::getUrl('chapitre') . '?id=' . $_GET['postid']);
            exit();
        }
        $commentsManager->addComment(
            htmlspecialchars($_GET['postid']),
            htmlspecialchars(ucfirst($_POST['comment-author'])),
            htmlspecialchars($_POST['comment-content'])
        );
        Alert::setAlert('Le commentaire a bien été posté.', 'success');
        header('Location: ' . Router::getUrl('chapitre') . '?id=' . $_GET['postid']);
    }

    /**
     * Report a comment
     */
    public function reportComment() {
        $commentsManager = new CommentsManager();
        $commentExist = $commentsManager->exist('comments', $_GET['commentid']);
        if (empty($commentExist)) {
            Alert::setAlert('Le commentaire n\'existe pas.', 'error');
            header('Location: ' . Router::getUrl('chapitre') . '?id=' . $_GET['postid']);
            exit();
        }
        $commentsManager->reportComment(htmlspecialchars($_GET['commentid']));
        Alert::setAlert('Le commentaire a bien été signalé.', 'success');
        header('Location: ' . Router::getUrl('chapitre') . '?id=' . $_GET['postid']);
    }

}