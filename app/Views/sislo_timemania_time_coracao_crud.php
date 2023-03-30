<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dados Cor de Pele</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_timemania_time_coracaos" name="sislo_timemania_time_coracaos" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" id="time_coracao" name="time_coracao" class="form-control" required="required" value="<?= $time_coracao; ?>">
                        <input type="hidden" id="idsislo_timemania_time_coracao" name="idsislo_timemania_time_coracao" class="form-control" value="<?= $idsislo_timemania_time_coracao; ?>">
                        <input type="hidden" id="incluir" value="<?= $incluir; ?>" name="incluir">
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