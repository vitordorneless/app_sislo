<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tarifação de Contas e Serviços Financeiros - DECÊNDIO!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_decendio_servicos" name="sislo_decendio_servicos" method="POST">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Referência</label>
                        <input type="text" required="required" id="referencia" name="referencia" placeholder="MM/YYYY" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Caução</label>
                        <input type="text" id="valor_caucao" name="valor_caucao" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tributos Federais</label>
                        <input type="text" id="tributos_federais" name="tributos_federais" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Data Inicial</label>
                        <input type="date" id="data_inicial" name="data_inicial" class="form-control">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Data Final</label>
                        <input type="date" id="data_final" name="data_final" class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Adicionar Linhas</label>
                        <a href="#" class="btn btn-info addline">
                            <i class="fas fa-adjust"></i>Clique Aqui!!
                        </a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Remover Última Linha</label>
                        <a href="#" class="btn btn-danger addlineremove">
                            <i class="fas fa-adjust"></i>Clique Aqui!!
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <table id="dt_fechamento" class="table table-striped table-bordered table-responsive text text-sm text-center">
                    <thead>
                        <tr>
                            <th>Conta/Serviço</th>
                            <th>QTD</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="theline">
                            <td>
                                <select id="id_sislo_servicos_decendio" name="id_sislo_servicos_decendio[]" class="form-control">
                                    <?php
                                    foreach ($tipos as $value) {
                                        echo '<option value="' . $value->idsislo_servicos_decendio . '">' . $value->servico . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><input type="number" min="0" max="99999" id="quantidade" name="quantidade[]" class="form-control"></td>
                            <td><input type="text" id="valor_total" name="valor_total[]" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>
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