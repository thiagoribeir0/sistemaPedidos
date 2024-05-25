<?php
include('conexao.php');
include('protect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && isset($_POST['produto_id'])) {
        $action = $_POST['action'];
        $produto_id = $_POST['produto_id'];

        if ($action == "update") {
            $nomeProduto = $_POST["nomeProduto"];
            $quantidade = $_POST["quantidade"];
            $valor = $_POST["valor"];

            $sql_update = "UPDATE produtos SET nomeProduto='$nomeProduto', quantidade='$quantidade', valor='$valor' WHERE id='$produto_id'";
            $mysqli->query($sql_update) or die("Falha na execução do código SQL: " . $mysqli->error);
        } elseif ($action == "delete") {
            $sql_delete = "DELETE FROM produtos WHERE id='$produto_id'";
            $mysqli->query($sql_delete) or die("Falha na execução do código SQL: " . $mysqli->error);
        }
    }
}

$selectProdutos = "SELECT * FROM produtos";
$sql_query = $mysqli->query($selectProdutos) or die("Falha na execução do código SQL: " . $mysqli->error);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Lista de Produtos</title>
</head>

<body>

</body>

</html>
<div class="container">
    <br>
    <h2>Lista de produtos</h2>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Valor (R$)</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($sql_query->num_rows > 0) {
                while ($row = $sql_query->fetch_assoc()) {
                    echo "<tr>";
                    echo "<form method='post'>";
                    echo "<td><input type='text' class='form-control' name='nomeProduto' value='" . $row['nomeProduto'] . "'></td>";
                    echo "<td><input type='text' class='form-control' name='quantidade' value='" . $row['quantidade'] . "'></td>";
                    echo "<td><input type='text' class='form-control' name='valor' value='" . $row['valor'] . "'></td>";
                    echo "<td>
                                <input type='hidden' name='produto_id' value='" . $row['id'] . "'>
                                <button type='submit' name='action' value='update' class='btn btn-primary'>Salvar alterações</button>
                                <button type='submit' name='action' value='delete' class='btn btn-danger'>Deletar</button>
                              </td>";
                    echo "</form>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Sem produtos cadastrados!</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <p><a href='painel.php' class='btn btn-secondary'>Voltar</a></p>
</div>
</body>

</html>