<?php

namespace App\Controllers;

class Sislo_ComissaoJogos extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_comissao_jogos.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_comissao_jogos', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function sislo_comissao_jogos_situacao() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_comissao_jogos_situacao.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_comissao_jogos_situacao', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function sislo_comissao_jogos_situacao_geral() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_comissao_jogos_situacao_geral.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_comissao_jogos_situacao_geral', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function redireciona_comissao_jogos() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_jogos = new \App\Models\SisloJogosCefModel;
            $jogos = $sislo_jogos->where('status', 1)->orderBy('nome', 'asc')->findAll();
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['cod_loterico'] = $this->session->get('cod_lot');

                $data = array(
                    "scripts" => array(
                        "sislo_comissao_jogos_crud.js",
                        "sweetalert2.all.min.js",
                        "jquery.validate.js",
                        "jquery.mask.min.js",
                        "jquery.maskMoney.min.js",
                        "util.js"
                    ),
                    "user_name" => $dadosuser->sislo_nome,
                    "jogos" => $jogos,
                    "cod_loterico" => $this->session->get('cod_lot'),
                    "incluir" => $incluir
                );

                echo view('template/header', $data);
                echo view('template/menu');
                echo view('template/content');
                echo view('sislo_comissao_jogos_crud', $data);
                echo view('template/footer', $data);
                echo view('template/scripts', $data);
            } else {
                $incluir = 2;
            }
        } else {
            echo view('login');
        }
    }

    public function carrega_comissoes() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_comissao_jogos as scs');
        $query = $builder->select("scs.idsislo_comissao_jogos as idsislo_comissao_jogos,"
                        . "sts.nome as nome, scs.percent_comissao as percent_comissao,"
                        . "scs.concurso as concurso, scs.quantidade as quantidade,scs.valor as valor, "
                        . "scs.comissao as comissao, scs.dia_inicial as dia_inicial, "
                        . "scs.dia_final as dia_final")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")
                ->where("scs.referencia", $referencia)
                ->where("scs.cod_loterico", $cod_lot)
                ->orderBy('scs.dia_inicial', 'ASC')
                ->get();
        return $query;
    }

    public function carrega_ajax_table_sislo_situacao_jogos() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_comissao_jogos as scs');
        $query = $builder->select("sts.nome as nome, SUM(scs.quantidade) as quantidade, SUM(scs.valor) as valor, SUM(scs.comissao) as comissao")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")
                ->where("scs.referencia", $referencia)
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->groupBy("scs.id_sislo_jogos_cef")
                ->orderBy('scs.comissao', 'DESC')
                ->get();
        return $query;
    }

    public function carrega_ajax_table_sislo_situacao_bolao() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $builder = $db->table('sislo_comissao_bolao as scs');
        $query = $builder->select("sts.nome as nome, SUM(scs.cotas) as cotas, SUM(scs.valor_bolao) as valor_bolao, SUM(scs.valor_tarifa) as valor_tarifa")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")
                ->where('MONTH(scs.dia_inicial)', $this->request->getPost('mes'))
                ->where('YEAR(scs.dia_inicial)', $this->request->getPost('ano'))
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->groupBy("scs.id_sislo_jogos_cef")
                ->orderBy('scs.valor_tarifa', 'DESC')
                ->get();
        return $query;
    }

    public function ajax_table_sislo_situacao_jogos() {
        if ($this->request->isAJAX()) {
            $sislo_comissao = $this->carrega_ajax_table_sislo_situacao_jogos()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_comissao as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->nome;
                $row[] = trim($value->quantidade);
                $row[] = $this->formataValoresMonetarios($value->valor);
                $row[] = $this->formataValoresMonetarios($value->comissao);
                ++$tt;
                ++$tb;
                $data[] = $row;
            }
            $json = array(
                "recordsTotal" => $tb,
                "recordsFiltered" => $tb,
                "data" => $data
            );
            echo json_encode($json);
        } else {
            echo view('login');
        }
    }

    public function carrega_comissoes_silce() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_comissao_silce as scs');
        $query = $builder->select("sts.nome as nome, SUM(scs.comissao_total) as comissao_total, SUM(scs.comissao) as comissao")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")
                ->where("scs.referencia", $referencia)
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->groupBy("scs.id_sislo_jogos_cef")
                ->orderBy('scs.comissao_total', 'DESC')
                ->get();
        return $query;
    }

    public function carrega_comissoes_ibc() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_comissao_ibc as scs');
        $query = $builder->select("sts.nome as nome, SUM(scs.comissao_total) as comissao_total, SUM(scs.comissao) as comissao")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")
                ->where("scs.referencia", $referencia)
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->groupBy("scs.id_sislo_jogos_cef")
                ->orderBy('scs.comissao_total', 'DESC')
                ->get();
        return $query;
    }

    public function carrega_premios_pagos() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_premios_pagos as scs');
        $query = $builder->select("sts.nome as nome, SUM(scs.valor) as valor, scs.quantidade AS quantidade")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")
                ->where("scs.referencia", $referencia)
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->groupBy("scs.id_sislo_jogos_cef")
                ->orderBy('scs.valor', 'DESC')
                ->get();
        return $query;
    }

    public function ajax_table_sislo_situacao_jogos_geral() {
        //refatorar, transformar esses foreachs em outras funções para diminuir tamanho do código
        if ($this->request->isAJAX()) {
            $sislo_comissao = $this->carrega_ajax_table_sislo_situacao_jogos()->getResult();
            $sislo_comissao_bolao = $this->carrega_ajax_table_sislo_situacao_bolao()->getResult();
            $sislo_comissao_silce = $this->carrega_comissoes_silce()->getResult();
            $sislo_comissao_ibc = $this->carrega_comissoes_ibc()->getResult();
            $sislo_premios_pagos = $this->carrega_premios_pagos()->getResult();
            $data = $data_silce = $data_ibc = $data_bolao = $data_premios_pagos = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            $comissao_jogos = $comissao_jogos_silce = $comissao_jogos_ibc = $comissao_jogos_bolao = $premios_pagos = 0;
            foreach ($sislo_comissao as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->nome;
                $row[] = trim($value->quantidade);
                $row[] = $this->formataValoresMonetarios($value->valor);
                $row[] = $this->formataValoresMonetarios($value->comissao);
                ++$tt;
                ++$tb;
                $comissao_jogos = bcadd($comissao_jogos, $value->comissao, 2);
                $data[] = $row;
            }

            foreach ($sislo_premios_pagos as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->nome;
                $row[] = trim($value->quantidade);
                $row[] = $this->formataValoresMonetarios($value->valor);
                ++$tt;
                ++$tb;
                $premios_pagos = bcadd($premios_pagos, $value->valor, 2);
                $data_premios_pagos[] = $row;
            }

            foreach ($sislo_comissao_bolao as $value) {
                $row_bolao = array();
                $row_bolao[] = $tt;
                $row_bolao[] = $value->nome;
                $row_bolao[] = trim($value->cotas);
                $row_bolao[] = $this->formataValoresMonetarios($value->valor_bolao);
                $row_bolao[] = $this->formataValoresMonetarios($value->valor_tarifa);
                ++$tt;
                ++$tb;
                $comissao_jogos_bolao = bcadd($comissao_jogos_bolao, $value->valor_tarifa, 2);
                $data_bolao[] = $row_bolao;
            }

            foreach ($sislo_comissao_silce as $value) {
                $row_silce = array();
                $row_silce[] = $tt;
                $row_silce[] = $value->nome;
                $row_silce[] = $this->formataValoresMonetarios($value->comissao);
                $row_silce[] = $this->formataValoresMonetarios($value->comissao_total);
                ++$tt;
                ++$tb;
                $comissao_jogos_silce = bcadd($comissao_jogos_silce, $value->comissao, 2);
                $data_silce[] = $row_silce;
            }

            foreach ($sislo_comissao_ibc as $value) {
                $row_ibc = array();
                $row_ibc[] = $tt;
                $row_ibc[] = $value->nome;
                $row_ibc[] = $this->formataValoresMonetarios($value->comissao);
                $row_ibc[] = $this->formataValoresMonetarios($value->comissao_total);
                ++$tt;
                ++$tb;
                $comissao_jogos_ibc = bcadd($comissao_jogos_ibc, $value->comissao, 2);
                $data_ibc[] = $row_ibc;
            }

            $json = array(
                "recordsTotal" => $tb,
                "recordsFiltered" => $tb,
                "comissao_jogos" => 'R$ ' . $this->formataValoresMonetarios($comissao_jogos),
                "comissao_bolao" => 'R$ ' . $this->formataValoresMonetarios($comissao_jogos_bolao),
                "total_jogos" => 'R$ ' . $this->formataValoresMonetarios(bcadd($comissao_jogos_bolao, $comissao_jogos, 2)),
                "comissao_jogos_silce" => 'R$ ' . $this->formataValoresMonetarios($comissao_jogos_silce),
                "premios_pagos" => 'R$ ' . $this->formataValoresMonetarios($premios_pagos),
                "comissao_jogos_ibc" => 'R$ ' . $this->formataValoresMonetarios($comissao_jogos_ibc),
                "total_silce" => 'R$ ' . $this->formataValoresMonetarios(bcadd($comissao_jogos_ibc, $comissao_jogos_silce, 2)),
                "data_jogos" => $data,
                "data_silce" => $data_silce,
                "data_bolao" => $data_bolao,
                "data_premios_pagos" => $data_premios_pagos,
                "data_ibc" => $data_ibc
            );
            echo json_encode($json);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_comissao() {
        if ($this->request->isAJAX()) {
            $sislo_comissao = $this->carrega_comissoes()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_comissao as $value) {
                $row = array();
                $row[] = $this->formataDataParaDatatable($value->dia_inicial);
                $row[] = $this->formataDataParaDatatable($value->dia_final);
                $row[] = $value->nome;
                $row[] = trim($value->concurso);
                $row[] = trim($value->quantidade);
                $row[] = $this->formataValoresMonetarios($value->valor);
                $row[] = $this->formataValoresMonetarios($value->comissao);
                $row[] = $value->percent_comissao;
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_comissao_jogos/?id=' . $value->idsislo_comissao_jogos) . '">Editar</a>';
                ++$tt;
                ++$tb;
                $data[] = $row;
            }
            $json = array(
                "recordsTotal" => $tb,
                "recordsFiltered" => $tb,
                "data" => $data
            );
            echo json_encode($json);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {//verificar certo o lance da prestação de contas
        if ($this->request->isAJAX()) {
            $cob_diaria_conta_model = new \App\Models\Sislo_ComissaoJogosModel;
            $datas = array();
            $datas['cod_loterico'] = $this->request->getPost('cod_loterico');
            $datas['referencia'] = $this->request->getPost('referencia');
            $datas['dia_inicial'] = $this->request->getPost('dia_inicial');
            $datas['dia_final'] = $this->request->getPost('dia_final');
            $datas['id_sislo_jogos_cef'] = $this->request->getPost('id_sislo_jogos_cef');
            $datas['concurso'] = $this->request->getPost('concurso');
            $datas['quantidade'] = $this->request->getPost('quantidade');
            $datas['valor'] = $this->request->getPost('valor');
            $datas['comissao'] = $this->request->getPost('comissao');
            $datas['percent_comissao'] = $this->request->getPost('percent_comissao');
            $datas['status'] = 1;
            $datas['data_ultima_alteracao'] = date('Y-m-d H:i:s');

            $insert = array();
            $i = 0;
            foreach ($datas['id_sislo_jogos_cef'] as $value) {
                $percent_comissao = ($this->limparValoresMonetarios($datas['comissao'][$i]) / $this->limparValoresMonetarios($datas['valor'][$i])) * 100;
                $conjunto = [
                    'cod_loterico' => $datas['cod_loterico'],
                    'referencia' => $datas['referencia'],
                    'dia_inicial' => $datas['dia_inicial'],
                    'dia_final' => $datas['dia_final'],
                    'id_sislo_jogos_cef' => $value,
                    'concurso' => $datas['concurso'][$i],
                    'quantidade' => $datas['quantidade'][$i],
                    'valor' => $this->limparValoresMonetarios($datas['valor'][$i]),
                    'comissao' => $this->limparValoresMonetarios($datas['comissao'][$i]),
                    'percent_comissao' => $percent_comissao,
                    'status' => $datas['status'],
                    'data_ultima_alteracao' => $datas['data_ultima_alteracao']
                ];

                array_push($insert, $conjunto);
                unset($conjunto);
                unset($percent_comissao);
                ++$i;
            }

            if ($this->request->getPost('incluir') == '1') {
                $entrou = $cob_diaria_conta_model->insertBatch($insert) == true ? 1 : 0;
                $sislo_notificacao_model = new \App\Models\Sislo_NotificacaoModel();
                $sislo_notificacao_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
                $sislo_notificacao_model->set('notificacao', 'Comissão de Jogos Inserida');
                $sislo_notificacao_model->set('valor', array_sum($datas['comissao']));
                $sislo_notificacao_model->set('status', 1);
                $sislo_notificacao_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                $sislo_notificacao_model->insert();
                //após testar, criar com o relatório a prestação de contas
                echo $entrou;
            } else {//este else trabalhar emcima do editar que vai ser criado
                //$sislo_contaspagar_model->where('idsislo_contas_pagar', $this->request->getPost('idsislo_contas_pagar'));
                echo $entrou;
            }
        } else {
            echo view('login');
        }
    }

}
