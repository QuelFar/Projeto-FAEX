<?php
require_once 'Conexao.php';

    class Crud extends Conexao{
        private $tabela;
        private $dados;
        private $conexao;
        private $sql;

        public function insert($tabela, array $dados){
            $this->conexao = $this->conectar();
            $col = "";
            $val = "";
            foreach($dados as $coluna => $valor){
                $col .= "$coluna,";
                $val .= "'$valor',";
            }
            $col = rtrim($col,',');
            $val = rtrim($val,',');

            $this->sql = "INSERT INTO $tabela ($col) VALUES($val)";
            echo $this->sql;
        }

        public function select($tabela, array $dados){
            $this->conexao = $this->conectar();
            $where = "";
            foreach ($dados as $coluna => $valor){
                    $where .= "$coluna='$valor' AND ";
            }
            $where = rtrim($where,'AND ');
            $this->sql = "SELECT * FROM $tabela WHERE $where";
            return $this->conexao->query($this->sql);
        }
        public function update($tabela, array $dados){
            $this->conexao = $this->conectar();
            $up = "";
            $where = "";
            foreach ($this->$dados as $coluna => $valor){
                if($coluna == 'id'){
                    $where .= "$coluna='$valor'";
                }else{
                    $up .= "$coluna='$valor',";
                }
            }
            $up = rtrim($up,',');
            $this->sql = "UPDATE $tabela SET $up WHERE $where";
            echo $this->sql;
            $this->conexao->query($this->sql);
        }

        public function delete($tabela, $dados){
            $this->conexao = $this->conectar();
            $this->sql = "DELETE FROM $tabela WHERE id in ($dados)";
            $this->conexao->query($this->sql);
        }
    }
