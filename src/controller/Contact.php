<?php

namespace projet4\src\controller;

use projet4\core\Alert;
use projet4\core\Router;

class Contact {

    private $ownerMail = 'batpaulin@gmail.com';

    /**
     * Get the $_POST values, make some checking and then call sendMail() if everything is ok.
     */
    public function getMailInfos() {
        $_SESSION['mailinfos'] = [
            'name' => trim($_POST['name']),
            'mail' => trim($_POST['mail']),
            'subject' => trim($_POST['subject']),
            'message' => trim($_POST['message'])
        ];
        if (empty(trim($_POST['name'])) || empty(trim($_POST['mail'])) || empty(trim($_POST['subject'])) || empty(trim($_POST['message']))) {
            Alert::setAlert('Tous les champs ne sont pas remplis', 'error');
            header('Location: ' . Router::getUrl('contact'));
            exit();
        } elseif (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            Alert::setAlert('L\'adresse e-mail renseignée n\'est pas valide.', 'error');
            header('Location: ' . Router::getUrl('contact'));
            exit();
        } else {
            $subject = strip_tags($_POST['subject']);
            $headers = 'FROM : ' . strip_tags($_POST['name']) . ' <' . strip_tags($_POST['mail'] . '>');
            $message = strip_tags($_POST['message']);
            $this->sendMail($subject, $message, $headers);
        }
    }

    /**
     * @param $subject
     * @param $message
     * @param $headers
     * Send the mail, unset the session and make an alert success.
     */
    private function sendMail($subject, $message, $headers) {
        mail($this->ownerMail, $subject, $message, $headers);
        unset($_SESSION['mailinfos']);
        Alert::setAlert('Votre message a bien été envoyé !', 'success');
        header('Location: ' . Router::getUrl('contact'));
    }

    /**
     * @param $name
     * If an error happens when submitting the form, the inputs content will be saved so that the visitors don't have to rewrite everything.
     */
    public static function getValue($name) {
        if (isset($_SESSION['mailinfos'][$name])) {
            echo $_SESSION['mailinfos'][$name];
            unset($_SESSION['mailinfos'][$name]);
        }
    }

}