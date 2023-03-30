<div class="card">
    <div class="card-header">
        <h3 class="card-title">Contas a Pagar!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_contaapagar" method="POST">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Fornecedor</label>
                        <select id="id_sislo_fornecedores" name="id_sislo_fornecedores" autofocus="autofocus" class="form-control">
                            <?php
                            foreach ($fornecedores as $value) {
                                $select = $value->idsislo_fornecedores == $id_sislo_fornecedores ? 'selected' : '';
                                echo '<option value="' . $value->idsislo_fornecedores . '" ' . $select . ' >' . $value->nome . '</option>';                                
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Vencimento</label>
                        <?php
                        $venc = new DateTime($vencimento);
                        $data_pag = new DateTime($data_pagamento);
                        ?>
                        <input type="date" id="vencimento" name="vencimento" class="form-control" required="required" value="<?= $venc->format('Y-m-d'); ?>">
                        <input type="hidden" id="idsislo_contas_pagar" name="idsislo_contas_pagar" class="form-control" value="<?= $idsislo_contas_pagar; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Valor</label>
                        <input type="text" id="valor_pagar" name="valor_pagar" class="form-control convert_money" required="required" value="<?= $valor_pagar; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Descontos</label>
                        <input type="text" id="descontos" name="descontos" class="form-control convert_money" value="<?= $descontos; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Juros</label>
                        <input type="text" id="juros" name="juros" class="form-control convert_money" value="<?= $juros; ?>">
                    </div>
                </div>                
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Data Pagamento</label>
                        <input type="date" id="data_pagamento" name="data_pagamento" class="form-control" value="<?= $data_pag->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Referência</label>
                        <input type="text" required="required" id="referencia" name="referencia" placeholder="MM/YYYY" class="form-control" value="<?= $referencia; ?>">
                    </div>
                </div>                
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Status Pagamento</label>
                        <select id="status_pagamento" name="status_pagamento" class="form-control">
                            <option value="1" <?= $status_pagamento == '1' ? 'selected' : ''; ?>>Pago</option>
                            <option value="2" <?= $status_pagamento == '2' ? 'selected' : ''; ?>>Pagar</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tipo Pagamento</label>
                        <select id="tipo_pagamento" name="tipo_pagamento" class="form-control">
                            <option value="1" <?= $tipo_pagamento == '1' ? 'selected' : ''; ?>>Boleto Bancário</option>
                            <option value="2" <?= $tipo_pagamento == '2' ? 'selected' : ''; ?>>Depósito</option>
                            <option value="3" <?= $tipo_pagamento == '3' ? 'selected' : ''; ?>>PIX</option>
                            <option value="4" <?= $tipo_pagamento == '4' ? 'selected' : ''; ?>>Tributos</option>
                            <option value="5" <?= $tipo_pagamento == '5' ? 'selected' : ''; ?>>Convênios</option>
                            <option value="6" <?= $tipo_pagamento == '6' ? 'selected' : ''; ?>>Outros</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Forma Pagamento</label>
                        <select id="forma_pagamento" name="forma_pagamento" class="form-control">
                            <option value="1" <?= $forma_pagamento == '1' ? 'selected' : ''; ?>>Dinheiro</option>
                            <option value="2" <?= $forma_pagamento == '2' ? 'selected' : ''; ?>>Cheque</option>
                            <option value="3" <?= $forma_pagamento == '3' ? 'selected' : ''; ?>>Internet Banking</option>
                            <option value="4" <?= $forma_pagamento == '4' ? 'selected' : ''; ?>>Recursos Lotérica</option>
                            <option value="5" <?= $forma_pagamento == '5' ? 'selected' : ''; ?>>Terceiros</option>
                            <option value="6" <?= $forma_pagamento == '6' ? 'selected' : ''; ?>>043</option>
                        </select>
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