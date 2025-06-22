<?php
require_once '../4.model/atendimento.php';
class atendimentoDao{

    public function inserir(atendimento $atend){
        $url = "http://localhost:3000/atendimentos";
        $dados = [
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
        $atendimento->setNomeCompleto(htmlspecialchars($row['nome']));
        $atendimento->setDataNascimento(htmlspecialchars($row['data_nascimento']));
        $atendimento->setCidade(htmlspecialchars($row['cidade']));
    

        return $atendimento;
    }

    public function editar(usuario $user){
        $url = "http://localhost:3000/usuarios/".$user->getId();
        $dados = [
            "nome" => $user->getNomeCompleto(),
            "data_nascimento" => $user->getDataNascimento(),
            "cidade"=> $user->getCidade(),
            "estado"=> $user->getEstado(),
            "email"=> $user->getEmail(),
            "senha"=> $user->getSenha(),
            "cep"=>$user->getCep(),
            "rua"=>$user->getRua(),
            "complemento"=>$user->getComplemento(),
            "numero"=>$user->getNumero(),
            "bairro"=>$user->getBairro(),
            "user"=>$user->getUser()

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
        $url = "http://localhost:3000/usuarios/" . urlencode($id);
        try {
            // @file_get_contents() para evitar warnings automáticos.
            $response = @file_get_contents($url);
            if ($response === FALSE) {
                return null; // ID não encontrado ou erro na requisição
            }
            $data = json_decode($response, true);
            if ($data) {
                return $this->listaUsuarios($data);
            }
            return null;
        } catch (Exception $e) {
            echo "<p>Erro ao buscar usuário por ID: </p> <p>{$e->getMessage()}</p>";
            return null;
        }
    }

    public function excluir($id){
//fazer validaçãod e busca por id
        $url = "http://localhost:3000/usuarios/". urldecode(($id));

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