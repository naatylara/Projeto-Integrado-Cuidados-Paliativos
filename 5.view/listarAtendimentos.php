<?php
// 5.view/listarAtendimentos.php

include_once __DIR__ . '/../7.dao/atendimentoDao.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$atendimentoDao = new atendimentoDao();
$listaAtendimentos = $atendimentoDao->read();

$mensagemSucesso = $_SESSION['mensagem_sucesso'] ?? '';
unset($_SESSION['mensagem_sucesso']);

$mensagemErro = $_SESSION['mensagem_erro'] ?? '';
unset($_SESSION['mensagem_erro']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Listar Atendimentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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

<div class="container my-5">
    <h1 class="page-title">Atendimentos Cadastrados</h1>

    <?php if ($mensagemSucesso): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($mensagemSucesso) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if ($mensagemErro): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($mensagemErro) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <a href="1.index.html" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Voltar para Tela Inicial
    </a>

    <?php if (empty($listaAtendimentos)): ?>
        <div class="alert alert-info" role="alert">
            Nenhum atendimento encontrado.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Doença</th>
                        <th>ID Usuário</th>
                        <th>Data</th>
                        <th>Sintomas</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaAtendimentos as $atendimento): ?>
                        <tr>
                            <td><?= htmlspecialchars($atendimento->getId()) ?></td>
                            <td><?= htmlspecialchars($atendimento->getDoenca()) ?></td>
                            <td><?= htmlspecialchars($atendimento->getUsuarioId()) ?></td>
                            <td><?= htmlspecialchars($atendimento->getData()) ?></td>
                            <td>
                                <?php
                                $sintomas = $atendimento->getSintomas();
                                if (is_array($sintomas)) {
                                    echo htmlspecialchars(implode(', ', $sintomas));
                                } else {
                                    echo htmlspecialchars($sintomas);
                                }
                                ?>
                            </td>
                            <td>
                                <a href="prontuario.php?editar=<?= htmlspecialchars($atendimento->getId()) ?>" class="btn btn-sm btn-primary btn-action me-2">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <a href="../8.controller/atendimentoController.php?excluir=<?= htmlspecialchars($atendimento->getId()) ?>" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Tem certeza que deseja excluir este atendimento?');">
                                    <i class="bi bi-trash"></i> Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
