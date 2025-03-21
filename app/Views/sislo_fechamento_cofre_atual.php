<div class="card">
    <div class="card-header">
        <h3 class="card-title">Fechamento de Cofre - Diário!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_fechamento_cofre" name="sislo_fechamento_cofre" method="POST">
            <?php
            $hoje = new \Datetime('now');
            $soma_remessas = 0;
            ?>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm" for="data_fechamento">Data Fechamento</label>
                        <input type="date" readonly="readonly" id="data_fechamento" name="data_fechamento" class="form-control" value="<?= $hoje->format('Y-m-d') ?>">
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
                        $soma_remessas += $value->valor;
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
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm" for="data_fechamento">Total em Dinheiro</label>
                        <input type="text" readonly="readonly" id="total_dinheiro" name="total_dinheiro" class="form-control" value="<?= number_format($soma_remessas, 2, ',', '.') ?>">
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <label class="text text-sm" for="data_fechamento">Total em Dinheiro por Extenso</label>
                        <input type="text" readonly="readonly" id="total_dinheiro_extenso" name="total_dinheiro_extenso" class="form-control" value="<?= $porextenso ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    if (empty($dados_remessas_analitico)) {
                        echo '<div class="col-sm-12"><div class="form-group"><h1 class="text text-danger">Sem Sangrias nesse dia!!</h1></div></div>';
                    } else {
                        echo '<div class="table-responsive table-striped">';
                        echo '<table class="table table-bordered table-hover table-sm">';
                        echo '<caption>Relação dos tipos de notas</caption>';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th scope="col">Nota</th>';
                        echo '<th scope="col">Total</th>';
                        echo '<th scope="col">Total de Notas</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        foreach ($dados_remessas_analitico as $value) {
                            switch ($value) {
                                case !empty($value->numerario_02):
                                    echo '<tr>';
                                    echo '<td>';
                                    echo 'Nota de 2 Reais';
                                    echo '</td>';
                                    echo '<td>';
                                    echo 'R$ ' . number_format(bcmul($value->numerario_02, 2, 0), 2, ',', '.');
                                    echo '</td>';
                                    echo '<td>';
                                    echo bcdiv(bcmul($value->numerario_02, 2, 0), 2, 0);
                                    echo '</td>';
                                    echo '</tr>';
                                case !empty($value->numerario_05):
                                    echo '<tr>';
                                    echo '<td>';
                                    echo 'Nota de 5 Reais';
                                    echo '</td>';
                                    echo '<td>';
                                    echo 'R$ ' . number_format(bcmul($value->numerario_05, 5, 0), 2, ',', '.');
                                    echo '</td>';
                                    echo '<td>';
                                    echo bcdiv(bcmul($value->numerario_05, 5, 0), 5, 0);
                                    echo '</td>';
                                    echo '</tr>';
                                case !empty($value->numerario_10):
                                    echo '<tr>';
                                    echo '<td>';
                                    echo 'Nota de 10 Reais';
                                    echo '</td>';
                                    echo '<td>';
                                    echo 'R$ ' . number_format(bcmul($value->numerario_10, 10, 0), 2, ',', '.');
                                    echo '</td>';
                                    echo '<td>';
                                    echo bcdiv(bcmul($value->numerario_10, 10, 0), 10, 0);
                                    echo '</td>';
                                    echo '</tr>';
                                case !empty($value->numerario_20):
                                    echo '<tr>';
                                    echo '<td>';
                                    echo 'Nota de 20 Reais';
                                    echo '</td>';
                                    echo '<td>';
                                    echo 'R$ ' . number_format(bcmul($value->numerario_20, 20, 0), 2, ',', '.');
                                    echo '</td>';
                                    echo '<td>';
                                    echo bcdiv(bcmul($value->numerario_20, 20, 0), 20, 0);
                                    echo '</td>';
                                    echo '</tr>';
                                case !empty($value->numerario_50):
                                    echo '<tr>';
                                    echo '<td>';
                                    echo 'Nota de 50 Reais';
                                    echo '</td>';
                                    echo '<td>';
                                    echo 'R$ ' . number_format(bcmul($value->numerario_50, 50, 0), 2, ',', '.');
                                    echo '</td>';
                                    echo '<td>';
                                    echo bcdiv(bcmul($value->numerario_50, 50, 0), 50, 0);
                                    echo '</td>';
                                    echo '</tr>';
                                case !empty($value->numerario_100):
                                    echo '<tr>';
                                    echo '<td>';
                                    echo 'Nota de 100 Reais';
                                    echo '</td>';
                                    echo '<td>';
                                    echo 'R$ ' . number_format(bcmul($value->numerario_100, 100, 0), 2, ',', '.');
                                    echo '</td>';
                                    echo '<td>';
                                    echo bcdiv(bcmul($value->numerario_100, 100, 0), 100, 0);
                                    echo '</td>';
                                    echo '</tr>';
                                case !empty($value->numerario_200):
                                    echo '<tr>';
                                    echo '<td>';
                                    echo 'Nota de 200 Reais';
                                    echo '</td>';
                                    echo '<td>';
                                    echo 'R$ ' . number_format(bcmul($value->numerario_200, 200, 0), 2, ',', '.');
                                    echo '</td>';
                                    echo '<td>';
                                    echo bcdiv(bcmul($value->numerario_200, 200, 0), 200, 0);
                                    echo '</td>';
                                    echo '</tr>';
                            }
                        }

                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                    }

                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-danger" id="fechacofre" type="submit">
                            <i class="fas fa-dollar-sign"></i> Fechar Cofre
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>