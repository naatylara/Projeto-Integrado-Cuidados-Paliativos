<?php
include '../dao/ConnectionFactory.php';
include '../dao/usuarioDao.php';
include '../model/usuario.php';

$usuario = new Usuario();
$usuarioDao = new usuarioDao();

if(isset($_POST['cadastrar'])){
    $usuario->setNomeCompleto($_POST['nomeCompleto']);
    $usuario->setDataNascimento($_POST['dataNascimento']);
    $usuario->setCpf($_POST['cpf']);
    $usuario->setEndereco($_POST['endereco']);
    $usuario->setTelefone($_POST['telefone']);
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);
    $usuarioDao->inserir($usuario);
    //header("Location: ../index.php");

}


?>