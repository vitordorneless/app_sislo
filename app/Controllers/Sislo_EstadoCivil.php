<?php

namespace App\Controllers;

class Sislo_EstadoCivil extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_estadocivil.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_estadocivil', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_estadocivil() {
        if ($this->request->isAJAX()) {
            $sislo_estadocivil_model = new \App\Models\Sislo_EstadoCivilModel;
            $sislo = $sislo_estadocivil_model->where('status', 1)->orderBy('estadocivil', 'asc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->estadocivil;
                $row[] = $value->status == 1 ? "Ativo" : "Inativo";
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_estadocivil/?id=' . $value->id_sislo_estadocivil) . '">Editar</a>';
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

    public function redireciona_estadocivil() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_EstadoCivilModel();
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['id_sislo_estadocivil'] = '';
                $dados['estadocivil'] = '';
                $dados['status'] = '';
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_model->find($this->request->getGet('id'));
                $dados['id_sislo_estadocivil'] = $dados_loterica->id_sislo_estadocivil;
                $dados['estadocivil'] = $dados_loterica->estadocivil;
                $dados['status'] = $dados_loterica->status;
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_estadocivil_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "estadocivil" => $dados['estadocivil'],
                "id_sislo_estadocivil" => $dados['id_sislo_estadocivil'],
                "status" => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_estadocivil_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_EstadoCivilModel();
            $sislo_model->set('estadocivil', $this->request->getPost('estadocivil'));
            $sislo_model->set('status', $this->request->getPost('status'));
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('id_sislo_estadocivil', $this->request->getPost('id_sislo_estadocivil'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

}
