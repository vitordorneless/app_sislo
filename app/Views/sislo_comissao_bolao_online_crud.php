<div class="card">
    <div class="card-header">
        <h3 class="card-title">Comissão Jogos - BOLÃO ONLINE!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_comissao_jogos_bolao_online_loterias" name="sislo_comissao_jogos_bolao_online_loterias" method="POST">
            <div class="row">                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Dia Inicial</label>
                        <input type="date" id="dia_inicial" name="dia_inicial" required="required" class="form-control">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                    </div>
                </div>                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Adicionar Linhas</label>
                        <a href="#" class="btn btn-info addline">
                            <i class="fas fa-adjust"></i>Clique Aqui!!
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
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
                            <th>Jogo</th>
                            <th>Cotas</th>
                            <th>Valor Bolão</th>
                            <th>Tarifa</th>
                            <th>Valor Tarifa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="theline">
                            <td>
                                <select id="id_sislo_jogos_cef" name="id_sislo_jogos_cef[]" class="form-control">
                                    <?php
                                    foreach ($jogos as $value) {
                                        echo '<option value="' . $value->idsislo_jogos_cef . '">' . $value->nome . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>                            
                            <td><input type="number" min="1" max="200" id="cotas" name="cotas[]" class="form-control"></td>
                            <td><input type="text" id="valor_bolao" name="valor_bolao[]" class="form-control"></td>
                            <td><input type="text" id="tarifa" name="tarifa[]" class="form-control"></td>
                            <td><input type="text" id="valor_tarifa" name="valor_tarifa[]" class="form-control"></td>
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