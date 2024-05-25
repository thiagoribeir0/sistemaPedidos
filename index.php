<?php

include('conexao.php');

if (isset($_POST['email']) || isset($_POST['senha'])) {

    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail.";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha.";
    } else {

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $result = $stmt->get_result();
        $quantidade = $result->num_rows; //num_rows

        if ($quantidade == 1) {

            $usuario = $result->fetch_assoc(); //estudar fetch_assoc

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");
        } else {
            echo "<script>alert('Falha ao logar! E-mail ou senha incorretos.');</script>";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Página de Login</title>

    <style>
        html,
        body {
            height: 100%;
        }

        .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .form-control {
            font-size: 1.25rem;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .d-grid .btn {
            font-size: 1.25rem;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title text-center">Acesse sua conta</h5>
                <br>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="inputEmail4" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" id="inputEmail4">
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="inputPassword4" class="form-label">Senha</label>
                        <input type="password" class="form-control" name="senha" id="inputPassword4">
                    </div>
                    <br>
                    <div class="d-grid">
                        <input type="submit" class="btn btn-primary btn-block" value="Entrar">
                    </div>
                </form>
                <div class="text-center mt-3">
                    Não possui uma conta? <a href="cadastro.php">Cadastrar</a>.
                </div>
            </div>
        </div>
    </div>
</body>

</html>