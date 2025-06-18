<?php
require_once __DIR__ . '/../8.controller/usuarioController.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
            <?php listar(); ?>
        </tbody>
    </table>
</div>
</body>
</html>