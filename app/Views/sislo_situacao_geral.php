<div class="card">
    <div class="card-header">
        <h3 class="card-title">Situação Geral</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <form class="form-inline" id="sislo_situacao_geral" method="POST">
                <?php
                $ano = $anos = date('Y');
                $mes = date('m');
                ?>
                <div class="form-group">
                    <label class="text text-sm">&nbsp;&nbsp;&nbsp;Mês: &nbsp;&nbsp;&nbsp;</label>
                    <select id="mes" name="mes" class="form-control">
                        <option value="0">Selecione...</option>
                        <option value="01" <?= $mes == '01' ? 'selected' : ''; ?>>Janeiro</option>
                        <option value="02" <?= $mes == '02' ? 'selected' : ''; ?>>Fevereiro</option>
                        <option value="03" <?= $mes == '03' ? 'selected' : ''; ?>>Março</option>
                        <option value="04" <?= $mes == '04' ? 'selected' : ''; ?>>Abril</option>
                        <option value="05" <?= $mes == '05' ? 'selected' : ''; ?>>Maio</option>
                        <option value="06" <?= $mes == '06' ? 'selected' : ''; ?>>Junho</option>
                        <option value="07" <?= $mes == '07' ? 'selected' : ''; ?>>Julho</option>
                        <option value="08" <?= $mes == '08' ? 'selected' : ''; ?>>Agosto</option>
                        <option value="09" <?= $mes == '09' ? 'selected' : ''; ?>>Setembro</option>
                        <option value="10" <?= $mes == '10' ? 'selected' : ''; ?>>Outubro</option>
                        <option value="11" <?= $mes == '11' ? 'selected' : ''; ?>>Novembro</option>
                        <option value="12" <?= $mes == '12' ? 'selected' : ''; ?>>Dezembro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="text text-sm">&nbsp;&nbsp;&nbsp;Ano: &nbsp;&nbsp;&nbsp;</label>
                    <select id="ano" name="ano" class="form-control">
                        <option value="0">Selecione...</option>
                        <option value="<?= $anos - 1 ?>" <?= ($ano - 1) == $anos ? 'selected' : ''; ?>><?= $anos - 1 ?></option>
                        <option value="<?= $anos ?>" <?= $ano == $anos ? 'selected' : ''; ?>><?= $anos ?></option>
                        <option value="<?= $anos + 1 ?>" <?= ($ano + 1) == $anos ? 'selected' : ''; ?>><?= $anos + 1 ?></option>
                        <option value="<?= $anos + 2 ?>" <?= ($ano + 2) == $anos ? 'selected' : ''; ?>><?= $anos + 2 ?></option>
                        <option value="<?= $anos + 3 ?>" <?= ($ano + 3) == $anos ? 'selected' : ''; ?>><?= $anos + 3 ?></option>
                        <option value="<?= $anos + 4 ?>" <?= ($ano + 4) == $anos ? 'selected' : ''; ?>><?= $anos + 4 ?></option>
                        <option value="<?= $anos + 5 ?>" <?= ($ano + 5) == $anos ? 'selected' : ''; ?>><?= $anos + 5 ?></option>
                    </select>
                </div>
                &nbsp;&nbsp;&nbsp;
                <div class="form-group">
                    <button class="btn btn-danger" id="btnform" type="submit">
                        <i class="fas fa-asterisk"></i>  Visualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card-footer" id="conteudo">
        <div class="row" id="antes"></div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-dark">
                    <div class="inner">
                        <h3 id="total_todos_jogos"></h3>
                        <p>Jogos + Bolão + SILCE + IBC + Federal</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-dark">
                    <div class="inner">
                        <h3 id="total_todos_nao_jogos"></h3>
                        <p>Não Jogos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-dark">
                    <div class="inner">
                        <h3 id="total_todos_deveres"></h3>
                        <p>Contas e Salários a Pagar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h5 id="total_todos_situacao"></h5>
                        <p>Situação Lotérica</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-green">
                    <div class="inner">
                        <h3 id="total_meta_nao_jogos"></h3>
                        <p>Meta Não Jogos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-green">
                    <div class="inner">
                        <h3 id="total_meta_jogos"></h3>
                        <p>Meta Jogos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-green">
                    <div class="inner">
                        <h3 id="total_todas_metas"></h3>
                        <p>Total de Metas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-green">
                    <div class="inner">
                        <h5 id="total_metas_atingido"></h5>
                        <p>% Atingido</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-blue">
                    <div class="inner">
                        <h3 id="nao_jogos"></h3>
                        <p>Não Jogos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-blue">
                    <div class="inner">
                        <h3 id="contas_pagar"></h3>
                        <p>Contas a Pagar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-blue">
                    <div class="inner">
                        <h3 id="salarios"></h3>
                        <p>Salários a Pagar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-blue">
                    <div class="inner">
                        <h3 id="caixas"></h3>
                        <p>Situação Caixas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="comissao_jogos"></h3>
                        <p>Jogos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="comissao_bolao"></h3>
                        <p>Bolão</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="comissao_jogos_silce"></h3>
                        <p>SILCE</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="comissao_jogos_ibc"></h3>
                        <p>IBC</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-lg-3 col-4">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="total_jogos"></h3>
                        <p>Total Jogos / Bolões</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <div class="col-lg-3 col-4">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="comissao_bilhete_federal"></h3>
                        <p>Total Bilhete Federal</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <div class="col-lg-6 col-4">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="total_silce"></h3>
                        <p>Total SILCE / IBC</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
            <div class="col-lg-6 col-4">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="premios_pagos"></h3>
                        <p>Total Prêmios Pagos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="row">
            <table id="table_sislo_situacao_jogos_geral" class="table table-striped table-bordered table-responsive text text-sm text-center">
                <thead>
                    <tr>
                        <th colspan="5">JOGOS</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Jogo</th>
                        <th>Quantidade</th>
                        <th>Valor</th>
                        <th>Comissão</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <table id="table_sislo_situacao_bolao_geral" class="table table-striped table-bordered table-responsive text text-sm text-center">
                <thead>
                    <tr>
                        <th colspan="5">BOLÃO</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Jogo</th>
                        <th>Cotas</th>
                        <th>Valor</th>
                        <th>Comissão</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <table id="table_sislo_situacao_jogos_silce_geral" class="table table-striped table-bordered table-responsive text text-sm text-center">
                <thead>
                    <tr>
                        <th colspan="4">JOGOS - SILCE</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Jogo</th>                        
                        <th>Valor Comissão</th>
                        <th>Comissão Total</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <table id="table_sislo_situacao_jogos_ibc_geral" class="table table-striped table-bordered table-responsive text text-sm text-center">
                <thead>
                    <tr>
                        <th colspan="4">JOGOS - IBC</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Jogo</th>                        
                        <th>Valor Comissão</th>
                        <th>Comissão Total</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            
            <table id="table_sislo_bilhete_federal" class="table table-striped table-bordered table-responsive text text-sm text-center">
                <thead>
                    <tr>
                        <th colspan="4">Bilhete Federal</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Extração</th>                        
                        <th>Valor Bruto</th>
                        <th>Comissão</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <table id="table_sislo_premios_pagos" class="table table-striped table-bordered table-responsive text text-sm text-center">
                <thead>
                    <tr>
                        <th colspan="4">Prêmios Pagos</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Jogo</th>                        
                        <th>Quantidade</th>
                        <th>R$ Total</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            
            <table id="table_sislo_nao_jogos" class="table table-striped table-bordered table-responsive text text-sm text-center">
                <thead>
                    <tr>
                        <th colspan="4">Não Jogos</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>                        
                        <th>Quantidade</th>
                        <th>R$ Total</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            
            <table id="table_sislo_contas_pagar" class="table table-striped table-bordered table-responsive text text-sm text-center">
                <thead>
                    <tr>
                        <th colspan="4">Contas para Pagar</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>                                                
                        <th>R$ Total</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            
            <table id="table_sislo_salarios" class="table table-striped table-bordered table-responsive text text-sm text-center">
                <thead>
                    <tr>
                        <th colspan="4">Salários</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>                                                
                        <th>CPF</th>                                                
                        <th>R$</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            
            <table id="table_sislo_caixas" class="table table-striped table-bordered table-responsive text text-sm text-center">
                <thead>
                    <tr>
                        <th colspan="4">Caixas</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>                                                                                                              
                        <th>R$</th>
                        <th>Situação</th>          
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>