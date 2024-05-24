<?php

include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeProduto = $_POST["nomeProduto"];
    $quantidade = $_POST["quantidade"];
    $valor = $_POST["valor"];
    $sql_insert = "INSERT INTO produtos(nomeProduto,quantidade,valor) VALUES ('$nomeProduto', '$quantidade', '$valor')";
    $sql_query = $mysqli->query($sql_insert) or die("Falha na execução do código SQL: " . $mysqli->error);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Produto</title>
</head>
<body>
    <h1>Sistema de Cadastro de produtos</h1>

    <form action="cadastroProduto.php" method="post">
        <p>
            <label>Nome do produto:</label>
            <input type="text" name="nomeProduto">
        </p>

        <p>
            <label>Quantidade:</label>
            <input type="number" min="0" name="quantidade">
        </p>

        <p>
            <label>Valor por unidade:</label>
            <input type="number" min="0" name="valor">
        </p>

        <p>
            <input type="submit" value="Cadastrar Produto">
        </p>

        <?php
        $mysqli->close();

        header("Location: painel.php");
        exit();
        ?>

</body>
</html>