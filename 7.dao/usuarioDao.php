<?php
class usuarioDao{
    public function inserir(usuario $user){
        try{
            $sql = "INSERT INTO usuario (nomeCompleto, dataNascimento, cpf, endereco, telefone, email, senha)
            VALUES(:nomeCompleto, :dataNascimento, :cpf, :endereco, :telefone);";
            $con_sql = ConnectionFactory::getConnection()->prepare($sql);
            $con_sql -> bindValue(":nomeCompleto", $user->getNomeCompleto());
            $con_sql -> bindValue(":dataNascimento", $user->getDataNascimento());
            $con_sql -> bindValue(":cpf", $user->getCpf());
            $con_sql -> bindValue(":endereco", $user->getEndereco());  // ver com a juliana pois o Endereço tem uma classe própria. 
            $con_sql -> bindValue(":telefone", $user->getTelefone());
            $con_sql -> bindValue(":email", $user->getEmail());
            $con_sql ->bindValue(":senha", $user->getSenha());


            return $con_sql->execute(); //executa o comando

        }catch(PDOException $ex){
            echo "<p>Erro ao cadastar usuário!</p> $ex"; //ajustar a mensagem de erro! 
        }
    }

    
     public function read(){
        try{
            $sql = "SELECT * FROM usuario";
            $con_sql = ConnectionFactory::getConnection()->query($sql);
            $lista = $con_sql->fetchAll(PDO::FETCH_ASSOC);
            $UserList = array();
            foreach($lista as $linha){
                $UserList[] = $this->listaUsuarios($linha);
            }
            echo "Temos".count($UserList). "Usuários cadastrados";
            return $UserList;
        }catch(PDOException $ex){
            echo "<p> Ocorreu um erro ao selecionar usuários</p> $ex";
        }
    }

    public function listaUsuarios($linha){
        $usuario = new usuario();        //Aqui está com erro (precisa verificar)
        $usuario->setId($linha['id']);   //get e set id já está criado, só precisa dar atualizar!
        $usuario->setNomeCompleto($linha['nomeCompleto']);
        $usuario->setDataNascimento($linha['dataNascimento']);
        $usuario->setCpf($linha['cpf']);
        $usuario->setEndereco($linha['endereco']);
        $usuario->setTelefone(($linha['telefone']));
        $usuario->setEmail(($linha['email']));
        $usuario->setSenha(($linha['senha']));

        return $usuario;
    }
}
?>