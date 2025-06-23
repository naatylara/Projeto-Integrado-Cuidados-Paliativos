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
    <title>Cadastrar Atendimento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container my-5">

    <h1 class="mb-4">Cadastrar Atendimento</h1>

    <form action="resultadoProntuario.php" method="POST">

        <div class="mb-3">
            <label for="data" class="form-label">Data do Atendimento</label>
            <input type="date" class="form-control" id="data" name="data" required />
        </div>

        <div class="mb-3">
            <label for="doenca" class="form-label">Selecione a Doença</label>
            <select class="form-select" id="doenca" name="doenca" required>
                <option value="" selected disabled>Escolha uma doença</option>
                <option value="cancer">Câncer</option>
                <option value="insuficiencia-cardiaca">Insuficiência Cardíaca</option>
                <option value="doenca-pulmonar">Doença Pulmonar Obstrutiva Crônica (DPOC)</option>
                <option value="doenca-renal">Doença Renal Crônica</option>
                <option value="demencia">Demência / Alzheimer</option>
                <option value="esclerose-lateral">Esclerose Lateral Amiotrófica (ELA)</option>
                <option value="avc">Acidente Vascular Cerebral (AVC)</option>
                <option value="cirrose">Cirrose Hepática</option>
                <option value="fibrose-pulmonar">Fibrose Pulmonar</option>
                <option value="parkinson">Doença de Parkinson avançada</option>
                <option value="doenca-infecciosa">Doenças Infecciosas avançadas (ex: HIV/AIDS)</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Selecione os Sintomas</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sintomas[]" value="dor" id="sintomaDor" />
                <label class="form-check-label" for="sintomaDor">Dor Crônica</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sintomas[]" value="fadiga" id="sintomaFadiga" />
                <label class="form-check-label" for="sintomaFadiga">Fadiga</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sintomas[]" value="falta-de-ar" id="sintomaFaltaAr" />
                <label class="form-check-label" for="sintomaFaltaAr">Falta de Ar (Dispneia)</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sintomas[]" value="ansiedade" id="sintomaAnsiedade" />
                <label class="form-check-label" for="sintomaAnsiedade">Ansiedade</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sintomas[]" value="nausea" id="sintomaNausea" />
                <label class="form-check-label" for="sintomaNausea">Náusea</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sintomas[]" value="depressao" id="sintomaDepressao" />
                <label class="form-check-label" for="sintomaDepressao">Depressão</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sintomas[]" value="insonia" id="sintomaInsonia" />
                <label class="form-check-label" for="sintomaInsonia">Insônia</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sintomas[]" value="delirio" id="sintomaDelirio" />
                <label class="form-check-label" for="sintomaDelirio">Delírio / Confusão mental</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sintomas[]" value="constipacao" id="sintomaConstipacao" />
                <label class="form-check-label" for="sintomaConstipacao">Constipação intestinal</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sintomas[]" value="perda-apetite" id="sintomaPerdaApetite" />
                <label class="form-check-label" for="sintomaPerdaApetite">Perda de apetite</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sintomas[]" value="disfagia" id="sintomaDisfagia" />
                <label class="form-check-label" for="sintomaDisfagia">Disfagia (dificuldade de engolir)</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sintomas[]" value="fraqueza" id="sintomaFraqueza" />
                <label class="form-check-label" for="sintomaFraqueza">Fraqueza muscular</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Atendimento</button>
    </form>
</div>

    <!-- Bootstrap 5 JS Bundle CDN (Popper + JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Code injected by live-server -->
    <script>
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function () {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + window.location.host + window.location.pathname + '/ws';
                var socket = new WebSocket(address);
                socket.onmessage = function (msg) {
                    if (msg.data == 'reload') window.location.reload();
                    else if (msg.data == 'refreshcss') refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                    console.log('Live reload enabled.');
                    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                }
            })();
        }
        else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>
    </script>
</body>
</html>