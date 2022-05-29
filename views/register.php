<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Oliveira Trade - Cadastro</title>
</head>
<body>
    <div class="form-container d-flex flex-column align-items-center">
        <p class="text-uppercase fs-3 fst-italic fw-bold p-5 text-warning">Oliveira Trade</p>
        <p class="text-uppercase fs-3 fst-italic fw-bold p-5">Cadastro</p>
        
        <?php
            if (isset($_REQUEST['message'])) {
                $message = $_REQUEST['message'];
            }

            if (isset($message) && !empty($message)) {
                if (is_a($message, "RegisterSuccess")) {
                    echo "<span class='fw-bold text-success'>{$message->getMessage()}</span>";
                } else if (is_a($message, "EmptyField")) {
                    echo "<span class='fw-bold text-danger'>{$message->getMessage()}</span>";
                } else if (is_a($message, "CpfExists")) {
                    echo "<span class='fw-bold text-danger'>{$message->getMessage()}</span>";
                } else if (is_a($message, "EmailExists")) {
                    echo "<span class='fw-bold text-danger'>{$message->getMessage()}</span>";
                } 
            }
        ?>

        <div class="form-group w-25">
            <form action="/oliveiratrade/models/register.php" method="POST">
                <label for="firstName" class="fw-bold">Nome:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" maxlength="20"></input>

                <label for="lastName" class="fw-bold">Último nome:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" maxlength="20"></input>

                <label for="cpf" class="fw-bold">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" minlength="11"></input>

                <label for="birth" class="fw-bold">Nascimento:</label>
                <input type="date" class="form-control" id="birth" name="birth"></input>

                <label for="email" class="fw-bold">Email:</label>
                <input type="email" class="form-control" id="email" name="email"></input>

                <label for="password" class="fw-bold">Senha:</label>
                <input type="password" class="form-control" id="password" name="password" maxlength="20"></input>

                <input type="submit" class="btn btn-primary form-control mt-3" value="Cadastrar"></input>
            </form>
        </div>

        <a class="mx-auto mt-3 mb-5" href="/oliveiratrade/index.php">Entrar</a>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

    <script type="text/javascript">
        $(document).ready(() => {
            $("#cpf").mask("999.999.999-99");
        });
    </script>
    </html>