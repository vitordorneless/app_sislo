<?php

namespace App\Controllers;

class Sislo_Notificacao extends BaseController {

    public function ajax_list_notificacao() {
        if ($this->request->isAJAX()) {
            $cod_loterico = $this->session->get('cod_lot');
            $sislo_notifications = new \App\Models\Sislo_NotificacaoModel;
            $notificacoes = $sislo_notifications->where('cod_loterico',
                            $cod_loterico)->where('status', 1)
                    ->orderBy('notificacao', 'asc')
                    ->findAll();

            $conta_notificacoes = 0;
            $fech_caixa = $comissao_bolao = $comissao_jogos = $comissao_silce = $comissao_ibc = $comissao_decendio = null;
            foreach ($notificacoes as $value) {
                switch ($value->notificacao) {
                    case 'Comissão de Jogos Inserida':
                        $comissao_jogos = $value->notificacao . ' - ' .
                                $this->formataValoresMonetarios($value->valor);
                        ++$conta_notificacoes;
                        break;
                    case 'Comissão de Decêndio Inserida':
                        $comissao_decendio = $value->notificacao . ' - ' .
                                $this->formataValoresMonetarios($value->valor);
                        ++$conta_notificacoes;
                        break;
                    case 'Comissão de IBC Inserida':
                        $comissao_ibc = $value->notificacao . ' - ' .
                                $this->formataValoresMonetarios($value->valor);
                        ++$conta_notificacoes;
                        break;
                    case 'Comissão de SILCE Inserida':
                        $comissao_silce = $value->notificacao . ' - ' .
                                $this->formataValoresMonetarios($value->valor);
                        ++$conta_notificacoes;
                        break;
                    case 'Fechamento de Caixa':
                        $fech_caixa = $value->notificacao . ' - ' .
                                $this->formataValoresMonetarios($value->valor);
                        ++$conta_notificacoes;
                        break;
                    case 'Comissão de Bolão Inserida':
                        $comissao_bolao = $value->notificacao . ' - ' .
                                $this->formataValoresMonetarios($value->valor);
                        ++$conta_notificacoes;
                        break;
                }
            }
            if ($conta_notificacoes == 0) {
                $notification = '<li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning
                            navbar-badge">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg
                        dropdown-menu-right">
                            <span class="dropdown-item
                            dropdown-header">Sem Notificações</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2">
                                </i> Sem Movimentação
                                <span class="float-right
                                text-muted text-sm">0</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" 
                        data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-users"></i>  
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">                            
                            <div class="dropdown-divider"></div>
                            <a href="' . base_url('sair');
                '" class="dropdown-item">
                                <i class="fas fa-users mr-1"></i> Sair do Sislo
                            </a>
                            <div class="dropdown-divider"></div>                            
                        </div>
                    </li>
                        </div>
                    </li>';
            } else {
                if (is_null($comissao_jogos)) {
                    $jogos = '';
                } else {
                    $jogos = '<a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> ' .
                            $comissao_jogos . '
                            </a>
                            <div class="dropdown-divider"></div>';
                }

                if (is_null($comissao_decendio)) {
                    $decendio = '';
                } else {
                    $decendio = '<a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> ' .
                            $comissao_decendio . '
                            </a>
                            <div class="dropdown-divider"></div>';
                }

                if (is_null($comissao_ibc)) {
                    $ibc = '';
                } else {
                    $ibc = '<a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> ' .
                            $comissao_ibc . '
                            </a>
                            <div class="dropdown-divider"></div>';
                }

                if (is_null($comissao_silce)) {
                    $silce = '';
                } else {
                    $silce = '<a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> ' .
                            $comissao_silce . '
                            </a>
                            <div class="dropdown-divider"></div>';
                }

                if (is_null($fech_caixa)) {
                    $caixa = '';
                } else {
                    $caixa = '<a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> ' .
                            $fech_caixa . '
                            </a>
                            <div class="dropdown-divider"></div>';
                }

                if (is_null($comissao_bolao)) {
                    $bolao = '';
                } else {
                    $bolao = '<a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> ' .
                            $comissao_bolao . '
                            </a>
                            <div class="dropdown-divider"></div>';
                }

                $notification = '<li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">' .
                        $conta_notificacoes . '</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg
                        dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">' .
                        $conta_notificacoes . ' Notificações</span>
                            <div class="dropdown-divider"></div>
                            ' . $jogos . $decendio . $ibc . $silce .
                        $caixa . $bolao . '
                        </div>
                        <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" 
                        data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-users"></i>  
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">                            
                            <div class="dropdown-divider"></div>
                            <a href="' . base_url('sair') . '" class="dropdown-item">
                                <i class="fas fa-users mr-1"></i> Sair do Sislo
                            </a>
                            <div class="dropdown-divider"></div>                            
                        </div>                    
                    </li>';
            }
            $sislo_notifications->set('status', 0);
            
            $sislo_notifications->where('cod_loterico', $cod_loterico)
                    ->where('status', 1);
            $sislo_notifications->update();
            echo $notification;
        } else {
            echo view('login');
        }
    }
}
