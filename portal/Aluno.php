<?php

class Aluno extends Pessoa{
    private $ra;
    private $id_sala;
    private $id_desktop;

    public function setRA($ra){
        $this->ra = $ra;
    }
    public function getRA(){
        return $this->ra;
    }

    public function setIdAluno($id_aluno){
        $this->id_aluno = $id_aluno;
    }
    public function getIdAluno(){
        return $this->id_aluno;
    }

    public function setIdDesktop($id_desktop){
        $this->id_desktop = $id_desktop;
    }
    public function getIdDesktop(){
        return $this->id_desktop;
    }
}

?>