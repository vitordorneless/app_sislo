<?php

namespace App\Controllers;

class Sislo_ServicosDecendio extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_servicos_decendio.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_servicos_decendio', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function redireciona_dec_servicos() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_tipos = new \App\Models\Sislo_Tipo_ServicoModel;
            $sislo_servicos = new \App\Models\Sislo_TiposConvenioModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $tipos = $sislo_tipos->where('status', 1)->orderBy('servico', 'asc')->findAll();
            $servicos = $sislo_servicos->where('status', 1)->orderBy('convenio', 'asc')->findAll();
            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['cod_loterico'] = $this->session->get('cod_lot');

                $data = array(
                    "scripts" => array(
                        "sislo_servicos_decendio_crud.js",
                        "sweetalert2.all.min.js",
                        "jquery.validate.js",
                        "jquery.mask.min.js",
                        "jquery.maskMoney.min.js",
                        "util.js"
                    ),
                    "user_name" => $dadosuser->sislo_nome,
                    "tipos" => $tipos,
                    "servicos" => $servicos,
                    "cod_loterico" => $this->session->get('cod_lot'),
                    "incluir" => $incluir
                );

                echo view('template/header', $data);
                echo view('template/menu');
                echo view('template/content');
                echo view('sislo_servicos_decendio_crud', $data);
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
        $builder = $db->table('sislo_servicos_decendio as scs');
        $query = $builder->select("scs.idsislo_servicos_decendio as idsislo_servicos_decendio, sts.servico as servico, scs.servico as servicodecendio")
                ->join("sislo_tipo_servico as sts", "scs.id_sislo_tipo_servico = sts.idsislo_tipo_servico", "inner")
                ->orderBy('scs.servico', 'asc')->get();
        return $query;
    }

    public function ajax_list_servicos_dec() {//fazer o redireciona FAZER o formulario para incluir, form para editar
        if ($this->request->isAJAX()) {
            $sislo_list_servicos = $this->carrega_servicos()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_list_servicos as $value) {
                $row = array();
                $row[] = trim($value->servico);
                $row[] = trim($value->servicodecendio);
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_dec_servicos/?id=' . $value->idsislo_servicos_decendio) . '">Editar</a>';
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
            $decendio_servico_model = new \App\Models\Sislo_ServicosDecendioModel;
            $datas = array();
            $datas['id_sislo_tipo_servico'] = $this->request->getPost('id_sislo_tipo_servico');
            $datas['id_sislo_servicos_decendio'] = $this->request->getPost('id_sislo_servicos_decendio');
            $datas['servico'] = $this->request->getPost('servico');
            $datas['status'] = 1;
            $datas['data_ultima_alteracao'] = date('Y-m-d H:i:s');
            $insert = [];
            $i = 0;
            foreach ($datas['id_sislo_servicos_decendio'] as $value) {
                $conjunto = [
                    'id_sislo_tipo_servico' => $datas['id_sislo_tipo_servico'],
                    'id_sislo_tipos_convenio' => $value,
                    'servico' => $datas['servico'][$i],
                    'status' => $datas['status'],
                    'data_ultima_alteracao' => $datas['data_ultima_alteracao']
                ];

                array_push($insert, $conjunto);
                unset($conjunto);
                ++$i;
            }

            if ($this->request->getPost('incluir') == '1') {
                $entrou = $decendio_servico_model->insertBatch($insert) == true ? 1 : 0;
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
