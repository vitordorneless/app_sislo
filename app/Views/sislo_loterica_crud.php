<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dados da Lotérica</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_lotericas" name="sislo_lotericas" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Razão Social</label>
                        <input type="text" id="razao_social" name="razao_social" class="form-control" required="required" value="<?= $razao_social; ?>">
                        <input type="hidden" id="idsislo_loterica" name="idsislo_loterica" class="form-control" value="<?= $idsislo_loterica; ?>">
                        <input type="hidden" id="incluir" value="<?= $incluir; ?>" name="incluir">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>CNPJ</label>
                        <input type="text" id="cnpj" name="cnpj" class="form-control" required="required" value="<?= $cnpj; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Código Lotérico</label>
                        <input type="text" id="cod_loterico" name="cod_loterico" class="form-control" required="required" value="<?= $cod_loterico; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nome Fantasia</label>
                        <input type="text" id="nome_fantasia" name="nome_fantasia" class="form-control" required="required" value="<?= $nome_fantasia; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>CEP</label>
                        <input type="text" id="cep" name="cep" class="form-control" required="required" value="<?= $cep; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <label>Rua</label>
                        <input type="text" id="logradouro" name="logradouro" class="form-control" required="required" value="<?= $logradouro; ?>">
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
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Complemento</label>
                        <input type="text" id="complemento" name="complemento" class="form-control" required="required" value="<?= $complemento; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" id="bairro" name="bairro" class="form-control" required="required" value="<?= $bairro; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" id="cidade" name="cidade" class="form-control" required="required" value="<?= $cidade; ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>UF</label>
                        <input type="text" id="uf" name="uf" class="form-control" required="required" value="<?= $uf; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" required="required" value="<?= $email; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Telefone Celular</label>
                        <input type="text" id="tel1" name="tel1" class="form-control" value="<?= $tel1; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Telefone Fixo</label>
                        <input type="text" id="tel2" name="tel2" class="form-control" value="<?= $tel2; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Contato</label>
                        <input type="text" id="tel3" name="tel3" class="form-control" value="<?= $tel3; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>WhatsApp</label>
                        <input type="text" id="whatsapp" name="whatsapp" class="form-control" value="<?= $whatsapp; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Agência</label>
                        <input type="text" id="agencia_cc" name="agencia_cc" class="form-control" value="<?= $agencia_cc; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Conta Corrente (003)</label>
                        <input type="text" id="conta_corrente" name="conta_corrente" class="form-control" value="<?= $conta_corrente; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Prestação (043)</label>
                        <input type="text" id="cc_prestacao" name="cc_prestacao" class="form-control" value="<?= $cc_prestacao; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Telefone Agência</label>
                        <input type="text" id="tel_agencia" name="tel_agencia" class="form-control" value="<?= $tel_agencia; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Proprietário (usuário TFL)</label>
                        <input type="text" id="proprietario_user" name="proprietario_user" class="form-control" value="<?= $proprietario_user; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Senha Proprietário</label>
                        <input type="text" id="proprietario_pass" name="proprietario_pass" class="form-control" value="<?= $proprietario_pass; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Login Expresso Parceiros</label>
                        <input type="text" id="expresso_login" name="expresso_login" class="form-control" value="<?= $expresso_login; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Senha Expresso Parceiros</label>
                        <input type="text" id="expresso_pass" name="expresso_pass" class="form-control" value="<?= $expresso_pass; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Código Convênio (Caixa Aqui)</label>
                        <input type="text" id="caixaaqui_cod" name="caixaaqui_cod" class="form-control" value="<?= $caixaaqui_cod; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Identificação Operador</label>
                        <input type="text" id="caixaaqui_codlot" name="caixaaqui_codlot" class="form-control" value="<?= $caixaaqui_codlot; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Senha do Operador</label>
                        <input type="text" id="caixaaqui_pass" name="caixaaqui_pass" class="form-control" value="<?= $caixaaqui_pass; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Status</label>
                        <select id="sislo_status" name="sislo_status" class="form-control">
                            <?php
                            $selected = $sislo_status == '1' ? 'selected' : '';
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