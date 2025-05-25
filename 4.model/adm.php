<?php

class adm extends Usuario{
    private $permissoes;
    
}

public function __construct($permissoes, $agenda){
    $this->permissoes = permissoes;
    $this->agenda = agenda;
}

public function getPermissoes(){
    return $this -> permissoes;
}

public function setPermissoes($permissoes){
    return $this -> permissoes;
}
public function getAgenda(){
    return $this -> agenda;
}
public function setAgenda($agenda){
    return $this -> agenda;
}
public function __toString() {
    return "{$this->permissoes}, {$this->agenda}";
}


?>