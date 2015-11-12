<?php

// Classe do banco de dados
class Usuario{
    
    // atributo nome
    public $nome;
    public $endereco;
    public $bairro;
    public $cidade;
    
    // construtor
    public function __construct($nome, $endereco, $bairro, $cidade){
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
    }
}
?>