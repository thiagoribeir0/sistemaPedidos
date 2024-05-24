<?php

include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $sql_insert = "INSERT INTO usuarios(nome,email,senha) VALUES ('$nome', '$email', '$senha')";
    $sql_query = $mysqli->query($sql_insert) or die("Falha na execução do código SQL: " . $mysqli->error);

    if ($sql_query === TRUE) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o usuário: " . $mysqli->error;
    }

    $mysqli->close();

    header("Location: index.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro</title>
</head>
<body>
    <h1>Cadastre seu usuário</h1>
    <form action="cadastro.php" method="POST">
        <p>
            <label>Nome completo:</label>
            <input type="text" name="nome">
        </p>
        <p>
            <label>E-mail:</label>
            <input type="email" name="email">
        </p>
        <p>
            <label>Senha:</label>
            <input type="password" name="senha">
        </p>
        <p>
            <input type="submit" value="Cadastrar">
        </p>
    </form>
</body>
</html>