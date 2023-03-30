<div class="card">
    <div class="card-header">
        <h3 class="card-title">Registro de Sangria Diária!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_sangria_crud" name="sislo_sangria_crud" method="POST">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Data Registro</label>
                        <?php
                        $data_fechamentos = new Datetime('now');
                        $data_coletas = new Datetime($data_coleta);
                        ?>
                        <input type="date" required="required" id="data_registro" name="data_registro" class="form-control" value="<?= $data_fechamentos->format('Y-m-d'); ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                        <input type="hidden" id="idsislo_sangria" name="idsislo_sangria" class="form-control" value="<?= $idsislo_sangria; ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Data Envio</label>
                        <input type="date" id="data_coleta" name="data_coleta" class="form-control" value="<?= $data_coletas->format('Y-m-d') ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Caixa Operador</label>
                        <select id="caixa_operador" name="caixa_operador" class="form-control">
                            <?php
                            foreach ($operadores as $value) {
                                $selected = $value->idsislo_funcionarios == $caixa_operador ? 'selected' : '';
                                echo '<option ' . $selected . ' value="' . $value->idsislo_funcionarios . '">' . $value->nome . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Caixa Nº</label>
                        <select id="idsislo_tfl" name="idsislo_tfl" class="form-control">
                            <?php
                            foreach ($tfls as $value) {
                                $selected = $value->idsislo_tfl == $idsislo_tfl ? 'selected' : '';
                                echo '<option ' . $selected . ' value="' . $value->idsislo_tfl . '">Caixa nº ' . $value->caixa_numero . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Numerário de R$ 2</label>
                        <input type="number" min="0" max="999999" id="numerario_02" name="numerario_02" class="form-control" value="<?= $numerario_02 ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Numerário de R$ 5</label>
                        <input type="number" min="0" max="999999" id="numerario_05" name="numerario_05" class="form-control" value="<?= $numerario_05 ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Numerário de R$ 10</label>
                        <input type="number" min="0" max="999999" id="numerario_10" name="numerario_10" class="form-control" value="<?= $numerario_10 ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Numerário de R$ 20</label>
                        <input type="number" min="0" max="999999" id="numerario_20" name="numerario_20" class="form-control" value="<?= $numerario_20 ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Numerário de R$ 50</label>
                        <input type="number" min="0" max="999999" id="numerario_50" name="numerario_50" class="form-control" value="<?= $numerario_50 ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Numerário de R$ 100</label>
                        <input type="number" min="0" max="999999" id="numerario_100" name="numerario_100" class="form-control" value="<?= $numerario_100 ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Numerário de R$ 200</label>
                        <input type="number" min="0" max="999999" id="numerario_200" name="numerario_200" class="form-control" value="<?= $numerario_200 ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Montante R$</label>
                        <input type="text" required="required" id="valor" name="valor" class="form-control convert_money" value="<?= $valor ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Número controle Caixa Operador</label>
                        <input type="text" required="required" id="num_controle" name="num_controle" class="form-control" value="<?= $num_controle ?>">
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