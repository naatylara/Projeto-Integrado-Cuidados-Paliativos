<?php
// 6.view/prontuario.php

include_once '../7.dao/atendimentoDao.php';
// REMOVIDO: include_once '../4.model/atendimento.php'; // Esta linha é redundante se atendimentoDao.php já a inclui

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$atendimentoDao = new atendimentoDao();
$atendimento = null; // Inicializa a variável atendimento como null

// Pega e limpa as mensagens de sucesso ou erro da sessão, se existirem
$mensagemSucesso = $_SESSION['mensagem_sucesso'] ?? '';
unset($_SESSION['mensagem_sucesso']);

$mensagemErro = $_SESSION['mensagem_erro'] ?? '';
unset($_SESSION['mensagem_erro']);


if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $atendimento = $atendimentoDao->buscarPorId($id);
    if (!isset($atendimento)) {
        $_SESSION['mensagem_erro'] = "Atendimento de ID {$id} não encontrado para edição.";
        header("Location: listarAtendimentos.php"); // Redireciona para a lista se não encontrar
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $atendimento ? "Editar Atendimento" : "Cadastrar Atendimento" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="container my-5">

    <h1 class="mb-4"><?= $atendimento ? "Editar Atendimento" : "Cadastrar Atendimento" ?></h1>

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

    <form action="../8.controller/atendimentoController.php" method="POST">
        
        <?php if ($atendimento): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($atendimento->getId()) ?>" />
            <input type="hidden" name="salvar_edicao" value="1" />
        <?php else: ?>
            <input type="hidden" name="cadastrar" value="1" />
        <?php endif; ?>

        <div class="mb-3">
            <label for="doenca" class="form-label">Doença:</label>
            <input type="text" class="form-control" id="doenca" name="doenca" value="<?= htmlspecialchars($atendimento ? $atendimento->getDoenca() : '') ?>" required />
        </div>

        <div class="mb-3">
            <label for="usuario_id" class="form-label">ID do Usuário:</label>
            <input type="number" class="form-control" id="usuario_id" name="usuario_id" value="<?= htmlspecialchars($atendimento ? $atendimento->getUsuarioId() : '') ?>" required />
        </div>

        <div class="mb-3">
            <label for="data" class="form-label">Data:</label>
            <input type="date" class="form-control" id="data" name="data" value="<?= htmlspecialchars($atendimento ? $atendimento->getData() : date('Y-m-d')) ?>" required />
        </div>

        <div class="mb-3">
            <label class="form-label">Sintomas:</label>
            <?php
            // Lista de sintomas possíveis
            $sintomasLista = [
                "febre" => "Febre",
                "tosse" => "Tosse",
                "dor-cabeca" => "Dor de cabeça",
                "fadiga" => "Fadiga",
                "dor-garganta" => "Dor de garganta",
                "congestao" => "Congestão nasal",
                "diarreia" => "Diarreia",
                "vomito" => "Vômito",
                "erupcao-cutanea" => "Erupção cutânea",
                "dor-muscular" => "Dor muscular",
                "perda-olfato" => "Perda de olfato/paladar",
                "dificuldade-respirar" => "Dificuldade de respirar",
                "dor-peito" => "Dor no peito",
                "delirio" => "Delírio / Confusão mental",
                "constipacao" => "Constipação intestinal",
                "perda-apetite" => "Perda de apetite",
                "disfagia" => "Disfagia (dificuldade de engolir)",
                "fraqueza" => "Fraqueza muscular",
            ];

            // Pega os sintomas selecionados do atendimento existente (se estiver editando)
            $sintomasSelecionados = [];
            if ($atendimento) {
                $sintomasDoObjeto = $atendimento->getSintomas();
                if (is_array($sintomasDoObjeto)) {
                    $sintomasSelecionados = $sintomasDoObjeto;
                } else {
                    // Se, por algum motivo, não for um array, tenta decodificar como JSON
                    $decoded = json_decode($sintomasDoObjeto, true);
                    $sintomasSelecionados = is_array($decoded) ? $decoded : [];
                }
            }

            foreach ($sintomasLista as $key => $label) {
                // Marca o checkbox se o sintoma estiver na lista do atendimento
                $checked = in_array($key, $sintomasSelecionados) ? 'checked' : '';
                echo "
                <div class='form-check'>
                    <input class='form-check-input' type='checkbox' name='sintomas[]' value='$key' id='sintoma_$key' $checked />
                    <label class='form-check-label' for='sintoma_$key'>$label</label>
                </div>";
            }
            ?>
        </div>

        <button type="submit" class="btn btn-primary"><?= $atendimento ? "Salvar Edição" : "Cadastrar Atendimento" ?></button>
    </form>

    <a href="listarAtendimentos.php" class="btn btn-secondary mt-3">
        <i class="bi bi-list"></i> Voltar para a Listagem
    </a>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>