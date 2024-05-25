<?php

include('conexao.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $mysqli->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha);

    try {
        if ($stmt->execute()) {
            $message = "Usuário cadastrado com sucesso!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script type='text/javascript'>setTimeout(function() { window.location.href = 'index.php'; }, 1000);</script>";
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            $message = "Erro ao cadastrar, e-mail já está em uso.";
        } else {
            $message = "Erro ao cadastrar o usuário: " . $e->getMessage();
        }
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    $stmt->close();
}

$mysqli->close();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Cadastro</title>
</head>

<body>
    <div class="container">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title text-center">Cadastre seu usuário</h5>
                <br>
                <form action="cadastro.php" method="POST">
                    <div class="mb-3">
                        <label for="inputNome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" id="inputNome">
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail4" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" id="inputEmail4">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword4" class="form-label">Senha</label>
                        <input type="password" class="form-control" name="senha" id="inputPassword4">
                    </div>
                    <br>
                    <div class="d-grid">
                        <input type="submit" class="btn btn-primary btn-block" value="Cadastrar">
                    </div>
                </form>
                <div class="text-center mt-3">
                    Já possui cadastro? <a href="index.php">Fazer login</a>.
                </div>
            </div>
        </div>
    </div>
</body>

</html>