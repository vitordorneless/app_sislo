<div class="card">
    <div class="card-header">
        <h3 class="card-title">Movimentar Estoque!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_movimentacao_estoques" name="sislo_movimentacao_estoques" method="POST">
            <div class="row">
                <div class="col-sm-4">                    
                    <div class="form-group">
                        <label class="text text-sm">Ítem</label>
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                        <input type="hidden" id="id_sislo_item_estoque" name="id_sislo_item_estoque" class="form-control" value="<?= $id_sislo_item_estoque; ?>">
                        <input type="text" id="item" name="Ítem" class="form-control" value="<?= $item[0]->item; ?>">
                    </div>
                </div>                
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Quantidade</label>
                        <input type="number" min="1" max="9999999999999999" id="quantidade_saida" name="quantidade_saida" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Caixa Operador</label>
                        <select id="id_sislo_tfl" name="id_sislo_tfl" class="form-control">
                            <option value="0">Selecione...</option>
                            <?php
                            foreach ($tfl_list as $value) {                                
                                echo '<option value="' . $value->idsislo_tfl . '">Caixa ' . $value->caixa_numero . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Uso Externo</label>                    
                        <select id="externo" name="externo" class="form-control">                            
                            <option value="1">Sim</option>
                            <option value="0" selected="selected">Não</option>
                        </select>                    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-archive"></i>  Atualizar Dados
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>