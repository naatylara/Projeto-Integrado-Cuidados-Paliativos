<?php

class Pessoa {
    private $nomeCompleto;
    private $dataNascimento;
    private $cpf;
    private $endereco;
    private $telefone;
    private $cidade;
    private $estado;

    /*public function __construct($nomeCompleto, $dataNascimento, $cpf, $endereco, $telefone) {
        $this->nomeCompleto = $nomeCompleto;
        $this->dataNascimento = $dataNascimento;
        $this->cpf = $cpf;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
    }*/

     public function getCidade() {
        return $this->cidade;
    }
    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }


    public function getEstado() {
        return $this->estado;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getNomeCompleto() {
        return $this->nomeCompleto;
    }

    public function setNomeCompleto($nomeCompleto) {
        $this->nomeCompleto = $nomeCompleto;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function __toString() {
        return "Pessoa - Nome Completo: {$this->nomeCompleto}, Data Nascimento: {$this->dataNascimento}, Cpf: {$this->cpf}, Endereço: {$this->endereco}, Telefone: {$this->telefone}";
    }
}

?>
