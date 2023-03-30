<?php

namespace App\Controllers;

class SisloJogosCef extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_jogoscef.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_jogoscef', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_jogos_cef() {
        if ($this->request->isAJAX()) {
            $sislo_jogos_cef_model = new \App\Models\SisloJogosCefModel;
            $sislo = $sislo_jogos_cef_model->where('status', 1)->orderBy('nome', 'asc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo as $value) {
                $row = array();                
                $row[] = trim($value->nome);
                $row[] = $value->seg == 1 ? '<strong>&or;</strong>' : '...';
                $row[] = $value->ter == 1 ? '<strong>&or;</strong>' : '...';
                $row[] = $value->qua == 1 ? '<strong>&or;</strong>' : '...';
                $row[] = $value->qui == 1 ? '<strong>&or;</strong>' : '...';
                $row[] = $value->sex == 1 ? '<strong>&or;</strong>' : '...';
                $row[] = $value->sab == 1 ? '<strong>&or;</strong>' : '...';
                $row[] = $value->dom == 1 ? '<strong>&or;</strong>' : '...';
                $row[] = $value->status == 1 ? "Ativo" : "Inativo";
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_jogoscef/?id=' . $value->idsislo_jogos_cef) . '">Editar</a>';
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

    public function redireciona_jogoscef() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\SisloJogosCefModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['idsislo_jogos_cef'] = '';
                $dados['nome'] = '';
                $dados['seg'] = 0;
                $dados['ter'] = 0;
                $dados['qua'] = 0;
                $dados['qui'] = 0;
                $dados['sex'] = 0;
                $dados['sab'] = 0;
                $dados['dom'] = 0;
                $dados['status'] = '';
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_model->find($this->request->getGet('id'));
                $dados['idsislo_jogos_cef'] = $dados_loterica->idsislo_jogos_cef;
                $dados['nome'] = $dados_loterica->nome;
                $dados['seg'] = $dados_loterica->seg;
                $dados['ter'] = $dados_loterica->ter;
                $dados['qua'] = $dados_loterica->qua;
                $dados['qui'] = $dados_loterica->qui;
                $dados['sex'] = $dados_loterica->sex;
                $dados['sab'] = $dados_loterica->sab;
                $dados['dom'] = $dados_loterica->dom;
                $dados['status'] = $dados_loterica->status;
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_jogoscef_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "nome" => $dados['nome'],
                "seg" => $dados['seg'],
                "ter" => $dados['ter'],
                "qua" => $dados['qua'],
                "qui" => $dados['qui'],
                "sex" => $dados['sex'],
                "sab" => $dados['sab'],
                "dom" => $dados['dom'],
                "idsislo_jogos_cef" => $dados['idsislo_jogos_cef'],
                "status" => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_jogoscef_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\SisloJogosCefModel;
            $sislo_model->set('nome', $this->request->getPost('nome'));
            $sislo_model->set('status', $this->request->getPost('status'));
            $sislo_model->set('seg', $this->request->getPost('seg') == 1 ? 1 : 0);
            $sislo_model->set('ter', $this->request->getPost('ter') == 1 ? 1 : 0);
            $sislo_model->set('qua', $this->request->getPost('qua') == 1 ? 1 : 0);
            $sislo_model->set('qui', $this->request->getPost('qui') == 1 ? 1 : 0);
            $sislo_model->set('sex', $this->request->getPost('sex') == 1 ? 1 : 0);
            $sislo_model->set('sab', $this->request->getPost('sab') == 1 ? 1 : 0);
            $sislo_model->set('dom', $this->request->getPost('dom') == 1 ? 1 : 0);
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('idsislo_jogos_cef', $this->request->getPost('idsislo_jogos_cef'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

}
