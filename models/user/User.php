<?php

class User {
    public function __construct($firstName, $lastName, $cpf, $birth, $email ,$password) {
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->cpf = $cpf;
      $this->birth = $birth;
      $this->email = $email;
      $this->password = $password;  
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getFullName() {
        return $this->firstName . " " . $this->lastName;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getBirth() {
        return $this->birth;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setBirth($birth) {
        $this->birth = $birth;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }
}

?>