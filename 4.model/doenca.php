<?php

class Doenca
{
    private $nome;
    private $sintomas; 
    private $tratamentoPaliativo;

    /*public function __construct($nome = '', $sintomas = null, $tratamentoPaliativo = '')
    {
        $this->nome = $nome;
        $this->sintomas = $sintomas ?? new ArrayObject();
        $this->tratamentoPaliativo = $tratamentoPaliativo;
    }*/

    // GETTERS
    public function getNome()
    {
        return $this->nome;
    }

    public function getSintomas()
    {
        return $this->sintomas;
    }

    public function getTratamentoPaliativo()
    {
        return $this->tratamentoPaliativo;
    }

    // SETTERS
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setSintomas(ArrayObject $sintomas)
    {
        $this->sintomas = $sintomas;
    }

    public function setTratamentoPaliativo($tratamentoPaliativo)
    {
        $this->tratamentoPaliativo = $tratamentoPaliativo;
    }
    
     public function __toString()
    {
        $sintomasStr = implode(', ', (array)$this->sintomas);
        return "Doença: {$this->nome}\nSintomas: {$sintomasStr}\nTratamento Paliativo: {$this->tratamentoPaliativo}";
    }
}

?>