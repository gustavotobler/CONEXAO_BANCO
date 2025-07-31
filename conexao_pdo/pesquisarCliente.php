<?php 
require_once 'conexao.php';

$conexao = conectarBanco();

$busca = $_GET['busca']?? '';
if(!$busca){
?>
<form action="pesquisarCliente.php" method="GET">
    <label for="busca">Digite o ID ou Nome do bobbie goods: </label>
    <input type="text" id="busca" name="busca" required>
    <button type="submit">Buscar</button>
</form>
<?php 
exit;
}

// Buscando clientes
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

if (!$clientes) {
    die("Erro: Nenhum cliente encontrado.");
}
?>
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
        margin: 100px auto 40px auto; /* margem para menu fixo */
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
</style>

<ul>
    <li><a href="index.php">Início</a></li>
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropbtn">DropDown</a>
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
    <h2>Resultado da busca</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($clientes as $cliente): ?>
            <tr>
                <td><?= htmlspecialchars($cliente['id_cliente']) ?></td>
                <td><?= htmlspecialchars($cliente['nome']) ?></td>
                <td><?= htmlspecialchars($cliente['endereco']) ?></td>
                <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                <td><?= htmlspecialchars($cliente['email']) ?></td>
                <td>
                    <a class="edit-link" href="atualizarCliente.php?id=<?= urlencode($cliente['id_cliente']) ?>">Editar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
