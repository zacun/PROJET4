<?php

require_once '../src/model/PostsManager.php';
use projet4\core\Controller;

class PagesController extends Controller{

    public function home() {
        $this->render('home');
    }

    public function contact() {
        $this->render('contact');
    }

    public function allPosts() {
        $postsManager = new PostsManager();
        $allPosts = $postsManager->getAllPosts();
        $this->render('allPosts', compact('allPosts'));
    }

    public function singlePost() {
        $this->render('singlePost');
    }

}