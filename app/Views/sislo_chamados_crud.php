<div class="card">
    <div class="card-header">
        <h3 class="card-title">Chamados de Tecnologia!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_chamados" name="sislo_chamados" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nº do chamado</label>
                        <input type="text" id="numero_chamado" required="required" name="numero_chamado" class="form-control" value="<?= $numero_chamado; ?>">
                        <input type="hidden" id="idsislo_chamados" name="idsislo_chamados" class="form-control" value="<?= $idsislo_chamados; ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" id="titulo_chamado" required="required" name="titulo_chamado" class="form-control" value="<?= $titulo_chamado; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="1" <?= $status == 1 ? 'selected' : ''; ?>>Concluído</option>
                            <option value="0" <?= $status == 0 ? 'selected' : ''; ?>>Para Fazer</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Conteúdo do chamado</label>
                        <textarea id="texto_chamado" required="required" name="texto_chamado" class="form-control" rows="3" placeholder="..."><?= $texto_chamado; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Conclusão do chamado</label>
                        <textarea id="conclusao_chamado" name="conclusao_chamado" class="form-control" rows="3" placeholder="..."><?= $conclusao_chamado; ?></textarea>
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