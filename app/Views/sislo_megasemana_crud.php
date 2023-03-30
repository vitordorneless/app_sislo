<div class="card">
    <div class="card-header">
        <h3 class="card-title">Mega Semana CEF!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_megasemana" name="sislo_megasemana" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Campanha</label>
                        <input type="text" id="campanha" required="required" name="campanha" class="form-control" value="<?= $campanha; ?>">
                        <input type="hidden" id="idsislo_mega_semana" name="idsislo_mega_semana" class="form-control" value="<?= $idsislo_mega_semana; ?>">
                        <input type="hidden" id="incluir" name="incluir" class="form-control" value="<?= $incluir; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Ano Referencia</label>
                        <input type="text" id="ano_referencia" required="required" name="ano_referencia" class="form-control" value="<?= date('Y'); ?>">                        
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Jogo</label>
                        <select id="id_sislo_jogos_cef" name="id_sislo_jogos_cef" class="form-control">
                            <?php
                            foreach ($jogos as $value) {
                                $selected = $value->nome == 'MEGA-SENA' ? 'selected' : '';
                                echo '<option ' . $selected . ' value="' . $value->idsislo_jogos_cef . '">' . $value->nome . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="1" <?= $status == 1 ? 'selected' : ''; ?>>Ativo</option>
                            <option value="0" <?= $status == 0 ? 'selected' : ''; ?>>Inativo</option>
                        </select>
                    </div>
                </div>
            </div>
            <?php
            $datedia_01 = new DateTime($dia_01);
            $datedia_02 = new DateTime($dia_02);
            $datedia_03 = new DateTime($dia_03);
            ?>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Sorteio Terça</label>
                        <input type="date" id="dia_01" required="required" name="dia_01" class="form-control" value="<?= $datedia_01->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Sorteio Quinta</label>
                        <input type="date" id="dia_02" required="required" name="dia_02" class="form-control" value="<?= $datedia_02->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Sorteio Sábado</label>
                        <input type="date" id="dia_03" required="required" name="dia_03" class="form-control" value="<?= $datedia_03->format('Y-m-d'); ?>">
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