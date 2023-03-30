<div class="card">
    <div class="card-header">
        <h3 class="card-title">Jogos CEF!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_jogoscef" name="sislo_jogoscef" method="POST">        
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" id="nome" required="required" name="nome" class="form-control" value="<?= $nome; ?>">
                    <input type="hidden" id="idsislo_jogos_cef" name="idsislo_jogos_cef" class="form-control" value="<?= $idsislo_jogos_cef; ?>">
                    <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">                    
                </div>
            </div>
            <div class="col-sm-6">
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
                <label>Dias Sorteios:</label>
                <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="seg" name="seg" <?=$seg == 1 ?? 'checked' ?> value="1">
                    <label class="form-check-label">Seg</label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="ter" name="ter" <?=$ter == 1 ?? 'checked' ?> value="1">
                    <label class="form-check-label">Ter</label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="qua" name="qua" <?=$qua == 1 ?? 'checked' ?> value="1">
                    <label class="form-check-label">Qua</label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="qui" name="qui" <?=$qui == 1 ?? 'checked' ?> value="1">
                    <label class="form-check-label">Qui</label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="sex" name="sex" <?=$sex == 1 ?? 'checked' ?> value="1">
                    <label class="form-check-label">Sex</label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="sab" name="sab" <?=$sab == 1 ?? 'checked' ?> value="1">
                    <label class="form-check-label">Sáb</label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" id="dom" name="dom" <?=$dom == 1 ?? 'checked' ?> value="1">
                    <label class="form-check-label">Dom</label>
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