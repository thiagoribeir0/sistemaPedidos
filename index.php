<?php

include('conexao.php');

if (isset($_POST['email']) || isset($_POST['senha'])) { // verifica se os campos email ou senha foram enviados via método POST - isset: verifica se a variável foi definida e não é nula
    if (strlen($_POST['email']) == 0) { // verifica se o campo email está vazio - strlen: retorna o comprimento de uma string
        echo "Preencha seu e-mail.";
    } else if (strlen($_POST['senha']) == 0) { // verifica se o campo senha está vazio 
        echo "Preencha sua senha.";
    } else {

        // atribuição de variáveis
        $email = $_POST['email']; // atribui o valor enviado no formulário para a variável email
        $senha = $_POST['senha']; // atribui o valor enviado no formulário para a variável senha

        // preparação da consulta 
        $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?"); // prepara a consulta para selecionar todos os campos da tabela 'usuarios' onde o email corresponde ao valor fornecido
        $stmt->bind_param("ss", $email, $senha); // vincula o parâmetro $email à consulta; 's' indica que o tipo do parâmetro é string
        $stmt->execute(); // executa a instrução preparada
        $result = $stmt->get_result(); // obtém o resultado da consulta
        $quantidade = $result->num_rows; // obtém o número de linhas retornadas pela consulta

        if ($quantidade == 1) { // se exatamente um usuário foi encontrado com o email e senha fornecidos

            $usuario = $result->fetch_assoc(); // obtém os dados do usuário como um array associativo

            if (!isset($_SESSION)) {
                session_start(); // inicia uma nova sessão, se ainda não foi iniciada
            }

            $_SESSION['id'] = $usuario['id']; // armazena o ID do usuário na sessão
            $_SESSION['nome'] = $usuario['nome']; // armazena o nome na sessão

            header("Location: painel.php"); // redireciona o usuário autenticado para o painel
        } else {
            echo "<script>alert('Falha ao logar! E-mail ou senha incorretos.');</script>"; // exibe uma mensagem de erro se o email ou senha estiverem incorretos
        }

        $stmt->close(); // fecha a instrução preparada
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
    <title>Página de Login</title>
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