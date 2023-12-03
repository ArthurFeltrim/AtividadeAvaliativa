<?php

// assim verifica caso o usuario esteja conectado
session_start();
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Avaliacao";
$sql = "SELECT * FROM usuarios";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consultar usuários no banco de dados
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);;

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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }

        nav {
            background-color: #444;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px;
            margin:  10px;
            font-size: 30px;
            font-family: comic;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
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
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Login</th>
                <!-- Adicione mais colunas conforme necessário -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Exibir dados na tabela
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['Login'] . "</td>";
                    // Adicione mais colunas conforme necessário
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Nenhum usuário cadastrado</td></tr>";
            }
            ?>
        </tbody>
    </table>
    

</body>
</html>
