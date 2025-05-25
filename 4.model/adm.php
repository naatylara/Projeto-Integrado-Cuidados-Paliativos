<?php

class adm extends Usuario{
    private $permissoes;


    public function __construct($permissoes){
    $this->permissoes = permissoes;

    }

    public function getPermissoes(){
    return $this -> permissoes;
    }

    public function setPermissoes($permissoes){
    return $this -> permissoes;
    }

    public function __toString() {
    return "{$this->permissoes}";
    }

}
?>