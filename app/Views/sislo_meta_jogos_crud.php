<div class="card">
    <div class="card-header">
        <h3 class="card-title">Metas Jogos!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_meta_jogos" name="sislo_meta_jogos" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Ano</label>
                        <input type="number" min="2014" max="2099" id="ano" name="ano" autofocus="autofocus" class="form-control" required="required" value="<?= $ano; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                        <input type="hidden" id="id_sislo_meta_jogos" name="id_sislo_meta_jogos" class="form-control" value="<?= $id_sislo_meta_jogos; ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Jogo</label>
                        <select id="id_sislo_jogos_cef" name="id_sislo_jogos_cef[]" class="form-control">
                            <?php
                            foreach ($jogos as $value) {
                                $selected_jogo = $value->idsislo_jogos_cef == $id_sislo_jogos_cef ? 'selected' : '';
                                echo '<option "' . $selected_jogo . '" value="' . $value->idsislo_jogos_cef . '">' . $value->nome . '</option>';
                            }
                            ?>
                        </select>
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
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Janeiro - Bolão</label>
                        <input type="text" id="janeiro_bolao" name="janeiro_bolao" class="form-control convert_money" required="required" value="<?= $janeiro_bolao; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Fevereiro - Bolão</label>
                        <input type="text" id="fevereiro_bolao" name="fevereiro_bolao" class="form-control convert_money" required="required" value="<?= $fevereiro_bolao; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Março - Bolão</label>
                        <input type="text" id="marco_bolao" name="marco_bolao" class="form-control convert_money" required="required" value="<?= $marco_bolao; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Abril - Bolão</label>
                        <input type="text" id="abril_bolao" name="abril_bolao" class="form-control convert_money" required="required" value="<?= $abril_bolao; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Maio - Bolão</label>
                        <input type="text" id="maio_bolao" name="maio_bolao" class="form-control convert_money" required="required" value="<?= $maio_bolao; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Junho - Bolão</label>
                        <input type="text" id="junho_bolao" name="junho_bolao" class="form-control convert_money" required="required" value="<?= $junho_bolao; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Julho - Bolão</label>
                        <input type="text" id="julho_bolao" name="julho_bolao" class="form-control convert_money" required="required" value="<?= $julho_bolao; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Agosto - Bolão</label>
                        <input type="text" id="agosto_bolao" name="agosto_bolao" class="form-control convert_money" required="required" value="<?= $agosto_bolao; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Setembro - Bolão</label>
                        <input type="text" id="setembro_bolao" name="setembro_bolao" class="form-control convert_money" required="required" value="<?= $setembro_bolao; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Outubro - Bolão</label>
                        <input type="text" id="outubro_bolao" name="outubro_bolao" class="form-control convert_money" required="required" value="<?= $outubro_bolao; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Novembro - Bolão</label>
                        <input type="text" id="novembro_bolao" name="novembro_bolao" class="form-control convert_money" required="required" value="<?= $novembro_bolao; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Dezembro - Bolão</label>
                        <input type="text" id="dezembro_bolao" name="dezembro_bolao" class="form-control convert_money" required="required" value="<?= $dezembro_bolao; ?>">
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