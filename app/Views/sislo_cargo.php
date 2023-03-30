<div class="card">
    <div class="card-header">
        <h3 class="card-title">Gerenciar Cargo Funcionários</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <a class="btn btn-primary" href="<?= base_url('redireciona_cargo/?id=0'); ?>">Incluir</a><br><br>
        </div>
        <table id="table_sislo_cargos" class="table table-responsive table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cargo</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>