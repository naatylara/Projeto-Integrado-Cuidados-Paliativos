<?php
//include __DIR__. '/../7.dao/ConnectionFactory.php';
//include __DIR__. '/../7.dao/usuarioDaoSQL.php';
include __DIR__ . '/../4.model/usuario.php';
include __DIR__ . '/../7.dao/usuarioDao.php';

//ESTÁ ALTERADO
$usuarioDao = new usuarioDao();

if(isset($_POST['cadastrar'])){
    $usuario = new usuario();
    $usuario->setNomeCompleto($_POST['nome']);
    $usuario->setDataNascimento($_POST['data_nascimento']);
    $usuario->setCidade($_POST['cidade']);
    $usuario->setEstado($_POST['estado']);
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);
    $usuario->setCep($_POST['cep']);
    $usuario->setRua($_POST['rua']);
    $usuario->setComplemento($_POST['complemento']);
    $usuario->setNumero($_POST['numero']);
    $usuario->setBairro($_POST['bairro']);
    $usuario->setUser($_POST['user']);
    
    $usuarioDao->inserir($usuario);
    header("Location: /Projeto-Integrado-Cuidados-Paliativos/5.view/1.index.html");
    exit();
}

if(isset($_GET['editar'])){
    $idUsuario = $_GET['editar'];
    $usuario = $usuarioDao->buscarPorId($idUsuario);
    if(!isset($usuario)){
        echo "<p>Usuario de Id {$idUsuario} não encontrado. </p>";
        header("Location: ../1.index.php?erro=nao_encontrado");
    }
}

if(isset($_POST['salvar_edicao'])){
    $usuario = new usuario();

    $usuario->setId($_POST['id']);
    $usuario->setNomeCompleto($_POST['nome']);
    $usuario->setDataNascimento($_POST['data_nascimento']);
    $usuario->setCidade($_POST['cidade']);
    $usuario->setEstado($_POST['estado']);
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);
    $usuario->setCep($_POST['cep']);
    $usuario->setRua($_POST['rua']);
    $usuario->setComplemento($_POST['complemento']);
    $usuario->setNumero($_POST['numero']);
    $usuario->setBairro($_POST['bairro']);
    $usuario->setUser($_POST['user']);

    $usuarioDao->editar($usuario);
    header("Location: ../5.view/listarUsuarios.php "); // ou onde quiser redirecionar  
}

function listar(){

    $usuarioDao = new usuarioDao();
    $lista = $usuarioDao->read();
    foreach($lista as $user){
        
        echo "<tr>
                <td>{$user->getId()}</td>
                <td>{$user->getNomeCompleto()}</td>
                <td>{$user->getDataNascimento()}</td>
                <td>{$user->getEstado()}</td>
                <td>{$user->getCidade()}</td>
                <td>{$user->getEmail()}</td>

                <td>
                    <a href='6.primeiro_acesso.php?editar={$user->getId()}'class = 'btn btn-primary'> 
                <i class='bi bi-pencil-square'></i>
                Editar</a>

                    <a href='../8.controller/usuarioController.php?excluir={$user->getId()}' class='btn btn-danger'> 
                <i class='bi bi-trash'></i>
                Exluir</a>

                </td>
            </tr>";
    }

}

if(isset($_GET['excluir'])){
    $idUsuario = $_GET['excluir'];
    $usuario = $usuarioDao->buscarPorId($idUsuario);
    if(!isset($usuario)){
        echo "<p>Usuario de Id {$idUsuario} não encontrado. </p>";
        header("Location: ../1.index.php?erro=nao_encontrado");

    } else {

        $usuarioDao->excluir($idUsuario);
        header("Location: ../5.view/listarUsuarios.php?excluido={$idUsuario}");
    
    }
}


?>