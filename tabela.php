<?php
include('conexao.php');
include('protect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['action']) && isset($_POST['produto_id'])) {
        $action = $_POST['action'];
        $produto_id = $_POST['produto_id'];

        if($action == "update") {
            $nomeProduto = $_POST["nomeProduto"];
            $quantidade = $_POST["quantidade"];
            $valor = $_POST["valor"];

        $sql_update = "UPDATE produtos SET nomeProduto='$nomeProduto', quantidade='$quantidade', valor='$valor' WHERE id='$produto_id'";
        $mysqli->query($sql_update) or die ("Falha na execução do código SQL: " . $mysqli->error);
    
    } elseif($action == "delete") {
            $sql_delete = "DELETE FROM produtos WHERE id='$produto_id'";
            $mysqli->query($sql_delete) or die("Falha na execução do código SQL: " . $mysqli->error);
        }
    }
}

$selectProdutos = "SELECT * FROM produtos";
$sql_query = $mysqli->query($selectProdutos) or die("Falha na execução do código SQL: " . $mysqli->error);

function exibirProdutos() {
    global $sql_query;
    if ($sql_query->num_rows > 0) {
        echo "
                <table>
                <tr>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Valor por unidade (R$)</th>
                </tr>
            ";
        while ($row = $sql_query->fetch_assoc()) {
            echo "<tr>";
            echo "<form method='post'>";
            echo "<td><input type='text' name='nomeProduto' value='" . $row['nomeProduto'] . "'></td>";
            echo "<td><input type='text' name='quantidade' value='" . $row['quantidade'] . "'></td>";
            echo "<td><input type='text' name='valor' value='" . $row['valor'] . "'></td>";
            echo "<td>
                <input type='hidden' name='produto_id' value='" . $row['id'] . "'>
                <button type='submit' name='action' value='update'>Salvar alterações</button>
                <button type='submit' name='action' value='delete'>Deletar</button>
                </td>";
            echo "</form>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Sem produtos cadastrados!</p>";
    }
}

        exibirProdutos();


?>