<div class="card">
    <div class="card-header">
        <h3 class="card-title">Gerenciar TFL!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_tfl" name="sislo_tfl" method="POST">
            <input type="hidden" id="idsislo_tfl" value="<?= $idsislo_tfl; ?>" name="idsislo_tfl">
            <input type="hidden" id="incluir" value="<?= $incluir; ?>" name="incluir">
            <div class="form-group">
                <label class="col-lg-2 control-label">Código Lotérico</label>
                <div class="col-lg-10">
                    <input type="text" id="cod_loterico" name="cod_loterico" class="form-control" required="required" value="<?= $cod_loterico; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Terminal</label>
                <div class="col-lg-10">
                    <input type="text" required="required" id="terminal" value="<?= $terminal; ?>" name="terminal" class="form-control" maxlength="30" autofocus="autofocus">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Número do Caixa</label>
                <div class="col-lg-10">
                    <input type="text" id="caixa_numero" value="<?= $caixa_numero; ?>" name="caixa_numero" required="required" class="form-control" maxlength="30">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Série</label>
                <div class="col-lg-10">
                    <input type="text" id="serie" value="<?= $serie; ?>" required="required" name="serie" class="form-control" maxlength="100">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Status</label>
                <div class="col-lg-10">
                    <select id="status" name="status" class="form-control">
                        <?php
                        $selected = $status == '1' ? 'selected' : '';
                        ?>
                        <option value="1" <?= $selected; ?>>Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
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