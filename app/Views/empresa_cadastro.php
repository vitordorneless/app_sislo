<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Lotérica Mel</title>
        <link href="<?php echo base_url('startbootstrap/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('AdminLTE/dist/img/favicon.ico'); ?>">
        <link href="<?= base_url('startbootstrap/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet">
        <link href="<?= base_url('startbootstrap/vendor/simple-line-icons/css/simple-line-icons.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?= base_url('startbootstrap/vendor/fontawesome-free/css/all.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?= base_url('startbootstrap/css/landing-page.min.css'); ?>" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-light bg-light static-top">
            <div class="container">
                <a class="navbar-brand" href="home">Sislô - Sistema de Gestão Lotérico</a>
                <a class="btn btn-primary" href="login">Acessar Sislô</a>
                <a class="btn btn-primary btn-warning" href="area_candidato">Área Candidato</a>
                <a class="btn btn-primary btn-warning" href="empresa_area">Área Empresa</a>
            </div>
        </nav>
        <section class="features-icons bg-light text-center">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cadastro Empresa Lotérica</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-group" id="sislo_empresa" name="sislo_empresa" method="POST">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Cód Lotérico</label>
                                        <input type="text" id="cod_loterico" name="cod_loterico" class="form-control" required="required"">                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Nome Fantasia</label>
                                        <input type="text" id="nome_fantasia" name="nome_fantasia" class="form-control" required="required"">
                                        <input type="hidden" id="incluir" value="<?= $incluir; ?>" name="incluir">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Razão Social</label>
                                        <input type="text" id="razao_social" name="razao_social" class="form-control" required="required"">                                        
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>CNPJ</label>
                                        <input type="text" id="cnpj" name="cnpj" class="form-control" required="required">
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Telefone Fixo</label>
                                        <input type="text" id="tel1" name="tel1" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Telefone Celular</label>
                                        <input type="text" id="tel2" name="tel2" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>WhatsApp</label>
                                        <input type="text" id="whatsapp" name="whatsapp" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="email" id="email" name="email" class="form-control" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>CEP</label>
                                        <input type="text" id="cep" name="cep" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Rua</label>
                                        <input type="text" id="endereco" name="endereco" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Número</label>
                                        <input type="text" id="numero" name="numero" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Complemento</label>
                                        <input type="text" id="complemento" name="complemento" class="form-control" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Bairro</label>
                                        <input type="text" id="bairro" name="bairro" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Cidade</label>
                                        <input type="text" id="cidade" name="cidade" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label>UF</label>
                                        <input type="text" id="uf" name="uf" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Telefone Celular</label>
                                        <input type="text" id="tel3" name="tel3" class="form-control" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button class="btn btn-danger" type="submit">
                                            <i class="fas fa-edit"></i>Inserir Dados
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer" id="conteudo"></div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                        <?php
                        $hj = new DateTime('now');
                        ?>
                        <p class="text-muted small mb-4 mb-lg-0">&copy; sislo.com.br <?= $hj->format('Y'); ?>. All Rights Reserved.</p>
                    </div>
                    <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item mr-3">
                                <a href="#">
                                    <i class="fab fa-facebook fa-2x fa-fw"></i>
                                </a>
                            </li>
                            <li class="list-inline-item mr-3">
                                <a href="#">
                                    <i class="fab fa-twitter-square fa-2x fa-fw"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="fab fa-instagram fa-2x fa-fw"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <script src="<?= base_url('startbootstrap/vendor/jquery/jquery.min.js'); ?>"></script>
        <script src="<?= base_url('startbootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
        <script src="<?= base_url('js/empresa_cadastro.js'); ?>"></script>
        <script src="<?= base_url('js/jquery.validate.js'); ?>"></script>
        <script src="<?= base_url('js/util.js'); ?>"></script>
        <script src="<?= base_url('js/sweetalert2.all.min.js'); ?>"></script>
    </body>
</html>