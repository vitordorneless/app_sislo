<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dia de Sorte!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_diadesortes" name="sislo_diadesortes" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Concurso</label>
                        <input type="text" id="concurso" required="required" autofocus name="concurso" class="form-control" value="<?= $concurso; ?>">
                        <input type="hidden" id="idsislo_diadesorte" name="idsislo_diadesorte" class="form-control" value="<?= $idsislo_diadesorte; ?>">
                        <input type="hidden" id="id_sislo_jogos_cef" name="id_sislo_jogos_cef" class="form-control" value="<?= $id_sislo_jogos_cef; ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                    </div>
                </div>
                <?php
                $datedia = new DateTime($data_concurso);
                ?>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Data Concurso</label>
                        <input type="date" id="data_concurso" required="required" name="data_concurso" class="form-control" value="<?= $datedia->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Saiu Ganhador</label>
                        <select id="saiu_ganhador" name="saiu_ganhador" class="form-control">
                            <option value="1" <?= $saiu_ganhador == 1 ? 'selected' : ''; ?>>Sim</option>
                            <option value="0" <?= $saiu_ganhador == 0 ? 'selected' : ''; ?>>Não</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 01</label>
                        <input type="number" min="01" max="31" id="dez_01" required="required" name="dez_01" class="form-control" value="<?= $dez_01; ?>">                        
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 02</label>
                        <input type="number" min="01" max="31" id="dez_02" required="required" name="dez_02" class="form-control" value="<?= $dez_02; ?>">                        
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 03</label>
                        <input type="number" min="01" max="31" id="dez_03" required="required" name="dez_03" class="form-control" value="<?= $dez_03; ?>">                        
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 04</label>
                        <input type="number" min="01" max="31" id="dez_04" required="required" name="dez_04" class="form-control" value="<?= $dez_04; ?>">                        
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 05</label>
                        <input type="number" min="01" max="31" id="dez_05" required="required" name="dez_05" class="form-control" value="<?= $dez_05; ?>">                        
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Dez. 06</label>
                        <input type="number" min="01" max="31" id="dez_06" required="required" name="dez_06" class="form-control" value="<?= $dez_06; ?>">                        
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Dez. 07</label>
                        <input type="number" min="01" max="31" id="dez_07" required="required" name="dez_07" class="form-control" value="<?= $dez_07; ?>">                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Mês da Sorte</label>
                        <select id="mes" name="mes" class="form-control">
                            <?php
                            $selected1 = $selected2 = $selected3 = $selected4 = $selected5 = $selected6 = $selected7 = $selected8 = $selected9 = $selected10 = $selected11 = $selected12 = '';

                            switch ($mes) {
                                case '1':
                                    $selected1 = 'selected';
                                    break;
                                case '2':
                                    $selected2 = 'selected';
                                    break;
                                case '3':
                                    $selected3 = 'selected';
                                    break;
                                case '4':
                                    $selected4 = 'selected';
                                    break;
                                case '5':
                                    $selected5 = 'selected';
                                    break;
                                case '6':
                                    $selected6 = 'selected';
                                    break;
                                case '7':
                                    $selected7 = 'selected';
                                    break;
                                case '8':
                                    $selected8 = 'selected';
                                    break;
                                case '9':
                                    $selected9 = 'selected';
                                    break;
                                case '10':
                                    $selected10 = 'selected';
                                    break;
                                case '11':
                                    $selected11 = 'selected';
                                    break;
                                case '12':
                                    $selected12 = 'selected';
                                    break;
                            }
                            ?>
                            <option value="1" <?= $selected1; ?>>Janeiro</option>
                            <option value="2" <?= $selected2; ?>>Fevereiro</option>
                            <option value="3" <?= $selected3; ?>>Março</option>
                            <option value="4" <?= $selected4; ?>>Abril</option>
                            <option value="5" <?= $selected5; ?>>Maio</option>
                            <option value="6" <?= $selected6; ?>>Junho</option>
                            <option value="7" <?= $selected7; ?>>Julho</option>
                            <option value="8" <?= $selected8; ?>>Agosto</option>
                            <option value="9" <?= $selected9; ?>>Setembro</option>
                            <option value="10" <?= $selected10; ?>>Outubro</option>
                            <option value="11" <?= $selected11; ?>>Novembro</option>
                            <option value="12" <?= $selected12; ?>>Dezembro</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Prêmio Atual (R$)</label>
                        <input type="text" id="premio_atual" name="premio_atual" class="form-control convert_money" required="required" value="<?= $premio_atual; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Prêmio Acumulado (R$)</label>
                        <input type="text" id="premio_acumulado" name="premio_acumulado" class="form-control convert_money" required="required" value="<?= $premio_acumulado; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Arrecadação Total (R$)</label>
                        <input type="text" id="arrecadacao_total" name="arrecadacao_total" class="form-control convert_money" required="required" value="<?= $arrecadacao_total; ?>">
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