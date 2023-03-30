<div class="card">
    <div class="card-header">
        <h3 class="card-title">Conta Corrente</h3>
    </div>
    <div class="card-body">        
        <div class="row">
            <form class="form-inline" id="list_contacorrente" method="POST">
                <?php
                $ano = $anos = date('Y');
                $mes = date('m');
                ?>
                <div class="form-group">
                    <label class="text text-sm">&nbsp;&nbsp;&nbsp;Mês: &nbsp;&nbsp;&nbsp;</label>
                    <select id="mes" name="mes" class="form-control">
                        <option value="0">Selecione...</option>
                        <option value="1" <?= $mes == '1' ? 'selected' : ''; ?>>Janeiro</option>
                        <option value="2" <?= $mes == '2' ? 'selected' : ''; ?>>Fevereiro</option>
                        <option value="3" <?= $mes == '3' ? 'selected' : ''; ?>>Março</option>
                        <option value="4" <?= $mes == '4' ? 'selected' : ''; ?>>Abril</option>
                        <option value="5" <?= $mes == '5' ? 'selected' : ''; ?>>Maio</option>
                        <option value="6" <?= $mes == '6' ? 'selected' : ''; ?>>Junho</option>
                        <option value="7" <?= $mes == '7' ? 'selected' : ''; ?>>Julho</option>
                        <option value="8" <?= $mes == '8' ? 'selected' : ''; ?>>Agosto</option>
                        <option value="9" <?= $mes == '9' ? 'selected' : ''; ?>>Setembro</option>
                        <option value="10" <?= $mes == '10' ? 'selected' : ''; ?>>Outubro</option>
                        <option value="11" <?= $mes == '11' ? 'selected' : ''; ?>>Novembro</option>
                        <option value="12" <?= $mes == '12' ? 'selected' : ''; ?>>Dezembro</option>
                    </select>
                </div>           
                <div class="form-group">
                    <label class="text text-sm">&nbsp;&nbsp;&nbsp;Ano: &nbsp;&nbsp;&nbsp;</label>
                    <select id="ano" name="ano" class="form-control">
                        <option value="0">Selecione...</option>
                        <option value="<?= $anos - 1 ?>" <?= ($ano - 1) == $anos ? 'selected' : ''; ?>><?= $anos - 1 ?></option>
                        <option value="<?= $anos ?>" <?= $ano == $anos ? 'selected' : ''; ?>><?= $anos ?></option>
                        <option value="<?= $anos + 1 ?>" <?= ($ano + 1) == $anos ? 'selected' : ''; ?>><?= $anos + 1 ?></option>
                        <option value="<?= $anos + 2 ?>" <?= ($ano + 2) == $anos ? 'selected' : ''; ?>><?= $anos + 2 ?></option>
                        <option value="<?= $anos + 3 ?>" <?= ($ano + 3) == $anos ? 'selected' : ''; ?>><?= $anos + 3 ?></option>
                        <option value="<?= $anos + 4 ?>" <?= ($ano + 4) == $anos ? 'selected' : ''; ?>><?= $anos + 4 ?></option>
                        <option value="<?= $anos + 5 ?>" <?= ($ano + 5) == $anos ? 'selected' : ''; ?>><?= $anos + 5 ?></option>
                    </select>
                </div>
                &nbsp;&nbsp;&nbsp;
                <div class="form-group">                        
                    <button class="btn btn-danger" id="btnform" type="submit">
                        <i class="fas fa-asterisk"></i>  Visualizar
                    </button>
                </div>                    
            </form>
        </div>        
    </div>
    <div class="card-footer" id="conteudo">
        <div class="row" id="antes"></div>
        <div class="row">
            <table id="table_sislo_contacorrente_list" name="table_sislo_contacorrente_list" class="table table-striped table-bordered table-responsive text text-sm text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código Lotérico</th>
                        <th>Referência</th>
                        <th>Data Transação</th>
                        <th>Origem</th>
                        <th>Valor (R$)</th>
                        <th>Crédito</th>
                        <th>Débito</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>