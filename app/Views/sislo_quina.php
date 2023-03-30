<div class="card">
    <div class="card-header">
        <h3 class="card-title">Quina!</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <a href="<?= base_url('redireciona_quina/?id=0'); ?>" class="btn btn-primary">Incluir Quina</a>
        </div>
        <div class="row">
            <table id="table_quinas" class="table table-responsive table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Concurso</th>                        
                        <th>Dez. 01</th>
                        <th>Dez. 02</th>
                        <th>Dez. 03</th>
                        <th>Dez. 04</th>
                        <th>Dez. 05</th>                        
                        <th>Ganhador?</th>
                        <th>Prêmio Atual</th>
                        <th>Acumulado</th>                        
                        <th>Arrec. Total</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody class='text text-center'></tbody>
            </table>
        </div>        
    </div>    
</div>