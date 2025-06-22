<?php

class pessoa {
    private $nomeCompleto;
    private $dataNascimento;
    private $cidade;
    private $estado;
    private $cep;
    private $rua;
    private $numero;
    private $complemento;
    private $bairro;

    // Getters e Setters

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

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getRua() {
        return $this->rua;
    }

    public function setRua($rua) {
        $this->rua = $rua;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function __toString() {
        return "Pessoa - Nome Completo: {$this->nomeCompleto}, Data Nascimento: {$this->dataNascimento}, " .
               "Cidade: {$this->cidade}, Estado: {$this->estado}, CEP: {$this->cep}, Rua: {$this->rua}, Número: {$this->numero}, " .
               "Complemento: {$this->complemento}, Bairro: {$this->bairro}";
    }
}

?>