<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Avaliacao";

// Inicializar variáveis
$id = $login = $senha = "";


if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitizar o ID do usuário
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Conectar ao banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Consultar dados do usuário
    $sql = "SELECT * FROM usuarios WHERE ID = $id";
    $result = $conn->query($sql);

    // Verificar se o usuário existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $login = $row['Login'];
     
    } else {
        echo "Usuário não encontrado.";
        exit;
    }

    // Fechar a conexão
    $conn->close();
}

// Processar o formulário de atualização quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar e validar dados
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
    $senha = $_POST['senha'];

    // Conectar ao banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Atualizar a senha do usuário no banco de dados
    $sql_update = "UPDATE usuarios SET Senha = '$senha' WHERE ID = $id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Senha do usuário atualizada com sucesso.";
    } else {
        echo "Erro ao atualizar senha do usuário: " . $conn->error;
    }

    // Fechar a conexão
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização de Usuários</title>
    <style>
         body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        table {
            max-width: 600px;
            margin: 20px auto;
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #333;
            color: #fff;
        }

        table tr:hover {
            background-color: #f5f5f5;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        a:hover {
            color: #836FFF;
            transition:0.7s;
        }
    </style>
</head>
<body>
    <h2>Atualização de Usuários</h2>

    <!-- Formulário de Atualização -->
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <label for="login">Login:</label>
        <input type="text" name="login" value="<?php echo $login; ?>" required>

        <label for="senha">Nova Senha:</label>
        <input type="password" name="senha" required>

        <input type="submit" value="Atualizar Senha">
    </form>

    <!-- Tabela para Facilitar a Atualização -->
    <h2>Usuários Disponíveis para Atualização</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Atualizar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conectar ao banco de dados
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar a conexão
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            // Consultar usuários no banco de dados
            $sql_select = "SELECT ID, Login FROM usuarios";
            $result_select = $conn->query($sql_select);

            // Tabela de Usuários para Facilitar a Atualização
            if ($result_select->num_rows > 0) {
                while ($row = $result_select->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['Login'] . "</td>";
                    echo "<td><a href='atualizacao_usuarios.php?id=" . $row['ID'] . "'>Atualizar Senha</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nenhum usuário cadastrado</td></tr>";
            }

            // Fechar a conexão
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
