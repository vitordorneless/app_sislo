<div class="card">
    <div class="card-header">
        <h3 class="card-title">Incluir / Editar Colaborador(a)</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_colaboradores" name="sislo_colaboradores" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Código Lotérico</label>
                        <input type="text" id="cod_loterico" name="cod_loterico" class="form-control" required="required" value="<?= $cod_loterico; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Re-Emprego?</label>
                        <select id="reemprego" name="reemprego" class="form-control">
                            <?php
                            $selectedreemprego = $reemprego == '1' ? 'selected' : '';
                            ?>
                            <option value="1" <?= $selectedreemprego; ?>>Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nome do Colaborador(a)</label>
                        <input type="text" id="nome" name="nome" class="form-control" required="required" value="<?= $nome; ?>">
                        <input type="hidden" id="idsislo_funcionarios" name="idsislo_funcionarios" class="form-control" value="<?= $idsislo_funcionarios; ?>">
                        <input type="hidden" id="incluir" value="<?= $incluir; ?>" name="incluir">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>CPF</label>
                        <input type="text" id="cpf" name="cpf" class="form-control" required="required" value="<?= $cpf; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Sexo</label>
                        <select id="genero" name="genero" class="form-control">
                            <?php
                            $selected_genero = $genero == '1' ? 'selected' : '';
                            ?>
                            <option value="1" <?= $selected_genero; ?>>Masculino</option>
                            <option value="0">Feminino</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Data Nascimento</label>
                        <?php
                        $dtnascimento = new DateTime($nascimento);
                        $emissaorg = new DateTime($identidade_emissao);
                        $ctps_emissaoctps = new Datetime($ctps_emissao);
                        $cnh_emissaocnh = new DateTime($cnh_emissao);
                        $nascconjuges = new Datetime($nascimento_conjuge);
                        $nascimento_filho1s = new Datetime($nascimento_filho1);
                        $nascimento_filho2s = new Datetime($nascimento_filho2);
                        $nascimento_filho3s = new Datetime($nascimento_filho3);
                        $nascimento_filho4s = new Datetime($nascimento_filho4);
                        $admissaos = new Datetime($admissao);
                        $data_demissaos = new Datetime($data_demissao);
                        ?>
                        <input type="date" id="nascimento" name="nascimento" class="form-control" required="required" value="<?= $dtnascimento->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Local Nascimento</label>
                        <input type="text" id="local_nascimento" name="local_nascimento" class="form-control" required="required" value="<?= $local_nascimento; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>PIS</label>
                        <input type="text" id="pis" name="pis" class="form-control" required="required" value="<?= $pis; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>RG</label>
                        <input type="text" id="identidade" name="identidade" class="form-control" required="required" value="<?= $identidade; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Órgão Emissor</label>
                        <input type="text" id="orgao_emissor" name="orgao_emissor" class="form-control" required="required" value="<?= $orgao_emissor; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Data de Emissão</label>
                        <input type="date" id="identidade_emissao" name="identidade_emissao" class="form-control" required="required" value="<?= $emissaorg->format('Y-m-d'); ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nome da Mãe</label>
                        <input type="text" id="nome_mae" name="nome_mae" class="form-control" required="required" value="<?= $nome_mae; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nome do Pai</label>
                        <input type="text" id="nome_pai" name="nome_pai" class="form-control" value="<?= $nome_pai; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Carteira de Trabalho - CTPS</label>
                        <input type="text" id="ctps" name="ctps" class="form-control" required="required" value="<?= $ctps; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Série Carteira de Trabalho - CTPS</label>
                        <input type="text" id="serie" name="serie" class="form-control" required="required" value="<?= $serie; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Data de Emissão - CTPS</label>
                        <input type="date" id="ctps_emissao" name="ctps_emissao" class="form-control" required="required" value="<?= $ctps_emissaoctps->format('Y-m-d'); ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nº Título de Eleitor</label>
                        <input type="text" id="titulo_eleitor" name="titulo_eleitor" class="form-control" required="required" value="<?= $titulo_eleitor; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nº Zona</label>
                        <input type="text" id="zona" name="zona" class="form-control" required="required" value="<?= $zona; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nº Seção</label>
                        <input type="text" id="secao" name="secao" class="form-control" required="required" value="<?= $secao; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nº CNH</label>
                        <input type="text" id="cnh" name="cnh" class="form-control" value="<?= $cnh; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Emissão CNH</label>
                        <input type="date" id="cnh_emissao" name="cnh_emissao" class="form-control" value="<?= $cnh_emissaocnh->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Cor da Pele</label>
                        <select id="id_cor" name="id_cor" class="form-control">
                            <?php
                            foreach ($id_cor_list as $value) {
                                $selectid_cor = $value->id_sislo_cor == $id_cor ? 'selected' : '';
                                echo '<option value="' . $value->id_sislo_cor . '" ' . $selectid_cor . ' >' . $value->cor . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Escolaridade</label>
                        <select id="id_escolaridade" name="id_escolaridade" class="form-control">
                            <?php
                            foreach ($id_escolaridade_list as $value) {
                                $selectid_escolaridade = $value->id_sislo_escolaridade == $id_escolaridade ? 'selected' : '';
                                echo '<option value="' . $value->id_sislo_escolaridade . '" ' . $selectid_escolaridade . ' >' . $value->escolaridade . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?= $email; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>CEP</label>
                        <input type="text" id="cep" name="cep" class="form-control" required="required" value="<?= $cep; ?>">
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="form-group">
                        <label>Rua</label>
                        <input type="text" id="endereco" name="endereco" class="form-control" required="required" value="<?= $endereco; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Número</label>
                        <input type="text" id="numero" name="numero" class="form-control" required="required" value="<?= $numero; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" id="bairro" name="bairro" class="form-control" required="required" value="<?= $bairro; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" id="cidade" name="cidade" class="form-control" required="required" value="<?= $cidade; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>UF</label>
                        <input type="text" id="uf" name="uf" class="form-control" required="required" value="<?= $uf; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Telefone Fixo</label>
                        <input type="text" id="tel1" name="tel1" class="form-control" value="<?= $tel1; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Telefone Celular</label>
                        <input type="text" id="tel2" name="tel2" class="form-control" required="required" value="<?= $tel2; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Telefone Contato</label>
                        <input type="text" id="tel3" name="tel3" class="form-control" value="<?= $tel3; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Estado Civil</label>
                        <select id="id_estado_civil" name="id_estado_civil" class="form-control">
                            <?php
                            foreach ($id_estadocivil_list as $value) {
                                $selectid_estado_civil = $value->id_sislo_estadocivil == $id_estado_civil ? 'selected' : '';
                                echo '<option value="' . $value->id_sislo_estadocivil . '" ' . $selectid_estado_civil . ' >' . $value->estadocivil . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Nome Cônjuge</label>
                        <input type="text" id="nome_conjuge" name="nome_conjuge" class="form-control" value="<?= $nome_conjuge; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Nascimento</label>
                        <input type="date" id="nascimento_conjuge" name="nascimento_conjuge" class="form-control" value="<?= $nascconjuges->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>CPF Cônjuge</label>
                        <input type="text" id="cpf_conjuge" name="cpf_conjuge" maxlength="11" class="form-control" value="<?= $cpf_conjuge; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nome do Filho</label>
                        <input type="text" id="nome_filho1" name="nome_filho1" class="form-control" value="<?= $nome_filho1; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>CPF Filho</label>
                        <input type="text" id="cpf_filho1" name="cpf_filho1" maxlength="11" class="form-control" value="<?= $cpf_filho1; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nascimento Filho</label>
                        <input type="date" id="nascimento_filho1" name="nascimento_filho1" class="form-control" value="<?= $nascimento_filho1s->format('Y-m-d'); ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nome do Filho</label>
                        <input type="text" id="nome_filho2" name="nome_filho2" class="form-control" value="<?= $nome_filho2; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>CPF Filho</label>
                        <input type="text" id="cpf_filho2" name="cpf_filho2" maxlength="11" class="form-control" value="<?= $cpf_filho2; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nascimento Filho</label>
                        <input type="date" id="nascimento_filho2" name="nascimento_filho2" class="form-control" value="<?= $nascimento_filho2s->format('Y-m-d'); ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nome do Filho</label>
                        <input type="text" id="nome_filho3" name="nome_filho3" class="form-control" value="<?= $nome_filho3; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>CPF Filho</label>
                        <input type="text" id="cpf_filho3" name="cpf_filho3" maxlength="11" class="form-control" value="<?= $cpf_filho3; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nascimento Filho</label>
                        <input type="date" id="nascimento_filho3" name="nascimento_filho3" class="form-control" value="<?= $nascimento_filho3s->format('Y-m-d'); ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nome do Filho</label>
                        <input type="text" id="nome_filho4" name="nome_filho4" class="form-control" value="<?= $nome_filho4; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>CPF Filho</label>
                        <input type="text" id="cpf_filho4" name="cpf_filho4" maxlength="11" class="form-control" value="<?= $cpf_filho4; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nascimento Filho</label>
                        <input type="date" id="nascimento_filho4" name="nascimento_filho4" class="form-control" value="<?= $nascimento_filho4s->format('Y-m-d'); ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Optante Vale Transporte?</label>
                        <select id="optante_VT" name="optante_VT" class="form-control">
                            <?php
                            $selectedoptante_VT = $optante_VT == '1' ? 'selected' : '';
                            ?>
                            <option value="1" <?= $selectedoptante_VT; ?>>Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Nome da Linha</label>
                        <input type="text" id="linha1" name="linha1" required="required" class="form-control" value="<?= $linha1; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Valor da Linha</label>
                        <input type="text" id="valor_linha1" required="required" name="valor_linha1" class="form-control" value="<?= $valor_linha1; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Nome da Linha</label>
                        <input type="text" id="linha2" name="linha2" class="form-control" value="<?= $linha2; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Valor da Linha</label>
                        <input type="text" id="valor_linha2" name="valor_linha2" class="form-control" value="<?= $valor_linha2; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Nome da Linha</label>
                        <input type="text" id="linha3" name="linha3" class="form-control" value="<?= $linha3; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Valor da Linha</label>
                        <input type="text" id="valor_linha3" name="valor_linha3" class="form-control" value="<?= $valor_linha3; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Cargo</label>
                        <select id="id_cargo" name="id_cargo" class="form-control">
                            <?php
                            foreach ($id_cargo_list as $value) {
                                $selectid_cargo = $value->id_sislo_cargo == $id_cargo ? 'selected' : '';
                                echo '<option value="' . $value->id_sislo_cargo . '" ' . $selectid_cargo . ' >' . $value->cargo . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Admissão</label>
                        <input type="date" id="admissao" required="required" name="admissao" class="form-control" value="<?= $admissaos->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Demissão</label>
                        <input type="date" id="data_demissao" name="data_demissao" class="form-control" value="<?= $data_demissaos->format('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Motivo da Demissão</label>
                        <select id="id_motivo_demissao" name="id_motivo_demissao" class="form-control">
                            <option value="0">Escolher</option>
                            <?php
                            foreach ($motivo_demissao_list as $value) {
                                $selectid_motivo_demissao = $value->id_motivo_demissao == $id_motivo_demissao ? 'selected' : '';
                                echo '<option value="' . $value->id_motivo_demissao . '" ' . $selectid_motivo_demissao . ' >' . $value->motivo_demissao . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Salário Inicial</label>
                        <input type="text" id="salario" name="salario" class="form-control" required="required" value="<?= $salario; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Adicional</label>
                        <input type="text" id="adicional" name="adicional" class="form-control" value="<?= $adicional; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Insalubridade</label>
                        <input type="text" id="insalubridade" name="insalubridade" class="form-control" value="<?= $insalubridade; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Insalubridade (%)</label>
                        <input type="text" id="insalubridade_percent" name="insalubridade_percent" class="form-control" value="<?= $insalubridade_percent; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Entrada</label>
                        <input type="text" id="entrada" name="entrada" class="form-control" required="required" value="<?= $entrada; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Almoço</label>
                        <input type="text" id="almoco" required="required" name="almoco" class="form-control" value="<?= $almoco; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Volta do Almoço</label>
                        <input type="text" id="volta_almoco" required="required" name="volta_almoco" class="form-control" value="<?= $volta_almoco; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Saída</label>
                        <input type="text" id="saida" name="saida" required="required" class="form-control" value="<?= $saida; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Contrato de Experiência</label>
                        <select id="id_contrato_experiencia" name="id_contrato_experiencia" class="form-control">
                            <?php
                            $selectedid_contrato_experiencia = $id_contrato_experiencia == '1' ? 'selected' : '';
                            ?>
                            <option value="1" <?= $selectedid_contrato_experiencia; ?>>90 dias</option>
                            <option value="0">45 + 45 dias</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select id="status" name="status" class="form-control">
                            <?php
                            $selectedstatus = $status == '1' ? 'selected' : '';
                            ?>
                            <option value="1" <?= $selectedstatus; ?>>Ativo</option>
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