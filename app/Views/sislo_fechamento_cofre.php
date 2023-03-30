<div class="card">
    <div class="card-header">
        <h3 class="card-title">Fechamento de Cofre - Diário!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_fechamento_cofre" name="sislo_fechamento_cofre" method="POST">
            <?php
            $hoje = new \Datetime('now');
            ?>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm" for="data_fechamento">Data Fechamento</label>
                        <input type="date" id="data_fechamento" name="data_fechamento" readonly="readonly" class="form-control" value="<?= $hoje->format('Y-m-d') ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm" for="senha_protege">Senha Carro Forte</label>
                        <input type="text" readonly="readonly" id="senha_protege" name="senha_protege" class="form-control" value="<?= $senha_protege ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm" for="os_gtv">Nº OS GTV</label>
                        <input type="text" id="os_gtv" name="os_gtv" autofocus="autofocus" required="required" class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm" for="guia_gtv">Nº Guia GTV</label>
                        <input type="text" id="guia_gtv" required="required" name="guia_gtv" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                if (empty($dados_remessas)) {
                    echo '<div class="col-sm-12"><div class="form-group"><h1 class="text text-danger">Sem Sangrias nesse dia!!</h1></div></div>';
                    echo '<input type="hidden" readonly="readonly" value="0" id="remessa" name="remessa[]" class="form-control">';
                } else {
                    foreach ($dados_remessas as $value) {
                        echo '<div class="col-sm-3">';
                        echo '<div class="form-group">';
                        echo '<label class="text text-sm">Sangrias Caixa nº' . $value->caixa_numero . '</label>';
                        echo '<input type="text" readonly="readonly" value="' . number_format($value->valor, 2, ',', '.') . '" id="remessa" name="remessa[]" class="form-control">';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
            <div class="row">
                <?php
                if (empty($dados_sobra_cx)) {
                    echo '<div class="col-sm-12"><div class="form-group"><h1 class="text text-danger">Sem Sobra de Caixa nesse dia!!</h1></div></div>';
                    echo '<input type="hidden" value="0" id="sobra_cx" name="sobra_cx[]" class="form-control">';
                } else {
                    foreach ($dados_sobra_cx as $values) {
                        echo '<div class="col-sm-3">';
                        echo '<div class="form-group">';
                        echo '<label class="text text-sm">Sobras Caixa nº' . $values->caixa_operador . '</label>';
                        echo '<input type="text" value="' . number_format($values->total_sobra_cx, 2, ',', '.') . '" id="sobra_cx" name="sobra_cx[]" class="form-control">';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="text text-sm">Acumulado de Comissão</label>
                        <input type="text" id="acumulado_comissao" name="acumulado_comissao" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="text text-sm" for="comissao">Valor retirado das Sobras?</label>
                        <input type="text" id="comissao" name="comissao" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="text text-sm" for="pag_lot_fed">Pagamento Loteria Federal</label>
                        <input type="text" id="pag_lot_fed" name="pag_lot_fed" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="text text-sm" for="pag_telesena">Pagamento Tele-sena</label>
                        <input type="text" id="pag_telesena" name="pag_telesena" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="text text-sm" for="pag_outros">Outros</label>
                        <input type="text" id="pag_outros" name="pag_outros" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="text text-sm" for="obs_outros">Observação outros</label>
                        <input type="text" id="obs_outros" name="obs_outros" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-danger" id="fechacofre" type="submit">
                            <i class="fas fa-dollar-sign"></i>  Fechar Cofre
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>