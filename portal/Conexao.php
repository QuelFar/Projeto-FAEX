<?php

class Conexao{
    private $host;
    private $user;
    private $password;
    private $db;
    private $charset;

    public function __construct($host,$user,$password,$db,$charset){
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;
        $this->charset = $charset;
    }

    public function conectar(){
        $conection = new mysqli($this->host,$this->user,$this->password,$this->db);
        $conection->set_charset($this->charset);
        return $conection;
    }
}
?>