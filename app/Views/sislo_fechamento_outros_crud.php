<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liquidar Valores Outros</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_fechamento_outros" name="sislo_fechamento_outros" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <?php
                    $data_fech = new DateTime($data_fechamento);
                    ?>
                    <div class="form-group">
                        <label class="text text-sm">Data Fechamento</label>
                        <input type="date" id="data_fechamento" name="data_fechamento" readonly="readonly" class="form-control" value="<?= $data_fech->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-4">
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
                <div class="col-sm-4">
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
            </div>            
            <div class="row">                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Brinde (R$)</label>
                        <input type="text" id="total_brinde" name="total_brinde" readonly="readonly" class="form-control convert_money" value="<?= $total_brinde; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                        <input type="hidden" id="idsislo_fechamento_caixa" name="idsislo_fechamento_caixa" class="form-control" value="<?= $idsislo_fechamento_caixa; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Total PIX (R$)</label>
                        <input type="text" id="total_pix" name="total_pix" readonly="readonly" class="form-control convert_money" value="<?= $total_pix; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Outros / Cartão (R$)</label>
                        <input type="text" id="total_outros" name="total_outros" readonly="readonly" class="form-control convert_money" value="<?= $total_outros; ?>">
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="text text-sm">Obs. Brinde</label>
                        <input type="text" id="obs_brinde" name="obs_brinde" readonly="readonly" class="form-control" value="<?= $obs_brinde; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="text text-sm">Obs. Outros</label>
                        <input type="text" id="obs_outros" name="obs_outros" readonly="readonly" class="form-control" value="<?= $obs_outros; ?>">
                    </div>
                </div>
            </div>  
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Status Liquidação</label>
                        <select id="status_liquidacao" name="status_liquidacao" autofocus="autofocus" class="form-control">                            
                            <option value="0">Devedor</option>
                            <option value="1">Liquidado</option>                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-anchor"></i>  Liquidar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>