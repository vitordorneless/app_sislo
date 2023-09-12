<?php

namespace App\Controllers;

class Sislo_CandidatoExperiencia extends BaseController {

    public function index() {
        if ($this->session->get('candidato_cpf')) {
            $candidato = new \App\Models\Sislo_CandidatoModel;
            $dados_candidato = $candidato->where('cpf', $this->session->get('candidato_cpf'))->first();

            $data = array(
                "scripts" => array(
                    "candidato_experiencia.js",
                    "util.js"
                ),
                "user_name" => $dados_candidato->nome
            );
            echo view('template/candidato_header', $data);
            echo view('template/candidato_menu');
            echo view('template/candidato_content');
            echo view('candidato_experiencia', $data);
            echo view('template/candidato_footer', $data);
            echo view('template/candidato_scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_candidato_experiencia() {
        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_CandidatoExperienciaModel;
            $sislo = $sislo_model->where('cpf_sislo_candidato', $this->session->get('candidato_cpf'))->orderBy('data_inicial', 'desc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->nome_empresa;
                $row[] = $value->cargo;
                $row[] = $value->funcoes;
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_experiencia/?id=' . $value->id_sislo_candidato_experiencia) . '">Editar</a>';
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
            echo view('sislo');
        }
    }

    public function redireciona_experiencia() {
        if ($this->session->get('candidato_cpf')) {
            $candidato = new \App\Models\Sislo_CandidatoModel;
            $sislo_model = new \App\Models\Sislo_CandidatoExperienciaModel;
            $dados_nome = $candidato->where('cpf', $this->session->get('candidato_cpf'))->first();

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['id_sislo_candidato_experiencia'] = '';
                $dados['cpf_sislo_candidato'] = '';
                $dados['nome_empresa'] = '';
                $dados['data_inicial'] = '';
                $dados['data_final'] = '';
                $dados['emprego_atual'] = '';
                $dados['cargo'] = '';
                $dados['funcoes'] = '';
                $dados['status'] = '';
            } else {
                $incluir = 2;
                $dados_candidato = $sislo_model->find($this->request->getGet('id'));
                $dados['id_sislo_candidato_experiencia'] = $dados_candidato->id_sislo_candidato_experiencia;
                $dados['cpf_sislo_candidato'] = $dados_candidato->cpf_sislo_candidato;
                $dados['nome_empresa'] = $dados_candidato->nome_empresa;
                $dados['data_inicial'] = $dados_candidato->data_inicial;
                $dados['data_final'] = $dados_candidato->data_final;
                $dados['emprego_atual'] = $dados_candidato->emprego_atual;
                $dados['cargo'] = $dados_candidato->cargo;
                $dados['funcoes'] = $dados_candidato->funcoes;
                $dados['status'] = $dados_candidato->status;
                unset($dados_candidato);
            }
            $data = array(
                "scripts" => array(
                    "sislo_experiencia_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dados_nome->nome,
                "incluir" => $incluir,
                "id_sislo_candidato_experiencia" => $dados['id_sislo_candidato_experiencia'],
                "cpf_sislo_candidato" => $dados['cpf_sislo_candidato'],
                "nome_empresa" => $dados['nome_empresa'],
                "data_inicial" => $dados['data_inicial'],
                "data_final" => $dados['data_final'],
                "emprego_atual" => $dados['emprego_atual'],
                "cargo" => $dados['cargo'],
                "funcoes" => $dados['funcoes'],
                "status" => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_experiencia_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_CandidatoExperienciaModel();            
            $sislo_model->set('cpf_sislo_candidato', $this->request->getPost('cpf_sislo_candidato'));
            $sislo_model->set('nome_empresa', $this->request->getPost('nome_empresa'));
            $sislo_model->set('data_inicial', $this->request->getPost('data_inicial'));
            $sislo_model->set('data_final', $this->request->getPost('data_final'));
            $sislo_model->set('emprego_atual', $this->request->getPost('emprego_atual'));
            $sislo_model->set('cargo', $this->request->getPost('cargo'));
            $sislo_model->set('funcoes', $this->request->getPost('funcoes'));
            $sislo_model->set('status', $this->request->getPost('status'));
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('id_sislo_candidato_experiencia', $this->request->getPost('id_sislo_candidato_experiencia'));
                $sislo_model->where('cpf_sislo_candidato', $this->request->getPost('cpf_sislo_candidato'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }
}
