<?php

namespace App\Controllers;

class Sislo_Premios_Pagos extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_premios_pagos.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_premios_pagos', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function redireciona_premios_pagos() {
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
                        "sislo_premios_pagos_crud.js",
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
                echo view('sislo_premios_pagos_crud', $data);
                echo view('template/footer', $data);
                echo view('template/scripts', $data);
            } else {
                $incluir = 2;
            }
        } else {
            echo view('login');
        }
    }

    public function carrega_premios_pagos() {
        $db = \Config\Database::connect();
        $builder = $db->table('sislo_premios_pagos as scs');
        $query = $builder->select("scs.idsislo_premios_pagos as idsislo_premios_pagos, "
                                . "sts.nome as nome, scs.quantidade as quantidade, "
                                . "scs.valor as valor, scs.dia_inicial as dia_inicial, scs.dia_final as dia_final")
                        ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")
                        ->where('MONTH(scs.dia_inicial)', $this->request->getPost('mes'))
                        ->where('YEAR(scs.dia_inicial)', $this->request->getPost('ano'))
                        ->where("scs.cod_loterico", $this->session->get('cod_lot'))
                        ->where('scs.status', 1)
                        ->orderBy('scs.dia_inicial', 'asc')->get();
        return $query;
    }

    public function ajax_list_premios_pagos() {//fazer o redireciona FAZER o formulario para incluir, form para editar
        if ($this->request->isAJAX()) {
            $sislo_comissao = $this->carrega_premios_pagos()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_comissao as $value) {
                $row = array();
                $row[] = $this->formataDataParaDatatable($value->dia_inicial);
                $row[] = $this->formataDataParaDatatable($value->dia_final);
                $row[] = $value->nome;
                $row[] = trim($value->quantidade);
                $row[] = $this->formataValoresMonetarios($value->valor);
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_premios_pagos/?id=' . $value->idsislo_premios_pagos) . '">Editar</a>';
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

    public function ajax_save_form() {
        if ($this->request->isAJAX()) {
            $cob = new \App\Models\Sislo_Premios_PagosModel();
            $datas = array();
            $datas['cod_loterico'] = $this->request->getPost('cod_loterico');
            $datas['referencia'] = $this->request->getPost('referencia');
            $datas['dia_inicial'] = $this->request->getPost('dia_inicial');
            $datas['dia_final'] = $this->request->getPost('dia_final');
            $datas['quantidade'] = $this->request->getPost('quantidade');
            $datas['valor'] = $this->request->getPost('valor');
            $datas['id_sislo_jogos_cef'] = $this->request->getPost('id_sislo_jogos_cef');
            $datas['status'] = 1;
            $datas['data_ultima_alteracao'] = date('Y-m-d H:i:s');
            $insert = array();
            $i = 0;
            foreach ($datas['id_sislo_jogos_cef'] as $value) {
                $conjunto = [
                    'cod_loterico' => $datas['cod_loterico'],
                    'referencia' => $datas['referencia'],
                    'dia_inicial' => $datas['dia_inicial'],
                    'dia_final' => $datas['dia_final'],
                    'id_sislo_jogos_cef' => $value,
                    'quantidade' => $datas['quantidade'][$i],
                    'valor' => $this->limparValoresMonetarios($datas['valor'][$i]),
                    'status' => $datas['status'],
                    'data_ultima_alteracao' => $datas['data_ultima_alteracao']
                ];
                array_push($insert, $conjunto);
                unset($conjunto);
                ++$i;
            }

            if ($this->request->getPost('incluir') == '1') {
                $entrou = $cob->insertBatch($insert) == true ? 1 : 0;
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
