<?php

namespace App\Controllers;

class Sislo_Candidato extends BaseController {

    public function include_candidate() {
        $sislo_escolaridade_model = new \App\Models\Sislo_EscolaridadeModel;
        $dados_escolaridade = $sislo_escolaridade_model
                ->where('status', 1)
                ->orderBy('escolaridade', 'asc')
                ->findAll();
        $incluir = 1;
        $data = array(
            "incluir" => $incluir,
            'id_escolaridade_list' => $dados_escolaridade
        );
        echo view('cadastro_candidato', $data);
    }

    public function area_candidato() {
        echo view('area_candidato');
    }

    public function area_candidato_logado() {        

        $sislo_usuarios_model = new \App\Models\Sislo_CandidatoModel;
        $result = $sislo_usuarios_model->where('cpf', $this->session->get('candidato_cpf'))->first();

        $data = array(
            "scripts" => array(
                "area_candidato_logado.js",
                "slick.js",
                "util.js"
            ),
            "user_name" => $result->nome,
            "candidato" => $result
        );
        echo view('template/candidato_header', $data);
        echo view('template/candidato_menu');
        echo view('template/candidato_content');
        echo view('area_candidato_logado', $data);
        echo view('template/candidato_footer', $data);
        echo view('template/candidato_scripts', $data);
    }

    public function ajax_login_candidato() {
        $json = array();
        $json['status'] = 0;
        $json['error_list'] = array();

        $cpf = $this->request->getPost('cpf');
        $password = $this->request->getPost('password');
        $sislo_usuarios_model = new \App\Models\Sislo_CandidatoLoginModel;
        $sislo_candidato = new \App\Models\Sislo_CandidatoModel;
        $result = $sislo_usuarios_model->where('cpf_sislo_candidato', $cpf)->where('pass', sha1($password, false))->first();

        if (!empty($result->id_sislo_candidato_login)) {
            $dadoscandidato = $sislo_candidato->where('cpf', $cpf)->first();
            $candidato_cpf = ['candidato_cpf' => $cpf];
            $candidato_nome = ['candidato_nome' => $dadoscandidato->nome];
            $this->session->set($candidato_cpf);
            $this->session->set($candidato_nome);
            $json['status'] = 1;
        } else {
            $json['status'] = 0;
        }

        if ($json['status'] === 0) {
            $json['error_list'] = 'Preencher novamente, dados incorretos';
        }

        echo json_encode($json);
    }

    public function ajax_save_form() {
        if ($this->request->isAJAX()) {
            $candidato = new \App\Models\Sislo_CandidatoModel;
            $candidato_login = new \App\Models\Sislo_CandidatoLoginModel;

            $candidato->set('nome', $this->request->getPost('nome'));
            $candidato->set('cpf', $this->request->getPost('cpf'));
            $candidato->set('sexo', $this->request->getPost('genero'));
            $candidato->set('nascimento', $this->request->getPost('nascimento'));
            $candidato->set('escolaridade', $this->request->getPost('id_escolaridade'));
            $candidato->set('email', $this->request->getPost('email'));
            $candidato->set('cep', $this->request->getPost('cep'));
            $candidato->set('endereco', $this->request->getPost('endereco'));
            $candidato->set('numero', $this->request->getPost('numero'));
            $candidato->set('complemento', $this->request->getPost('complemento'));
            $candidato->set('bairro', $this->request->getPost('bairro'));
            $candidato->set('cidade', $this->request->getPost('cidade'));
            $candidato->set('uf', $this->request->getPost('uf'));
            $candidato->set('telefone', $this->request->getPost('telefone'));
            $candidato->set('status', 1);
            $candidato->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                $candidato->insert();
                $candidato_login->set('cpf_sislo_candidato', $this->request->getPost('cpf'));
                $candidato_login->set('pass', sha1("102030", false));
                $candidato_login->set('status', 1);
                $candidato_login->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                echo $candidato_login->insert() == true ? 1 : 0;
            } else {//este else trabalhar emcima do editar que vai ser criado
                //$sislo_contaspagar_model->where('idsislo_contas_pagar', $this->request->getPost('idsislo_contas_pagar'));
                echo $entrou = 0;
            }
        } else {
            echo view('sislo');
        }
    }
}
