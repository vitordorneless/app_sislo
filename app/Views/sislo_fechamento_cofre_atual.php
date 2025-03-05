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
                        <input type="date" id="data_fechamento" name="data_fechamento" class="form-control" value="<?= $hoje->format('Y-m-d') ?>">
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
                <div class="col-sm-12">
                    <?php
                        if(empty($dados_remessas_analitico)){
                            echo '<div class="col-sm-12"><div class="form-group"><h1 class="text text-danger">Sem Sangrias nesse dia!!</h1></div></div>';
                        }else{
                            echo '<div class="table-responsive">';
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
                            echo '<tr>';
                            echo '<td>';
                            echo '';//aqui o tipo de nota
                            echo '</td>';
                            echo '<td>';
                            echo '';//aqui o total já somado
                            echo '</td>';
                            echo '<td>';
                            echo '';//aqui a contagem de notas
                            echo '</td>';
                            echo '</tr>';
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
                            <i class="fas fa-dollar-sign"></i>  Fechar Cofre
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>