<?php
    require_once "conexao.php";

    $conexao = conectarBanco();

    //Obtendo o ID via GET
    $id_cliente = $_GET['id'] ?? null;
    $cliente = null;
    $msgErro = "";

    function buscarClientePorId ($id_cliente, $conexao){
        $stmt = $conexao -> prepare("SELECT id_cliente, nome, endereco, telefone, email
                                     FROM cliente WHERE id_cliente = :id");
        $stmt -> bindParam(":id", $id_cliente, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetch();
    }

    if($id_cliente && is_numeric($id_cliente)){
        $cliente = buscarClientePorId($id_cliente, $conexao);
        if(!$cliente){
            $msgErro = "Erro: Cliente não encontrado";
        }
    } else{
        $msgErro = "Digite o ID do client para bsucar os dados";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Atualizar cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous" />
    <style>
        body {
            background-color: red;
            margin: 0;
            padding: 0;
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
            overflow: visible;
            background-color: black;
            display: flex;
        }
        li {
            position: relative;
            float: none; /* flex cuida do alinhamento */
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
            height: 33rem;
            background-color: #DCDCDC;
            margin: 100px auto 0 auto; /* topo para afastar do menu fixo e centralizar */
            border-radius: 8px;
            width: 30rem;
            padding: 20px;
        }
        .card input {
            margin-top: 5px;
            height: 40px;
            border-radius: 8px;
            border: 0px;
            width: 100%;
            box-sizing: border-box;
        }
        .card label {
            margin-top: 15px;
            font-size: 20px;
            display: block;
        }
        .card p {
            margin-top: 20px;
            font-size: 20px;
        }
    </style>
    <script>
        function habilitarEdicao(campo){
            document.getElementById(campo).removeAttribute("readonly");
        }
    </script>
</head>
<body>
    <ul>
        <li><a href="index.php">Início</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Dropdown</a>
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
        <h2>Atualizar Cliente</h2>
        <?php if($msgErro): ?>
            <strong><p style="color:red; margin-top:30px;"><?= htmlspecialchars($msgErro) ?></p></strong>
            <form action="atualizarCliente.php" method="GET">
                <label for="id">ID do cliente:</label>
                <input type="number" id="id" name="id" required min="1" />
                <button type="submit" class="btn btn-outline-dark" style="margin-top:10px;">Buscar</button>
            </form>
        <?php else: ?>
            <form action="processarAtualizacao.php" method="POST">
                <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($cliente['id_cliente']) ?>" />
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" readonly onclick="habilitarEdicao('nome')" />
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" value="<?= htmlspecialchars($cliente['endereco']) ?>" readonly onclick="habilitarEdicao('endereco')" />
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" readonly onclick="habilitarEdicao('telefone')" />
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" readonly onclick="habilitarEdicao('email')" />
                <button type="submit" class="btn btn-outline-dark" style="margin-top:10px;">Atualizar</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
