<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sislô | Logar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?= base_url('AdminLTE/plugins/fontawesome-free/css/all.min.css'); ?>">        
        <link rel="stylesheet" href="<?= base_url('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('AdminLTE/dist/css/adminlte.min.css'); ?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('startbootstrap/img/favicon.ico'); ?>">        
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?= base_url('home'); ?>"><b>Sis</b>lô</a>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Conecte-se para gerir sua Lotérica!</p>
                    <form id="login_form" name="login_form" method="post">
                        <div class="input-group mb-3">
                            <input type="text" id="cod_lot" name="cod_lot" class="form-control" required="required" placeholder="Código Lotérico" autofocus="autofocus">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>                            
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="username" name="username" class="form-control" required="required" placeholder="Usuário">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>                            
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="password" name="password" required="required" class="form-control" placeholder="Senha de acesso">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit" id="btn-login" class="btn btn-primary btn-block">Acessar</button>
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </form>
                    <p class="mb-1">
                        <br>
                        <a href="<?= base_url('recuperar_senha'); ?>">Esqueci minha senha</a>
                    </p>
                </div>
            </div>
        </div>
        <script src="<?= base_url('AdminLTE/plugins/jquery/jquery.min.js'); ?>"></script>
        <script src="<?= base_url('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
        <script src="<?= base_url('AdminLTE/dist/js/adminlte.min.js'); ?>"></script>
        <script src="<?= base_url('js/login.js'); ?>"></script>
        <script src="<?= base_url('js/util.js'); ?>"></script>
    </body>
</html>