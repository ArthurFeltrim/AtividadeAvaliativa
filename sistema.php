<?php
// assim verifica caso o usuario esteja conectado
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// pega o nome do usuario obetido no banco
$usuario_logado = $_SESSION['login'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo $usuario_logado; ?>!</h2>

    <!-- Menu de Navegação -->
    <nav>
        <ul>
            <li><a href="cadastro_usuarios.php">Cadastro de Usuários</a></li>
            <li><a href="relatorio_usuarios.php">Relatórios de Usuários</a></li>
            <li><a href="atualizacao_usuarios.php">Atualização de Usuários</a></li>
            <li><a href="delecao_usuarios.php">Deleção de Usuários</a></li>
            <li><a href="logoff.php">Logoff</a></li>
        </ul>
    </nav>

    <!-- Conteúdo da Tela Inicial -->
    <h3>Tela Inicial - Relatório de Usuários</h3>
    <!-- Coloque aqui o código para exibir o relatório de usuários -->
</body>
</html>
