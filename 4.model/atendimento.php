<?php

class atendimento {
    private $doenca;
    private $usuarioId;
    private $data;
    private $sintomas;

    public function getDoenca() {
        return $this->doenca;
    }

    public function setDoenca($doenca) {
        $this->doenca = $doenca;
    }

    public function getUsuarioId() {
        return $this->usuarioId;
    }

    public function setUsuarioId($usuarioId) {
        $this->usuarioId = $usuarioId;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getSintomas() {
        return $this->sintomas;
    }

    public function setSintomas($sintomas) {
        $this->sintomas = $sintomas;
    }

    public function __toString() {
        return "Atendimento - Doença: {$this->doenca}, Usuário ID: {$this->usuarioId}, Data: {$this->data}, Sintomas: {$this->sintomas}";
    }
}

?>
