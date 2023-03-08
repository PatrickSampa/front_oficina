<?php

include_once('config.php');
try {

    if ($_POST['altercadnome'] == null || $_POST['altercnpj']  == null ||  $_POST['alterinscricao'] == null||  $_POST['altercep'] == null ||  $_POST['alterrazao'] == null||
    $_POST['alterbairro']== null||$_POST['alterlogradouro']==null || $_POST['alterestado']==null || $_POST['altermunicipio']==null || $_POST['alternumero']==null) {
        throw new Exception("Não deixe campos em branco!", 1);
        
    } else {

    include_once('classes/Oficina.php');
    include_once('classes/Endereco.php');
    
    $oficina = new Oficina( $_POST['altercadnome'], $_POST['altercnpj'], $_POST['alterinscricao'], $_POST['alterrazao']);
    $result = $conn->query("UPDATE oficina SET nome='{$oficina->get_nome()}',cnpj='{$oficina->get_cnpj()}',
    inscricao={$oficina->get_inscricao()}, razao='{$oficina->get_razao()}'");
    
    $res = mysqli_query($conn, 'select max(idEmpresa) from oficina;');
    $max = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $max = $max[0]['max(idEmpresa)'];
    
    $res2 = mysqli_query($conn, "select idMunicipio from municipio where Municipio like '{$_POST['altermunicipio']}';");
    $idmun = mysqli_fetch_all($res2, MYSQLI_ASSOC);
    $idmun = $idmun[0]['idMunicipio'];
    
    $endereco = new Endereco( $_POST['altercep'], $_POST['alternumero'],$_POST['alterbairro'],$_POST['alterlogradouro'], $max, $idmun);
    $result = $conn->query("UPDATE Endereco SET CEP='{$endereco->get_cep()}',numero='{$endereco->get_numero()}',bairro='{$endereco->get_bairro()}', 
    Logradouro='{$endereco->get_logradouro()}';");
    }
    echo "<div class='alert alert-success' role='alert' style='text-align: center;'>
    Oficina Atualizada com sucesso
  </div>";
    
} catch (\Throwable $th) {
    echo 'Deu ruim: </br>'.'>>>>>>>>>'. $th->getMessage();
     
}
mysqli_close($conn);

?>