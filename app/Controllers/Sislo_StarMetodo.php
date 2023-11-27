<?php

namespace App\Controllers;

class Sislo_StarMetodo extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_star_metodo.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_star_metodo', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_star_metodo() {
        if ($this->request->isAJAX()) {
            $sislo_star_metodo_model = new \App\Models\Sislo_StarMetodoModel;
            $sislo = $sislo_star_metodo_model->where('status', 1)->orderBy('pergunta', 'asc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = mb_strimwidth($value->pergunta, 0, 35, "...");
                $row[] = $value->status == 1 ? "Ativo" : "Inativo";
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_star_metodo/?id=' . $value->id_sislo_star_metodo) . '">Editar</a>';
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

    public function redireciona_star_metodo() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_StarMetodoModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['id_sislo_star_metodo'] = '';
                $dados['pergunta'] = '';
                $dados['resposta_1'] = '';
                $dados['pontuacao_1'] = '';
                $dados['resposta_2'] = '';
                $dados['pontuacao_2'] = '';
                $dados['resposta_3'] = '';
                $dados['pontuacao_3'] = '';
                $dados['resposta_4'] = '';
                $dados['pontuacao_4'] = '';
                $dados['status'] = '';
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_model->find($this->request->getGet('id'));
                $dados['id_sislo_star_metodo'] = $dados_loterica->id_sislo_star_metodo;
                $dados['pergunta'] = $dados_loterica->pergunta;
                $dados['resposta_1'] = $dados_loterica->resposta_1;
                $dados['pontuacao_1'] = $dados_loterica->pontuacao_1;
                $dados['resposta_2'] = $dados_loterica->resposta_2;
                $dados['pontuacao_2'] = $dados_loterica->pontuacao_2;
                $dados['resposta_3'] = $dados_loterica->resposta_3;
                $dados['pontuacao_3'] = $dados_loterica->pontuacao_3;
                $dados['resposta_4'] = $dados_loterica->resposta_4;
                $dados['pontuacao_4'] = $dados_loterica->pontuacao_4;
                $dados['status'] = $dados_loterica->status;
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_star_metodo_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "pergunta" => $dados['pergunta'],
                "resposta_1" => $dados['resposta_1'],
                "pontuacao_1" => $dados['pontuacao_1'],
                "resposta_2" => $dados['resposta_2'],
                "pontuacao_2" => $dados['pontuacao_2'],
                "resposta_3" => $dados['resposta_3'],
                "pontuacao_3" => $dados['pontuacao_3'],
                "resposta_4" => $dados['resposta_4'],
                "pontuacao_4" => $dados['pontuacao_4'],
                "id_sislo_star_metodo" => $dados['id_sislo_star_metodo'],
                "status" => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_star_metodo_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_StarMetodoModel();
            $sislo_model->set('pergunta', $this->request->getPost('pergunta'));
            $sislo_model->set('resposta_1', $this->request->getPost('resposta_1'));
            $sislo_model->set('pontuacao_1', $this->request->getPost('pontuacao_1'));
            $sislo_model->set('resposta_2', $this->request->getPost('resposta_2'));
            $sislo_model->set('pontuacao_2', $this->request->getPost('pontuacao_2'));
            $sislo_model->set('resposta_3', $this->request->getPost('resposta_3'));
            $sislo_model->set('pontuacao_3', $this->request->getPost('pontuacao_3'));
            $sislo_model->set('resposta_4', $this->request->getPost('resposta_4'));
            $sislo_model->set('pontuacao_4', $this->request->getPost('pontuacao_4'));
            $sislo_model->set('status', $this->request->getPost('status'));
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('id_sislo_star_metodo', $this->request->getPost('id_sislo_star_metodo'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }
}
