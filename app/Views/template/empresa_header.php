<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SISLÔ | <?php echo $user_name; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= base_url('AdminLTE/plugins/fontawesome-free/css/all.min.css'); ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?= base_url('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url('AdminLTE/dist/css/adminlte.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('css/slick-theme.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('css/slick.css'); ?>">
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('AdminLTE/dist/img/favicon.ico'); ?>">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">                    
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-users"></i>  
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">                            
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('sair'); ?>" class="dropdown-item">
                                <i class="fas fa-users mr-1"></i> Sair
                            </a>
                            <div class="dropdown-divider"></div>                            
                        </div>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="<?= base_url('area_candidato_logado'); ?>" class="brand-link">
                    <img src="<?= base_url('AdminLTE/dist/img/logo_sislo.png'); ?>" alt="sislo Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Sislo Vagas</span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info">
                            <a href="<?= base_url('area_candidato_logado'); ?>" class="d-block">Empresa: <strong><?= $user_name ?></strong></a>                            
                        </div>                        
                    </div>
