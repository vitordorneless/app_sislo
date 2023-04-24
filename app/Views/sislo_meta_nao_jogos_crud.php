<div class="card">
    <div class="card-header">
        <h3 class="card-title">Loteria Federal!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_meta_nao_jogos" name="sislo_meta_nao_jogos" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Ano</label>
                        <input type="number" min="2014" max="2099" id="ano" name="ano" class="form-control" required="required" value="<?= $ano; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                        <input type="hidden" id="id_sislo_meta_nao_jogos" name="id_sislo_meta_nao_jogos" class="form-control" value="<?= $id_sislo_meta_nao_jogos; ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
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
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Janeiro</label>
                        <input type="text" id="janeiro" name="janeiro" class="form-control convert_money" required="required" value="<?= $janeiro; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Fevereiro</label>
                        <input type="text" id="fevereiro" name="fevereiro" class="form-control convert_money" required="required" value="<?= $fevereiro; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Março</label>
                        <input type="text" id="marco" name="marco" class="form-control convert_money" required="required" value="<?= $marco; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Abril</label>
                        <input type="text" id="abril" name="abril" class="form-control convert_money" required="required" value="<?= $abril; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Maio</label>
                        <input type="text" id="maio" name="maio" class="form-control convert_money" required="required" value="<?= $maio; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Junho</label>
                        <input type="text" id="junho" name="junho" class="form-control convert_money" required="required" value="<?= $junho; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Julho</label>
                        <input type="text" id="julho" name="julho" class="form-control convert_money" required="required" value="<?= $julho; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Agosto</label>
                        <input type="text" id="agosto" name="agosto" class="form-control convert_money" required="required" value="<?= $agosto; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Setembro</label>
                        <input type="text" id="setembro" name="setembro" class="form-control convert_money" required="required" value="<?= $setembro; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Outubro</label>
                        <input type="text" id="outubro" name="outubro" class="form-control convert_money" required="required" value="<?= $outubro; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Novembro</label>
                        <input type="text" id="novembro" name="novembro" class="form-control convert_money" required="required" value="<?= $novembro; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Dezembro</label>
                        <input type="text" id="dezembro" name="dezembro" class="form-control convert_money" required="required" value="<?= $dezembro; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-archive"></i>  Salvar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>