<div class="card">
    <div class="card-header">
        <h3 class="card-title">Comissão Jogos - BOLÃO!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_comissao_jogos_bolao_loterias" name="sislo_comissao_jogos_loterias" method="POST">
            <div class="row">                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Dia Inicial</label>
                        <?php
                        $d_inicial = new DateTime($dia_inicial);                        
                        ?>
                        <input type="date" id="dia_inicial" name="dia_inicial" required="required" class="form-control" value="<?= $d_inicial->format('Y-m-d'); ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                        <input type="hidden" id="idsislo_comissao_bolao" name="idsislo_comissao_bolao" class="form-control" value="<?= $idsislo_comissao_bolao; ?>">                        
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tarifa</label>
                        <input type="text" id="tarifa" name="tarifa" value="<?= $tarifa; ?>" class="form-control convert_money">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Valor Tarifa</label>
                        <input type="text" id="valor_tarifa" name="valor_tarifa" value="<?= $valor_tarifa; ?>" class="form-control convert_money">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Jogo</label>
                            <select id="id_sislo_jogos_cef" name="id_sislo_jogos_cef" class="form-control">
                                <?php
                                    foreach ($jogos as $value) {                                        
                                        $select = $value->idsislo_jogos_cef == $id_sislo_jogos_cef ? 'selected' : '';
                                        echo '<option value="' . $value->idsislo_jogos_cef . '" ' . $select . ' >' . $value->nome . '</option>';
                                    }
                                ?>
                            </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Cotas</label>
                            <input type="number" min="1" max="200" id="cotas" name="cotas" value="<?= $cotas; ?>" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Valor Bolão</label>
                        <input type="text" id="valor_bolao" name="valor_bolao" value="<?= $valor_bolao; ?>" class="form-control convert_money">
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