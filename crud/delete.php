<?php
include_once('config.php');        
if ($_POST['delnome'] == null) {
    throw new Exception("Insira a oficina a ser deletada!", 1);
}
$result = $conn->query("SELECT idEmpresa FROM oficina WHERE cnpj = {$_POST['delnome']}");
 if (mysqli_num_rows($result)==0){
    throw new Exception("Oficina não encontrada!", 1);
}
else {
    try {
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $res = $conn->query("delete from endereco where Oficina_idEmpresa = {$result[0]['idEmpresa']};");
        $res = $conn->query("delete from oficina where idEmpresa = {$result[0]['idEmpresa']};");
        echo "<div class='alert alert-success' role='alert' style='text-align: center;'>
        Oficina Deletada
      </div>";

    } catch (\Throwable $th) {
    echo 'Deu ruim: </br>'.'>>>>>>>>>'. $th->getMessage();
    }
}
?>