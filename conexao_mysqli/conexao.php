<?php 
    //Habilita relatório detalhado de erros no MySQLI
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    /*Função para conectar no banco de dados *Retorna um objeto de conexão MySQLI 
     * ou interrompe o script em caso de erro. */
    function conectadb()
    {
        //Configuração de banco de dados
        $endereco = "localhost";// Endereço do servidor MySQLI.
        $usuario = "root";//Nome de usuário do banco de dados.
        $senha = "";//Senha do banco de dados.
        $banco= "empresa";//Nome do banco de dados.

        try {
            //Criação de conexão
            $con = new mysqli($endereco, $usuario, $senha, $banco);
    
            //Definição de conjunto de caracteres para eviar problemas de acentuação
            $con->set_charset("utf8mb4"); //Retorna o objeto de conexão
        } catch (Exception $e){
            //Exibe uma mensagem de erro e encerra o script
            die("Erro na conexão: ".$e->getMessage());
        }
    }
?>