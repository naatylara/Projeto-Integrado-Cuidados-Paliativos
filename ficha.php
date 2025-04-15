<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php'); // Redireciona para a página de login se o usuário não estiver logado
    exit();
}

$usuario = $_SESSION['usuario'];

// Exemplo de dados da ficha médica (esses dados podem vir de um banco de dados real)
$fichaMedica = [
    'nome' => 'João da Silva',
    'idade' => 65,
    'genero' => 'Masculino',
    'condicao' => 'Doença terminal - câncer',
    'tratamento' => 'Quimioterapia',
    'medicamentos' => 'Analgesicos, Antieméticos',
    'observacoes' => 'Necessário acompanhamento contínuo.',
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Ficha Médica - Cuidados Paliativos</title>
</head>
<body>
    <!-- Cabeçalho -->
    <header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Cuidados Paliativos</a>
            <div class="ms-auto">
                <a href="logout.php" class="btn btn-outline-danger">Sair</a>
            </div>
        </div>
    </header>

    <!-- Ficha Médica -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Ficha Médica - <?php echo $fichaMedica['nome']; ?></h2>
            <div class="row">
                <div class="col-md-6">
                    <h5>Informações Pessoais</h5>
                    <p><strong>Nome:</strong> <?php echo $fichaMedica['nome']; ?></p>
                    <p><strong>Idade:</strong> <?php echo $fichaMedica['idade']; ?> anos</p>
                    <p><strong>Gênero:</strong> <?php echo $fichaMedica['genero']; ?></p>
                </div>
                <div class="col-md-6">
                    <h5>Informações Médicas</h5>
                    <p><strong>Condição:</strong> <?php echo $fichaMedica['condicao']; ?></p>
                    <p><strong>Tratamento:</strong> <?php echo $fichaMedica['tratamento']; ?></p>
                    <p><strong>Medicamentos:</strong> <?php echo $fichaMedica['medicamentos']; ?></p>
                    <p><strong>Observações:</strong> <?php echo $fichaMedica['observacoes']; ?></p>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
