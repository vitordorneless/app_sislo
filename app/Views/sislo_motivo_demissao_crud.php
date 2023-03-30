<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dados Motivo para Demissões</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_motivo_demissaos" name="sislo_motivo_demissaos" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Motivo da Demissão</label>
                        <input type="text" id="motivo_demissao" name="motivo_demissao" class="form-control" required="required" value="<?= $motivo_demissao; ?>">
                        <input type="hidden" id="id_motivo_demissao" name="id_motivo_demissao" class="form-control" value="<?= $id_motivo_demissao; ?>">
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