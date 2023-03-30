<div class="card">
    <div class="card-header">
        <h3 class="card-title">Gerenciar Usuário!</h3>
    </div>
    <div class="card-body">
        <form class="form-group" id="sislo_usuarios" method="POST">
            <input type="hidden" id="sislo_usuarios_id" value="<?= $sislo_usuarios_id; ?>" name="sislo_usuarios_id">
            <input type="hidden" id="incluir" value="<?= $incluir; ?>" name="incluir">
            <div class="form-group">
                <label class="col-lg-2 control-label">Código Lotérico</label>
                <div class="col-lg-10">
                    <input type="text" id="sislo_id_loterica" value="<?= $sislo_id_loterica; ?>" name="sislo_id_loterica" class="form-control" maxlength="10" required="required" autofocus="autofocus">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Login</label>
                <div class="col-lg-10">
                    <input type="text" id="sislo_login" value="<?= $sislo_login; ?>" name="sislo_login" class="form-control" maxlength="30" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Nome</label>
                <div class="col-lg-10">
                    <input type="text" id="sislo_nome" value="<?= $sislo_nome; ?>" required="required" name="sislo_nome" class="form-control" maxlength="100">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Email</label>
                <div class="col-lg-10">
                    <input type="email" id="sislo_email" value="<?= $sislo_email; ?>" required="required" name="sislo_email" class="form-control" maxlength="100">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Senha</label>
                <div class="col-lg-10">
                    <input type="password" id="sislo_pass" value="<?= $sislo_pass; ?>" required="required" name="sislo_pass" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Status</label>
                <div class="col-lg-10">
                    <select id="sislo_status" name="sislo_status" class="form-control">
                        <?php
                        $selected = $sislo_status == '1' ? 'selected' : '';
                        ?>
                        <option value="1" <?= $selected; ?>>Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-edit"></i>Salvar / Atualizar Dados
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer" id="conteudo"></div>
</div>