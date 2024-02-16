<div class="card">
    <div class="card-header">
        <h3 class="card-title">Calculadora de BOLÃO</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <form class="form-inline" id="sislo_calculadora_bolao_list" method="POST">
                <div class="form-group">
                    <div class="form-group">
                        <label class="text text-sm">Data:&nbsp;&nbsp;&nbsp;</label>
                        <?php
                        $data_atual = new DateTime();
                        ?>
                        <input type="date" id="data_atual" name="data_atual" required="required" class="form-control" value="<?= $data_atual->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label class="text text-sm">&nbsp;&nbsp;&nbsp;Máximo de Cotas: &nbsp;&nbsp;&nbsp;</label>
                        <input type="number" min="1" max="100" id="cotas" name="cotas" class="form-control" value="4">
                    </div>
                </div>
                <div class="form-group">
                    <label class="text text-sm">&nbsp;&nbsp;&nbsp;Comissão Desejada (R$)&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" id="comissao_desejada" name="comissao_desejada" class="form-control convert_money">
                </div>
                &nbsp;&nbsp;&nbsp;
                <div class="form-group">
                    <button class="btn btn-danger" id="btnform" type="submit">
                        <i class="fas fa-calculator"></i>  Calcular
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card-footer" id="conteudo">
        <div class="row" id="antes"></div>
        <div class="row">
            <table id="table_sislo_calculadora_bolao_list" class="table table-striped table-bordered table-responsive text text-sm text-center">
                <thead>
                    <tr>
                        <th>Jogo</th>
                        <th>Cotas</th>
                        <th>%</th>
                        <th>Valor Cota</th>
                        <th>Valor Comissão</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>