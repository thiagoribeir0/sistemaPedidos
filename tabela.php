<?php
include('conexao.php');

$selectProdutos = "SELECT * FROM produtos";
$sql_query = $mysqli->query($selectProdutos) or die("Falha na execução do código SQL: " . $mysqli->error);

function exibirProdutos() {
    global $sql_query;
    if ($sql_query->num_rows > 0){
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
            echo "<td>" . "<input type='text' class='$row[id]' value='$row[nomeProduto]'>" . "</td>";
            echo "<td>" . "<input type='text' class='$row[id]' value='$row[quantidade]'>" . "</td>";
            echo "<td>" . "<input type='text' class='$row[id]' value='$row[valor]'>" . "</td>";
            echo "<td>" . "<input type='submit' value='Salvar alterações'>" . "</td>";
            echo "<td>" . "<input type='submit' value='Apagar'>" . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Sem produtos cadastrados!</p>";
    }
}

        exibirProdutos();


?>