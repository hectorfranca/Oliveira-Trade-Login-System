<?php

require_once(__DIR__ . "/../RegisterMessage.php");
    
class InvalidAccount extends RegisterMessage {
    public function __construct($message) {
        parent::__construct($message);
    }
}

?>