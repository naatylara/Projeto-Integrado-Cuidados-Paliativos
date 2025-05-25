<?php
    class ConnectionFactory{
        static $connection;

        public static function getConnection(){
            if(!issset($connection)){
                $port = 3306;                       //porta banco de dados
                $dbName = "CuidadosPaliativosDb";   //nome do banco de dados
                $userDb = "root";                   // usuário do banco de dados
                $host = "localhost";                // onde está hospedado meu banco de dados
                $pass = "";                         //
            
            try{
                $connection = new PDO("mysql:host=$host;dbname=$dbName;port=$port", $userDb, $pass); // <-- $connection é o objeto da classe PDO para gerenciar o BD
                echo "Servidor conectado com sucesso !";
                return $connection;
            }catch(PDOException $ex){                       // pega a excessão PDO e coloca na variável $ex
                echo "Erro na aplicação !".$ex -> getMessage();
            }
        }
        return $connection;
    }
}
?>