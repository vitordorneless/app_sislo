<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dados Tipos de Convênios</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_convenios" name="sislo_convenios" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Convênio</label>
                        <input type="text" id="convenio" name="convenio" class="form-control" required="required" value="<?= $convenio; ?>">
                        <input type="hidden" id="idsislo_tipos_convenio" name="idsislo_tipos_convenio" class="form-control" value="<?= $idsislo_tipos_convenio; ?>">
                        <input type="hidden" id="incluir" value="<?= $incluir; ?>" name="incluir">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Valor Global</label>
                        <input type="text" id="valor_global" name="valor_global" class="form-control" required="required" value="<?= $valor_global; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
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