<?php 
require_once 'conexao.php';

$conexao = conectarBanco();

$busca = trim($_GET['busca'] ?? '');

if (!$busca) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <title>Pesquisar Cliente</title>
        <style>
            body {
                background-color: red;
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }
            ul {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 9999;
                list-style-type: none;
                margin: 0;
                padding: 0;
                background-color: black;
                display: flex;
            }
            li {
                position: relative;
                float: none;
            }
            li a, .dropbtn {
                display: inline-block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                cursor: pointer;
            }
            li a:hover, .dropdown:hover .dropbtn {
                background-color: red;
            }
            .dropdown-content {
                display: none;
                position: absolute;
                background-color: yellow;
                min-width: 160px;
                box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
                z-index: 10000;
                top: 100%;
                left: 0;
            }
            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
            }
            .dropdown-content a:hover {
                background-color: pink;
            }
            .dropdown:hover .dropdown-content {
                display: block;
            }
            .card {
                background-color: #DCDCDC;
                border-radius: 8px;
                width: 90%;
                max-width: 400px;
                margin: 100px auto 40px auto;
                padding: 20px 30px;
                box-sizing: border-box;
                text-align: center;
            }
            label, input {
                display: block;
                width: 100%;
                margin-top: 15px;
                font-size: 18px;
            }
            input {
                height: 40px;
                border-radius: 8px;
                border: 1px solid #999;
                padding: 5px 10px;
            }
            button {
                margin-top: 25px;
                width: 100%;
                height: 40px;
                border-radius: 8px;
                border: none;
                background-color: black;
                color: white;
                font-size: 18px;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            button:hover {
                background-color: red;
            }
        </style>
    </head>
    <body>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Cliente</a>
                <div class="dropdown-content">
                    <a href="atualizarCliente.php">Atualizar</a>
                    <a href="deletarCliente.php">Delete</a>
                    <a href="inserirCliente.php">Inserir</a>
                    <a href="listarClientes.php">Lista</a>
                    <a href="pesquisarCliente.php">Busca</a>
                </div>
            </li>
        </ul>
        <div class="card">
            <form action="pesquisarCliente.php" method="GET">
                <label for="busca">Digite o ID ou Nome do cliente:</label>
                <input type="text" id="busca" name="busca" required />
                <button type="submit">Buscar</button>
            </form>
        </div>
        <CENTER>
<ADRESS>
    Gustavo Tobler - Técnico em Desenvolvimento de sistemas
</ADRESS>
</CENTER>
    </body>
    </html>
    <?php
    exit;
}

// Buscar clientes
if (is_numeric($busca)) {
    $stmt = $conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE id_cliente = :id");
    $stmt->bindParam(":id", $busca, PDO::PARAM_INT);
} else {
    $stmt = $conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE nome LIKE :nome");
    $buscaNome = "%$busca%";
    $stmt->bindParam(":nome", $buscaNome, PDO::PARAM_STR);
}

$stmt->execute();
$clientes = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Resultado da Busca</title>
    <style>
        body {
            background-color: red;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        ul {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 9999;
            list-style-type: none;
            margin: 0;
            padding: 0;
            background-color: black;
            display: flex;
        }
        li {
            position: relative;
            float: none;
        }
        li a, .dropbtn {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            cursor: pointer;
        }
        li a:hover, .dropdown:hover .dropbtn {
            background-color: red;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: yellow;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            z-index: 10000;
            top: 100%;
            left: 0;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }
        .dropdown-content a:hover {
            background-color: pink;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .card {
            background-color: #DCDCDC;
            border-radius: 8px;
            width: 90%;
            max-width: 900px;
            margin: 100px auto 40px auto;
            padding: 20px 30px;
            box-sizing: border-box;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #ccc;
        }
        tr:nth-child(even) {
            background-color: #eee;
        }
        a.edit-link {
            color: blue;
            text-decoration: none;
        }
        a.edit-link:hover {
            text-decoration: underline;
        }
        .mensagem {
            margin: 120px auto 40px auto;
            width: fit-content;
            background-color: #f44336;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <ul>
        <li><a href="index.php">Início</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Cliente</a>
            <div class="dropdown-content">
                <a href="atualizarCliente.php">Atualizar</a>
                <a href="deletarCliente.php">Delete</a>
                <a href="inserirCliente.php">Inserir</a>
                <a href="listarClientes.php">Lista</a>
                <a href="pesquisarCliente.php">Busca</a>
            </div>
        </li>
    </ul>

    <div class="card">
        <h2>Resultado da busca por: "<?php echo htmlspecialchars($busca); ?>"</h2>

        <?php if (count($clientes) === 0): ?>
            <div class="mensagem">Nenhum cliente encontrado.</div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th><th>Nome</th><th>Endereço</th><th>Telefone</th><th>Email</th><th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['id_cliente']) ?></td>
                            <td><?= htmlspecialchars($cliente['nome']) ?></td>
                            <td><?= htmlspecialchars($cliente['endereco']) ?></td>
                            <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                            <td><?= htmlspecialchars($cliente['email']) ?></td>
                            <td><a class="edit-link" href="atualizarCliente.php?id=<?= urlencode($cliente['id_cliente']) ?>">Editar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    
    <CENTER>
<ADRESS>
    Gustavo Tobler - Técnico em Desenvolvimento de sistemas
</ADRESS>
</CENTER>
</body>
</html>
