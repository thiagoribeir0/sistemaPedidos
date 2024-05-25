<?php

include('conexao.php');
include('protect.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeProduto = $_POST["nomeProduto"];
    $quantidade = $_POST["quantidade"];
    $valor = $_POST["valor"];
    $sql_insert = "INSERT INTO produtos(nomeProduto,quantidade,valor) VALUES ('$nomeProduto', '$quantidade', '$valor')";
    
    try {
        if ($mysqli->query($sql_insert) === TRUE) {
            $message = "Produto cadastrado com sucesso!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script type='text/javascript'>setTimeout(function() { window.location.href = 'painel.php'; }, 1000);</script>";
            exit();
        } else {
            $message = "Erro ao cadastrar o produto: " . $mysqli->error;
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } catch (mysqli_sql_exception $e) {
        $message = "Erro ao cadastrar o produto: " . $e->getMessage();
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Visualizar Produto</title>
 </head>

<body>
    <div class="container">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title text-center">Cadastro de produtos</h5>
                <br>
                <form action="cadastroProduto.php" method="POST">
                    <div class="mb-3">
                        <label for="inputProduto" class="form-label">Nome do produto</label>
                        <input type="text" class="form-control" name="nomeProduto">
                    </div>
                    <div class="mb-3">
                        <label for="inputQtde" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" min="0" name="quantidade">
                    </div>
                    <div class="mb-3">
                        <label for="inputValor" class="form-label">Valor unitário</label>
                        <input type="number" class="form-control" min="0" name="valor">
                    </div>
                    <br>
                    <div class="d-grid">
                        <input type="submit" class="btn btn-primary btn-block" value="Adicionar">
                    </div>
                </form>
                <div class="text-center mt-3">
                    <a href="painel.php">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>