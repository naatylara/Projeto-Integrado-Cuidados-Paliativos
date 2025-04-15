<?php
// Inicia a sessão
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION['usuario'])) {
    header('Location: ficha.php'); // Redireciona para a página ficha.php se já estiver logado
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Definir credenciais de login para exemplo (em um caso real, você deve validar no banco de dados)
    $usuarioValido = 'usuario123';
    $senhaValida = 'senha123';

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verifica se as credenciais são válidas
    if ($usuario === $usuarioValido && $senha === $senhaValida) {
        $_SESSION['usuario'] = $usuario; // Inicia a sessão com o nome do usuário
        header('Location: ficha.php'); // Redireciona para a página ficha.php
        exit();
    } else {
        $erro = 'Credenciais inválidas!';
    }
}
?>

