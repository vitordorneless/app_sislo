<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sislô | Logar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?= base_url('AdminLTE/plugins/fontawesome-free/css/all.min.css'); ?>">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?= base_url('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('AdminLTE/dist/css/adminlte.min.css'); ?>">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?= base_url('home'); ?>"><b>Sis</b>lô</a>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Conecte-se para ver as vagas!</p>
                    <form id="login_candidato_form" name="login_candidato_form" method="post">
                        <div class="input-group mb-3">                            
                            <input type="text" id="cod_loterico" name="cod_loterico" class="form-control" required="required" placeholder="Informe seu Código Lotérico">
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
                </div>
            </div>
        </div>
        <script src="<?= base_url('AdminLTE/plugins/jquery/jquery.min.js'); ?>"></script>
        <script src="<?= base_url('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
        <script src="<?= base_url('AdminLTE/dist/js/adminlte.min.js'); ?>"></script>
        <script src="<?= base_url('js/empresa_area.js'); ?>"></script>
        <script src="<?= base_url('js/util.js'); ?>"></script>
    </body>
</html>