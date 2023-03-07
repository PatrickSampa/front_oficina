<?php

    if(isset($_POST['cadUsuario'])){
        /* print_r($_POST['nameEmpresa']);
        print_r($_POST['cnpjEmpresa']);
        print_r($_POST['inscricaoEmpresa']);
        print_r($_POST['razaoEmpresa']); */
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
    }
    elseif (isset($_POST['deletar'])) {
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
                echo 'Oficina deletada com sucesso!';

            } catch (\Throwable $th) {
            echo 'Deu ruim: </br>'.'>>>>>>>>>'. $th->getMessage();
            }
        }
        
        
    }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="imagens/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Oficina do Zé</title>
</head>

<body>
    <div class="container text-center">
        <!-- Substituir o botão pelos dados do usuário 
        <div id="dados-usuario">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                Acessar
            </button>
        </div>-->
            <div id='dados-usuario'>
                <button type='button' class='btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#cadUsuarioModal'>Cadastrar</button>
                <button type='button' class='btn btn-outline-primary m-3' data-bs-toggle='modal' data-bs-target='#loginModal'>Acessar</button>
                <button type='button' class='btn btn-outline-danger' data-bs-toggle='modal' data-bs-target='#cadDeletarModal'>Deletar</button>
            </div>
        
        <div class="m-5">
            <span id="msgAlert"></span>
        </div>
    </div>
    <?php
        $nome = '';
        $cnpj = '';
        $inscricao = '';
        $razao = '';
        $cep = '';
        $estado = '';
        $municipio = '';
        $bairro = '';
        $logradouro = '';
        $numero = 0;
        
        
        if(isset($_POST['acessar'])){
            include_once('config.php');
            if($_POST['cnpjres']== null){
                $result2 = $conn->query("SELECT * FROM oficina");
                try{
                    //$res = $conn->query("delete from endereco where Oficina_idEmpresa = {$result[0]['idEmpresa']};");
                    $qtd = $result2->num_rows;
                    if($qtd>0){
                        echo "<table class='table table-hover table-striped table-bordered'>";
                        echo "<thead class='table-dark'>";
                        echo "<tr>";
                        echo "<th>Nome</th>";
                        echo "<th>CNPJ</th>";
                        echo "<th>Inscrição</th>";
                        echo "<th>Razão</th>";
                        echo "<th>CEP</th>";
                        echo "<th>Número</th>";
                        echo "<th>Bairro</th>";
                        echo "<th>Município</th>";
                        echo "</tr>";
                        while($row = $result2->fetch_object()){
                            $result = $conn->query("SELECT * FROM endereco WHERE Oficina_idEmpresa = $row->idEmpresa");
                            $row2 = $result->fetch_object();
                            $result3 = $conn->query("SELECT * FROM municipio WHERE idMunicipio = $row2->Municipio_idMunicipio");
                            $row3 = $result3->fetch_object();
                            echo "<tr>";
                            echo "<th>".$row->nome."</th>"; 
                            echo "<th>".$row->cnpj."</th>";
                            echo "<th>".$row->inscricao."</th>";
                            echo "<th>".$row->razao."</th>";
                            echo "<th>".$row2->CEP."</th>";
                            echo "<th>".$row2->numero."</th>";
                            echo "<th>".$row2->bairro."</th>";
                            echo "<th>".$row3->Municipio."</th>";
                            echo "</tr>";
                        }    
                        echo "</table>";    
                    }
        
                }catch (\Throwable $th) {
                    echo 'Deu ruim: </br>'.'>>>>>>>>>'. $th->getMessage();
        
                }
            }else{
                //$result = $conn->query("SELECT Oficina_idEmpresa FROM endereco WHERE Oficina_idEmpresa = {$_POST['cnpjres']}");
                $result2 = $conn->query("SELECT * FROM oficina WHERE cnpj = {$_POST['cnpjres']}");
                if (mysqli_num_rows($result2)==0){
                    echo "<div class='alert alert-danger' role='alert' style='text-align: center;'>
                    Oficina não encontrada
                  </div>";
                }                
                try{
                    //$res = $conn->query("delete from endereco where Oficina_idEmpresa = {$result[0]['idEmpresa']};");
                    $qtd = $result2->num_rows;
                    if($qtd>0){
                        echo "<table class='table table-hover'>";
                        echo "<thead class='table-dark'>";
                        echo "<tr>";
                        echo "<th>Nome</th>";
                        echo "<th>CNPJ</th>";
                        echo "<th>Inscrição</th>";
                        echo "<th>Razão</th>";
                        echo "<th>CEP</th>";
                        echo "<th>Número</th>";
                        echo "<th>Bairro</th>";
                        echo "<th>Município</th>";
                        echo "<th> Editar</th>";
                        
                        echo "</tr>";
                        while($row = $result2->fetch_object()){
                            $result = $conn->query("SELECT * FROM endereco WHERE Oficina_idEmpresa = $row->idEmpresa");
                            $row2 = $result->fetch_object();
                            $result3 = $conn->query("SELECT * FROM municipio WHERE idMunicipio = $row2->Municipio_idMunicipio");
                            $row3 = $result3->fetch_object();
                            echo "<tr>";
                            echo "<th>".$row->nome."</th>"; 
                            echo "<th>".$row->cnpj."</th>";
                            echo "<th>".$row->inscricao."</th>";
                            echo "<th>".$row->razao."</th>";
                            echo "<th>".$row2->CEP."</th>";
                            echo "<th>".$row2->numero."</th>";
                            echo "<th>".$row2->bairro."</th>";
                            echo "<th>".$row3->Municipio."</th>";
                            echo "<th><button type='button' class='btn btn-outline-blue' data-bs-toggle='modal' data-bs-target='#cadAlterarModal'>Editar</button></th>";
                            echo "</tr>";
                            $nome = $row->nome;
                            $cnpj = $row->cnpj;
                            $inscricao = $row->inscricao;
                            $razao = $row->razao;
                            $cep = $row2->CEP;
                            $municipio = $row3->Municipio;
                            $bairro = $row2->bairro;
                            $logradouro = $row2->Logradouro;
                            $numero = $row2->numero;
                        }    
                        echo "</table>";    
                    }
        
                }catch (\Throwable $th) {
                    echo 'Deu ruim: </br>'.'>>>>>>>>>'. $th->getMessage();
        
                }
            }

            
        }
        


    ?>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Buscar Oficina</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="mostrat-usuario-form" action="index.php" method="POST">
                        <span id="msgAlertErroLogin"></span>
                        <div class="mb-3">
                            <label for="cadnome" class="col-form-label">Informe o CNPJ da empresa: </label>
                            <input type="text" name="cnpjres" class="form-control" id="cnpjres" placeholder="CNPJ">
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-outline-primary bt-sm" id="acessar" name="acessar" value="BUSCAR">
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cadUsuarioModal" tabindex="-1" aria-labelledby="cadUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadUsuarioModalLabel" >Cadastrar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cad-usuario-form" action="index.php" method="POST">
                        <span id="msgAlertErroCad"></span>

                        <div class="mb-3">
                            <label for="cadnome" class="col-form-label">Nome:</label>
                            <input type="text" name="nameEmpresa" class="form-control" id="nameEmpresa" placeholder="Digite o nome da empresa">
                        </div>

                        <div class="mb-3">
                            <label for="cademail" class="col-form-label">CNPJ:</label>
                            <input type="text" name="cnpjEmpresa" class="form-control" id="cnpjEmpresa" placeholder="Digite seu CNPJ">
                        </div>

                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Inscrição:</label>
                            <input type="text" name="inscricaoEmpresa" class="form-control" id="inscricaoEmpresa"  placeholder="Digite sua Inscrição">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Razão:</label>
                            <input type="text" name="razaoEmpresa" class="form-control" id="razaoEmpresa"  placeholder="Digite sua Inscrição">
                        </div>
                        <h6>Endereço</h6>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Cep:</label>
                            <input type="text" name="cep" class="form-control" id="cep"  placeholder="Informe seu cep">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Estado:</label>
                            <input type="text" name="estado" class="form-control" id="estado"  placeholder="Informe seu Estado">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Município:</label>
                            <input type="text" name="municipio" class="form-control" id="municipio"  placeholder="Informe seu Município ">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Bairro:</label>
                            <input type="text" name="bairro" class="form-control" id="bairro"  placeholder="Informe seu Bairro">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Logradouro:</label>
                            <input type="text" name="logradouro" class="form-control" id="logradouro"  placeholder="Informe seu logradouro">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Número:</label>
                            <input type="text" name="numero" class="form-control" id="numero"  placeholder="Informe seu número">
                        </div>
                        <div class="mb-3">
                            <input type="submit" id="cadUsuario" name="cadUsuario">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
<div class="modal fade" id="cadAlterarModal" tabindex="-1" aria-labelledby="cadAlterarModalLabel" aria-hidden="true">
         
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadAlterarModalLabel" >Alterar Dados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cad-alterar-form">
                        <span id="msgAlertErroCad"></span>

                        <div class="mb-3">
                            <label for="cademail" class="col-form-label">CNPJ:</label>
                            <input type="text" name="cnpj" class="form-control" id="cnpj" placeholder="Digite seu CNPJ" value="<?php 
                            echo $cnpj;
                                 ?>">
                        </div>

                        <div class="mb-3">
                            <label for="cadnome" class="col-form-label">Nome:</label>
                            <input type="text" name="cadnome" class="form-control" id="cadnome" placeholder="Digite o nome da empresa" valuevalue="<?php
                            echo $nome;
                                 ?>" >
                        </div>

                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Inscrição:</label>
                            <input type="text" name="inscricao" class="form-control" id="inscricao"  placeholder="Digite sua Inscrição" value="<?php 
                            echo $inscricao;
                                 ?>">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Razão:</label>
                            <input type="text" name="razao" class="form-control" id="razao"  placeholder="Digite sua Inscrição" value="<?php 
                            echo $razao;
                                 ?>">
                        </div>
                        <h6>Endereço</h6>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Cep:</label>
                            <input type="text" name="cep" class="form-control" id="cep"  placeholder="Informe seu cep" value="<?php 
                            echo $cep;
                                 ?>">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Estado:</label>
                            <input type="text" name="estado" class="form-control" id="estado"  placeholder="Informe seu Estado" value="<?php 
                                 ?>">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Município:</label>
                            <input type="text" name="municipio" class="form-control" id="municipio"  placeholder="Informe seu Município " <?php 
                            echo $municipio;
                                 ?>>
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Bairro:</label>
                            <input type="text" name="barrio" class="form-control" id="bairro"  placeholder="Informe seu Bairro" <?php 
                            echo $bairro;
                                 ?>>
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Logradouro:</label>
                            <input type="text" name="logradouro" class="form-control" id="logradouro"  placeholder="Informe seu logradouro" <?php 
                            echo $logradouro;
                                 ?>>
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Número:</label>
                            <input type="text" name="numero" class="form-control" id="numero"  placeholder="Informe seu número" <?php 
                            echo $numero;
                                 ?>>
                        </div>


                        <div class="mb-3">
                            <input type="submit" class="btn btn-outline-success bt-sm" id="cad-usuario-btn" value="Alterar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cadDeletarModal" tabindex="-1" aria-labelledby="cadDeletarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadDeletarModalLabel" >Deletar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cad-alterar-form" action="index.php" method="POST">
                        <span id="msgAlertErroCad"></span>

                        <div class="mb-3">
                            <label for="cadnome" class="col-form-label">Informe o CNPJ da Oficina:</label>
                            <input type="text" name="delnome" class="form-control" id="delnome" placeholder="CNPJ">

                        </div>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-outline-success bt-sm" id="deletar" value="DELETAR" name="deletar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
</body>
<footer>
<script>
    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</footer>

</html>
