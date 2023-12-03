<?php
// Conectar ao banco de dados (substitua os valores conforme necessário)
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Avaliacao";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consultar usuários no banco de dados
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

// Fechar a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Usuários</title>
</head>
<body>
    <h2>Relatório de Usuários</h2>

    <!-- Tabela de Usuários -->
    <table border="1">
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
