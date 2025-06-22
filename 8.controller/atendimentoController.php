<?php
//include __DIR__. '/../7.dao/ConnectionFactory.php';
//include __DIR__. '/../7.dao/usuarioDaoSQL.php';
include __DIR__ . '/../4.model/atendimento.php';
include __DIR__ . '/../7.dao/atendimentoDao.php';


$atendimentoDao = new atendimentoDao();

if(isset($_POST['cadastrar'])){
    $atendimento = new atendimento();
    $atendimento->setDoenca($_POST['doenca']);
    $atendimento->setUsuarioId($_POST['usuarioId']);
    $atendimento->setData($_POST['data']);
    $atendimento->setSintomas($_POST['sintomas']);

    $atendimentoDao->inserir($atendimento);
    header("Location: /Projeto-Integrado-Cuidados-Paliativos/5.view/1.index.html");
    exit();
}

if(isset($_GET['editar'])){
    $idAtendimento = $_GET['editar'];
    $atendimento = $atendimentoDao->buscarPorId($idAtendimento);
    if(!isset($atendimento)){
        echo "<p>Atendimento de Id {$idAtendimento} não encontrado. </p>";
        header("Location: ../1.index.php?erro=nao_encontrado");
    }
}

if(isset($_POST['salvar_edicao'])){

    $atendimento = new atendimento();
    $atendimento->setId($_POST['id']);
    $atendimento->setDoenca($_POST['doenca']);
    $atendimento->setUsuarioId($_POST['usuarioId']);
    $atendimento->setData($_POST['data']);
    $atendimento->setSintomas($_POST['sintomas']);

    $atendimentoDao->editar($atendimento);
    header("Location: ../5.view/listarAtendimentos.php "); // ou onde quiser redirecionar  
}

function listar(){

    $atendimentoDao = new atendimentoDao();
    $lista = $atendimentoDao->read();
    foreach($lista as $user){
        
        echo "<tr>
                <td>{$user->getId()}</td>
                <td>{$user->getDoenca()}</td>
                <td>{$user->getUsuarioId()}</td>
                <td>{$user->getData()}</td>
                <td>{$user->getSintomas()}</td>

                <td>
                    <a href='6.primeiro_acesso.php?editar={$user->getId()}'class = 'btn btn-primary'> 
                <i class='bi bi-pencil-square'></i>
                Editar</a>

                    <a href='../8.controller/atendimentoController.php?excluir={$user->getId()}' class='btn btn-danger'> 
                <i class='bi bi-trash'></i>
                Exluir</a>

                </td>
            </tr>";
    }

}

if(isset($_GET['excluir'])){
    $idAtendimento = $_GET['excluir'];
    $atend = $atendimentoDao->buscarPorId($idAtendimento);
    if(!isset($atend)){
        echo "<p>Atendimento de Id {$idAtendimento} não encontrado. </p>";
        header("Location: ../1.index.php?erro=nao_encontrado");

    } else {

        $atendimentoDao->excluir($idAtendimento);
        header("Location: ../5.view/listarAtendimentos.php?excluido={$idAtendimento}");
    
    }
}


?>