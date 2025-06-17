<?php
//JÁ ESTÁ ALTERADO
class usuarioDao{
    public function inserir(usuario $user){
        try{
            $sql = "INSERT INTO usuario (nome, data_nascimento, cidade, estado, email, senha, cep, rua, complemento, numero, bairro, user)
            VALUES(:nome, :data_nascimento, :cidade, :estado, :email, :senha, cep, :rua, :complemento, :numero, :bairro, :usuario);"; // create table no Querry do banco
            $con_sql = ConnectionFactory::getConnection()->prepare($sql);
            $con_sql -> bindValue(":nome", $user->getNomeCompleto());
            $con_sql -> bindValue(":data_nascimento", $user->getDataNascimento());
            $con_sql->bindValue(":cidade", $user->getCidade());  // novo
            $con_sql->bindValue(":estado", $user->getEstado());  // novo
            $con_sql -> bindValue(":email", $user->getEmail());
            $con_sql ->bindValue(":senha", $user->getSenha());
            $con_sql ->bindValue(":cep", $user->getCep());
            $con_sql ->bindValue(":rua", $user->getRua());
            $con_sql ->bindValue(":complemento", $user->getComplemento());
            $con_sql ->bindValue(":numero", $user->getNumero());
            $con_sql ->bindValue(":bairro", $user->getBairro());
            $con_sql ->bindValue(":user", $user->getUser());


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
        $usuario->setCidade($linha['cidade']);
        $usuario->setEstado($linha['estado']);
        $usuario->setEmail(($linha['email']));
        $usuario->setSenha(($linha['senha']));
        $usuario->setCep(($linha['cep']));
        $usuario->setRua(($linha['rua']));
        $usuario->setComplemento(($linha['complemento']));
        $usuario->setNumero(($linha['numero']));
        $usuario->setBairro(($linha['bairro']));
        $usuario->setUser(($linha['user']));

        return $usuario;
    }


    public function editar(Usuario $user){
        try{

            $sql = "UPDATE usuario SET 
                nome = :nome, data_nascimento = :data_nascimento, cidade = :cidade, estado = :estado, email = :email, senha = :senha, cep = :cep, rua = :rua, complemento = :complemento, numero = :numero, bairro = :bairro, user = :user WHERE id = :id";
            $conn = ConnectionFactory::getConnection()->prepare($sql);
            $conn->bindValue(":nome", $user->getNomeCompleto());
            $conn->bindValue(":data_nascimento", $user->getDataNascimento());
            $conn->bindValue(":cidade", $user->getCidade());
            $conn->bindValue(":estado", $user->getEstado());
            $conn-> bindValue(":email", $user->getEmail());
            $conn->bindValue(":senha", $user->getSenha());
            $conn->bindValue(":cep", $user->getCep());
            $conn->bindValue(":rua", $user->getRua());
            $conn->bindValue(":complemento", $user->getComplemento());
            $conn->bindValue(":numero", $user->getNumero());
            $conn->bindValue(":bairro", $user->getBairro());
            $conn->bindValue(":user", $user->getUser());

            return $conn->execute();
             // Executa o update
        }catch(PDOException $ex){

            echo "<p> Erro ao editar </p> <p> $ex </p>";
        }
    }

    public function buscarPorId($id){

        try{

            $sql = "SELECT * FROM usuario WHERE id = :id";
            $conn = ConnectionFactory::getConnection()->prepare($sql);
            $conn->bindValue(":id", $id);
            $conn->execute();
            $row = $conn->fetch(PDO::FETCH_ASSOC);
             // Busca apenas uma linha
            if($row){

                return $this->listaUsuarios($row);

            }

            return null;
             // Retorna null se não encontrar o ID
        }catch(PDOException $ex){

            echo "<p>Erro ao buscar fabricante por ID: </p> <p> {$ex->getMessage()} </p>";

            return null;
        }
    }

}
?>