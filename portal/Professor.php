<?php

class Professor extends Pessoa{
    private $id;
    private $id_not;
    private $marca_not;
    private $modelo_not;

    public function setID($id){
        $this->id = $id;
    }
    public function getID(){
        return $this->id;
    }

    public function setIDNot($id_not){
        $this->id_not = $id_not;
    }
    public function getIDNot(){
        return $this->id_not;
    }

    public function setMarcaNot($marca_not){
        $this->marca_not = $marca_not;
    }
    public function getMarcaNot(){
        return $this->marca_not;
    }

    public function setModeloNot($modelo_not){
        $this->modelo_not = $modelo_not;
    }
    public function getModeloNot(){
        return $this->modelo_not;
    }
}

?>