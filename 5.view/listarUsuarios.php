<?php
include __DIR__ . '/../7.dao/ConnectionFactory.php';
include __DIR__ . '/../7.dao/usuarioDao.php';
include __DIR__ . '/../4.model/usuario.php';

$usuarioDao = new usuarioDao();
$usuarios = $usuarioDao->read();  // pega lista de objetos Usuario

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    if(isset($_GET['editar'])){
        echo "chamou via editar"; //Apenas para teste
        require_once '8.controller/usuarioController.php';

    } 
    ?>
<div class="container mt-4">
    <h2>Usuários cadastrados</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome Completo</th>
                <th>Data de Nascimento</th>
                <th>Endereço</th>
                <th>Email</th>
                 <th>Ações</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            if ($usuarios && count($usuarios) > 0) {
                foreach ($usuarios as $user) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($user->getId()) . "</td>";
                    echo "<td>" . htmlspecialchars($user->getNomeCompleto()) . "</td>";
                    echo "<td>" . htmlspecialchars($user->getDataNascimento()) . "</td>";
                    echo "<td>" . htmlspecialchars($user->getEndereco()) . "</td>";
                    echo "<td>" . htmlspecialchars($user->getEmail()) . "</td>";
                    echo "<td>";echo "<a href='?editar=" . urlencode($user->getId()) . "' class='btn btn-primary btn-sm'>Editar</a>";echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo '<tr><td colspan="5">Nenhum usuário cadastrado.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>