<?php
namespace projet4\core;

class Alert {

    public static function setAlert(string $message, string $type) {
        $_SESSION['alert'] = ['message' => $message, 'type' => $type];
    }

    public static function getAlert() {
        if (isset($_SESSION['alert'])) {
            echo '<div class="alert ' . $_SESSION['alert']['type'] . '">' . $_SESSION['alert']['message'] . '</div>';
            unset($_SESSION['alert']);
        }
    }

}