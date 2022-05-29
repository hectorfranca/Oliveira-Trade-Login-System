<?php

session_start();
session_destroy();

require_once(__DIR__ . "/../controllers/LoginController.php");

$loginController = new LoginController();
$loginController->logout();

?>