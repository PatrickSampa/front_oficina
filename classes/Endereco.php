<?php
class Endereco{
    private $cep;
    private $numero;
    private $bairro;
    private $logradouro;
    private $Oficina_idEmpresa;
    private $Municipio_idMunicipio;

    function __construct($cep, $numero, $bairro, $logradouro, $Oficina_idEmpresa, $Municipio_idMunicipio){
        $this -> cep = $cep;
        $this -> numero = $numero;
        $this -> bairro = $bairro;
        $this -> logradouro = $logradouro;
        $this -> Oficina_idEmpresa = $Oficina_idEmpresa;
        $this -> Municipio_idMunicipio = $Municipio_idMunicipio;
    }

    public function get_cep(){
        return $this->cep;
    }

    public function set_cep($cep){
        $this -> cep = $cep;
    }

    public function get_numero(){
        return $this->numero;
    }

    public function set_numero($numero){
        $this -> numero = $numero;
    }

    public function get_bairro(){
        return $this->bairro;
    }

    public function set_bairro($bairro){
        $this -> bairro = $bairro;
    }

    public function get_logradouro(){
        return $this->logradouro;
    }

    public function set_logradouro($logradouro){
        $this -> logradouro = $logradouro;
    }

    public function get_FkOficina(){
        return $this->Oficina_idEmpresa;
    }

    public function set_FkOficina($FkOficina){
        $this -> Oficina_idEmpresa = $FkOficina;
    }

    public function get_FkMunicipio(){
        return $this->Municipio_idMunicipio;
    }

    public function set_FkMunicipio($FkMunicipi){
        $this -> Municipio_idMunicipio = $FkMunicipi;
    }

}
?>