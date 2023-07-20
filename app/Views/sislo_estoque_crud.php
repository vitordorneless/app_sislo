<div class="card">
    <div class="card-header">
        <h3 class="card-title">Estoque!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_estoques" name="sislo_estoques" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <?php
                    if ($incluir == 1) {
                        $data_fech = new DateTime();
                    } else {
                        $data_fech = new DateTime($data_entrada);
                    }
                    ?>
                    <div class="form-group">
                        <label class="text text-sm">Data Entrada</label>
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                        <input type="date" id="data_entrada" name="data_entrada" autofocus="autofocus" required="required" class="form-control" value="<?= $data_fech->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Ítem</label>
                        <select id="id_sislo_item_estoque" name="id_sislo_item_estoque" class="form-control">
                            <option value="0">Selecione...</option>
                            <?php
                            foreach ($itens as $value) {
                                $select = $value->id_sislo_item_estoque == $id_sislo_item_estoque ? 'selected' : '';
                                echo '<option value="' . $value->id_sislo_item_estoque . '" ' . $select . ' >Caixa ' . $value->item . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Quantidade</label>
                        <input type="number" min="1" max="9999999999999999" id="quantidade" name="quantidade" class="form-control" value="<?= $quantidade; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Status</label>                    
                        <select id="status" name="status" class="form-control">
                            <?php
                            $selected = $status == '1' ? 'selected' : '';
                            ?>
                            <option value="1" <?= $selected; ?>>Ativo</option>
                            <option value="0">Inativo</option>
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