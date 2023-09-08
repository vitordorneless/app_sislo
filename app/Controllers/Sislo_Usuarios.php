<?php

namespace App\Controllers;

class Sislo_Usuarios extends BaseController {

    public function index() {

        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_usuarios_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_usuarios.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_usuarios_list', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_user() {
        if ($this->request->isAJAX()) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $users = $sislo_usuarios_model->where('sislo_status', 1)->orderBy('sislo_nome', 'asc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($users as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->sislo_login;
                $row[] = $value->sislo_nome;
                $row[] = $value->sislo_email;
                $row[] = $value->sislo_status == 1 ? "Ativo" : "Inativo";
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_usuario/?id=' . $value->sislo_usuarios_id) . '">Editar</a>';
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
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_usuarios_model->set('sislo_id_loterica', $this->request->getPost('sislo_id_loterica'));
            $sislo_usuarios_model->set('sislo_login', $this->request->getPost('sislo_login'));
            $sislo_usuarios_model->set('sislo_nome', $this->request->getPost('sislo_nome'));
            $sislo_usuarios_model->set('sislo_pass', sha1($this->request->getPost('sislo_pass'), false));
            $sislo_usuarios_model->set('sislo_email', $this->request->getPost('sislo_email'));
            $sislo_usuarios_model->set('sislo_status', $this->request->getPost('sislo_status'));
            $sislo_usuarios_model->set('sislo_data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_usuarios_model->insert() == true ? 1 : 0;
            } else {
                $sislo_usuarios_model->where('sislo_usuarios_id', $this->request->getPost('sislo_usuarios_id'));
                echo $sislo_usuarios_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

    public function redireciona_usuario() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['sislo_usuarios_id'] = '';
                $dados['sislo_id_loterica'] = $this->session->get('cod_lot');
                $dados['sislo_login'] = '';
                $dados['sislo_nome'] = '';
                $dados['sislo_pass'] = '';
                $dados['sislo_email'] = '';
                $dados['sislo_status'] = '';
            } else {
                $incluir = 2;
                $dados_user = $sislo_usuarios_model->find($this->request->getGet('id'));
                $dados['sislo_usuarios_id'] = $this->request->getGet('id');
                $dados['sislo_id_loterica'] = $dados_user->sislo_id_loterica;
                $dados['sislo_login'] = $dados_user->sislo_login;
                $dados['sislo_nome'] = $dados_user->sislo_nome;
                $dados['sislo_pass'] = $dados_user->sislo_pass;
                $dados['sislo_email'] = $dados_user->sislo_email;
                $dados['sislo_status'] = $dados_user->sislo_status;
                unset($dados_user);
            }
            $data = array(
                "scripts" => array(
                    "sislo_usuarios_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "sislo_usuarios_id" => $dados['sislo_usuarios_id'],
                "sislo_id_loterica" => $dados['sislo_id_loterica'],
                "sislo_login" => $dados['sislo_login'],
                "sislo_nome" => $dados['sislo_nome'],
                "sislo_pass" => $dados['sislo_pass'],
                "sislo_email" => $dados['sislo_email'],
                "sislo_status" => $dados['sislo_status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_usuarios_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

}
