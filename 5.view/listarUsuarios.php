<?php
//include __DIR__ . '/../7.dao/ConnectionFactory.php';    
//include __DIR__ . '/../7.dao/usuarioDao.php';
include __DIR__ . '/../4.model/usuario.php';
//include __DIR__ . '/../7.dao/usuarioDaoSQL.php';


//$usuarioDao = new usuarioDao();
//$usuarios = $usuarioDao->read();  // pega lista de objetos Usuario

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    if(isset($_GET['editar'])){
        echo "chamou via editar"; //Apenas para teste
        require_once '8.controller/usuarioController.php';

    } 
    ?>
<div class="container mt-4">
    <h2>Usuários cadastrados</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome Completo</th>
                <th>Data de Nascimento</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Email</th>
                <th>Ações</th> 
            </tr>
        </thead>
        <tbody>
            <?php
                if($_SERVER["REQUEST_METHOD"] == "GET"){
                    require_once __DIR__ . '/../8.controller/usuarioController.php';
                    echo "teste";
                    listar();
                }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>