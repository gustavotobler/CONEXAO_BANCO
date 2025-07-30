<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PDO - Display Centralizado</title>
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
    </style>
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

  
</body>
</html>
