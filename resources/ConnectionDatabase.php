<?php

require_once("../global.php");

define("USER", $_ENV['DB_USER']);
define("HOST", $_ENV['DB_HOST']);
define("DATABASE", $_ENV['DB_NAME']);
define("PASSWORD", $_ENV['DB_PASSWORD']);

class ConnectionDatabase {
    function __construct() {

    }

    function getConnection() {
        try {
            $connection = new PDO("pgsql:host=".HOST.";port=5432;dbname=".DATABASE, USER, PASSWORD);
            
            return $connection;
        } catch (PDOException $exception) {
            exit("Error:" . $exception->getMessage());
        }
    }

}

?>