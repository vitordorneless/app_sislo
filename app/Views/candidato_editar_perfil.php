<div class="card">
    <div class="card-header">
        <h3 class="card-title">Seu Perfil - Edição</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_candidato" name="sislo_candidato" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" id="nome" name="nome" required="required" class="form-control" value="<?= $dados_candidato->nome; ?>">
                        <input type="hidden" id="id_sislo_candidato" name="id_sislo_candidato" value="<?= $dados_candidato->id_sislo_candidato; ?>">
                        <input type="hidden" id="incluir" name="incluir" value="2">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>CPF</label>
                        <input type="text" id="cpf" name="cpf" required="required" class="form-control" value="<?= $dados_candidato->cpf; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <?php
                    $dtnascimento = new DateTime($dados_candidato->nascimento);
                    ?>
                    <div class="form-group">
                        <label>Data Nascimento</label>
                        <input type="date" id="nascimento" value="<?= $dtnascimento->format('Y-m-d'); ?>" name="nascimento" class="form-control">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Sexo</label>
                        <select id="genero" name="genero" class="form-control" required="required">
                            <option value="1" <?= $dados_candidato->sexo == 1 ? 'selected' : ''; ?>>Masculino</option>
                            <option value="0" <?= $dados_candidato->sexo == 0 ? 'selected' : ''; ?>>Feminino</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Escolaridade</label>
                        <select id="id_escolaridade" name="id_escolaridade" class="form-control" required="required">
                            <?php
                            foreach ($id_escolaridade_list as $value) {
                                $selected = $value->id_sislo_escolaridade == $dados_candidato->escolaridade ? 'selected' : '';
                                echo '<option value="' . $value->id_sislo_escolaridade . ' ' . $selected . '">' . $value->escolaridade . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" id="email" value="<?= $dados_candidato->email; ?>" name="email" class="form-control" required="required">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Telefone Celular</label>
                        <input type="text" id="telefone" value="<?= $dados_candidato->telefone; ?>" name="telefone" class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>CEP</label>
                        <input type="text" id="cep" name="cep" class="form-control" value="<?= $dados_candidato->cep; ?>" required="required">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Rua</label>
                        <input type="text" id="endereco" name="endereco" value="<?= $dados_candidato->endereco; ?>" class="form-control" required="required">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Número</label>
                        <input type="text" id="numero" name="numero" value="<?= $dados_candidato->numero; ?>" class="form-control" required="required">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Complemento</label>
                        <input type="text" id="complemento" value="<?= $dados_candidato->complemento; ?>" name="complemento" class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" id="bairro" name="bairro" class="form-control" value="<?= $dados_candidato->bairro; ?>" required="required">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" id="cidade" name="cidade" class="form-control" value="<?= $dados_candidato->cidade; ?>" required="required">
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>UF</label>
                        <input type="text" id="uf" name="uf" class="form-control" value="<?= $dados_candidato->uf; ?>" required="required">
                    </div>
                </div>
                <div class="col-sm-3">
                    <br><br>
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