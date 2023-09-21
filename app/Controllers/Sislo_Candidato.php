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

    public function candidato_perfil() {
        $sislo_escolaridade_model = new \App\Models\Sislo_EscolaridadeModel;
        $candidato = new \App\Models\Sislo_CandidatoModel;
        $dados_escolaridade = $sislo_escolaridade_model->where('status', 1)
                ->orderBy('escolaridade', 'asc')
                ->findAll();
        $dados_candidato = $candidato->where('cpf', $this->session->get('candidato_cpf'))->first();
        $data = array(
            "scripts" => array(
                "candidato_perfil.js", "slick.js", "util.js"
            ),
            "user_name" => $dados_candidato->nome,
            'id_escolaridade_list' => $dados_escolaridade,
            'dados_candidato' => $dados_candidato
        );
        echo view('template/candidato_header', $data);
        echo view('template/candidato_menu');
        echo view('template/candidato_content');
        echo view('candidato_perfil', $data);
        echo view('template/candidato_footer', $data);
        echo view('template/candidato_scripts', $data);
    }

    public function candidato_vagas() {
        $candidato = new \App\Models\Sislo_CandidatoModel;
        $dados_candidato = $candidato->where('cpf', $this->session->get('candidato_cpf'))->first();
        $data = array(
            "scripts" => array(
                "candidato_vagas.js", "slick.js", "util.js"
            ),
            "user_name" => $dados_candidato->nome,
            'dados_candidato' => $dados_candidato
        );
        echo view('template/candidato_header', $data);
        echo view('template/candidato_menu');
        echo view('template/candidato_content');
        echo view('candidato_vagas', $data);
        echo view('template/candidato_footer', $data);
        echo view('template/candidato_scripts', $data);
    }

    public function carrega_vagas() {
        $db = \Config\Database::connect();
        $builder = $db->table('sislo_vagas as sv');
        $query = $builder->select("sv.cod_loterico as cod_loterico, 
            sv.id_sislo_vagas as id_sislo_vagas,
            sv.data_publicacao as data_publicacao,
            sv.data_limite as data_limite,
            sv.cargo as cargo,
            ssv.nome_status as nome_status, sle.cidade as cidade,sle.uf as uf, 
            sle.nome_fantasia as nome_fantasia")
                        ->join("sislo_status_vaga as ssv",
                                "sv.id_sislo_status_vaga = "
                                . "ssv.id_sislo_status_vaga")
                        ->join("sislo_loterica_empresa as sle",
                                "sv.cod_loterico = "
                                . "sle.cod_loterico")
                        ->orderBy('sv.data_publicacao', 'desc')->get();
        return $query;
    }

    public function ajax_list_candidato_vaga() {
        if ($this->request->isAJAX()) {
            $sislo_fech = $this->carrega_vagas()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_fech as $value) {
                $data_inicio = new \DateTime($value->data_publicacao);
                $data_fim = new \DateTime($value->data_limite);
                $dateInterval = $data_inicio->diff($data_fim);
                $row = array();
                $row[] = $tt;
                $row[] = strtoupper($value->nome_fantasia);
                $row[] = strtoupper($value->cidade) . '/' . strtoupper($value->uf);
                $row[] = date("d/m/Y", strtotime($value->data_publicacao));
                $row[] = date("d/m/Y", strtotime($value->data_limite));
                $row[] = $dateInterval->days;
                $row[] = strtoupper($value->cargo);
                $row[] = $value->nome_status;
                $row[] = '<a class="btn btn-primary" href="' .
                        base_url('ver_vaga/?id=' .
                                $value->id_sislo_vagas) . '">Ver Vaga</a>';

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

    public function candidato_editar_perfil() {
        $sislo_escolaridade_model = new \App\Models\Sislo_EscolaridadeModel;
        $candidato = new \App\Models\Sislo_CandidatoModel;
        $dados_escolaridade = $sislo_escolaridade_model->where('status', 1)
                ->orderBy('escolaridade', 'asc')
                ->findAll();
        $dados_candidato = $candidato->where('cpf', $this->session->get('candidato_cpf'))->first();
        $data = array(
            "scripts" => array(
                "candidato_editar_perfil.js", "slick.js", "util.js", "sweetalert2.all.min.js", "jquery.validate.js", "jquery.mask.min.js", "jquery.maskMoney.min.js",
            ),
            "user_name" => $dados_candidato->nome,
            'id_escolaridade_list' => $dados_escolaridade,
            'dados_candidato' => $dados_candidato
        );
        echo view('template/candidato_header', $data);
        echo view('template/candidato_menu');
        echo view('template/candidato_content');
        echo view('candidato_editar_perfil', $data);
        echo view('template/candidato_footer', $data);
        echo view('template/candidato_scripts', $data);
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

    public function ajax_list_experiencia() {
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
            } else {
                $candidato->where('id_sislo_candidato', $this->request->getPost('id_sislo_candidato'));
                echo $candidato->update() == true ? 1 : 0;
            }
        } else {
            echo view('sislo');
        }
    }
}
