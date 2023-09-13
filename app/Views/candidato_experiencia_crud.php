<div class="card">
    <div class="card-header">
        <h3 class="card-title">Adicionar Experiência</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_experiencias" name="sislo_experiencias" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nome da Empresa</label>
                        <input type="text" id="nome_empresa" name="nome_empresa" class="form-control" required="required" value="<?= $nome_empresa; ?>">
                        <input type="hidden" id="cpf_sislo_candidato" name="cpf_sislo_candidato" class="form-control" value="<?= $cpf_sislo_candidato; ?>">
                        <input type="hidden" id="id_sislo_candidato_experiencia" name="id_sislo_candidato_experiencia" class="form-control" value="<?= $id_sislo_candidato_experiencia; ?>">
                        <input type="hidden" id="incluir" value="<?= $incluir; ?>" name="incluir">
                    </div>
                </div>
                <?php
                $data_iniciall = new DateTime($data_inicial);
                $data_finall = new DateTime($data_final);
                ?>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Data Inicial</label>
                        <input type="date" id="data_inicial" name="data_inicial" class="form-control" required="required" value="<?= $data_iniciall->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Data Final</label>
                        <input type="date" id="data_final" name="data_final" class="form-control" value="<?= $data_finall->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">                        
                        <label>Emprego Atual?</label>
                        <input type="checkbox" class="form-control form-check-input" id="emprego_atual">
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Cargo</label>
                        <input type="text" id="cargo" name="cargo" class="form-control" required="required" value="<?= $cargo; ?>">                        
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Funções</label>                        
                        <textarea id="funcoes" required="required" name="funcoes" class="form-control" rows="3" placeholder="Descreva suas funções e atividades ..."><?= $funcoes; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Status</label>
                        <select id="status" name="status" class="form-control">
                            <?php
                            $selected = $status == '1' ? 'selected' : '';
                            ?>
                            <option value="1" <?= $selected; ?>>Ativo</option>
                            <option value="0">Deletar / Apagar</option>
                        </select>

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