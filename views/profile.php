<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Oliveira Trade - Perfil</title>
</head>
<body>

    <div class="d-flex flex-column align-items-center">
        <p class="text-uppercase fs-3 fst-italic fw-bold p-5 text-warning">Oliveira Trade</p>
        <p class="text-uppercase fs-3 fst-italic fw-bold p-5">Perfil</p>

        <div class="data">
            <label for="name" class="fw-bold">Nome:</label>
            <span id="name"><?=$user->getFullName()?></span><br>

            <label for="cpf" class="fw-bold">CPF:</label>
            <span id="cpf"><?=$user->getCpf()?></span><br>

            <label for="birth" class="fw-bold">Birth:</label>
            <span id="birth"><?=$user->getBirth()?></span><br>
   
            <label for="email" class="fw-bold">Email:</label>
            <span id="email"><?=$user->getEmail()?></span><br>
        </div>

        <form action="/oliveiratrade/models/editProfile.php" class="d-flex flex-column align-items-center w-25 mt-3">
            <input type="submit" class="btn btn-primary w-75" value="Editar"></input>
        </form>

        <a class="mx-auto mt-3" href="/oliveiratrade/models/logout.php">Sair</a>
    </div>

</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</html>