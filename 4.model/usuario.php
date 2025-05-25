<?php
    
    class Usuario extends Pessoa {
        private $id;
        private $email;
        private $user;
        private $senha;
        
    
        public function __construct($email, $user, $senha){
            parent:: __construct($nomeCompleto, $dataNascimento, $cpf, $endereco, $telefone)
    
            this->email = $email;
            this->user= $user;
            this->senha = $senha;

        }

        public function getEmail(){

            return this->email;
        }

        public function setEmail($email){

            this->email = $email;
        }

        public function getUser(){

            return this->user;
        }

        public function setUser($user){

            this->user = $user;
        }

        public function getSenha(){

            return this->senha;
        }

        public function setSenha($senha){

            this->senha = $senha;
        }

    public function __toString(){

        return parent::__toString()."Usuário - Email: {$this->email}, User: {$this->user}, Senha: {$this->senha}, Cargo: {$this->cargo}";
    }

}

     
   
?>