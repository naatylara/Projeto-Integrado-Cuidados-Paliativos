<?php
include __DIR__. '/../7.dao/ConnectionFactory.php';
include __DIR__. '/../7.dao/usuarioDao.php';
include __DIR__. '/../4.model/usuario.php';


$usuarioDao = new usuarioDao();

if(isset($_POST['cadastrar'])){
    $usuario = new Usuario();
    $usuario->setNomeCompleto($_POST['nome']);
    $usuario->setDataNascimento($_POST['data_nascimento']);
    //$usuario->setCpf($_POST['cpf']);
    //$usuario->setEndereco($_POST['endereco']);
    $usuario->setCidade($_POST['cidade']);
    $usuario->setEstado($_POST['estado']);
    //$usuario->setTelefone($_POST['telefone']);
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);
    $usuarioDao->inserir($usuario);
    header("Location: /Projeto-Integrado-Cuidados-Paliativos/5.view/1.index.html");
    exit();
}

if(isset($_GET['editar'])){
    $idUsuario = $_GET['editar'];
    $usuario = $usuarioDao->bucaPorId($idUsuario);
    if(!isset($usuario)){
        echo "<p>Usuario de Id {$idUsuario} não encontrado. </p>";
        header("Location: ../1.index.php?erro=nao_encontrado");
    }
}

if(isset($_POST['salvar_edicao'])){
    $usuario = new Usuario();
    $usuario->setId($_POST['id']);
    $usuario->setNomeCompleto($_POST['nome']);
    $usuario->setDataNascimento($_POST['data_nascimento']); 
    //$usuario->setEndereco($_POST['endereco']);
     $user->setCidade($_POST['cidade']);
    $user->setEstado($_POST['estado']);
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);
    $usuarioDao->editar($usuario);
    header("Location: .../listarUsuarios.php"); // ou onde quiser redirecionar
}

function listar(){
    $usuarioDao = new UsuarioDao();
    $lista = $usuarioDao->read();
    foreach($lista as $usuario){
        echo "<tr> 
                <td>{$usuario->getId()}</td>
                <td>{$usuario->getNomeCompleto()}</td>
                <td>{$usuario->getDataNascimento()}</td>
                <td>{$usuario->getEstado()}</td>
                <td>{$usuario->getCidade()}</td>
                <td>{$usuario->getEmail()}</td>
                <td>
                    <a href='editarUsuario.php?editar={$usuario->getId()}>Editar</a>
                </td>
            </tr>";
    }
}

?>