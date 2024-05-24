<?php

include('conexao.php');
include('protect.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Geral</title>
</head>
<body>

    Bem-vindo ao painel geral, <?php echo $_SESSION['nome']; ?>.

    <form action="cadastroProduto.php" method="GET">
        <p>
            <button type="submit">Cadastrar Produto</button>
        </p>
    </form>

    <form action="tabela.php" method="GET">
        <p>
            <button type="submit">Visualizar Produto</button>
        </p>
    </form>

    <p>
        <a href="logout.php">Sair</a>
    </p>
    
</body>
</html>