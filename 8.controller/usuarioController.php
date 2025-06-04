<?php
include __DIR__. '/../7.dao/ConnectionFactory.php';
include __DIR__. '/../7.dao/usuarioDao.php';
include __DIR__. '/../4.model/usuario.php';


$usuarioDao = new usuarioDao();

if(isset($_POST['cadastrar'])){
    $usuario = new Usuario();
    $usuario->setNomeCompleto($_POST['nomeCompleto']);
    $usuario->setDataNascimento($_POST['dataNascimento']);
    $usuario->setCpf($_POST['cpf']);
    $usuario->setEndereco($_POST['endereco']);
    $usuario->setTelefone($_POST['telefone']);
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);
    $usuarioDao->inserir($usuario);
    header("Location: ../index.php");

}


?>