<?php

    session_start();

    require_once(__DIR__ . "/../controllers/LoginController.php");

    $loginController = new LoginController();
    $loginController->login();

?>