<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Cadastro de Cliente</h2>
    <form action="processarinsercao.php" method="POST">
        <label for="nome">Nome: </label>
        <input type="text" id="nome" name="nome" required>
        <br/>
        <br/>

        <label for="endereco">Endereco: </label>
        <input type="text" id="endereco" name="endereco" required>
        <br/>
        <br/>

        <label for="telefone">Telefone: </label>
        <input type="text" id="telefone" name="telefone" required>
        <br/>
        <br/>

        <label for="email">Email: </label>
        <input type="email" id="email" name="email" required>
        <br/>
        <br/>

        <button type="submit">Cadastrar Cliente</button>
    </form>
    
</body>
</html>