<?php

require_once(__DIR__ . "/../resources/ConnectionDatabase.php");
require_once(__DIR__ . "/../models/user/User.php");
require_once(__DIR__ . "/../models/user/UserDAO.php");
require_once(__DIR__ . "/../messages/login/InvalidAccount.php");
require_once(__DIR__ . "/../messages/login/LogoutSuccess.php");
require_once(__DIR__ . "/../messages/EmptyField.php");

class LoginController {

    public function __contruct() {

    }

    public function register() {
        if (isset($_POST['firstName']) && !empty($_POST['firstName'])
            && isset($_POST['lastName']) && !empty($_POST['lastName'])
            && isset($_POST['cpf']) && !empty($_POST['cpf'])
            && isset($_POST['birth']) && !empty($_POST['birth'])
            && isset($_POST['email']) && !empty($_POST['email'])
            && isset($_POST['password']) && !empty($_POST['password'])) {


            $firstName = trim($_POST['firstName']);
            $lastName = trim($_POST['lastName']);
            $cpf = preg_replace('/[^0-9]/', '', trim($_POST['cpf']));
            $birth = trim($_POST['birth']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $user = new User($firstName, $lastName, $cpf, $birth, $email ,$password);
            $userDao = new UserDAO();

            $_REQUEST['message'] = $userDao->register($user);

            include_once(__DIR__ . "/../views/register.php");
        } else {
            $_REQUEST['message'] = new EmptyField("Por favor preencha o formulário.");
            include_once(__DIR__ . "/../views/register.php");
        }
    }

    public function login() {
        $conn = new ConnectionDatabase();
        $connection = $conn->getConnection();

        if (isset($_POST['login']) && !empty($_POST['login'])
            && isset($_POST['password']) && !empty($_POST['password'])) {

            $login = trim($_POST['login']);
            $password = trim($_POST['password']);

            $statement = $connection->prepare("SELECT * FROM users WHERE email = ? OR cpf = ?");

            if ($statement) {
                $statement->bindParam(1, $login, PDO::PARAM_STR);
                $statement->bindParam(2, $login, PDO::PARAM_STR);
                $statement->execute();

                $rowCount = $statement->rowCount();

                if ($rowCount > 0) {
                    $result = $statement->fetch();

                    if (password_verify($_POST['password'], $result['password'])) {
                        session_regenerate_id();
                        $_SESSION['loggedin'] = TRUE;
                        $_SESSION['id'] = $result['id'];

                        header("Location: ../models/profile.php");
                    } else {
                        $_REQUEST['message'] = new InvalidAccount("Conta inválida.");
                        include_once(__DIR__ . "/../index.php");
                    }
                } else {
                    $_REQUEST['message'] = new InvalidAccount("Conta inválida.");
                    include_once(__DIR__ . "/../index.php");
                }
            }
        } else {
            $_REQUEST['message'] = new EmptyField("Por favor preencha o formulário.");
            include_once(__DIR__ . "/../index.php");
        }

        $connection = NULL;
    }

    public function profile() {
        if (isset($_SESSION['loggedin'])) {
            $conn = new ConnectionDatabase();
            $connection = $conn->getConnection();
    
            $statement = $connection->prepare("SELECT * FROM users WHERE id = ?");
            $statement->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
            $statement->execute();
    
            $result = $statement->fetch();
    
            $user = new User($result['first_name'], $result['last_name'], $result['cpf'], 
                $result['birth'], $result['email'], $result['password']);

            $_REQUEST['user'] = $user;

            include_once(__DIR__ . "/../views/profile.php");
        }  
    }

    public function editProfile() {
        if (isset($_SESSION['loggedin'])) {
            $conn = new ConnectionDatabase();
            $connection = $conn->getConnection();
    
            $statement = $connection->prepare("SELECT * FROM users WHERE id = ?");
            $statement->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
            $statement->execute();
    
            $result = $statement->fetch();
    
            $user = new User($result['first_name'], $result['last_name'], $result['cpf'], 
                $result['birth'], $result['email'], $result['password']);

            $_REQUEST['user'] = $user;

            include_once(__DIR__ . "/../views/editProfile.php");
        }  
    }

    public function update() {
        if (isset($_POST['firstName']) && !empty($_POST['firstName'])
            && isset($_POST['lastName']) && !empty($_POST['lastName'])
            && isset($_POST['cpf']) && !empty($_POST['cpf'])
            && isset($_POST['birth']) && !empty($_POST['birth'])
            && isset($_POST['email']) && !empty($_POST['email'])) {


            $firstName = trim($_POST['firstName']);
            $lastName = trim($_POST['lastName']);
            $cpf = preg_replace('/[^0-9]/', '', trim($_POST['cpf']));
            $birth = trim($_POST['birth']);
            $email = trim($_POST['email']);
            $password = NULL;

            $user = new User($firstName, $lastName, $cpf, $birth, $email, $password);
            $userDao = new UserDAO();

            if ($userDao->update($_SESSION['id'], $user)) {
                header("Location: ../models/profile.php");
            }
        } else {
            $_REQUEST['message'] = new EmptyField("Por favor preencha o formulário.");
            include_once(__DIR__ . "/../models/editProfile.php");
        }
    }

    public function logout() {
        $_REQUEST['message'] = new LogoutSuccess("Logout efetuado com sucesso!");
        include_once(__DIR__ . "/../index.php");
    }

}

?>