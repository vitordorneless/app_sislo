<?php

namespace App\Controllers;

class Sislo_Decendio extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_decendio.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_decendio', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function redireciona_decendio() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_tipos = new \App\Models\Sislo_ServicosDecendioModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $tipos = $sislo_tipos->where('status', 1)->orderBy('servico', 'asc')->findAll();
            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['cod_loterico'] = $this->session->get('cod_lot');

                $data = array(
                    "scripts" => array(
                        "sislo_decendio_crud.js",
                        "sweetalert2.all.min.js",
                        "jquery.validate.js",
                        "jquery.mask.min.js",
                        "jquery.maskMoney.min.js",
                        "util.js"
                    ),
                    "user_name" => $dadosuser->sislo_nome,
                    "tipos" => $tipos,
                    "cod_loterico" => $this->session->get('cod_lot'),
                    "incluir" => $incluir
                );

                echo view('template/header', $data);
                echo view('template/menu');
                echo view('template/content');
                echo view('sislo_decendio_crud', $data);
                echo view('template/footer', $data);
                echo view('template/scripts', $data);
            } else {
                $incluir = 2;
            }
        } else {
            echo view('login');
        }
    }

    public function carrega_servicos() {
        $db = \Config\Database::connect();
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $cod_lot = $this->session->get('cod_lot');
        $builder = $db->table('sislo_decendio as scs');
        $query = $builder->select("scs.idsislo_decendio as idsislo_decendio, "
                                . "sts.servico as servico, scs.quantidade as quantidade, scs.valor_total as valor_total, scs.valor_unitario as valor_unitario")
                        ->join("sislo_servicos_decendio as sts", "scs.id_sislo_servicos_decendio = sts.idsislo_servicos_decendio", "inner")
                        ->where("scs.referencia", $referencia)
                        ->where("scs.cod_loterico", $cod_lot)
                        ->orderBy('scs.valor_total', 'DESC')->get();
        return $query;
    }

    public function ajax_list_decendio() {//fazer o redireciona FAZER o formulario para incluir, form para editar
        if ($this->request->isAJAX()) {
            $sislo_list_servicos = $this->carrega_servicos()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_list_servicos as $value) {
                $row = array();
                $row[] = trim($value->servico);
                $row[] = trim($value->quantidade);
                $row[] = $this->formataValoresMonetarios(bcdiv($value->valor_total,$value->quantidade,2));
                $row[] = $this->formataValoresMonetarios($value->valor_total);
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_decendio/?id=' . $value->idsislo_decendio) . '">Editar</a>';
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
            $decendio_servico_model = new \App\Models\Sislo_DecendioModel;
            $decendio_caucao_model = new \App\Models\Sislo_CaucaoModel;
            $datas = array();
            $datas['id_sislo_servicos_decendio'] = $this->request->getPost('id_sislo_servicos_decendio');
            $datas['referencia'] = $this->request->getPost('referencia');
            $datas['cod_loterico'] = $this->request->getPost('cod_loterico');
            $datas['quantidade'] = $this->request->getPost('quantidade');
            $datas['valor_total'] = $this->request->getPost('valor_total');
            $datas['status'] = 1;
            $datas['data_ultima_alteracao'] = date('Y-m-d H:i:s');
            $insert = [];
            $i = 0;
            foreach ($datas['id_sislo_servicos_decendio'] as $value) {                
                $conjunto = [
                    'referencia' => $datas['referencia'],
                    'cod_loterico' => $datas['cod_loterico'],
                    'id_sislo_servicos_decendio' => $value,
                    'quantidade' => $datas['quantidade'][$i],
                    'valor_total' => $this->limparValoresMonetarios($datas['valor_total'][$i]),
                    'valor_unitario' => 0,
                    'status' => $datas['status'],
                    'data_ultima_alteracao' => $datas['data_ultima_alteracao']
                ];

                array_push($insert, $conjunto);
                unset($conjunto);
                ++$i;
            }

            if ($this->request->getPost('incluir') == '1') {
                $decendio_caucao_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
                $decendio_caucao_model->set('referencia', $this->request->getPost('referencia'));
                $decendio_caucao_model->set('valor_caucao', $this->limparValoresMonetarios($this->request->getPost('valor_caucao')));
                $decendio_caucao_model->set('tributos_federais', $this->limparValoresMonetarios($this->request->getPost('tributos_federais')));
                $decendio_caucao_model->set('status', $datas['status']);
                $decendio_caucao_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                $decendio_caucao_model->insert();
                $entrou = $decendio_servico_model->insertBatch($insert) == true ? 1 : 0;
                $sislo_notificacao_model = new \App\Models\Sislo_NotificacaoModel();
                $sislo_notificacao_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
                $sislo_notificacao_model->set('notificacao', 'Comissão de Bolão Inserida');
                $sislo_notificacao_model->set('valor', array_sum($datas['valor_total']));
                $sislo_notificacao_model->set('status', 1);
                $sislo_notificacao_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                $sislo_notificacao_model->insert();
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
