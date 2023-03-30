<?php

namespace App\Controllers;

class Sislo_Fornecedores extends BaseController {

    public function index() {

        if ($this->session->get('user_id')) {
            $sislo_loterica_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_loterica_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_fornecedores.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_fornecedores_list', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_fornecedores() {
        if ($this->request->isAJAX()) {
            $sislo_fornecedores_model = new \App\Models\Sislo_FornecedoresModel();
            $sislo_fornecedores = $sislo_fornecedores_model->where('cod_loterico', $this->session->get('cod_lot'))->where('status', 1)->orderBy('nome', 'asc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_fornecedores as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->cod_loterico;
                $row[] = $value->nome;
                $row[] = $value->contato;
                $row[] = $value->whats;
                $row[] = $value->email;
                $row[] = $value->status == 1 ? "Ativo" : "Inativo";
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_fornecedores/?id=' . $value->idsislo_fornecedores) . '">Editar</a>';
                ++$tt;
                ++$tb;
                $data[] = $row;
            }
            $json = array("recordsTotal" => $tb,"recordsFiltered" => $tb,"data" => $data);
            echo json_encode($json);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_fornecedores_model = new \App\Models\Sislo_FornecedoresModel();
            $sislo_fornecedores_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_fornecedores_model->set('nome', $this->request->getPost('nome'));
            $sislo_fornecedores_model->set('cnpj', $this->request->getPost('cnpj'));
            $sislo_fornecedores_model->set('contato', $this->request->getPost('contato'));
            $sislo_fornecedores_model->set('tel', $this->request->getPost('tel'));
            $sislo_fornecedores_model->set('whats', $this->request->getPost('whats'));
            $sislo_fornecedores_model->set('email', $this->request->getPost('email'));
            $sislo_fornecedores_model->set('status', $this->request->getPost('status'));
            $sislo_fornecedores_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_fornecedores_model->insert() == true ? 1 : 0;
            } else {
                $sislo_fornecedores_model->where('idsislo_fornecedores', $this->request->getPost('idsislo_fornecedores'));
                echo $sislo_fornecedores_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

    public function redireciona_fornecedores() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_fornecedores_model = new \App\Models\Sislo_FornecedoresModel();
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['idsislo_fornecedores'] = '';
                $dados['cod_loterico'] = $this->session->get('cod_lot');
                $dados['nome'] = '';
                $dados['cnpj'] = '';
                $dados['contato'] = '';
                $dados['tel'] = '';
                $dados['whats'] = '';
                $dados['email'] = '';
                $dados['status'] = '';
            } else {
                $incluir = 2;
                $dados_fornecedores = $sislo_fornecedores_model->find($this->request->getGet('id'));
                $dados['idsislo_fornecedores'] = $dados_fornecedores->idsislo_fornecedores;
                $dados['cod_loterico'] = $dados_fornecedores->cod_loterico;
                $dados['nome'] = $dados_fornecedores->nome;
                $dados['cnpj'] = $dados_fornecedores->cnpj;
                $dados['contato'] = $dados_fornecedores->contato;
                $dados['tel'] = $dados_fornecedores->tel;
                $dados['whats'] = $dados_fornecedores->whats;
                $dados['email'] = $dados_fornecedores->email;
                $dados['status'] = $dados_fornecedores->status;
                unset($dados_fornecedores);
            }
            $data = array(
                "scripts" => array(
                    "sislo_fornecedores_crud.js",
                    "jquery.mask.min.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "idsislo_fornecedores" => $dados['idsislo_fornecedores'],
                "cod_loterico" => $dados['cod_loterico'],
                "nome" => $dados['nome'],
                "cnpj" => $dados['cnpj'],
                "contato" => $dados['contato'],
                "tel" => $dados['tel'],
                "whats" => $dados['whats'],
                "email" => $dados['email'],
                "status" => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_fornecedores_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

}
