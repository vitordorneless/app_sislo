<div class="card">
    <div class="card-header">
        <h3 class="card-title">Senha Protege</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <form class="form-inline" id="sislo_protegesenha_list" method="POST">                
                <?php                    
                        $data_fech = new DateTime();                    
                    ?>
                    <div class="form-group">
                        <label class="text text-sm">Data</label>
                        <input type="date" id="data_senha" name="data_senha" autofocus="autofocus" required="required" class="form-control" value="<?= $data_fech->format('Y-m-d'); ?>">
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
            <table id="table_protegesenha_list" class="table table-striped table-bordered table-responsive text text-sm text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fixo</th>
                        <th>Dependência</th>
                        <th>Mês</th>
                        <th>Semana</th>
                        <th>Dia</th>
                        <th>Senha</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>