
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
                            <input type="text" name="inscricao" class="form-control" id="inscricao"  placeholder="Digite sua Inscrição">
                        </div>
                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Razão:</label>
                            <input type="text" name="razao" class="form-control" id="razao"  placeholder="Digite sua Inscrição">
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
                            <input type="text" name="barrio" class="form-control" id="bairro"  placeholder="Informe seu Bairro">
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
                            <input type="submit" class="btn btn-outline-success bt-sm" id="cad-usuario-btn" value="Alterar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>