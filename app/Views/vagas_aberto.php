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
        <div class="login-logo">
            <a href="<?= base_url('home'); ?>"><b>Sis</b>lô</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Conecte-se para concorrer as vagas!</p>
                <table id="table_sislo_vaga" class="table table-responsive table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Empresa</th>
                            <th>Localização</th>
                            <th>Publicação</th>
                            <th>Data Limite</th>
                            <th>Dias Publicado</th>
                            <th>Cargo</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>        
        <script src="<?= base_url('AdminLTE/plugins/jquery/jquery.min.js'); ?>"></script>
        <script src="<?= base_url('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
        <script src="<?= base_url('AdminLTE/dist/js/adminlte.min.js'); ?>"></script>
        <script src="<?= base_url('AdminLTE/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?= base_url('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
        <script src="<?= base_url('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
        <script src="<?= base_url('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
        <script src="<?= base_url('AdminLTE/dist/js/demo.js'); ?>"></script>
        <script src="<?= base_url('js/vagas_aberto.js'); ?>"></script>
        <script src="<?= base_url('js/util.js'); ?>"></script>
    </body>
</html>