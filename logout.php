<?php
session_start();
require_once('sistema.php'); 
// Verifica se o usuário está logado
if(isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];

    // Atualiza o status de logado 
    $sql = "UPDATE usuarios SET logado = 0 WHERE id = $usuario_id";
    $resultado = mysqli_query($conexao, $sql);

    if($resultado) {
        // Limpa todas as variáveis de sessão
        session_unset();

        // Destrói a sessão
        session_destroy();

        // Redireciona para a página de login
        header("Location: login.php");
        exit();
    } else {
        echo "Erro ao realizar o logout.";
    }
} else {
    // Se o usuário não estiver logado, redirecione para a página de login
    header("Location: login.php");
    exit();
}
?>
