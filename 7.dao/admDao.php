<?php
class admDao {

    public function inserir(adm $adm){
        try {
            $sql = "INSERT INTO usuario (nomeCompleto, dataNascimento, cpf, endereco, telefone, email, user, senha, permissoes)
            VALUES (:nomeCompleto, :dataNascimento, :cpf, :endereco, :telefone, :email, :user, :senha, :permissoes)";
             
            $con_sql = ConnectionFactory::getConnection()->prepare($sql);
           
            $con_sql->bindValue(":nomeCompleto", $adm->getNomeCompleto());
            $con_sql->bindValue(":dataNascimento", $adm->getDataNascimento());
            $con_sql->bindValue(":cpf", $adm->getCpf());
            $con_sql->bindValue(":endereco", $adm->getEndereco());
            $con_sql->bindValue(":telefone", $adm->getTelefone());
            $con_sql->bindValue(":email", $adm->getEmail());
            $con_sql->bindValue(":user", $adm->getUser());
            $con_sql->bindValue(":senha", $adm->getSenha());
            $con_sql->bindValue(":permissoes", $adm->getPermissoes());

            return $con_sql->execute();

        } catch (PDOException $ex) {
            echo "<p>Erro ao cadastrar Adm!</p> $ex";
        }
    }

    public function read(){
        try {
            $sql = "SELECT * FROM usuario WHERE permissoes IS NOT NULL";
            $con_sql = ConnectionFactory::getConnection()->query($sql);
            $lista = $con_sql->fetchAll(PDO::FETCH_ASSOC);
            $admList = array();

            foreach ($lista as $linha) {
                $admList[] = $this->listaAdms($linha);
            }
            return $admList;

        } catch (PDOException $ex) {
            echo "<p>Erro ao selecionar os adms!</p> $ex";
        }
    }

    public function listaAdms($linha){
        $adm = new adm($linha['permissoes']);  //Ver com a juliana!
        $adm->setId($linha['id']);
        $adm->setNomeCompleto($linha['nomeCompleto']);
        $adm->setDataNascimento($linha['dataNascimento']);
        //$adm->setCpf($linha['cpf']);
        $adm->setEndereco($linha['endereco']);
        //$adm->setTelefone($linha['telefone']);
        $adm->setEmail($linha['email']);
        $adm->setUser($linha['user']);
        $adm->setSenha($linha['senha']);
        $adm->setPermissoes($linha['permissoes']);

        return $adm;
    }
}
?>