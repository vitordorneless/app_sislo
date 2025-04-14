<div class="card">
    <div class="card-header">
        <h3 class="card-title">Comissão Jogos</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_comissao_jogos_edit_loterias" name="sislo_comissao_jogos_edit_loterias" method="POST">
            <div class="row">                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Dia Inicial</label>
                        <?php
                        $d_inicial = new DateTime($dia_inicial);                        
                        ?>
                        <input type="date" id="dia_inicial" name="dia_inicial" required="required" class="form-control" value="<?= $d_inicial->format('Y-m-d'); ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                        <input type="hidden" id="idsislo_comissao_jogos" name="idsislo_comissao_jogos" class="form-control" value="<?= $idsislo_comissao_jogos; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Dia Final</label>
                        <?php
                        $d_final = new DateTime($dia_final);
                        ?>
                        <input type="date" id="dia_final" name="dia_final" required="required" class="form-control" value="<?= $d_final->format('Y-m-d'); ?>">                        
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Referência</label>
                        <input type="text" required="required" id="referencia" name="referencia" placeholder="MM/YYYY" class="form-control" autofocus="autofocus">
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
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Concurso</label>
                            <input type="text" id="concurso" name="concurso" value="<?= $concurso; ?>" class="form-control">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Quantidade</label>
                            <input type="number" min="0" max="99999" id="quantidade" name="quantidade" value="<?= $quantidade; ?>" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Valor</label>
                        <input type="text" id="valor" name="valor" value="<?= $valor; ?>" class="form-control convert_money">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Comissão</label>
                        <input type="text" id="comissao" name="comissao" value="<?= $comissao; ?>" class="form-control convert_money">
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