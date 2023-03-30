<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dados Tipo de PEC</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_tipopecs" name="sislo_tipopecs" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" id="tipo" name="tipo" class="form-control" required="required" value="<?= $tipo; ?>">
                        <input type="hidden" id="idsislo_tipo_pec" name="idsislo_tipo_pec" class="form-control" value="<?= $idsislo_tipo_pec; ?>">
                        <input type="hidden" id="incluir" value="<?= $incluir; ?>" name="incluir">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select id="status" name="status" class="form-control">
                            <?php
                            $selected = $status == '1' ? 'selected' : '';
                            ?>
                            <option value="1" <?= $selected; ?>>Ativo</option>
                            <option value="0">Inativo</option>
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