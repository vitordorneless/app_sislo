<div class="card">
    <div class="card-header">
        <h3 class="card-title">PEC</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_pecs" name="sislo_pecs" method="POST">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select id="id_sislo_tipo_pec" name="id_sislo_tipo_pec" autofocus="autofocus" class="form-control">
                            <?php
                            foreach ($tipo_pec as $value) {
                                $select = $value->idsislo_tipo_pec == $id_sislo_tipo_pec ? 'selected' : '';
                                echo '<option value="' . $value->idsislo_tipo_pec . '" ' . $select . ' >' . $value->tipo . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Opção de Entrada</label>
                        <select id="id_sislo_op_entrada" name="id_sislo_op_entrada" class="form-control">
                            <?php
                            foreach ($entrada as $value) {
                                $select = $value->idsislo_op_entrada == $id_sislo_op_entrada ? 'selected' : '';
                                echo '<option value="' . $value->idsislo_op_entrada . '" ' . $select . ' >' . $value->tipo . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Nome - Convênio</label>
                        <input type="text" id="nome_convenio" name="nome_convenio" class="form-control" required="required" value="<?= $nome_convenio; ?>">
                        <input type="hidden" id="idsislo_pec" name="idsislo_pec" class="form-control" value="<?= $idsislo_pec; ?>">
                        <input type="hidden" id="incluir" value="<?= $incluir; ?>" name="incluir">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Nº - Convênio</label>
                        <input type="text" id="convenio" name="convenio" class="form-control" required="required" value="<?= $convenio; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Destinação</label>
                        <select id="id_sislo_pec_destinacao" name="id_sislo_pec_destinacao" required="required" class="form-control">
                            <?php
                            foreach ($destinacao as $value) {
                                $select = $value->idsislo_pec_destinacao == $id_sislo_pec_destinacao ? 'selected' : '';
                                echo '<option value="' . $value->idsislo_pec_destinacao . '" ' . $select . ' >' . $value->tipo . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Identificador do Cliente:</label>
                        <select id="id_sislo_pec_identificador" name="id_sislo_pec_identificador" required="required" class="form-control">
                            <?php
                            foreach ($identificador as $value) {
                                $select = $value->idsislo_pec_identificador == $id_sislo_pec_identificador ? 'selected' : '';
                                echo '<option value="' . $value->idsislo_pec_identificador . '" ' . $select . ' >' . $value->tipo . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Vigência</label>
                        <input type="text" id="vigencia" name="vigencia" class="form-control" placeholder="<?= date('Y'); ?>" required="required" value="<?= $vigencia; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
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