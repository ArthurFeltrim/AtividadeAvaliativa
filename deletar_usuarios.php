<?php
// Conectar ao banco de dados (substitua os valores conforme necessário)
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Avaliacao";

// Inicializar variáveis
$usuarios = [];

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consultar usuários no banco de dados
$sql_select = "SELECT ID, Login FROM usuarios";
$result_select = $conn->query($sql_select);

// Verificar se há usuários para deletar
if ($result_select->num_rows > 0) {
    while ($row = $result_select->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

// Processar a exclusão quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_user']) && !empty($_POST['delete_user'])) {
        $user_id_to_delete = filter_var($_POST['delete_user'], FILTER_SANITIZE_NUMBER_INT);

        // Excluir o usuário do banco de dados
        $sql_delete = "DELETE FROM usuarios WHERE ID = $user_id_to_delete";

        if ($conn->query($sql_delete) === TRUE) {
            echo "Usuário deletado com sucesso.";
            // Recarregar a página para refletir as alterações
            echo "<script>window.location.href='deletar_usuarios.php';</script>";
            exit;
        } else {
            echo "Erro ao deletar usuário: " . $conn->error;
        }
    }
}

// Fechar a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Usuários</title>
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
            cursor: pointer;
        }

        a:hover {
            color: #555;
        }

        .delete-button {
            background-color: #d9534f;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Deletar Usuários</h2>

    <!-- Tabela de Usuários para Deletar -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($usuarios as $usuario) {
                echo "<tr>";
                echo "<td>" . $usuario['ID'] . "</td>";
                echo "<td>" . $usuario['Login'] . "</td>";
                echo "<td><button class='delete-button' onclick='deleteUser(" . $usuario['ID'] . ")'>Deletar</button></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function deleteUser(userId) {
            if (confirm("Tem certeza de que deseja deletar este usuário?")) {
                // Criar um formulário dinâmico para enviar o ID do usuário a ser deletado
                var form = document.createElement("form");
                form.method = "post";
                form.action = "deletar_usuarios.php";

                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "delete_user";
                input.value = userId;

                form.appendChild(input);
                document.body.appendChild(form);

                form.submit();
            }
        }
    </script>
</body>
</html>
