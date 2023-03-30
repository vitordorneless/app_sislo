<div class="card">
    <div class="card-header">
        <h3 class="card-title">Jogos CEF!</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <a href="<?= base_url('redireciona_jogoscef/?id=0'); ?>" class="btn btn-primary">Incluir Jogo CEF</a>
        </div>
        <div class="row">
            <table id="table_jogoscefs" class="table table-responsive table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Seg</th>
                        <th>Ter</th>
                        <th>Qua</th>
                        <th>Qui</th>
                        <th>Sex</th>
                        <th>Sab</th>
                        <th>Dom</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody class='text text-center'></tbody>
            </table>
        </div>        
    </div>    
</div>