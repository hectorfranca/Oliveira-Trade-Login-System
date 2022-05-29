<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Oliveira Trade - Entrar</title>
</head>
<body>
    <div class="form-container d-flex flex-column align-items-center">
        <p class="text-uppercase fs-3 fst-italic fw-bold p-5 text-warning">Oliveira Trade</p>
        <p class="text-uppercase fs-3 fst-italic fw-bold p-5">Login</p>

        <?php
            if (isset($_REQUEST['message'])) {
                $message = $_REQUEST['message'];
            }

            if (isset($message) && !empty($message)) {
                if (is_a($message, "InvalidAccount")) {
                    echo "<span class='fw-bold text-danger'>{$message->getMessage()}</span>";
                } else if (is_a($message, "EmptyField")) {
                    echo "<span class='fw-bold text-danger'>{$message->getMessage()}</span>";
                } else if (is_a($message, "LogoutSuccess")) {
                    echo "<span class='fw-bold text-success'>{$message->getMessage()}</span>";
                }
            }     
        ?>

        <div class="form-group w-25">
            <form action="/oliveiratrade/models/login.php" method="POST">
                <label for="login" class="fw-bold">Email ou CPF:</label>
                <input type="text" class="form-control" id="login" name="login"></input>

                <label for="password" class="fw-bold">Senha:</label>
                <input type="password" class="form-control" id="password" name="password"></input>

                <input type="submit" class="btn btn-primary form-control mt-3" value="Entrar"></input>
            </form>
        </div>

        <a class="mx-auto mt-3" href="/oliveiratrade/views/register.php">Cadastrar</a>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</html>