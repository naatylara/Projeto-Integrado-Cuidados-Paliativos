<?php
require_once __DIR__ . '/../8.controller/usuarioController.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .page-title {
            text-align: center;
            font-weight: bold;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #0d6efd;
        }
        .custom-table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .custom-table thead {
            background-color: #0d6efd;
            color: white;
        }
        .custom-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn-action {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .btn-action i {
            font-size: 1rem;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2 class="page-title">Usuários Cadastrados</h2>

    <table class="table table-striped table-bordered custom-table">
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
