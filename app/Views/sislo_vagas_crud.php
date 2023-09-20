<div class="card">
    <div class="card-header">
        <h3 class="card-title">Vagas Sislo!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_vagas" name="sislo_vagas" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Cargo</label>
                        <input type="text" id="cargo" name="cargo" autofocus="autofocus" class="form-control" required="required" value="<?= $cargo; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                        <input type="hidden" id="id_sislo_vagas" name="id_sislo_vagas" class="form-control" value="<?= $id_sislo_vagas; ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                    </div>
                </div>
                <?php
                if ($incluir == 1) {
                    $data_publi = new DateTime();
                    $data_limit = new DateTime();
                } else {
                    $data_publi = new DateTime($data_publicacao);
                    $data_limit = new DateTime($data_limite);
                }
                ?>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Data Publicação</label>
                        <input type="date" id="data_publicacao" name="data_publicacao" required="required" class="form-control" value="<?= $data_publi->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Data Limite</label>
                        <input type="date" id="data_limite" name="data_limite" required="required" class="form-control" value="<?= $data_limit->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Status</label>
                        <select id="id_sislo_status_vaga" name="id_sislo_status_vaga" class="form-control">
                            <option value="0">Selecione...</option>
                            <?php
                            foreach ($status as $value) {
                                if ($id_sislo_status_vaga == 0) {
                                    $select = $value->nome_status == 'Em Aberto' ? 'selected' : '';
                                } else {
                                    $select = $value->id_sislo_status_vaga == $id_sislo_status_vaga ? 'selected' : '';
                                }
                                echo '<option value="' . $value->id_sislo_status_vaga . '" ' . $select . ' >' . $value->nome_status . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Salário (R$)</label>
                        <input type="text" id="salario" name="salario" class="form-control convert_money" value="<?= $salario; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Carga Horária</label>
                        <input type="text" id="carga_horaria" name="carga_horaria" class="form-control" value="<?= $carga_horaria; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Vaga Promovida?</label>
                        <input type="checkbox" class="form-control form-check-input" id="vaga_promovida">

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Forma de Contratação</label>
                        <input type="text" id="forma_contratacao" name="forma_contratacao" class="form-control" value="<?= $forma_contratacao; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Requisitos</label>
                        <textarea id="requisitos" name="requisitos" 
                                  required="required" class="form-control" 
                                  rows="6" placeholder="Descreva os Requisitos para a vaga ..."><?= $requisitos; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Responsabilidades</label>
                        <textarea id="responsabilidades" name="responsabilidades" 
                                  required="required" class="form-control" 
                                  rows="6" placeholder="Descreva as Responsabilidades para a vaga ..."><?= $responsabilidades; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Diferenciais</label>
                        <textarea id="diferenciais" name="diferenciais" 
                                  required="required" class="form-control" rows="6" 
                                  placeholder="Descreva diferenciais para escolher o candidato perfeito ..."><?= $diferenciais; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Benefícios</label>
                        <textarea id="beneficios" name="beneficios" 
                                  required="required" class="form-control" rows="6" 
                                  placeholder="Descreva os benefícios oferecidos pela empresa ..."><?= $beneficios; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-archive"></i>  Publicar Vaga
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>