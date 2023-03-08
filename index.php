<?php

    if(isset($_POST['cadUsuario'])){
        include_once('crud/create.php');}
    
    if (isset($_POST['deletar'])) {
        include('crud/delete.php');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
<?php



if(isset($_POST['Editar'])) {
        echo "<script>
        $(document).ready(function(){
            $('#cadAlterarModal').modal('show');
        });
    </script>";
    }
elseif (isset($_POST['Alterar'])){
        include('crud/update.php');
        }
    
    
    
?>
</head>

 

<body>
    <div class="container text-center">
            <div id='dados-usuario'>
                <button type='button' class='btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#cadUsuarioModal'>Cadastrar</button>
                <button type='button' class='btn btn-outline-primary m-3' data-bs-toggle='modal' data-bs-target='#loginModal'>Acessar</button>
            </div>
        
        <div class="m-5">
            <span id="msgAlert"></span>
        </div>
    </div>
    <?php
    
        if(isset($_POST['acessar'])){
            include_once('config.php');
            if($_POST['cnpjres']== null){
                $result2 = $conn->query("SELECT * FROM oficina");
                try{
                    $qtd = $result2->num_rows;
                    if($qtd>0){
                        echo "<table class='table table-striped table-bordered'>";
                        echo "<thead/>";
                        echo "<tr>";
                        echo "<th>Nome</th>";
                        echo "<th>CNPJ</th>";
                        echo "<th>Inscrição</th>";
                        echo "<th>Razão</th>";
                        echo "<th>CEP</th>";
                        echo "<th>Número</th>";
                        echo "<th>Bairro</th>";
                        echo "<th>Município</th>";
                        echo "<td>Editar</td>";
                        echo "</tr>";

                        while($row = $result2->fetch_object()){
                            $result = $conn->query("SELECT * FROM endereco WHERE Oficina_idEmpresa = $row->idEmpresa");
                            $row2 = $result->fetch_object();
                            $result3 = $conn->query("SELECT * FROM municipio WHERE idMunicipio = $row2->Municipio_idMunicipio");
                            $row3 = $result3->fetch_object();
                            echo "<tr class='table-active'>";
                            echo "<th>".$row->nome."</th>"; 
                            echo "<th>".$row->cnpj."</th>";
                            echo "<th>".$row->inscricao."</th>";
                            echo "<th>".$row->razao."</th>";
                            echo "<th>".$row2->CEP."</th>";
                            echo "<th>".$row2->numero."</th>";
                            echo "<th>".$row2->bairro."</th>";
                            echo "<th>".$row3->Municipio."</th>";
                            echo "<th>
                            <form method='post' action='index.php'>
                            <input type='submit' class='btn btn-outline-success bt-sm' id='Editar' value='Editar' name='Editar'>
                            <input type='hidden' name='idEmpresa5' value= {$row->idEmpresa} id='idEmpresa5'/>
                            <form method='post' action='index.php'>
                            <input type='submit' class='btn btn-outline-danger bt-sm' id='deletar' value='Excluir' name='deletar'>
                            <input type='hidden' name='idEmpresa' value= {$row->idEmpresa} id='idEmpresa'/>
                            </form>
                            </form></th>";
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
                        echo "<table class='table table-bordered' >";
                        echo "<thead >";
                        echo "<tr>";
                        echo "<th>Nome</th>";
                        echo "<th>CNPJ</th>";
                        echo "<th>Inscrição</th>";
                        echo "<th>Razão</th>";
                        echo "<th>CEP</th>";
                        echo "<th>Número</th>";
                        echo "<th>Bairro</th>";
                        echo "<th>Município</th>";
                        echo "<td>Editar</td>";
                        
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
                            echo "<th>
                            <form method='post' action='index.php'>
                            <input type='submit' class='btn btn-outline-success bt-sm' id='Editar' value='Editar' name='Editar'>
                            <input type='hidden' name='idEmpresa5' value= {$row->idEmpresa} id='idEmpresa5'/>
                            <form method='post' action='index.php'>
                            <input type='submit' class='btn btn-outline-danger bt-sm' id='deletar' value='Excluir' name='deletar'>
                            <input type='hidden' name='idEmpresa' value= {$row->idEmpresa} id='idEmpresa'/>
                            </form>
                            </form></th>";
                            echo "</tr>";
                            
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
        <?php
        include_once('config.php');
            $resultado = $conn->query("SELECT * FROM oficina WHERE idEmpresa = {$_POST['idEmpresa5']}");
            $linha = $resultado->fetch_object();
            $resultado2 = $conn->query("SELECT * FROM Endereco WHERE Oficina_idEmpresa = {$_POST['idEmpresa5']}");
            $linha2 = $resultado2->fetch_object();
            $resultado3 = $conn->query("SELECT * FROM Municipio WHERE idMunicipio = {$linha2->Municipio_idMunicipio}");
            $linha3 = $resultado3->fetch_object();
            $resultado4 = $conn->query("SELECT * FROM Estado WHERE idEstado = {$linha3->Estado_idEstado}");
            $linha4 = $resultado4->fetch_object();
        ?>
         
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadAlterarModalLabel" >Alterar Dados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cad-alterar-form" action="index.php" method="POST">
                        <span id="msgAlertErroCad"></span>

                        <div class="mb-3">
                            <label for="cadnome" class="col-form-label">Nome:</label>
                            <input type="text" name="altercadnome" class="form-control" id="altercadnome" placeholder="Digite o nome da empresa" value="<?php echo $linha->nome ?>" >
                        </div>

                        <div class="mb-3">
                            <label for="cademail" class="col-form-label">CNPJ:</label>
                            <input type="text" name="altercnpj" class="form-control" id="altercnpj" placeholder="Digite seu CNPJ" value="<?php echo $linha->cnpj ?>">
                        </div>

                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Inscrição:</label>
                            <input type="text" name="alterinscricao" class="form-control" id="alterinscricao"  placeholder="Digite sua Inscrição" value="<?php echo $linha->inscricao?>">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Razão:</label>
                            <input type="text" name="alterrazao" class="form-control" id="alterrazao"  placeholder="Digite sua Inscrição" value="<?php echo $linha->razao?>">
                        </div>
                        <h6>Endereço</h6>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Cep:</label>
                            <input type="text" name="altercep" class="form-control" id="altercep"  placeholder="Informe seu cep" value="<?php echo $linha2->CEP?>">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Estado:</label>
                            <input type="text" name="alterestado" class="form-control" id="alterestado"  placeholder="Informe seu Estado" value="<?php echo $linha4->Estado?>">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Município:</label>
                            <input type="text" name="altermunicipio" class="form-control" id="altermunicipio"  placeholder="Informe seu Município " value="<?php echo $linha3->Municipio ?>">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Bairro:</label>
                            <input type="text" name="alterbairro" class="form-control" id="alterbairro"  placeholder="Informe seu Bairro"value= "<?php echo $linha2->bairro ?>">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Logradouro:</label>
                            <input type="text" name="alterlogradouro" class="form-control" id="alterlogradouro"  placeholder="Informe seu logradouro"value= <?php echo $linha2->Logradouro ?>>
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Número:</label>
                            <input type="text" name="alternumero" class="form-control" id="alternumero" placeholder="Informe seu número" value=<?php echo $linha2->numero?>>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-outline-success bt-sm" id="Alterar" value="Alterar" name="Alterar">
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
