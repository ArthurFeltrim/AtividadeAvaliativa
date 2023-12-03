<?php
// Conectar ao banco de dados (substitua os valores conforme necessário)
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Avaliacao";

function cadastrarUsuario($login, $senha) {
    global $servername, $username, $password, $dbname;

    // Validar dados (adapte conforme necessário)
    if (empty($login) || empty($senha)) {
        return "Preencha todos os campos.";
    }

    // Conectar ao banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verificar se o usuário já existe
    $sql_verificar = "SELECT * FROM usuarios WHERE Login = '$login'";
    $result_verificar = $conn->query($sql_verificar);

    if ($result_verificar->num_rows > 0) {
        return "Usuário já cadastrado. Escolha outro login.";
    }

    // Inserir usuário no banco de dados
    $sql_inserir = "INSERT INTO usuarios (Login, Senha) VALUES ('$login', '$senha')";
    
    if ($conn->query($sql_inserir) === TRUE) {
        return "Cadastro realizado com sucesso.";
    } else {
        return "Erro ao cadastrar usuário: " . $conn->error;
    }

    $conn->close();
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Chamar a função de cadastro
    $resultado_cadastro = cadastrarUsuario($login, $senha);

    // Exibir mensagem de resultado
    echo $resultado_cadastro;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <h2>Cadastrar Usuário</h2>

    <!-- Formulário de Cadastro -->
    <form method="post" action="">
        <label for="login">Login:</label>
        <input type="text" name="login" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
