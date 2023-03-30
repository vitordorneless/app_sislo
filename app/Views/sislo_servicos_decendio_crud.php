<div class="card">
    <div class="card-header">
        <h3 class="card-title">Serviços Decêndio!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_dec_servicos" name="sislo_dec_servicos" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tipo de Serviço</label>
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                        <select id="id_sislo_tipo_servico" name="id_sislo_tipo_servico" class="form-control">
                            <?php
                            foreach ($tipos as $value) {
                                echo '<option value="' . $value->idsislo_tipo_servico . '">' . $value->servico . '</option>';
                            }
                            ?>
                        </select>
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
                            <th>Tipo de Convênio</th>
                            <th>Serviço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="theline">
                            <td>
                                <select id="id_sislo_servicos_decendio" name="id_sislo_servicos_decendio[]" class="form-control">
                                    <?php
                                    foreach ($servicos as $value) {
                                        echo '<option value="' . $value->idsislo_tipos_convenio . '">' . $value->convenio . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><input type="text" id="servico" name="servico[]" class="form-control"></td>
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