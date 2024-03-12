<div class="card">
    <div class="card-header">
        <h3 class="card-title">Loteria Federal!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_loteria_federal" name="sislo_loteria_federal" method="POST">
            <div class="row">                
                <div class="col-sm-2">
                    <?php
                    if ($incluir == 1) {
                        $data_fech = new DateTime();
                    } else {
                        $data_fech = new DateTime($data_extracao);
                    }
                    ?>
                    <div class="form-group">
                        <label class="text text-sm">Modalidade</label>
                        <select id="modalidade" name="modalidade" class="form-control">
                            <?php
                            $selected_simples = $modalidade == '1' ? 'selected' : '';
                            $selected_milionario = $modalidade == '2' ? 'selected' : '';                            
                            ?>
                            <option value="1" <?= $selected_simples; ?>>Normal</option>
                            <option value="2" <?= $selected_milionario; ?>>Milionário</option>                            
                        </select>
                    </div>
                </div>                
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Total de Bilhetes Inteiros</label>
                        <input type="number" min="1" max="999" id="total_bilhetes_recibo" name="total_bilhetes_recibo" class="form-control" required="required" value="<?= $total_bilhetes_recibo; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                        <input type="hidden" id="id" name="id" class="form-control" value="<?= $id; ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Total de Bilhetes</label>
                        <input type="number" min="1" max="999" id="total_bilhetes_liquido" name="total_bilhetes_liquido" class="form-control" required="required" value="<?= $total_bilhetes_liquido; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Extração</label>
                        <input type="text" id="extracao" name="extracao" class="form-control convert_money resumo_credito" required="required" value="<?= $extracao; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Data da Extração</label>
                        <input type="date" id="data_extracao" name="data_extracao" class="form-control" value="<?= $data_fech->format('Y-m-d'); ?>" required="required">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Preço do Plano (R$)</label>
                        <input type="text" id="preco_plano" name="preco_plano" class="form-control convert_money" value="<?= $preco_plano; ?>" required="required">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Valor Bruto (R$)</label>
                        <input type="text" id="valor_bruto_recibo" name="valor_bruto_recibo" class="form-control convert_money" value="<?= $valor_bruto_recibo; ?>" required="required">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Valor Bruto Líquido (R$)</label>
                        <input type="text" id="valor_bruto_liquido" name="valor_bruto_liquido" class="form-control convert_money" value="<?= $valor_bruto_liquido; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Comissão (R$)</label>
                        <input type="text" id="comissao_recibo" name="comissao_recibo" class="form-control convert_money" value="<?= $comissao_recibo; ?>" required="required">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Valor Liquído (R$)</label>
                        <input type="text" id="valor_liquido_recibo" name="valor_liquido_recibo" class="form-control convert_money" value="<?= $valor_liquido_recibo; ?>" required="required">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Total de Comissão (R$)</label>
                        <input type="text" id="valor_liquido_real" name="valor_liquido_real" class="form-control convert_money" value="<?= $valor_liquido_real; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Lote</label>
                        <input type="number" min="1" id="lote" name="lote" class="form-control" value="<?= $lote; ?>" required="required">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Caixa</label>
                        <input type="text" id="caixa" name="caixa" class="form-control" value="<?= $caixa; ?>" required="required">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Encalhe</label>
                        <input type="text" id="quantidade_encalhe" name="quantidade_encalhe" class="form-control" value="<?= $quantidade_encalhe; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
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
                            <i class="fas fa-archive"></i>  Salvar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>