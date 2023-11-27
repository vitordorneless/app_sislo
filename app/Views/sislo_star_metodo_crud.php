<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dados Pergunta Método Star</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_stars" name="sislo_stars" method="POST">
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <label>Pergunta</label>
                        <input type="text" id="pergunta" name="pergunta" class="form-control" required="required" value="<?= $pergunta; ?>">
                        <input type="hidden" id="id_sislo_star_metodo" name="id_sislo_star_metodo" class="form-control" value="<?= $id_sislo_star_metodo; ?>">
                        <input type="hidden" id="incluir" value="<?= $incluir; ?>" name="incluir">
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
                            <option value="0">Inativo</option>
                        </select>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <label>Resposta Nº 1</label>
                        <input type="text" id="resposta_1" name="resposta_1" class="form-control" required="required" value="<?= $resposta_1; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Pontuação Nº 1</label>
                        <input type="number" min="1" max="10" id="pontuacao_1" name="pontuacao_1" class="form-control" required="required" value="<?= $pontuacao_1; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <label>Resposta Nº 2</label>
                        <input type="text" id="resposta_2" name="resposta_2" class="form-control" required="required" value="<?= $resposta_2; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Pontuação Nº 2</label>
                        <input type="number" min="1" max="10" id="pontuacao_2" name="pontuacao_2" class="form-control" required="required" value="<?= $pontuacao_2; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <label>Resposta Nº 3</label>
                        <input type="text" id="resposta_3" name="resposta_3" class="form-control" required="required" value="<?= $resposta_3; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Pontuação Nº 3</label>
                        <input type="number" min="1" max="10" id="pontuacao_3" name="pontuacao_3" class="form-control" required="required" value="<?= $pontuacao_3; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <label>Resposta Nº 4</label>
                        <input type="text" id="resposta_4" name="resposta_4" class="form-control" required="required" value="<?= $resposta_4; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Pontuação Nº 4</label>
                        <input type="number" min="1" max="10" id="pontuacao_4" name="pontuacao_4" class="form-control" required="required" value="<?= $pontuacao_4; ?>">
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