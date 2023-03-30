<div class="card">
    <div class="card-header">
        <h3 class="card-title">Sangrias de Caixa (Remessa)</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-inline">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?= base_url('redireciona_sangria/?id=0'); ?>">Incluir Sangria</a><br><br>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <form class="form-inline" id="sislo_sangria_list" method="POST">
                <?php
                $coleta = new Datetime('now');                
                ?>
                <div class="form-group">
                    <label class="text text-sm">&nbsp;&nbsp;&nbsp;Data de Coleta: &nbsp;&nbsp;&nbsp;</label>
                    <input type="date" id="coleta" required="required" name="coleta" class="form-control" value="<?= $coleta->format('Y-m-d'); ?>">
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
            <table id="table_sislo_sangria_list" class="table table-striped table-bordered table-responsive text text-sm text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Registro</th>
                        <th>Data Coleta</th>
                        <th>Operador</th>
                        <th>Caixa Nº</th>
                        <th>Nº Controle</th>
                        <th>Valor(R$)</th>                        
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>