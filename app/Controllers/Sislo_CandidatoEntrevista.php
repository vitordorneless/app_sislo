<?php

namespace App\Controllers;

class Sislo_CandidatoEntrevista extends BaseController {

    public function redireciona_entrevista() {
        if ($this->session->get('user_id')) {
            $sislo_status = new \App\Models\Sislo_StatusVagaModel;
            $status = $sislo_status->where('status', 1)->orderBy('nome_status', 'asc')->findAll();
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model_star = new \App\Models\Sislo_StarMetodoModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $sislo_model = new \App\Models\Sislo_VagasModel;
            $dados_loterica = $sislo_model->find($this->request->getGet('id'));
            $dados['id_sislo_vagas'] = $dados_loterica->id_sislo_vagas;
            $dados['cod_loterico'] = $dados_loterica->cod_loterico;
            $dados['data_publicacao'] = $dados_loterica->data_publicacao;
            $dados['data_limite'] = $dados_loterica->data_limite;
            $dados['cargo'] = $dados_loterica->cargo;
            $dados['responsabilidades'] = $dados_loterica->responsabilidades;
            $dados['requisitos'] = $dados_loterica->requisitos;
            $dados['beneficios'] = $dados_loterica->beneficios;
            $dados['salario'] = $dados_loterica->salario;
            $dados['diferenciais'] = $dados_loterica->diferenciais;
            $dados['vaga_promovida'] = $dados_loterica->vaga_promovida;
            $dados['carga_horaria'] = $dados_loterica->carga_horaria;
            $dados['forma_contratacao'] = $dados_loterica->forma_contratacao;
            $dados['id_sislo_status_vaga'] = $dados_loterica->id_sislo_status_vaga;
            unset($dados_loterica);

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
                "id_sislo_candidato" => $this->request->getGet('id_sislo_candidato'),
                "id_sislo_vagas" => $dados['id_sislo_vagas'],
                "cod_loterico" => $dados['cod_loterico'],
                "data_publicacao" => $dados['data_publicacao'],
                "data_limite" => $dados['data_limite'],
                "cargo" => $dados['cargo'],
                "responsabilidades" => $dados['responsabilidades'],
                "requisitos" => $dados['requisitos'],
                "beneficios" => $dados['beneficios'],
                "salario" => $dados['salario'],
                "diferenciais" => $dados['diferenciais'],
                "vaga_promovida" => $dados['vaga_promovida'],
                "carga_horaria" => $dados['carga_horaria'],
                "forma_contratacao" => $dados['forma_contratacao'],
                "id_sislo_status_vaga" => $dados['id_sislo_status_vaga'],
                "status" => $status,
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
