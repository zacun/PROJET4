<?php

use projet4\core\Controller;

class AdminController extends Controller {

    public function connect() {
        $this->render('admin/connect');
    }
    public function admin() {
        $this->render('admin/admin');
    }
    public function newPost() {
        $this->render('admin/newPost');
    }
    public function reportedComments() {
        $this->render('admin/reportedComments');
    }

}