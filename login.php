<?php
// Inicio da sessão
session_start();

// Para se conectar ao meu banco de dados
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "Avaliacao";

$conn = new mysqli($servername, $username, $password, $dbname);

// um if para validar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// vefica se caso foi enviado o formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // consulta o banco para validar as credencias
    $sql = "SELECT * FROM usuarios WHERE Login = '$login' AND Senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Caso o login seja feito com sucesso
        $_SESSION['login'] = $login;
        header("Location: sistema.php");
        exit();
    } else {
        // caso o login falhe
        $error_message = "Credenciais inválidas.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    
    <?php if(isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>

    <form method="post" action="">
        <label for="login">Login:</label>
        <input type="text" name="login" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>
