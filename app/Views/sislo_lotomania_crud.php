<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lotomania!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_lotomaniao" name="sislo_lotomaniao" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Concurso</label>
                        <input type="text" id="concurso" required="required" autofocus name="concurso" class="form-control" value="<?= $concurso; ?>">
                        <input type="hidden" id="idsislo_lotomania" name="idsislo_lotomania" class="form-control" value="<?= $idsislo_lotomania; ?>">
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
                        <input type="number" min="0" max="99" id="dez_01" required="required" name="dez_01" class="form-control" value="<?= $dez_01; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 02</label>
                        <input type="number" min="0" max="99" id="dez_02" required="required" name="dez_02" class="form-control" value="<?= $dez_02; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 03</label>
                        <input type="number" min="0" max="99" id="dez_03" required="required" name="dez_03" class="form-control" value="<?= $dez_03; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 04</label>
                        <input type="number" min="0" max="99" id="dez_04" required="required" name="dez_04" class="form-control" value="<?= $dez_04; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 05</label>
                        <input type="number" min="0" max="99" id="dez_05" required="required" name="dez_05" class="form-control" value="<?= $dez_05; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 06</label>
                        <input type="number" min="0" max="99" id="dez_06" required="required" name="dez_06" class="form-control" value="<?= $dez_06; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 07</label>
                        <input type="number" min="0" max="99" id="dez_07" required="required" name="dez_07" class="form-control" value="<?= $dez_07; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 08</label>
                        <input type="number" min="0" max="99" id="dez_08" required="required" name="dez_08" class="form-control" value="<?= $dez_08; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 09</label>
                        <input type="number" min="0" max="99" id="dez_09" required="required" name="dez_09" class="form-control" value="<?= $dez_09; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 10</label>
                        <input type="number" min="0" max="99" id="dez_10" required="required" name="dez_10" class="form-control" value="<?= $dez_10; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 11</label>
                        <input type="number" min="0" max="99" id="dez_11" required="required" name="dez_11" class="form-control" value="<?= $dez_11; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 12</label>
                        <input type="number" min="0" max="99" id="dez_12" required="required" name="dez_12" class="form-control" value="<?= $dez_12; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 13</label>
                        <input type="number" min="0" max="99" id="dez_13" required="required" name="dez_13" class="form-control" value="<?= $dez_13; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 14</label>
                        <input type="number" min="0" max="99" id="dez_14" required="required" name="dez_14" class="form-control" value="<?= $dez_14; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 15</label>
                        <input type="number" min="0" max="99" id="dez_15" required="required" name="dez_15" class="form-control" value="<?= $dez_15; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 16</label>
                        <input type="number" min="0" max="99" id="dez_16" required="required" name="dez_16" class="form-control" value="<?= $dez_16; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 17</label>
                        <input type="number" min="0" max="99" id="dez_17" required="required" name="dez_17" class="form-control" value="<?= $dez_17; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 18</label>
                        <input type="number" min="0" max="99" id="dez_18" required="required" name="dez_18" class="form-control" value="<?= $dez_18; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 19</label>
                        <input type="number" min="0" max="99" id="dez_19" required="required" name="dez_19" class="form-control" value="<?= $dez_19; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Dez. 20</label>
                        <input type="number" min="0" max="99" id="dez_20" required="required" name="dez_20" class="form-control" value="<?= $dez_20; ?>">
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