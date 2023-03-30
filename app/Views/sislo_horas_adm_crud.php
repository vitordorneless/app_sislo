<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ajuste de Horas!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_ajuste_horas" name="sislo_ajuste_horas" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Data do Ponto</label>
                        <?php
                        $data_fech = new DateTime($data_ponto);
                        ?>
                        <input type="date" id="data_ponto" required="required" name="data_ponto" class="form-control" value="<?= $data_fech->format('Y-m-d'); ?>">
                        <input type="hidden" id="idsislo_horas" name="idsislo_horas" class="form-control" value="<?= $idsislo_horas; ?>">
                        <input type="hidden" id="id_sislo_funcionarios" name="id_sislo_funcionarios" class="form-control" value="<?= $id_sislo_funcionarios; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Entrada</label>
                        <input type="text" id="entrada" required="required" name="entrada" class="form-control" value="<?= $entrada; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Almoço</label>
                        <input type="text" id="ida_almoco" required="required" name="ida_almoco" class="form-control" value="<?= $ida_almoco; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Retorno</label>
                        <input type="text" id="volta_almoco" required="required" name="volta_almoco" class="form-control" value="<?= $volta_almoco; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Saída</label>
                        <input type="text" id="saida" required="required" name="saida" class="form-control" value="<?= $saida; ?>">
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