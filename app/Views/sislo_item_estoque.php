<div class="card">
    <div class="card-header">
        <h3 class="card-title">Itens Estoque Lotérico</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <a class="btn btn-primary" href="<?= base_url('redireciona_item_estoque/?id=0'); ?>">Incluir</a><br><br>
        </div>
        <table id="table_item_estoque" class="table table-responsive table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>                    
                    <th>Ítem</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>