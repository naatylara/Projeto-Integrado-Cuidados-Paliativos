<?php
require_once __DIR__ . '/../8.controller/atendimentoController.php';
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
                <th>Doença</th>
                <th>UsuarioId</th>
                <th>Data</th>
                <th>Sintomas</th>
                 
            </tr>
        </thead>
        <tbody>
            <?php listar(); ?>
        </tbody>
    </table>
</div>
</body>
</html>