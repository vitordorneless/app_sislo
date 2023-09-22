<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ver Vaga!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_ver_vagas" name="sislo_ver_vagas" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="text text-sm">Cargo</label>
                        <input type="text" id="cargo" name="cargo" class="form-control" value="<?= $cargo; ?>">
                        <input type="hidden" id="id_sislo_vagas" name="id_sislo_vagas" class="form-control" value="<?= $id_sislo_vagas; ?>">
                        <input type="hidden" id="candidato_cpf" name="candidato_cpf" class="form-control" value="<?= $candidato_cpf; ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                        <input type="hidden" id="id_sislo_candidato" name="id_sislo_candidato" class="form-control" value="<?= $id_sislo_candidato; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Localização</label>
                        <input type="text" id="cidade" name="cidade" class="form-control" readonly="readonly" value="<?= $cidade . '/' . $uf; ?>">
                    </div>
                </div>
                <?php
                $data_publi = new DateTime($data_publicacao);
                $data_limit = new DateTime($data_limite);
                ?>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Data Publicação</label>
                        <input type="date" id="data_publicacao" name="data_publicacao" readonly="readonly" class="form-control" value="<?= $data_publi->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Data Limite</label>
                        <input type="date" id="data_limite" name="data_limite" readonly="readonly" class="form-control" value="<?= $data_limit->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="text text-sm">Status</label>
                        <select id="id_sislo_status_vaga" name="id_sislo_status_vaga" readonly="readonly" class="form-control">
                            <option value="0">Selecione...</option>
                            <?php
                            foreach ($status as $value) {
                                $select = $value->id_sislo_status_vaga == $id_sislo_status_vaga ? 'selected' : '';
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
                        <input type="text" id="carga_horaria" name="carga_horaria" readonly="readonly" class="form-control" value="<?= $carga_horaria; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text text-sm">Forma de Contratação</label>
                        <input type="text" id="forma_contratacao" name="forma_contratacao" readonly="readonly" class="form-control" value="<?= $forma_contratacao; ?>">
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
            <?php            
            if ($aplicou == 0) {
                echo '<div class="row">';
                echo '<div class="col-sm-12">';
                echo '<div class="form-group">';
                echo '<button class="btn btn-danger" type="submit">';
                echo '<i class="fas fa-archive"></i>  Quero me Candidatar para esta Vaga!';
                echo '</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            } else {
                echo '<div class="row">';
                echo '<div class="col-sm-12">';
                echo '<div class="form-group">';
                echo '<label>Você já está concorrendo a esta Vaga!!</label>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>