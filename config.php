<?php
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', 'ifpa');
    define('BASE', 'oficina');

    $conn = new MySQLi(HOST,USER,PASS,BASE);
    
    if($conn->connect_errno){
        echo "Erro";
    }


?>