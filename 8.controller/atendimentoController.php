<?php
// 8.controller/atendimentoController.php

// Alterado para include_once para garantir que a classe seja definida apenas uma vez
include_once __DIR__ . '/../4.model/atendimento.php'; 
include_once __DIR__ . '/../7.dao/atendimentoDao.php'; // Alterado para include_once

// Inicia a sessão para gerenciar mensagens de sucesso/erro e redirecionamentos
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$atendimentoDao = new atendimentoDao();

// --- Lógica para CADASTRAR Atendimento ---
if (isset($_POST['cadastrar'])) {
    $atendimento = new atendimento();
    // Uso do operador null coalescing (??) para evitar "Undefined array key"
    $atendimento->setDoenca($_POST['doenca'] ?? '');
    // CORREÇÃO CRÍTICA: Use 'usuario_id' para pegar o valor do POST
    $atendimento->setUsuarioId($_POST['usuario_id'] ?? ''); 
    $atendimento->setData($_POST['data'] ?? '');
    
    $sintomas = isset($_POST['sintomas']) ? $_POST['sintomas'] : [];
    // Converte o array de sintomas para JSON string ANTES de setar no objeto, pois a API espera JSON
    $atendimento->setSintomas(json_encode($sintomas)); 

    // Adicionado validação básica antes de enviar para a API
    if (empty($atendimento->getDoenca()) || empty($atendimento->getData()) || empty($atendimento->getUsuarioId())) {
        $_SESSION['mensagem_erro'] = "Por favor, preencha a doença, a data e o ID do usuário.";
        // Redireciona de volta para o formulário, permitindo que o usuário veja o erro
        header("Location: ../6.view/prontuario.php"); 
        exit();
    }

    $result = $atendimentoDao->inserir($atendimento);

    if ($result) { // O método inserir agora retorna o JSON da API ou true/false
        $_SESSION['mensagem_sucesso'] = "Atendimento cadastrado com sucesso!";
        // Redireciona para uma página de sucesso, talvez mostrando o ID do novo atendimento
        $idAtendimentoCriado = $result['id'] ?? null;
        if ($idAtendimentoCriado) {
            header("Location: ../5.view/resultadoProntuario.php?id_atendimento=" . $idAtendimentoCriado);
        } else {
            header("Location: ../5.view/listarAtendimentos.php"); // Fallback
        }
        exit();
    } else {
        $_SESSION['mensagem_erro'] = "Erro ao cadastrar atendimento. Verifique o ID do usuário e a API.";
        header("Location: ../6.view/prontuario.php"); // Redireciona de volta para o formulário
        exit();
    }
}

// --- Lógica para EDITAR Atendimento ---
if (isset($_POST['salvar_edicao'])) { 
    $atendimento = new atendimento();
    $atendimento->setId($_POST['id'] ?? null); // Certifica que o ID existe
    $atendimento->setDoenca($_POST['doenca'] ?? '');
    // CORREÇÃO CRÍTICA: Use 'usuario_id' para pegar o valor do POST
    $atendimento->setUsuarioId($_POST['usuario_id'] ?? ''); 
    $atendimento->setData($_POST['data'] ?? '');
    
    $sintomas = isset($_POST['sintomas']) ? $_POST['sintomas'] : [];
    $atendimento->setSintomas(json_encode($sintomas)); // Converte para JSON string

    // Adicionado validação básica para edição
    if (empty($atendimento->getId()) || empty($atendimento->getDoenca()) || empty($atendimento->getData()) || empty($atendimento->getUsuarioId())) {
        $_SESSION['mensagem_erro'] = "Dados incompletos para edição.";
        // Redireciona de volta para o formulário de edição com o ID
        header("Location: ../6.view/prontuario.php?editar=" . $atendimento->getId());
        exit();
    }

    $result = $atendimentoDao->editar($atendimento);

    if ($result) { // O método editar agora deve retornar true/false ou o JSON da API
        $_SESSION['mensagem_sucesso'] = "Atendimento editado com sucesso!";
        header("Location: ../5.view/listarAtendimentos.php"); // Redireciona para sua página de listagem
        exit();
    } else {
        $_SESSION['mensagem_erro'] = "Erro ao editar atendimento. Verifique o ID do usuário e a API.";
        header("Location: ../6.view/prontuario.php?editar=" . $atendimento->getId()); // Redireciona de volta
        exit();
    }
}

// --- Lógica para Excluir Atendimento ---
if (isset($_GET['excluir'])) {
    $idAtendimento = $_GET['excluir'];
    // Você pode adicionar uma verificação se o atendimento existe antes de tentar excluir,
    // ou confiar na API para isso.
    $result = $atendimentoDao->excluir($idAtendimento); // Seu método excluir deve retornar true/false

    if ($result) {
        $_SESSION['mensagem_sucesso'] = "Atendimento excluído com sucesso!";
        header("Location: ../5.view/listarAtendimentos.php?excluido={$idAtendimento}");
        exit();
    } else {
        $_SESSION['mensagem_erro'] = "Erro ao excluir atendimento. O atendimento pode não existir ou a API falhou.";
        header("Location: ../5.view/listarAtendimentos.php");
        exit();
    }
}

// Se nenhuma das condições POST/GET for satisfeita, redireciona para o formulário ou página inicial
// Isso evita que o controlador "fique parado" sem fazer nada.
if (!isset($_POST['cadastrar']) && !isset($_POST['salvar_edicao']) && !isset($_GET['excluir']) && !isset($_GET['editar'])) {
    header("Location: ../6.view/prontuario.php"); // Ou sua página inicial
    exit();
}

?>