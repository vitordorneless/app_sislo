<?php

namespace App\Controllers;

class Sislo_TimemaniaTimeCoracao extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_timemania_time_coracao.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_timemania_time_coracao', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_timemania_time_coracao() {
        if ($this->request->isAJAX()) {
            $sislo_timemania_time_coracao_model = new \App\Models\Sislo_TimemaniaTimeCoracaoModel;
            $sislo = $sislo_timemania_time_coracao_model->orderBy('time_coracao', 'asc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->time_coracao;                
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_timemania_time_coracao/?id=' . $value->idsislo_timemania_time_coracao) . '">Editar</a>';
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

    public function redireciona_timemania_time_coracao() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_TimemaniaTimeCoracaoModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['idsislo_timemania_time_coracao'] = '';
                $dados['time_coracao'] = '';                
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_model->find($this->request->getGet('id'));
                $dados['idsislo_timemania_time_coracao'] = $dados_loterica->idsislo_timemania_time_coracao;
                $dados['time_coracao'] = $dados_loterica->time_coracao;                
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_timemania_time_coracao_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "time_coracao" => $dados['time_coracao'],
                "idsislo_timemania_time_coracao" => $dados['idsislo_timemania_time_coracao']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_timemania_time_coracao_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_TimemaniaTimeCoracaoModel();
            $sislo_model->set('time_coracao', $this->request->getPost('time_coracao'));            

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('idsislo_timemania_time_coracao', $this->request->getPost('idsislo_timemania_time_coracao'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

}
