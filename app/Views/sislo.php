<div class="card">
    <div class="card-header">
        <h6 class="card-title">Seja bem vindo!!</h6>
    </div>
    <div class="card-body">
        <div class="carousel">
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="text text-center">Jogos do Dia!!</h3>
                    </div>
                    <div class="panel-body">
                        <p class="text text-center text-sm">Hoje é: <?= $dia; ?></p>
                        <ul class="list-group text-sm">
                            <?php
                            foreach ($dados_jogos as $value) {
                                echo '<li class="list-group-item">' . $value->nome . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="text text-center">Próximas contas a vencer!!</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>Fornecedor</th>
                                    <th>Vencimento</th>
                                    <th>Valor R$</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dados_contas as $value) {
                                    $vencimento = new \DateTime($value->vencimento);
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $value->nome;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $vencimento->format('d/m/Y');
                                    echo '</td>';
                                    echo '<td class="text text-right">';
                                    echo number_format($value->valor_pagar, 2, ',', '.');
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>                        
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="text text-center">Mega-Semanas Especiais!!</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-responsive table-striped text text-sm">
                            <thead>
                                <tr>
                                    <th>Período</th>
                                    <th>Campanha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $hoje = new \DateTime('now');
                                foreach ($dados_mega_semana as $value) {
                                    $dia_01 = new \Datetime($value->dia_01);
                                    $dia_02 = new \Datetime($value->dia_02);
                                    $dia_03 = new \Datetime($value->dia_03);
                                    $sentenca = $dia_01->format('d/m') . ', ' . $dia_02->format('d/m') . ', ' . $dia_03->format('d/m/Y');
                                    if ($hoje->format('m') == $dia_02->format('m')) {
                                        $class = 'class="table-success"';
                                    } else {
                                        $class = '';
                                    }
                                    echo '<tr ' . $class . '>';
                                    echo '<td>';
                                    echo $sentenca;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $value->campanha;
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="text text-center">Organize-se!!</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item active">Geração de Relatórios de jogos e Financeiro</li>
                            <li class="list-group-item">Lançamento das Comissões dos Jogos</li>
                            <li class="list-group-item active">Lançamento das Sangrias</li>
                            <li class="list-group-item">Perto da hora de comunicar a CEF, feche o cofre pelo Sislô</li>
                            <li class="list-group-item active">Após enviar e-mail, cuide o carro forte!</li>
                            <li class="list-group-item">Lance o fechamento dos Caixas Operadores</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

