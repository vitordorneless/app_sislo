<div class="card">
    <div class="card-header">
        <h3 class="card-title">Sislo Chamados de Desenvolvimento!</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <a href="<?= base_url('redireciona_sislo_chamados/?id=0'); ?>" class="btn btn-primary">Incluir Chamado</a>
        </div>
        <div class="row">
            <table id="table_chamadoss" class="table table-responsive table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nº Chamado</th>
                        <th>Título</th>
                        <th>Conteúdo</th>
                        <th>Conclusão</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody class='text text-center'></tbody>
            </table>
        </div>        
    </div>    
</div>