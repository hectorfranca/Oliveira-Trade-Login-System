<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require_once(__DIR__ . "/../controllers/LoginController.php");

    $loginController = new LoginController();
    $loginController->editProfile();

?>