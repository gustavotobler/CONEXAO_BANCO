<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Excluir Cliente</title>
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
            height: 20rem;
            background-color: #DCDCDC;
            margin: 100px auto 0 auto; /* afastar do menu fixo e centralizar */
            border-radius: 8px;
            width: 30rem;
            padding: 20px;
        }
        .card input {
            margin-top: 10px;
            height: 40px;
            border-radius: 8px;
            border: 0;
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
            color: red;
        }
        button.btn-outline-dark {
            margin-top: 15px;
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
        <h2>Excluir Cliente</h2>
        <strong><p>Digite o ID do cliente que deseja excluir</p></strong>
        <form action="processarDelecao.php" method="POST">
            <label for="id">ID do Cliente:</label>
            <input type="number" id="id" name="id" required min="1" />
            <button type="submit" class="btn btn-outline-dark">Deletar</button>
        </form>
    </div>
    <CENTER>
<ADRESS>
    Gustavo Tobler - Técnico em Desenvolvimento de sistemas
</ADRESS>
</CENTER>
</body>
</html>
