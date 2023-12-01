<div class="card">
    <div class="card-header">
        <h3 class="card-title">Vagas Sislo - Entrevista!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_vagas" name="sislo_vagas" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Cargo</label>
                        <input type="text" id="cargo" name="cargo" class="form-control" disabled="disabled" value="<?= $cargo; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                        <input type="hidden" id="id_sislo_vaga" name="id_sislo_vaga" class="form-control" value="<?= $id_sislo_vaga; ?>">
                        <input type="hidden" id="id_sislo_candidato" name="id_sislo_candidato" class="form-control" value="<?= $id_sislo_candidato; ?>">
                    </div>
                </div>
                <?php
                $data_publi = new DateTime($data_publicacao);
                $data_limit = new DateTime($data_limite);
                ?>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Data Publicação</label>
                        <input type="date" id="data_publicacao" name="data_publicacao" disabled="disabled" class="form-control" value="<?= $data_publi->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Data Limite</label>
                        <input type="date" id="data_limite" name="data_limite" disabled="disabled" class="form-control" value="<?= $data_limit->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Status</label>
                        <select id="id_sislo_status_vaga" name="id_sislo_status_vaga" class="form-control" disabled="disabled">
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
                        <input type="text" id="salario" name="salario" class="form-control convert_money" disabled="disabled" value="<?= $salario; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Carga Horária</label>
                        <input type="text" id="carga_horaria" name="carga_horaria" class="form-control" disabled="disabled" value="<?= $carga_horaria; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Vaga Promovida?</label>
                        <input type="checkbox" class="form-control form-check-input" disabled="disabled" id="vaga_promovida">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Forma de Contratação</label>
                        <input type="text" id="forma_contratacao" name="forma_contratacao"disabled="disabled" class="form-control" value="<?= $forma_contratacao; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Requisitos</label>
                        <textarea id="requisitos" name="requisitos"
                                  disabled="disabled" class="form-control"
                                  rows="6" placeholder="Descreva os Requisitos para a vaga ..."><?= $requisitos; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Responsabilidades</label>
                        <textarea id="responsabilidades" name="responsabilidades"
                                  disabled="disabled" class="form-control"
                                  rows="6" placeholder="Descreva as Responsabilidades para a vaga ..."><?= $responsabilidades; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Diferenciais</label>
                        <textarea id="diferenciais" name="diferenciais"
                                  disabled="disabled" class="form-control" rows="6"
                                  placeholder="Descreva diferenciais para escolher o candidato perfeito ..."><?= $diferenciais; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Benefícios</label>
                        <textarea id="beneficios" name="beneficios"
                                  disabled="disabled" class="form-control" rows="6"
                                  placeholder="Descreva os benefícios oferecidos pela empresa ..."><?= $beneficios; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Data Entrevista</label>
                        <input type="date" id="data_entrevista" 
                               autofocus="autofocus"
                               name="data_entrevista" class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Hora Entrevista</label>
                        <input type="time" id="hora_entrevista"                                
                               name="hora_entrevista" class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Compareceu?</label>
                        <input type="checkbox" class="form-control form-check-input" id="compareceu">
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $conta_pergunta = 1;
                foreach ($perguntas as $value) {//botar o id_sislo_star_metodo
                    //botar os value com as pontuações
                    //botar dados do candidato
                    echo '<div class="col-sm-12">'; //1
                    echo '<div class="form-group">'; //2
                    echo '<label class="text text-sm">Pergunta Nº ' . $conta_pergunta . '</label>';
                    echo '<input type="text" id="pergunta" name="pergunta" '
                    . 'class="form-control" disabled="disabled" '
                    . 'value="' . $value->pergunta . '">';
                    echo '</div>'; //2
                    echo '<div class="form-group">';
                    echo '<div class="custom-control custom-radio">';
                    echo '<input class="custom-control-input" type="radio" id="resposta1_' . $conta_pergunta . '" name="resposta1_' . $conta_pergunta . '">';
                    echo '<label for="resposta1_' . $conta_pergunta . '" class="custom-control-label">' . trim($value->resposta_1) . '</label>';
                    echo '</div>';
                    echo '<div class="custom-control custom-radio">';
                    echo '<input class="custom-control-input" type="radio" id="resposta2_' . $conta_pergunta . '" name="resposta2_' . $conta_pergunta . '">';
                    echo '<label for="resposta2_' . $conta_pergunta . '" class="custom-control-label">' . trim($value->resposta_2) . '</label>';
                    echo '</div>';
                    echo '<div class="custom-control custom-radio">';
                    echo '<input class="custom-control-input" type="radio" id="resposta3_' . $conta_pergunta . '" name="resposta3_' . $conta_pergunta . '">';
                    echo '<label for="resposta3_' . $conta_pergunta . '" class="custom-control-label">' . trim($value->resposta_3) . '</label>';
                    echo '</div>';
                    echo '<div class="custom-control custom-radio">';
                    echo '<input class="custom-control-input" type="radio" id="resposta4_' . $conta_pergunta . '" name="resposta4_' . $conta_pergunta . '">';
                    echo '<label for="resposta4_' . $conta_pergunta . '" class="custom-control-label">' . trim($value->resposta_4) . '</label>';
                    echo '</div>';
                    echo '</div>';

                    echo '</div>'; //1
                    ++$conta_pergunta;
                }
                ?>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Parecer RH</label>
                        <textarea id="parecer_rh" name="parecer_rh"
                                  class="form-control" rows="12"
                                  placeholder="Descreva o parecer após a entrevista ...">                                      
                        </textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>