<?php
require_once '../4.model/atendimento.php';
class atendimentoDao{

    public function inserir(atendimento $atend){
        $url = "http://localhost:3000/atendimentos";
        $dados = [
            "id" => $atend->getId(),
            "doenca" => $atend->getDoenca(),
            "usuarioId"=> $atend->getUsuarioId(),
            "data" => $atend->getData(),
            "sintomas"=> $atend->getSintomas(),
        ];
        
          $options = [               //Aqui é padrão(utiliza em qualquer API)
            "http" => [
                "header"  => "Content-Type: application/json\r\n",
                "method"  => "POST",
                "content" => json_encode($dados)
            ]
        ];

        $context = stream_context_create($options);     //stream é uma conexão onde você recebe e manda dados
        $result = file_get_contents($url, false, $context);
        return $result ? json_decode($result, true) : false;
    }


    public function read(){
        $url = "http://localhost:3000/atendimentos";
        $result = file_get_contents($url);
        $atendList = array();
        $lista = json_decode($result, true);
        foreach ($lista as $atend):
            $atendList[] = $this->listaAtendimentos($atend);
        endforeach;
        return $atendList;
    }

    public function listaAtendimentos($row){
        $atendimento = new atendimento();
        $atendimento->setId(htmlspecialchars($row['id']));
        $atendimento->setDoenca(htmlspecialchars($row['doenca']));
        $atendimento->setUsuarioId(htmlspecialchars($row['usuarioId']));
        $atendimento->setData(htmlspecialchars($row['data']));
        $atendimento->setSintomas(htmlspecialchars($row['sintomas']));
    
        return $atendimento;
    }

    public function editar(atendimento $atend){
        $url = "http://localhost:3000/atendimentos/".$atend->getId();
        $dados = [
            "id" => $atend->getId(),
            "doenca" => $atend->getDoenca(),
            "usuarioId"=> $atend->getUsuarioId(),
            "data" => $atend->getData(),
            "sintomas"=> $atend->getSintomas(),

        ];

        $options = [
            "http" => [
                "header"  => "Content-Type: application/json\r\n",
                "method"  => "PUT",
                "content" => json_encode($dados)
                //,"ignore_errors" => true
            ]
        ];

        $context = stream_context_create($options);      
        $result = file_get_contents($url, false, $context);
        
        if ($result === FALSE) {
            return ["erro" => "Falha na requisição PATCH"];
        }

        return json_decode($result, true);
    }

    public function buscarPorId($id){
        $url = "http://localhost:3000/atendimentos/" . urlencode($id);
        try {
            // @file_get_contents() para evitar warnings automáticos.
            $response = @file_get_contents($url);
            if ($response === FALSE) {
                return null; // ID não encontrado ou erro na requisição
            }
            $data = json_decode($response, true);
            if ($data) {
                return $this->listaAtendimentos($data);
            }
            return null;
        } catch (Exception $e) {
            echo "<p>Erro ao buscar usuário por ID: </p> <p>{$e->getMessage()}</p>";
            return null;
        }
    }

    public function excluir($id){
//fazer validaçãod e busca por id
        $url = "http://localhost:3000/atendimentos/". urldecode(($id));

        $options = [
            "http" => [

                "header"  => "Content-Type: application/json\r\n",
                "method"  => "DELETE",
            
            ]
        ];

        $context = stream_context_create($options);      
        $result = file_get_contents($url, false, $context);
        
        if ($result === FALSE) {
            return ["erro" => "Falha na requisição PATCH"];
        }
    }
}
?>