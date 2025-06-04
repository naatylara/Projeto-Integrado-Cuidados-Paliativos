<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro de Fabricantes</title>
</head>
<body>
    <?php
    if (isset($_GET['editar'])) {
        echo "chamou via editar"; //Apenas para teste
        require_once 'controller/FabricanteController.php';
    }
    ?>
    <div class="container mt-4">
        <form action="controller/FabricanteController.php" method="post">
            <input type="hidden" name="id" value="<?php echo isset($fabricante) && $fabricante->getId() ? $fabricante->getId() : '' ?>">
            <p>Nome</p>
            <input type="text" name="nome" class="form-control" required>
            <p>Endereço</p>
            <input type="text" name="endereco" class="form-control" required>
            <p>Documento</p>
            <input type="text" name="documento" class="form-control" required>
            <br>
            <input type="submit" value="Salvar" name="cadastrar" class="btn btn-primary">
        </form>

        <div class="row mt-4">
            <div class="col">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "GET") {
                            require_once 'controller/FabricanteController.php';
                            listar();
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- fecha container -->
</body>
</html>