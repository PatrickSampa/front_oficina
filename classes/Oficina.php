<?php
class Oficina{
    private $nome;
    private $cnpj;
    private $inscricao;
    private $razao;


    function __construct($nome, $cnpj, $inscricao, $razao){
        $this -> nome = $nome;
        $this -> cnpj = $cnpj;
        $this -> inscricao = $inscricao;
        $this -> razao = $razao;
    }

    public function get_nome(){
        return $this->nome;
    }

    public function set_nome($nome){
        $this->nome = $nome;

    }
    public function get_cnpj(){
        return $this->cnpj;
    }

    public function set_cnpj($cnpj){
        $this->cnpj = $cnpj;
        
    }
    public function get_inscricao(){
        return $this->inscricao;
    }

    public function set_inscricao($inscricao){
        $this->inscricao = $inscricao;
        
    }
    public function get_razao(){
        return $this->razao;
    }

    public function set_razao($razao){
        $this->razao = $razao;
        
    }
    
}

?>