<?php
namespace projet4\core;


class Mail {

    private $ownerMail;

    public function __construct(string $mail) {
        $this->ownerMail = $mail;
    }

    /**
     * @param $subject
     * @param $message
     * @param $headers
     * Send the mail and make an alert success.
     */
    public function newMail(string $subject, string $message, string $headers) {
        mail($this->ownerMail, $subject, $message, $headers);
        Alert::setAlert('Votre message a bien été envoyé !', 'success');
        header('Location: ' . Router::getUrl('contact'));
    }

}