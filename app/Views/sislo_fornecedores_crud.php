<div class="card">
    <div class="card-header">
        <h3 class="card-title">Fornecedores!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_fornecedores" name="sislo_fornecedores" method="POST">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Código Lotérico</label>
                        <input type="text" required="required" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">                        
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" required="required" id="nome" name="nome" class="form-control" autofocus="autofocus" value="<?= $nome; ?>">
                        <input type="hidden" id="idsislo_fornecedores" name="idsislo_fornecedores" class="form-control" value="<?= $idsislo_fornecedores; ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">                    
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>CNPJ</label>
                        <input type="text" required="required" id="cnpj" name="cnpj" class="form-control" value="<?= $cnpj; ?>">                    
                    </div>
                </div>            
            </div>
            <div class="row">            
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Contato</label>
                        <input type="text" id="contato" required="required" name="contato" class="form-control" value="<?= $contato; ?>">                    
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>WhatsApp</label>
                        <input type="text" id="whats" name="whats" required="required" class="form-control" value="<?= $whats; ?>">                    
                    </div>
                </div>
            </div>
            <div class="row">            
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="email" name="email" class="form-control" required="required" value="<?= $email; ?>">                    
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" id="tel" name="tel" required="required" class="form-control" value="<?= $tel; ?>">                    
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="1" <?= $status == 1 ? 'selected' : ''; ?>>Ativo</option>
                            <option value="0" <?= $status == 0 ? 'selected' : ''; ?>>Inativo</option>                        
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-edit"></i>Atualizar Dados
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>