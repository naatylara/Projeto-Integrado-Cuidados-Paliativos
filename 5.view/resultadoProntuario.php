<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Resultado do Atendimento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">Resultado do Atendimento</h1>

    <?php
    // Recebe os dados do POST
    $doenca = $_POST['doenca'] ?? '';
    $sintomas = $_POST['sintomas'] ?? [];
    $data = $_POST['data'] ?? '';

    // Lista das doenças graves
    $doencasGraves = [
        'cancer',
        'insuficiencia-cardiaca',
        'doenca-pulmonar',
        'doenca-renal',
        'demencia',
        'esclerose-lateral',
        'avc',
        'cirrose',
        'fibrose-pulmonar'
    ];

    $qtdSintomas = count($sintomas);

    // Avaliação do estado do paciente
    $estado = 'Sem preocupação';
    $mensagem = 'Paciente está estável. Não há necessidade de encaminhamento hospitalar no momento.';

    if (in_array($doenca, $doencasGraves)) {
        if ($qtdSintomas >= 3) {
            $estado = 'Grave';
            $mensagem = 'Encaminhar imediatamente para um hospital. Paciente em estado grave!';
        } elseif ($qtdSintomas > 0) {
            $estado = 'Mediano';
            $mensagem = 'Monitorar de perto. Avaliar necessidade de cuidados adicionais.';
        }
    } else {
        if ($qtdSintomas >= 3) {
            $estado = 'Mediano';
            $mensagem = 'Monitorar de perto. Avaliar necessidade de cuidados adicionais.';
        }
    }
    ?>

    <div class="alert
        <?php
            if ($estado === 'Grave') echo 'alert-danger';
            elseif ($estado === 'Mediano') echo 'alert-warning';
            else echo 'alert-success';
        ?>
    ">
        <h4 class="alert-heading">Estado do Paciente: <strong><?= htmlspecialchars($estado) ?></strong></h4>
        <p><strong>Data do Atendimento:</strong> <?= htmlspecialchars($data) ?></p>
        <p><strong>Doença selecionada:</strong> <?= htmlspecialchars($doenca) ?></p>
        <p><strong>Sintomas informados (<?= $qtdSintomas ?>):</strong></p>
        <ul>
            <?php foreach ($sintomas as $sintoma): ?>
                <li><?= htmlspecialchars($sintoma) ?></li>
            <?php endforeach; ?>
        </ul>

        <hr>
        <p><strong><?= htmlspecialchars($mensagem) ?></strong></p>
    </div>

    <a href="prontuario.php" class="btn btn-secondary">Novo Atendimento</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
