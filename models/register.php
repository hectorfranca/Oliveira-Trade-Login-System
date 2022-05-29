<?php

    require_once(__DIR__ . "/../controllers/LoginController.php");

    $loginController = new LoginController();
    $loginController->register();

?>