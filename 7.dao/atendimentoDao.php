<?php
// 7.dao/atendimentoDao.php
require_once '../4.model/atendimento.php';

class atendimentoDao {

    public function inserir(atendimento $atend){
        $url = "http://localhost:3000/atendimentos";
        $dados = [ //construindo array para mandar para o json
            "doenca" => $atend->getDoenca(),
            "usuario_id"=> $atend->getUsuarioId(), 
            "data" => $atend->getData(),
            "sintomas"=> json_decode($atend->getSintomas(), true), // Decodifica para array PHP antes de enviar
        ];
        
        //criando contexto
        $options = [
            "http" => [
                "header"  => "Content-Type: application/json\r\n",
                "method"  => "POST",
                "content" => json_encode($dados),
                "ignore_errors" => true // Importante para pegar respostas de erro da API
            ]
        ];

        $context = stream_context_create($options);
        $result = @file_get_contents($url, false, $context);

        if ($result === FALSE) {
            error_log("Erro ao acessar a API (inserir): " . error_get_last()['message']);
            return false;
        }

        $http_status = $http_response_header[0] ?? null; 
        if (strpos($http_status, '201 Created') === false) { // Verifica 201 Created 
            error_log("API de inserção retornou erro: " . $http_status . " - " . $result);
            return false;
        }
        return json_decode($result, true); // Retorna o objeto criado pela API
    }

    public function read(){
        $url = "http://localhost:3000/atendimentos";
        $options = [
            "http" => [ 
                "ignore_errors" => true // Importante para pegar status de erro
            ]
        ];
        $context = stream_context_create($options);
        $result = @file_get_contents($url, false, $context);
        
        if ($result === FALSE) {
            error_log("Erro ao acessar a API (read): " . error_get_last()['message']);
            return [];
        }

        $http_status = $http_response_header[0] ?? null;
        if (strpos($http_status, '200 OK') === false) {
            error_log("API de listagem retornou erro: " . $http_status . " - " . $result);
            return [];
        }

        $atendList = [];
        $lista = json_decode($result, true);

        if (is_array($lista)) {
            foreach ($lista as $atend){
                $atendList[] = $this->listaAtendimentos($atend);
            }
        }
        return $atendList;
    }

    public function listaAtendimentos($row){
        $atendimento = new atendimento();
        $atendimento->setId(htmlspecialchars($row['id'] ?? ''));
        $atendimento->setDoenca(htmlspecialchars($row['doenca'] ?? ''));
        // IMPORTANTE: use 'usuario_id' para corresponder à API Node.js
        $atendimento->setUsuarioId(htmlspecialchars($row['usuario_id'] ?? '')); 
        $atendimento->setData(htmlspecialchars($row['data'] ?? ''));

        // CORREÇÃO: Sintomas agora vêm da API já como um array PHP.
        // Verificamos o tipo para garantir que a decodificação só ocorra se for uma string JSON.
        $sintomasDoApi = $row['sintomas'] ?? []; // Assume que é um array vazio se não existir
        
        $finalSintomas = [];
        if (is_string($sintomasDoApi)) {
            // Se for uma string 
            $decoded = json_decode($sintomasDoApi, true);
            $finalSintomas = is_array($decoded) ? $decoded : [];
        } elseif (is_array($sintomasDoApi)) {
            // Se já for um array 
            $finalSintomas = $sintomasDoApi;
        }

        $atendimento->setSintomas($finalSintomas);
        
        return $atendimento;
    }

    public function editar(atendimento $atend){
        $url = "http://localhost:3000/atendimentos/" . urlencode($atend->getId());
        $dados = [
            "id" => $atend->getId(),
            "doenca" => $atend->getDoenca(),
            "usuario_id"=> $atend->getUsuarioId(), 
            "data" => $atend->getData(),
            "sintomas"=> json_decode($atend->getSintomas(), true), // Decodifica para array PHP
        ];

        $options = [
            "http" => [
                "header"  => "Content-Type: application/json\r\n",
                "method"  => "PUT",
                "content" => json_encode($dados),
                "ignore_errors" => true // Importante
            ]
        ];

        $context = stream_context_create($options);
        $result = @file_get_contents($url, false, $context);

        if ($result === FALSE) {
            error_log("Erro ao acessar a API (editar): " . error_get_last()['message']);
            return false;
        }

        $http_status = $http_response_header[0] ?? null;
        if (strpos($http_status, '200 OK') === false) {
            error_log("API de edição retornou erro: " . $http_status . " - " . $result);
            return false;
        }
        return json_decode($result, true); // Retorna o objeto editado ou true
    }

    public function buscarPorId($id){
        $url = "http://localhost:3000/atendimentos/" . urlencode($id);
        $options = [
            "http" => [
                "ignore_errors" => true // Importante para pegar status de erro
            ]
        ];
        $context = stream_context_create($options);
        $response = @file_get_contents($url, false, $context);
        
        if ($response === FALSE) {
            error_log("Erro ao acessar a API (buscarPorId): " . error_get_last()['message']);
            return null;
        }

        $http_status = $http_response_header[0] ?? null;
        if (strpos($http_status, '200 OK') === false) {
            error_log("API de busca por ID retornou erro: " . $http_status . " - " . $response);
            return null; 
        }

        $data = json_decode($response, true);
        if ($data) {
            return $this->listaAtendimentos($data);
        }
        return null;
    }

    public function excluir($id){
        $url = "http://localhost:3000/atendimentos/" . urlencode($id);
        $options = [
            "http" => [
                "method"  => "DELETE",
                "ignore_errors" => true // Importante
            ]
        ];
        $context = stream_context_create($options);
        $result = @file_get_contents($url, false, $context);

        if ($result === FALSE) {
            error_log("Erro ao acessar a API (excluir): " . error_get_last()['message']);
            return false;
        }

        $http_status = $http_response_header[0] ?? null;
        if (strpos($http_status, '200 OK') === false && strpos($http_status, '204 No Content') === false) { // 204 para DELETE sem conteúdo
            error_log("API de exclusão retornou erro: " . $http_status . " - " . $result);
            return false;
        }
        return true; // Retorna true em caso de sucesso
    }
}