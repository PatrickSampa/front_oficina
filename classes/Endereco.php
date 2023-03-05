<?php
class Oficina{
    private $cep;
    private $numero;
    private $bairro;
    private $Oficina_idEmpresa;
    private $Municipio_idMunicipio;

    function __construct($cep, $numero, $bairro, $Oficina_idEmpresa, $Municipio_idMunicipio){
        $this -> cep = $cep;
        $this -> numero = $numero;
        $this -> bairro = $bairro;
        $this -> Oficina_idEmpresa = $Oficina_idEmpresa;
        $this -> Municipio_idMunicipio = $Municipio_idMunicipio;
    }

    function get_cep(){
        return $this->cep;
    }

    function set_cep($cep){
        $this -> cep = $cep;
    }

    function get_numero(){
        return $this->numero;
    }

    function set_numero($numero){
        $this -> numero = $numero;
    }

    function get_bairro(){
        return $this->bairro;
    }

    function set_bairro($bairro){
        $this -> bairro = $bairro;
    }

    function get_FkOficina(){
        return $this->Oficina_idEmpresa;
    }

    function set_FkOficina($FkOficina){
        $this -> Oficina_idEmpresa = $FkOficina;
    }

    function get_FkMunicipio(){
        return $this->Municipio_idMunicipio;
    }

    function set_FkMunicipip($FkMunicipi){
        $this -> Municipio_idMunicipio = $FkMunicipi;
    }

}
?>