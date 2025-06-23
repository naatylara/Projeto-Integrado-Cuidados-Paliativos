<?php
// 5.view/listarAtendimentos.php

// Inclua o arquivo do DAO (que já faz require_once do model)
include_once __DIR__ . '/../7.dao/atendimentoDao.php';
// REMOVIDO: include __DIR__ . '/../4.model/atendimento.php'; // Esta linha é redundante se atendimentoDao.php já a inclui

// Inicia a sessão para exibir mensagens (se houver)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$atendimentoDao = new atendimentoDao();
$listaAtendimentos = $atendimentoDao->read(); // Busca todos os atendimentos da API

// Pega e limpa as mensagens de sucesso/erro da sessão, se existirem
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
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">Atendimentos Cadastrados</h1>

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
        <i class="bi bi-plus-circle"></i> Voltar Para Página Principal
    </a>

    <?php if (empty($listaAtendimentos)): ?>
        <div class="alert alert-info" role="alert">
            Nenhum atendimento encontrado.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
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
                                // Se os sintomas forem um array, converta para string legível
                                if (is_array($sintomas)) {
                                    echo htmlspecialchars(implode(', ', $sintomas));
                                } else {
                                    echo htmlspecialchars($sintomas); // Caso já seja string (ex: JSON raw)
                                }
                                ?>
                            </td>
                            <td>
                                <a href="prontuario.php?editar=<?= htmlspecialchars($atendimento->getId()) ?>" class="btn btn-sm btn-primary me-2">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <a href="../8.controller/atendimentoController.php?excluir=<?= htmlspecialchars($atendimento->getId()) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este atendimento?');">
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