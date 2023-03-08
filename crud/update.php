<?php

include_once('config.php');
include_once('classes/Oficina.php');
include_once('classes/Endereco.php');

try {
    
    if ($_POST['altercadnome'] == null || $_POST['altercnpj']  == null ||  $_POST['alterinscricao'] == null||  $_POST['altercep'] == null ||  $_POST['alterrazao'] == null||
    $_POST['alterbairro']== null||$_POST['alterlogradouro']==null || $_POST['alterestado']==null || $_POST['altermunicipio']==null || $_POST['alternumero']==null) {
        throw new Exception("Não deixe campos em branco!", 1);
        
    } else {    
    $result = $conn->query("SELECT * FROM oficina WHERE cnpj = {$_POST['altercnpj']};");
    $q_oficina = $result->fetch_object();
    $oficina = new Oficina( $_POST['altercadnome'], $_POST['altercnpj'], $_POST['alterinscricao'], $_POST['alterrazao']);
    $result = $conn->query("UPDATE oficina SET nome='{$oficina->get_nome()}',cnpj='{$oficina->get_cnpj()}',
    inscricao={$oficina->get_inscricao()}, razao='{$oficina->get_razao()}' WHERE cnpj = {$q_oficina->cnpj};");
    
    $res2 = mysqli_query($conn, "select idMunicipio from municipio where Municipio like '{$_POST['altermunicipio']}';");
    $idmun = mysqli_fetch_all($res2, MYSQLI_ASSOC);
    $idmun = $idmun[0]['idMunicipio'];
    
    $endereco = new Endereco( $_POST['altercep'], $_POST['alternumero'],$_POST['alterbairro'],$_POST['alterlogradouro'], $q_oficina->idEmpresa, $idmun);
    $result = $conn->query("UPDATE Endereco SET CEP='{$endereco->get_cep()}',numero='{$endereco->get_numero()}',bairro='{$endereco->get_bairro()}', 
    Logradouro='{$endereco->get_logradouro()}' WHERE Oficina_idEmpresa = {$q_oficina->idEmpresa};");
    }
    echo "<div class='alert alert-success' role='alert' style='text-align: center;'>
    Oficina Atualizada com sucesso
  </div>";
    
} catch (\Throwable $th) {
    echo 'Deu ruim: </br>'.'>>>>>>>>>'. $th->getMessage();
     
}
mysqli_close($conn);

?>