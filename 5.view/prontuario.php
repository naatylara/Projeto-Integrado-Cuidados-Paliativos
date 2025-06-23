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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
