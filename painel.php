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
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <header>
        <nav>
            <div>
                Bem-vindo ao painel geral, <strong><?php echo $_SESSION['nome']; ?></strong>.
            </div>

            <form action="logout.php" method="POST">
                <input type="submit" class="btn btn-danger" value="Sair">
            </form>

        </nav>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Adicionar produtos</h5>
                        <p class="card-text">Clique no botão abaixo para adicionar um novo produto.</p>
                        <a href="cadastroProduto.php" class="btn btn-primary">Adicionar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Visualizar produtos</h5>
                            <p class="card-text">Clique no botão abaixo para visualizar os produtos cadastrados.</p>
                            <a href="tabela.php" class="btn btn-primary">Visualizar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>