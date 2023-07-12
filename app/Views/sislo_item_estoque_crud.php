<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ítem Estoque</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_item_estoque" name="sislo_item_estoque" method="POST">
            <input type="hidden" id="id_sislo_item_estoque" value="<?= $id_sislo_item_estoque; ?>" name="id_sislo_item_estoque">
            <input type="hidden" id="incluir" value="<?= $incluir; ?>" name="incluir">
            <div class="form-group">
                <label class="col-lg-2 control-label">Código Lotérico</label>
                <div class="col-lg-10">
                    <input type="text" id="cod_loterico" name="cod_loterico" class="form-control" required="required" value="<?= $cod_loterico; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Item</label>
                <div class="col-lg-10">
                    <input type="text" required="required" id="item" value="<?= $item; ?>" name="item" class="form-control" maxlength="30" autofocus="autofocus">
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