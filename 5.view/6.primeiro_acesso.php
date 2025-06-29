
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!--BOOTSTRAP ICONS--> <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!--BOOTSTRAP--> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--CSS--> <link rel="stylesheet" href="assets/css/style.css"> 
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.jpg">
    <title>Primeiro Acesso</title>
    
    
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 80px;
        }
        .card-cadastro {
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .btn-outline-primary:hover {
            color: #fff;
        }
    </style>
    <script>
        function validateForm(event) {
        const usuario = document.getElementById('usuario');
        const senha = document.getElementById('senha');
        let valid = true;

        // Validação de nome de usuário (mínimo 3 caracteres)
        if (usuario.value.trim().length < 3) {
            usuario.setAttribute('aria-invalid', 'true');
            valid = false;
        } else {
            usuario.removeAttribute('aria-invalid');
        }

        // Validação de senha forte
        const senhaRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!senhaRegex.test(senha.value)) {
            senha.setAttribute('aria-invalid', 'true');
            valid = false;
        } else {
            senha.removeAttribute('aria-invalid');
        }

        if (!valid) {
            event.preventDefault();
            alert("Por favor, preencha os campos corretamente.");
        }
    }
    </script>    
</head>
<body>

     <!-- Cabeçalho -->
    <header class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top border-bottom">
        <div class="container-fluid">
        <!-- Logo / Marca -->
        <a href="1.index.html" class="navbar-brand fw-bold text-primary fs-3">
                <i class="bi bi-heart-pulse-fill me-2 text-danger"></i> Cuidados Paliativos
            </a>
        </div>
    </header>        

    <!-- Formulário de Cadastro -->
    <section class="py-5">
        <?php
        require_once __DIR__ . '/../7.dao/usuarioDao.php';
        $usuarioDao = new usuarioDao();
        if(isset($_GET['editar'])){
    $idUsuario = $_GET['editar'];
    $usuario = $usuarioDao->buscarPorId($idUsuario);
    if(!isset($usuario)){
        echo "<p>Usuario de Id {$idUsuario} não encontrado. </p>";
        header("Location: ../1.index.php?erro=nao_encontrado");
    }
    }
     ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-cadastro bg-white">
                        <h3 class="text-center mb-4">
                        <i class="bi bi-clipboard2-plus me-2 text-primary" style="font-size: 2rem;"></i> Primeiro Acesso
                        </h3>
                        <form action="../8.controller/usuarioController.php" method="POST"> 
                            <input type="hidden" name="id" 
                            value="<?= isset($usuario) && $usuario->getId() ? $usuario->getId() : '' ?>">
                            <!-- Dados Pessoais -->                            
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="nome" class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control" id="nome" name="nome" 
                                        value="<?= isset($usuario) && $usuario->getNomeCompleto() ? $usuario->getNomeCompleto() : '' ?>"required>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                        value="<?= isset($usuario) && $usuario->getEmail() ? $usuario->getEmail() : '' ?>"required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="user" class="form-label">Usuário</label>
                                        <input type="text" class="form-control" id="user" name="user" 
                                        value="<?= isset($usuario) && $usuario->getUser() ? $usuario->getUser() : '' ?>"required> 
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="senha" class="form-label">Senha</label>
                                        <input type="password" class="form-control" id="senha" name="senha" 
                                        value="<?= isset($usuario) && $usuario->getSenha() ? $usuario->getSenha() : '' ?>"required>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="confirmar_senha" class="form-label">Confirmar Senha</label>
                                        <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" 
                                        value="<?= isset($usuario) && $usuario->getDataNascimento() ? $usuario->getDataNascimento() : '' ?>"required>
                                    </div>
                                </div>

                            <!-- Endereço -->
                            <h5 class="mt-4 mb-3">Endereço</h5>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="cep" class="form-label">CEP</label>
                                    <input type="text" class="form-control" id="cep" name="cep" 
                                    value="<?= isset($usuario) && $usuario->getCep() ? $usuario->getCep() : '' ?>"required maxlength="8">
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="rua" class="form-label">Rua</label>
                                    <input type="text" class="form-control" id="rua" name="rua" 
                                    value="<?= isset($usuario) && $usuario->getRua() ? $usuario->getRua() : '' ?>"required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-3">
                                    <label for="numero" class="form-label">Número</label>
                                    <input type="text" class="form-control" id="numero" name="numero" 
                                    value="<?= isset($usuario) && $usuario->getNumero() ? $usuario->getNumero() : '' ?>"required>
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label for="complemento" class="form-label">Complemento</label>
                                    <input type="text" class="form-control" id="complemento" name="complemento"
                                    value="<?= isset($usuario) && $usuario->getComplemento() ? $usuario->getComplemento() : '' ?>">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="bairro" class="form-label">Bairro</label>
                                    <input type="text" class="form-control" id="bairro" name="bairro" 
                                    value="<?= isset($usuario) && $usuario->getBairro() ? $usuario->getBairro() : '' ?>"required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" 
                                    value="<?= isset($usuario) && $usuario->getCidade() ? $usuario->getCidade() : '' ?>"required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="estado" class="form-label">Estado</label>
                                    <input type="text" class="form-control" id="estado" name="estado" 
                                    value="<?= isset($usuario) && $usuario->getEstado() ? $usuario->getEstado() : '' ?>"required>
                                </div>
                                <p id="mensagem-erro" style="color: red; display: none;">CEP não encontrado</p>
                            </div>
                            <?php if(isset($usuario) && $usuario->getId()): ?>
                                <button type="submit" class="btn btn-primary w-100 mt-3" name="salvar_edicao">Salvar Edição</button>
                            <?php else: ?>
                                <button type="submit" class="btn btn-success w-100 mt-3" name="cadastrar">Cadastrar</button>
                            <?php endif; ?>
                        </form>

                        <div class="text-center mt-3">
                            <a href="5.login.html">Já tem conta? Faça login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {

    // Valida se as senhas coincidem
    document.querySelector("form").addEventListener("submit", function(e) {
        const senha = document.getElementById("senha").value;
        const confirmar = document.getElementById("confirmar_senha").value;
        if (senha !== confirmar) {
            e.preventDefault();
            alert("As senhas não coincidem.");
        }
    });

    // Busca o endereço pelo CEP (fonte:https://bruno.art.br/blog/preenchimento-de-endereco-automatico-pelo-campo-cep/)
    const mensagemErro = document.getElementById('mensagem-erro');

    document.getElementById('cep').addEventListener('input', function() {
        const cep = this.value.replace(/\D/g, ''); // remove caracteres não numéricos

        if (cep.length === 8) {
            const url = `https://viacep.com.br/ws/${cep}/json/`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.erro) {
                        mensagemErro.style.display = 'block';
                        resetFields();
                    } else {
                        mensagemErro.style.display = 'none';
                        document.getElementById('rua').value = data.logradouro || '';
                        document.getElementById('complemento').value = data.complemento || '';
                        document.getElementById('bairro').value = data.bairro || '';
                        document.getElementById('estado').value = data.uf || '';
                        document.getElementById('cidade').value = data.localidade || '';
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar CEP:', error);
                    mensagemErro.style.display = 'block';
                    resetFields();
                });
        }
    });

    function resetFields() {
        document.getElementById('rua').value = '';
        document.getElementById('complemento').value = '';
        document.getElementById('bairro').value = '';
        document.getElementById('numero').value = '';
        document.getElementById('estado').value = '';
        document.getElementById('cidade').value = '';
    }

    });

    </script>
</body>
</html>
