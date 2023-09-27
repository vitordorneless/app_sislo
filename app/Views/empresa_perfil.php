<div class="card">
    <div class="card-header">
        <h3 class="card-title">Perfil</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" id="cargo" name="cargo" class="form-control" readonly="readonly" value="<?= $dados->nome_fantasia; ?>">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>CNPJ</label>
                    <input type="text" id="cnpj" name="cnpj" class="form-control" readonly="readonly" value="<?= $dados->cnpj; ?>">
                </div>
            </div>            
        </div>
        <div class="row">            
            <div class="col-sm-4">
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" id="email" value="<?= $dados->email; ?>" name="email" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" id="tel1" value="<?= $dados->tel1; ?>" name="tel1" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>WhatsApp</label>
                    <input type="text" id="whatsapp" value="<?= $dados->whatsapp; ?>" name="whatsapp" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" id="tel2" value="<?= $dados->tel2; ?>" name="tel2" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" id="tel3" value="<?= $dados->tel3; ?>" name="tel3" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label>CEP</label>
                    <input type="text" id="cep" name="cep" class="form-control" value="<?= $dados->cep; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Rua</label>
                    <input type="text" id="logradouro" name="logradouro" value="<?= $dados->logradouro; ?>" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Número</label>
                    <input type="text" id="numero" name="numero" value="<?= $dados->numero; ?>" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Complemento</label>
                    <input type="text" id="complemento" value="<?= $dados->complemento; ?>" name="complemento" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Bairro</label>
                    <input type="text" id="bairro" name="bairro" class="form-control" value="<?= $dados->bairro; ?>">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Cidade</label>
                    <input type="text" id="cidade" name="cidade" class="form-control" value="<?= $dados->cidade; ?>">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <label>UF</label>
                    <input type="text" id="uf" name="uf" class="form-control" value="<?= $dados->uf; ?>">
                </div>
            </div>
        </div>
    </div>    
    <div class="card-footer" id="conteudo"></div>
</div>