<div class="card">
    <div class="card-header">
        <h3 class="card-title">Fechamento de Caixa Diário!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_fechamento_caixa" name="sislo_fechamento_caixa" method="POST">
            <div class="row">
                <div class="col-sm-2">
                    <?php
                    if ($incluir == 1) {
                        $data_fech = new DateTime();
                    } else {
                        $data_fech = new DateTime($data_fechamento);
                    }
                    ?>
                    <div class="form-group">
                        <label class="text text-sm">Data Fechamento</label>
                        <input type="date" id="data_fechamento" name="data_fechamento" autofocus="autofocus" required="required" class="form-control" value="<?= $data_fech->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Caixa Operador</label>
                        <select id="caixa_operador" name="caixa_operador" class="form-control">
                            <option value="0">Selecione...</option>
                            <?php
                            foreach ($id_tfl_list as $value) {
                                $select = $value->idsislo_tfl == $caixa_operador ? 'selected' : '';
                                echo '<option value="' . $value->idsislo_tfl . '" ' . $select . ' >Caixa ' . $value->caixa_numero . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Operador</label>
                        <select id="id_usuario" name="id_usuario" class="form-control">
                            <option value="0">Selecione...</option>
                            <?php
                            foreach ($id_usuario_list as $value) {
                                $select = $value->idsislo_funcionarios == $id_usuario ? 'selected' : '';
                                echo '<option value="' . $value->idsislo_funcionarios . '" ' . $select . ' >' . $value->nome . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Créditos (R$)</label>
                        <input type="text" id="total_credito" name="total_credito" class="form-control convert_money" required="required" value="<?= $total_credito; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                        <input type="hidden" id="idsislo_fechamento_caixa" name="idsislo_fechamento_caixa" class="form-control" value="<?= $idsislo_fechamento_caixa; ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Débitos (R$)</label>
                        <input type="text" id="total_debito" name="total_debito" class="form-control convert_money resumo_credito" required="required" value="<?= $total_debito; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Suprimento (R$)</label>
                        <input type="text" id="total_suprimento" name="total_suprimento" class="form-control convert_money" value="<?= $total_suprimento; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Total Moedas (R$)</label>
                        <input type="text" id="total_moedas" name="total_moedas" class="form-control convert_money" value="<?= $total_moedas; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Total Dinheiro (R$)</label>
                        <input type="text" id="total_dinheiro" name="total_dinheiro" class="form-control convert_money" value="<?= $total_dinheiro; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Total Bolões (R$)</label>
                        <input type="text" id="total_bolao" name="total_bolao" class="form-control convert_money" value="<?= $total_bolao; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Total Tele-sena (R$)</label>
                        <input type="text" id="total_telesena" name="total_telesena" class="form-control convert_money" value="<?= $total_telesena; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Total Bilhete Federal (R$)</label>
                        <input type="text" id="total_bilhete_federal" name="total_bilhete_federal" class="form-control convert_money" value="<?= $total_bilhete_federal; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Sangrias (R$)</label>
                        <input type="text" id="total_sangrias" name="total_sangrias" class="form-control convert_money" value="<?= $total_sangrias; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Sobra Caixa (R$)</label>
                        <input type="text" id="total_sobra_cx" name="total_sobra_cx" class="form-control convert_money" value="<?= $total_sobra_cx; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Brinde (R$)</label>
                        <input type="text" id="total_brinde" name="total_brinde" class="form-control convert_money" value="<?= $total_brinde; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Outros / Cartão (R$)</label>
                        <input type="text" id="total_outros" name="total_outros" class="form-control convert_money" value="<?= $total_outros; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Total PIX (R$)</label>
                        <input type="text" id="total_pix" name="total_pix" class="form-control convert_money" value="<?= $total_pix; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="text text-sm">Obs. Brinde</label>
                        <input type="text" id="obs_brinde" name="obs_brinde" class="form-control" value="<?= $obs_brinde; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="text text-sm">Obs. Outros</label>
                        <input type="text" id="obs_outros" name="obs_outros" class="form-control" value="<?= $obs_outros; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Caixa Inicial (R$)</label>
                        <input type="text" id="caixa_inicial" name="caixa_inicial" class="form-control convert_money" required="required" value="<?= $caixa_inicial; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Soma Geral (R$)</label>
                        <input type="text" readonly="readonly" id="soma_geral" name="soma_geral" class="form-control convert_money" value="<?= $soma_geral; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Resumo TFL (R$)</label>
                        <input type="text" readonly="readonly" id="resumo_tfl" name="resumo_tfl" class="form-control convert_money" value="<?= $resumo_tfl; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Diferença (+/-) (R$)</label>
                        <input type="text" readonly="readonly" id="diferenca" name="diferenca" class="form-control convert_money" value="<?= $diferenca; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-archive"></i>  Fechar Caixa
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>