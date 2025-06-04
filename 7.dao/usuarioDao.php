<?php
class usuarioDao{
    public function inserir(usuario $user){
        try{
            $sql = "INSERT INTO usuario (nome, data_nascimento, cidade, estado, email, senha)
            VALUES(:nome, :data_nascimento, :cidade, :estado, :email, :senha);"; // create table no Querry do banco
            $con_sql = ConnectionFactory::getConnection()->prepare($sql);
            $con_sql -> bindValue(":nome", $user->getNomeCompleto());
            $con_sql -> bindValue(":data_nascimento", $user->getDataNascimento());
            $con_sql->bindValue(":cidade", $user->getCidade());  // novo
            $con_sql->bindValue(":estado", $user->getEstado());  // novo
            //$con_sql -> bindValue(":cpf", $user->getCpf());
            //$con_sql -> bindValue(":endereco", $user->getEndereco());  // ver com a juliana pois o Endereço tem uma classe própria. 
            //$con_sql -> bindValue(":telefone", $user->getTelefone());
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
            echo " Temos ".count($UserList). " usuários cadastrados";
            return $UserList;
        }catch(PDOException $ex){
            echo "<p> Ocorreu um erro ao selecionar usuários</p> $ex";
        }
    }

    public function listaUsuarios($linha){
        $usuario = new Usuario();        //Aqui está com erro (precisa verificar)
        $usuario->setId($linha['id']);   //get e set id já está criado, só precisa dar atualizar!
        $usuario->setNomeCompleto($linha['nome']);
        $usuario->setDataNascimento($linha['data_nascimento']);
        //$usuario->setCpf($linha['cpf']);
        //$usuario->setEndereco($linha['endereco']);
        $usuario->setCidade($linha['cidade']);
        $usuario->setEstado($linha['estado']);
        //$usuario->setTelefone(($linha['telefone']));
        $usuario->setEmail(($linha['email']));
        $usuario->setSenha(($linha['senha']));

        return $usuario;
    }
}
?>