<?php

namespace App\Controllers;

class Sislo_Tfl extends BaseController {

    public function index() {

        if ($this->session->get('user_id')) {
            $sislo_loterica_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_loterica_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_tfl.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_tfl_list', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_tfl() {
        if ($this->request->isAJAX()) {
            $sislo_tfl_model = new \App\Models\Sislo_TflModel();
            $sislo_tfl = $sislo_tfl_model->where('cod_loterico', $this->session->get('cod_lot'))->where('status', 1)->orderBy('caixa_numero', 'asc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_tfl as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->cod_loterico;
                $row[] = $value->terminal;
                $row[] = $value->serie;
                $row[] = $value->caixa_numero;
                $row[] = $value->status == 1 ? "Ativo" : "Inativo";
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_tfl/?id=' . $value->idsislo_tfl) . '">Editar</a>';
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
            $sislo_tfl_model = new \App\Models\Sislo_TflModel();
            $sislo_tfl_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_tfl_model->set('terminal', $this->request->getPost('terminal'));
            $sislo_tfl_model->set('caixa_numero', $this->request->getPost('caixa_numero'));
            $sislo_tfl_model->set('serie', $this->request->getPost('serie'));
            $sislo_tfl_model->set('status', $this->request->getPost('status'));
            $sislo_tfl_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_tfl_model->insert() == true ? 1 : 0;
            } else {
                $sislo_tfl_model->where('idsislo_tfl', $this->request->getPost('idsislo_tfl'));
                echo $sislo_tfl_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

    public function redireciona_tfl() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_tfl_model = new \App\Models\Sislo_TflModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['idsislo_tfl'] = '';
                $dados['cod_loterico'] = $this->session->get('cod_lot');
                $dados['terminal'] = '';
                $dados['serie'] = '';
                $dados['caixa_numero'] = '';
                $dados['status'] = '';
            } else {
                $incluir = 2;
                $dados_tfl = $sislo_tfl_model->find($this->request->getGet('id'));
                $dados['idsislo_tfl'] = $dados_tfl->idsislo_tfl;
                $dados['cod_loterico'] = $dados_tfl->cod_loterico;
                $dados['terminal'] = $dados_tfl->terminal;
                $dados['serie'] = $dados_tfl->serie;
                $dados['caixa_numero'] = $dados_tfl->caixa_numero;
                $dados['status'] = $dados_tfl->status;
                unset($dados_tfl);
            }
            $data = array(
                "scripts" => array(
                    "sislo_tfl_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "idsislo_tfl" => $dados['idsislo_tfl'],
                "cod_loterico" => $dados['cod_loterico'],
                "terminal" => $dados['terminal'],
                "serie" => $dados['serie'],
                "caixa_numero" => $dados['caixa_numero'],
                "status" => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_tfl_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

}
