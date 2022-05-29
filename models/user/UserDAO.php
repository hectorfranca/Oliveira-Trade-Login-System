<?php

require_once(__DIR__ . "/../../resources/ConnectionDatabase.php");
require_once(__DIR__ . "/../../messages/register/EmailExists.php");
require_once(__DIR__ . "/../../messages/register/CpfExists.php");
require_once(__DIR__ . "/../../messages/register/RegisterSuccess.php");

class UserDAO {
    public function __construct() {
      $conn = new ConnectionDatabase();
      $this->connection = $conn->getConnection();
    }

    private function insert($user) {
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $cpf = $user->getCpf();
        $birth = $user->getBirth();
        $email = $user->getEmail();
        $password = $user->getPassword();

        $statement = $this->connection->prepare("INSERT INTO users (first_name, last_name, cpf, birth, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        if ($statement) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $statement->bindParam(1, $firstName, PDO::PARAM_STR);
            $statement->bindParam(2, $lastName, PDO::PARAM_STR);
            $statement->bindParam(3, $cpf, PDO::PARAM_STR);
            $statement->bindParam(4, $birth, PDO::PARAM_STR);
            $statement->bindParam(5, $email, PDO::PARAM_STR);
            $statement->bindParam(6, $password, PDO::PARAM_STR);
            $statement->execute();
            return new RegisterSuccess("Cadastro efetuado com sucesso!");
        } else {
            return "Erro: Não foi posssível realizar a preparação.";
        }

        $this->connection = NULL;
    }

    private function findByEmail($email) {
        $statement = $this->connection->prepare("SELECT email, password FROM users WHERE email = ?");

        if ($statement) {
            $statement->bindParam(1, $email, PDO::PARAM_STR);
            $statement->execute();

            $rowCount = $statement->rowCount();

            return $rowCount;
        } else {
            echo ("Erro: Não foi posssível realizar a preparação.");
        }
    }

    private function findByCpf($cpf) {
        $statement = $this->connection->prepare("SELECT email, password FROM users WHERE cpf = ?");

        if ($statement) {
            $statement->bindParam(1, $cpf, PDO::PARAM_STR);
            $statement->execute();

            $rowCount = $statement->rowCount();

            return $rowCount;
        } else {
            echo ("Erro: Não foi posssível realizar a preparação.");
        }
    }

    public function register($user) {
        if ($this->findByCpf($user->getCpf()) > 0) {
            return new CpfExists("CPF já cadastrado.");
        } else if ($this->findByEmail($user->getEmail()) > 0) {
            return new EmailExists("Email já cadastrado.");
        } else {
            return $this->insert($user);
        }

        $this->connection = NULL;
    }

    public function update($id, $user) {
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $cpf = $user->getCpf();
        $birth = $user->getBirth();
        $email = $user->getEmail();

        $statement = $this->connection->prepare("UPDATE users SET first_name = ?, last_name = ?,
            cpf = ?, birth = ?, email = ? WHERE id = ?");

        if ($statement) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $statement->bindParam(1, $firstName, PDO::PARAM_STR);
            $statement->bindParam(2, $lastName, PDO::PARAM_STR);
            $statement->bindParam(3, $cpf, PDO::PARAM_STR);
            $statement->bindParam(4, $birth, PDO::PARAM_STR);
            $statement->bindParam(5, $email, PDO::PARAM_STR);
            $statement->bindParam(6, $id, PDO::PARAM_INT);
            $statement->execute();

            return true;
        } else {
            echo ("Erro: Não foi posssível realizar a preparação.");
            return false;
        }
        
        $this->connection = NULL;
    }

}

?>