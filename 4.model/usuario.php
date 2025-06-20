<?php

require_once 'Pessoa.php';

class usuario extends Pessoa {
    private $id;
    private $email;
    private $user;
    private $senha;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;  // Correção aqui
    }

    public function __toString() {
        return parent::__toString() . 
        ", Email: {$this->email}, Usuário: {$this->user}";
        // Por segurança, senha não é exibida
    }
}
?>