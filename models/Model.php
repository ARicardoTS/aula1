<?php

// CI_Model eh do codeIgnitor
class Model extends CI_Model{
   
    // $usu vem do controller
    public function insert($usuario){
        
        // insere seu registro no banco de dados
        // 'Usuario' - nome da tabela
        $this->db->insert('unica',$usuario);
    }
    
    public function searchAll(){
        // faz a consulta no banco de dados
        $query =  $this->db->query("Select * from unica");
        //$query =  $this->db->query("SELECT `nome`, `endereco`, `bairro`, `cidade` FROM `unica` WHERE 1");
        // manda o resultado da consulta (query) para o controller
        return $query->result();
    }
    
    public function getUser($nome, $senha){
        $this->db->where('nome', $nome);
        $this->db->where('senha', $senha);
        $a = $this->db->get('unica');
        if($a->num_rows()>0){
            if($a->row()->nome ==="aricardots"){
                return "admin";
            }else{
                return "comum";
            }
        }else{
            return false;
        }
    }
}