<?php
class Oficina{
    private $nome;
    private $cnpj;
    private $inscricao;
    private $razao;
}

    function __construct($nome, $cnpj, $inscricao, $razao){
        $this -> nome = $nome;
        $this -> cnpj = $cnpj;
        $this -> inscricao = $inscricao;
        $this -> razao = $razao;
    }

    function get_nome(){
        return $this->nome;
    }

    function set_nome($nome){
        $this->nome = $nome;

    }
    function get_cnpj(){
        return $this->cnpj;
    }

    function set_cnpj($cnpj){
        $this->cnpj = $cnpj;
        
    }
    function get_inscricao(){
        return $this->inscricao;
    }

    function set_inscricao($inscricao){
        $this->inscricao = $inscricao;
        
    }
    function get_razao(){
        return $this->razao;
    }

    function set_razao($razao){
        $this->razao = $razao;
        
    }
?>