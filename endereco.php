<?php
class endereco{
    private $rua;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $cep;
    private $complemento;

    public function __construct($rua, $numero, $bairro, $cidade, $estado, $cep, $complemento){
        $this -> rua = $rua;
        $this -> numero = $numero;
        $this -> bairro = $bairro;
        $this -> cidade = $cidade;
        $this -> estado = $estado;
        $this -> cep = $cep;
        $this -> complemento = $complemento;
    }

    public function getRua(){
        return $this -> rua;
    }

    public function setRua($rua){
        $this -> rua = $rua;
    }

    public function getNumero(){
        return $this -> numero;
    }
    
    public function setNumero($numero){
        $this -> numero = $numero;
    }

    public function getBairro(){
        return $this -> bairro;
    }

    public function setBairro($bairro){
        $this -> bairro = $bairro;
    }

    public function getCidade(){
        return $this -> cidade;
    }
    
    public function setCidade($cidade){
        $this -> cidade = $cidade;
    }

    public function getEstado(){
        return $this -> estado;
    }

    public function setEstado($estado){
        $this -> estado = $estado;
    }

    public function getCep(){
        return $this -> cep;
    }
    public function setCep($cep){
        $this -> cep = $cep;
    }
    public function getComplemento(){
        return $this -> complemento;
    }
    public function setComplemento($complemento){
        $this -> complemento = $complemento;
    }
    public function __toString() {
        return "{$this->rua}, {$this->numero} - {$this->bairro}, {$this->cidade} - {$this->estado}, CEP: {$this->cep}";
    }
}

?>