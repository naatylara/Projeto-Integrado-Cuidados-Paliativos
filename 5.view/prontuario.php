<?php
// 6.view/prontuario.php

include_once '../7.dao/atendimentoDao.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$atendimentoDao = new atendimentoDao();
$atendimento = null;

$mensagemSucesso = $_SESSION['mensagem_sucesso'] ?? '';
unset($_SESSION['mensagem_sucesso']);

$mensagemErro = $_SESSION['mensagem_erro'] ?? '';
unset($_SESSION['mensagem_erro']);

if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $atendimento = $atendimentoDao->buscarPorId($id);
    if (!isset($atendimento)) {
        $_SESSION['mensagem_erro'] = "Atendimento de ID {$id} não encontrado para edição.";
        header("Location: listarAtendimentos.php");
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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.jpg">

    <style>
        body {
            background: #f0f2f5;
            padding-top: 80px;
        }
        .card-login {
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .btn-outline-primary:hover {
            color: #fff;
        }
    </style>
</head>
<body>

<header class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top border-bottom">
    <div class="container-fluid">
        <a href="1.index.html" class="navbar-brand fw-bold text-primary fs-3">
            <i class="bi bi-heart-pulse-fill me-2 text-danger"></i> Cuidados Paliativos
        </a>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-9">
                <div class="card card-login bg-white">
                    <h2 class="text-center mb-4">
                        <i class="bi bi-clipboard2-plus" style="font-size: 2rem;"></i><br>
                        <?= $atendimento ? "Editar Atendimento" : "Cadastrar Atendimento" ?>
                    </h2>

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
                            <?php
                            // Lista de doenças predefinida
                            $doencasLista = [
                                "cancer" => "Câncer",
                                "alzheimer" => "Doença de Alzheimer",
                                "parkinson" => "Parkinson ",
                                "esclerose" => "Esclerose Lateral Amiotrófica (ELA)",
                                "insuficiencia" => "Insuficiência cardíaca",
                                "dpoc" => "Doença pulmonar obstrutiva crônica (DPOC) ",
                                "hiv" => "HIV/AIDS",                             

                            ];
                            $doencaAtual = $atendimento ? $atendimento->getDoenca() : '';
                            ?>
                            <select class="form-select" id="doenca" name="doenca" required>
                                <option value="">Selecione uma doença</option>
                                <?php foreach ($doencasLista as $key => $label): ?>
                                    <option value="<?= $key ?>"
                                        <?= $doencaAtual === $key ? 'selected' : '' ?>>
                                        <?= $label ?>
                                    </option>
                                <?php endforeach; ?>

                                <?php if ($doencaAtual && !isset($doencasLista[$doencaAtual])): ?>
                                    <option value="<?= htmlspecialchars($doencaAtual) ?>" selected>
                                        <?= "Outro: " . htmlspecialchars($doencaAtual) ?>
                                    </option>
                                <?php endif; ?>
                            </select>
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

                            $sintomasSelecionados = [];
                            if ($atendimento) {
                                $sintomasDoObjeto = $atendimento->getSintomas();
                                if (is_array($sintomasDoObjeto)) {
                                    $sintomasSelecionados = $sintomasDoObjeto;
                                } else {
                                    $decoded = json_decode($sintomasDoObjeto, true);
                                    $sintomasSelecionados = is_array($decoded) ? $decoded : [];
                                }
                            }

                            foreach ($sintomasLista as $key => $label) {
                                $checked = in_array($key, $sintomasSelecionados) ? 'checked' : '';
                                echo "
                                <div class='form-check'>
                                    <input class='form-check-input' type='checkbox' name='sintomas[]' value='$key' id='sintoma_$key' $checked />
                                    <label class='form-check-label' for='sintoma_$key'>$label</label>
                                </div>";
                            }
                            ?>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary"><?= $atendimento ? "Salvar Edição" : "Cadastrar Atendimento" ?></button>
                            <a href="listarAtendimentos.php" class="btn btn-outline-primary">
                                <i class="bi bi-list"></i> Voltar para a Listagem
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>