<nav class="mt-2" style="font-size: 11px;">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-briefcase"></i>
                <p>
                    Super Admin
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('lotericas'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lotéricas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('planos_lotericas'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Planos Lotéricas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('chamados'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Chamados</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_teste'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Teste</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-brush"></i>
                        <p>
                            Suporte Sistema
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('tipos_convenio'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Decêndio - Tipo de Convênio</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('servicos_decendio'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Decêndio - Serviços</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('escolaridades'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Escolaridade</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('statusvaga'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Status Vagas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('statusvagacandidato'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Status Vagas Candidatos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('sislo_timemania_time_coracao'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Time do Coração</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('cors'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cor de Pele</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('estadocivils'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Estado Civil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('cargos'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cargo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('motivos'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Motivo Demissão</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('tipo_pec'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tipo de PEC</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('op_pec'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tipo de Operação - PEC</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('des_pec'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tipo de Destinação - PEC</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('ide_pec'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tipo de Identificador - PEC</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-briefcase"></i>
                <p>
                    Admin
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('sislo_usuarios'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Usuários</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_pec'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>PEC</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-clock"></i>
                <p>
                    Agendamento
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('sislo_agendamento'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Marcar Agendamento *</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_agendamento/exportar'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Exportar Agendamento *</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_agendamento/senha_externa'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Senha Externa *</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-barcode"></i>
                <p>
                    Financeiro
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('sislo_fornecedores'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fornecedores</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_contas_pagar'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Contas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_tipo_servico'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tipo Contas/Serviços</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_tipo_servico_interno'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tipo Serviços Internos *</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_cob_diaria_conta_servico'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cob. Diária Contas/Serviços</p>
                    </a>
                </li>                
                <li class="nav-item">
                    <a href="<?= base_url('sislo_decendio'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Decêndio</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_servicos_internos'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Serviços Internos *</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_saidas'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Saídas *</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_contacorrente'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Conta Corrente</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-film"></i>
                <p>
                    Loterias
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('sislo_jogos_cef'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Jogos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_mega_semana'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Mega-Semana</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_mega_sena'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Mega-Sena</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_dupla_sena'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dupla-Sena</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_quina'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Quina</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_supersete'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Super Sete</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_milionaria'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Milionária</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_timemania'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Timemania</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_diadesorte'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dia de Sorte</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_lotofacil'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lotofácil</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_lotomania'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lotomania</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-briefcase"></i>
                <p>
                    Gestão
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('sislo_tfl'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>TFL's</p>
                    </a>
                </li>                
                <li class="nav-item">
                    <a href="<?= base_url('sislo_sangrias'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sangrias</p>
                    </a>
                </li>                
                <li class="nav-item">
                    <a href="<?= base_url('sislo_fechamentos'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fechamento de Caixas</p>
                    </a>
                </li>                
                <li class="nav-item">
                    <a href="<?= base_url('sislo_fechamento_dia'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fechamento Cofre</p>
                    </a>
                </li>                                
                <li class="nav-item">
                    <a href="<?= base_url('sislo_loteria_federal'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Loteria Federal (Bilhete)</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_comissao_jogos'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Comissão Jogos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_comissao_jogosboloes'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Comissão BOLÃO</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_comissao_silce'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Comissão SILCE</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_comissao_ibc'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Comissão IBC</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_premios_pagos'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Prêmios Pagos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_metas_nao_jogos'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Meta Não Jogos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_metas_jogos'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Meta Jogos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_pec'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>PEC</p>
                    </a>
                </li>                
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-ambulance"></i>
                        <p>
                            Carro Forte
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('protege'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PROTEGE</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('protege_senha'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PROTEGE - Senha</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-circle"></i>
                        <p>
                            Estoque
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('sislo_item_estoque'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ítens</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('sislo_estoque'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Entrada</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('sislo_movimentacao_estoque'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Movimentação</p>
                            </a>
                        </li>
                    </ul>
                </li>                
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-certificate"></i>
                <p>
                    Indicadores
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('sislo_indicadores_caixas'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Caixa</p>
                    </a>
                </li>                
                <li class="nav-item">
                    <a href="<?= base_url('sislo_comissao_jogos_situacao'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Jogos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_comissao_jogos_situacao_geral'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Situação Jogos GERAL</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_situacao_geral'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Situação GERAL</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('situacao_boloes'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Bolões</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_decendio/situacao'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Situação Decêndio *</p>
                    </a>
                </li>                
                <li class="nav-item">
                    <a href="<?= base_url('sislo_cob_diaria_conta_servico/situacao_date'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Previsão Mensal - Por Datas *</p>
                    </a>
                </li>                
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-taxi"></i>
                <p>
                    Dep. Pessoal
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('sislo_funcionarios'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Funcionários</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_horas'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ponto Virtual</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('sislo_ajuste_horas'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ajuste de Ponto</p>
                    </a>
                </li>
                <!--<li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Contracheque *</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Benefícios *</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Férias *</p>
                    </a>
                </li>-->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-person-booth"></i>
                        <p>
                            Sislo RH
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('sislo_rh_vagas'); ?>" class="nav-link">
                                <i class="far fa-building nav-icon"></i>
                                <p>Vagas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('sislo_star'); ?>" class="nav-link">
                                <i class="far fa-star nav-icon"></i>
                                <p>Método Star</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</nav>