<div class="card">
    <div class="card-header">
        <h3 class="card-title">Sislo Ponto do Funcionário!</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <button class="btn btn-dark" id="entrada">
                        <i class="fas fa-angle-double-up"></i>  Entrada
                    </button>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <button class="btn btn-info" id="intervalo">
                        <i class="fas fa-angle-double-left"></i>  Intervalo
                    </button>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <button class="btn btn-dark" id="retorno">
                        <i class="fas fa-angle-double-right"></i>  Retorno
                    </button>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <button class="btn btn-danger" id="saida">
                        <i class="fas fa-angle-double-down"></i>  Saída
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table id="table_horass" class="table table-responsive table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Data</th>
                            <th>Entrada</th>
                            <th>Intervalo</th>
                            <th>Retorno</th>
                            <th>Saída</th>                            
                        </tr>
                    </thead>
                    <tbody class='text text-center'></tbody>
                </table>
            </div>
        </div>
    </div>
</div>