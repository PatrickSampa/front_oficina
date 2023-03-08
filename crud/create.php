<?php
include_once('config.php');
try {

    if ($_POST['nameEmpresa'] == null || $_POST['cnpjEmpresa']  == null ||  $_POST['inscricaoEmpresa'] == null||  $_POST['cep'] == null ||  $_POST['numero'] == null||
    $_POST['bairro']== null||$_POST['logradouro']==null) {
        throw new Exception("Preencha todos os campos!", 1);
        
    } else {

    include_once('classes/Oficina.php');
    include_once('classes/Endereco.php');
    
    $oficina = new Oficina( $_POST['nameEmpresa'], $_POST['cnpjEmpresa'], $_POST['inscricaoEmpresa'], $_POST['inscricaoEmpresa']);
    $result = $conn->query("INSERT INTO oficina VALUES(null, '{$oficina->get_nome()}','{$oficina->get_cnpj()}',
    {$oficina->get_inscricao()}, '{$oficina->get_razao()}')");
    
    $res = mysqli_query($conn, 'select max(idEmpresa) from oficina;');
    $max = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $max = $max[0]['max(idEmpresa)'];
    
    $res2 = mysqli_query($conn, "select idMunicipio from municipio where Municipio like '{$_POST['municipio']}';");
    $idmun = mysqli_fetch_all($res2, MYSQLI_ASSOC);
    $idmun = $idmun[0]['idMunicipio'];
    
    $endereco = new Endereco( $_POST['cep'], $_POST['numero'],$_POST['bairro'],$_POST['logradouro'], $max, $idmun);
    $result = $conn->query("INSERT INTO endereco VALUES (null, '{$endereco->get_cep()}','{$endereco->get_numero()}','{$endereco->get_bairro()}', 
    '{$endereco->get_logradouro()}',{$endereco->get_FkOficina()},{$endereco->get_FkMunicipio()});");}
    echo "<div class='alert alert-success' role='alert' style='text-align: center;'>
    Oficina Cadastrada com sucesso
  </div>";
    
} catch (\Throwable $th) {
    echo 'Deu ruim: </br>'.'>>>>>>>>>'. $th->getMessage();
     
}
mysqli_close($conn);

?>