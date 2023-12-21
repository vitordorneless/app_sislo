<div class="card">
    <div class="card-header">
        <h3 class="card-title">Vagas Sislo - Parecer!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_vagas" name="sislo_vagas" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Cargo</label>
                        <input type="text" id="cargo" name="cargo" autofocus="autofocus" class="form-control" readonly="readonly" value="<?= $cargo; ?>">
                        <input type="hidden" id="cod_loterico" name="cod_loterico" class="form-control" value="<?= $cod_loterico; ?>">
                        <input type="hidden" id="id_sislo_vagas" name="id_sislo_vagas" class="form-control" value="<?= $id_sislo_vagas; ?>">
                    </div>
                </div>
                <?php
                $data_publi = new DateTime($data_publicacao);
                $data_limit = new DateTime($data_limite);
                ?>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Data Publicação</label>
                        <input type="date" id="data_publicacao" name="data_publicacao" readonly="readonly" class="form-control" value="<?= $data_publi->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Data Limite</label>
                        <input type="date" id="data_limite" name="data_limite" readonly="readonly" class="form-control" value="<?= $data_limit->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Status</label>
                        <select id="id_sislo_status_vaga" name="id_sislo_status_vaga" class="form-control" readonly="readonly">
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
                        <input type="text" id="salario" name="salario" class="form-control convert_money" readonly="readonly" value="<?= $salario; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Carga Horária</label>
                        <input type="text" id="carga_horaria" name="carga_horaria" class="form-control" readonly="readonly" value="<?= $carga_horaria; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Vaga Promovida?</label>
                        <input type="checkbox" class="form-control form-check-input" readonly="readonly" id="vaga_promovida">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Forma de Contratação</label>
                        <input type="text" id="forma_contratacao" name="forma_contratacao"readonly="readonly" class="form-control" value="<?= $forma_contratacao; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Requisitos</label>
                        <textarea id="requisitos" name="requisitos"
                                  readonly="readonly" class="form-control"
                                  rows="6" placeholder="Descreva os Requisitos para a vaga ..."><?= $requisitos; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Responsabilidades</label>
                        <textarea id="responsabilidades" name="responsabilidades"
                                  readonly="readonly" class="form-control"
                                  rows="6" placeholder="Descreva as Responsabilidades para a vaga ..."><?= $responsabilidades; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Diferenciais</label>
                        <textarea id="diferenciais" name="diferenciais"
                                  readonly="readonly" class="form-control" rows="6"
                                  placeholder="Descreva diferenciais para escolher o candidato perfeito ..."><?= $diferenciais; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Benefícios</label>
                        <textarea id="beneficios" name="beneficios"
                                  readonly="readonly" class="form-control" rows="6"
                                  placeholder="Descreva os benefícios oferecidos pela empresa ..."><?= $beneficios; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <table id="table_sislo_candidatos" class="table table-striped table-bordered table-responsive text text-sm text-center">
                    <thead>
                        <tr>
                            <th colspan="5">CANDIDATOS</th>
                        </tr>
                        <tr>
                            <th>Nome</th>
                            <th>Pontuação Método STAR</th>
                            <th>Parecer</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($candidatos as $value) {
                            $pontuacao = 0;
                            $pontuacao += $value->pontuacao_1;
                            $pontuacao += $value->pontuacao_2;
                            $pontuacao += $value->pontuacao_3;
                            $pontuacao += $value->pontuacao_4;
                            $pontuacao += $value->pontuacao_5;
                            echo '<tr>';
                            echo '<td>';
                            echo $value->nome_candidato;
                            echo '</td>';
                            echo '<td><strong>';
                            echo $pontuacao;
                            echo '</strong></td>';
                            echo '<td>';
                            echo $value->parecer_rh;
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>