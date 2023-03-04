<?php
session_start();
//Gerar senha
//echo password_hash("123456", PASSWORD_DEFAULT);
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
                <button type='button' class='btn btn-outline-success' data-bs-toggle='modal' data-bs-target='#cadAlterarModal'>Alterar dados</button>
                <button type='button' class='btn btn-outline-danger' data-bs-toggle='modal' data-bs-target='#cadDeletarModal'>Deletar</button>
            </div>
        
        <div class="m-5">
            <span id="msgAlert"></span>
        </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Buscar Oficina</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="login-usuario-form">
                        <span id="msgAlertErroLogin"></span>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Informe o CNPJ da empresa: </label>
                            <input type="text" name="cnpjres" class="form-control" id="cnpjres" placeholder="CNPJ">
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-outline-primary bt-sm" id="login-usuario-btn" value="BUSCAR">
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
                    <form id="cad-usuario-form">
                        <span id="msgAlertErroCad"></span>

                        <div class="mb-3">
                            <label for="cadnome" class="col-form-label">Nome:</label>
                            <input type="text" name="cadnome" class="form-control" id="cadnome" placeholder="Digite o nome completo">
                        </div>

                        <div class="mb-3">
                            <label for="cademail" class="col-form-label">CNPJ:</label>
                            <input type="email" name="cnpj" class="form-control" id="cnpj" placeholder="Digite seu CNPJ">
                        </div>

                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Inscrição:</label>
                            <input type="password" name="inscricao" class="form-control" id="inscricao"  placeholder="Digite sua Inscrição">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Razão:</label>
                            <input type="password" name="razao" class="form-control" id="razao"  placeholder="Digite sua Inscrição">
                        </div>
                        <h6>Endereço</h6>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Cep:</label>
                            <input type="password" name="cep" class="form-control" id="cep"  placeholder="Informe seu cep">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Estado:</label>
                            <input type="password" name="estado" class="form-control" id="estado"  placeholder="Informe seu Estado">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Município:</label>
                            <input type="password" name="municipio" class="form-control" id="municipio"  placeholder="Informe seu Município ">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Bairro:</label>
                            <input type="password" name="barrio" class="form-control" id="bairro"  placeholder="Informe seu Bairro">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Logradouro:</label>
                            <input type="password" name="logradouro" class="form-control" id="logradouro"  placeholder="Informe seu logradouro">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Número:</label>
                            <input type="password" name="numero" class="form-control" id="numero"  placeholder="Informe seu número">
                        </div>


                        <div class="mb-3">
                            <input type="submit" class="btn btn-outline-success bt-sm" id="cad-usuario-btn" value="Cadastrar">
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
                            <label for="cadnome" class="col-form-label">Nome:</label>
                            <input type="text" name="cadnome" class="form-control" id="cadnome" placeholder="Digite o nome completo">
                        </div>

                        <div class="mb-3">
                            <label for="cademail" class="col-form-label">CNPJ:</label>
                            <input type="email" name="cnpj" class="form-control" id="cnpj" placeholder="Digite seu CNPJ">
                        </div>

                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Inscrição:</label>
                            <input type="password" name="inscricao" class="form-control" id="inscricao"  placeholder="Digite sua Inscrição">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Razão:</label>
                            <input type="password" name="razao" class="form-control" id="razao"  placeholder="Digite sua Inscrição">
                        </div>
                        <h6>Endereço</h6>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Cep:</label>
                            <input type="password" name="cep" class="form-control" id="cep"  placeholder="Informe seu cep">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Estado:</label>
                            <input type="password" name="estado" class="form-control" id="estado"  placeholder="Informe seu Estado">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Município:</label>
                            <input type="password" name="municipio" class="form-control" id="municipio"  placeholder="Informe seu Município ">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Bairro:</label>
                            <input type="password" name="barrio" class="form-control" id="bairro"  placeholder="Informe seu Bairro">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Logradouro:</label>
                            <input type="password" name="logradouro" class="form-control" id="logradouro"  placeholder="Informe seu logradouro">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Número:</label>
                            <input type="password" name="numero" class="form-control" id="numero"  placeholder="Informe seu número">
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
                    <form id="cad-alterar-form">
                        <span id="msgAlertErroCad"></span>

                        <div class="mb-3">
                            <label for="cadnome" class="col-form-label">Informe o CNPJ da Oficina:</label>
                            <input type="text" name="cadnome" class="form-control" id="cadnome" placeholder="CNPJ">

                        </div>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-outline-success bt-sm" id="cad-usuario-btn" value="DELETAR">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
</body>

</html>