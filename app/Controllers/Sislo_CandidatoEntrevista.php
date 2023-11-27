<?php

namespace App\Controllers;

class Sislo_CandidatoEntrevista extends BaseController {

    public function redireciona_entrevista() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model_star = new \App\Models\Sislo_StarMetodoModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $perguntas = $sislo_model_star->where('status', 1)->orderBy('pergunta', 'rand')->limit(5)->findAll();

            $data = array(
                "scripts" => array(
                    "sislo_entrevista.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "perguntas" => $perguntas,
                "id_sislo_vaga" => $this->request->getGet('id'),
                "id_sislo_candidato" => $this->request->getGet('id_sislo_candidato')
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_entrevista', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_CandidatoEntrevistaModel();
            $sislo_model->set('id_sislo_candidato', $this->request->getPost('id_sislo_candidato'));
            $sislo_model->set('id_sislo_vaga', $this->request->getPost('id_sislo_vaga'));
            $sislo_model->set('data_entrevista', $this->request->getPost('data_entrevista'));
            $sislo_model->set('hora_entrevista', $this->request->getPost('hora_entrevista'));
            $sislo_model->set('compareceu', $this->request->getPost('compareceu'));
            $sislo_model->set('id_sislo_star_metodo_1', $this->request->getPost('id_sislo_star_metodo_1'));
            $sislo_model->set('pontuacao_1', $this->request->getPost('pontuacao_1'));
            $sislo_model->set('id_sislo_star_metodo_2', $this->request->getPost('id_sislo_star_metodo_2'));
            $sislo_model->set('pontuacao_2', $this->request->getPost('pontuacao_2'));
            $sislo_model->set('id_sislo_star_metodo_3', $this->request->getPost('id_sislo_star_metodo_3'));
            $sislo_model->set('pontuacao_3', $this->request->getPost('pontuacao_3'));
            $sislo_model->set('id_sislo_star_metodo_4', $this->request->getPost('id_sislo_star_metodo_4'));
            $sislo_model->set('pontuacao_4', $this->request->getPost('pontuacao_4'));
            $sislo_model->set('id_sislo_star_metodo_5', $this->request->getPost('id_sislo_star_metodo_5'));
            $sislo_model->set('pontuacao_5', $this->request->getPost('pontuacao_5'));
            $sislo_model->set('parecer_rh', $this->request->getPost('parecer_rh'));            
            $sislo_model->set('status', $this->request->getPost('status'));
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('id_sislo_candidato_entrevista', $this->request->getPost('id_sislo_candidato_entrevista'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }
}
