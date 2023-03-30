<div class="card">
    <div class="card-header">
        <h3 class="card-title">Gerenciar Lotéricas</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <a class="btn btn-primary" href="<?= base_url('redireciona_loterica/?id=0'); ?>">Incluir</a><br><br>
        </div>
        <table id="table_sislo_lotericas" class="table table-responsive table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cód Lotérico</th>
                    <th>Nome</th>
                    <th>Cidade</th>
                    <th>UF</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>