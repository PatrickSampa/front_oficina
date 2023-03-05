<?php
    $host = 'localhost';
    $username = 'root';
    $pass = '';
    $name = 'oficina';

    $connexao = new MySQLi($host,$username,$pass,$name);
    
    if($connexao->connect_errno){
        echo "Erro";
    }else{
        echo "conexao efetuada com sucesso";
    }


?>