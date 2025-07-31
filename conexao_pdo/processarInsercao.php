<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Inserir Cliente</title>
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
        .mensagem {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px 40px;
            border-radius: 8px;
            font-size: 18px;
            color: white;
            z-index: 10001;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }
        .sucesso {
            background-color:rgb(235, 183, 15);
        }
        .erro {
            background-color:rgb(105, 32, 19);
    </style>
</head>
<body>

<ul>
    <li><a href="index.php">Início</a></li>
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropbtn">Menu</a>
        <div class="dropdown-content">
            <a href="atualizarCliente.php">Atualizar</a>
            <a href="deletarCliente.php">Delete</a>
            <a href="inserirCliente.php">Inserir</a>
            <a href="listarClientes.php">Lista</a>
            <a href="pesquisarCliente.php">Busca</a>
        </div>
    </li>
</ul>
<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexao = conectarBanco();

    // Sanitização básica e validação mínima
    $nome = htmlspecialchars(trim($_POST["nome"]));
    $endereco = htmlspecialchars(trim($_POST["endereco"]));
    $telefone = htmlspecialchars(trim($_POST["telefone"]));
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

    if (!$email) {
        echo '<div class="mensagem erro" id="msg">Email inválido.</div>';
    } else {
        $sql = "INSERT INTO cliente (nome, endereco, telefone, email) VALUES (:nome, :endereco, :telefone, :email)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":email", $email);

        try {
            $stmt->execute();
            echo '<div class="mensagem sucesso" id="msg">Cliente cadastrado com sucesso!</div>';
        } catch (PDOException $e) {
            error_log("Erro ao inserir cliente: " . $e->getMessage());
            echo '<div class="mensagem erro" id="msg">Erro ao cadastrar cliente.</div>';
        }
    }
}
?>

<script>
// Desaparece a mensagem após 3 segundos
setTimeout(() => {
    const msg = document.getElementById("msg");
    if (msg) {
        msg.style.opacity = "0";
        setTimeout(() => msg.remove(), 500);
    }
}, 3000);
</script>
<CENTER>
<ADRESS>
    Gustavo Tobler - Técnico em Desenvolvimento de sistemas
</ADRESS>
</CENTER>

</body>
</html>
