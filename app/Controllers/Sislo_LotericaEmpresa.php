<?php

namespace App\Controllers;

class Sislo_LotericaEmpresa extends BaseController {

    public function empresa_area() {
        echo view('empresa_area');
    }
    
    public function empresa_perfil() {        
        $candidato = new \App\Models\Sislo_LotericaEmpresaModel;        
        $dados = $candidato->where('cod_loterico', $this->session->get('codigo_loterico'))->first();
        $data = array(
            "scripts" => array(
                "empresa_perfil.js", "slick.js", "util.js"
            ),
            "user_name" => $dados->nome_fantasia,            
            'dados' => $dados
        );
        echo view('template/empresa_header', $data);
        echo view('template/empresa_menu');
        echo view('template/empresa_content');
        echo view('empresa_perfil', $data);
        echo view('template/empresa_footer', $data);
        echo view('template/empresa_scripts', $data);
    }

    public function ajax_login_empresa() {
        $json = array();
        $json['status'] = 0;
        $json['error_list'] = array();

        $cod_loterico = $this->request->getPost('cod_loterico');
        $password = $this->request->getPost('password');
        $sislo_usuarios_model = new \App\Models\Sislo_EmpresaLoginModel;
        $sislo_candidato = new \App\Models\Sislo_LotericaEmpresaModel;
        $result = $sislo_usuarios_model->where('cod_loterico', $cod_loterico)
                        ->where('pass', sha1($password, false))->first();

        if (!empty($result->id_sislo_empresa_login)) {
            $dadoscandidato = $sislo_candidato
                            ->where('cod_loterico', $cod_loterico)->first();
            $empresa_cod_loterico = ['codigo_loterico' => $cod_loterico];
            $empresa_nome = ['empresa_nome' => $dadoscandidato->nome_fantasia];
            $this->session->set($empresa_cod_loterico);
            $this->session->set($empresa_nome);
            $json['status'] = 1;
        } else {
            $json['status'] = 0;
        }

        if ($json['status'] === 0) {
            $json['error_list'] = 'Preencher novamente, dados incorretos';
        }

        echo json_encode($json);
    }

    public function area_empresa_logado() {

        $sislo_usuarios_model = new \App\Models\Sislo_LotericaEmpresaModel;
        $result = $sislo_usuarios_model->where('cod_loterico',
                        $this->session->get('codigo_loterico'))->first();

        $data = array(
            "scripts" => array(
                "area_empresa_logado.js",
                "slick.js",
                "util.js"
            ),
            "user_name" => $result->nome_fantasia,
            "empresa" => $result
        );
        echo view('template/empresa_header', $data);
        echo view('template/empresa_menu');
        echo view('template/empresa_content');
        echo view('area_empresa_logado', $data);
        echo view('template/empresa_footer', $data);
        echo view('template/empresa_scripts', $data);
    }

    public function index() {

        if ($this->session->get('user_id')) {
            $sislo_loterica_model = new \App\Models\Sislo_LotericaEmpresaModel;
            $result = $sislo_loterica_model->find($this->session
                            ->get('nome_fantasia'));
            $data = array(
                "scripts" => array(
                    "sislo_loterica.js",
                    "util.js"
                ),
                "user_name" => $result->nome_fantasia
            );
            echo view('template/empresa_header', $data);
            echo view('template/empresa_menu');
            echo view('template/empresa_content');
            echo view('sislo_loterica_empresa_list', $data);
            echo view('template/empresa_footer', $data);
            echo view('template/empresa_scripts', $data);
        } else {
            echo view('sislo');
        }
    }

    public function include_empresa() {
        $incluir = 1;
        $data = array("incluir" => $incluir);
        echo view('empresa_cadastro', $data);
    }

    public function ajax_list_lotericas() {
        if ($this->request->isAJAX()) {
            $sislo_loterica_model = new \App\Models\Sislo_LotericaEmpresaModel;
            $sislo_lotericas = $sislo_loterica_model->where('sislo_status', 1)
                            ->orderBy('nome_fantasia', 'asc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_lotericas as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->cod_loterico;
                $row[] = $value->nome_fantasia;
                $row[] = $value->cidade;
                $row[] = $value->uf;
                $row[] = $value->sislo_status == 1 ? "Ativo" : "Inativo";
                $row[] = '<a class="btn btn-primary" href="' .
                        base_url('redireciona_loterica_empresa/?id=' .
                                $value->idsislo_loterica_empresa) .
                        '">Editar</a>';
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

    public function redireciona_loterica_empresa() {
        if ($this->session->get('nome_fantasia')) {
            $sislo_loterica_model = new \App\Models\Sislo_LotericaEmpresaModel;
            $dadosuser = $sislo_loterica_model->find($this->session
                            ->get('nome_fantasia'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['razao_social'] = '';
                $dados['idsislo_loterica_empresa'] = '';
                $dados['cnpj'] = '';
                $dados['cod_loterico'] = '';
                $dados['nome_fantasia'] = '';
                $dados['cep'] = '';
                $dados['logradouro'] = '';
                $dados['numero'] = '';
                $dados['complemento'] = '';
                $dados['bairro'] = '';
                $dados['cidade'] = '';
                $dados['uf'] = '';
                $dados['tel1'] = '';
                $dados['tel2'] = '';
                $dados['tel3'] = '';
                $dados['whatsapp'] = '';
                $dados['email'] = '';
                $dados['sislo_status'] = '';
                $dados['plano'] = '1';
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_loterica_model->find($this->request
                                ->getGet('id'));
                $dados['razao_social'] = $dados_loterica->razao_social;
                $dados['idsislo_loterica_empresa'] = $dados_loterica
                        ->idsislo_loterica_empresa;
                $dados['cnpj'] = $dados_loterica->cnpj;
                $dados['cod_loterico'] = $dados_loterica->cod_loterico;
                $dados['nome_fantasia'] = $dados_loterica->nome_fantasia;
                $dados['cep'] = $dados_loterica->cep;
                $dados['logradouro'] = $dados_loterica->logradouro;
                $dados['numero'] = $dados_loterica->numero;
                $dados['complemento'] = $dados_loterica->complemento;
                $dados['bairro'] = $dados_loterica->bairro;
                $dados['cidade'] = $dados_loterica->cidade;
                $dados['uf'] = $dados_loterica->uf;
                $dados['tel1'] = $dados_loterica->tel1;
                $dados['tel2'] = $dados_loterica->tel2;
                $dados['tel3'] = $dados_loterica->tel3;
                $dados['whatsapp'] = $dados_loterica->whatsapp;
                $dados['email'] = $dados_loterica->email;
                $dados['sislo_status'] = $dados_loterica->sislo_status;
                $dados['plano'] = $dados_loterica->plano;
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_loterica_empresa_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->nome_fantasia,
                "incluir" => $incluir,
                "razao_social" => $dados['razao_social'],
                "idsislo_loterica_empresa" => $dados['idsislo_loterica_empresa'],
                "cnpj" => $dados['cnpj'],
                "cod_loterico" => $dados['cod_loterico'],
                "nome_fantasia" => $dados['nome_fantasia'],
                "cep" => $dados['cep'],
                "logradouro" => $dados['logradouro'],
                "numero" => $dados['numero'],
                "complemento" => $dados['complemento'],
                "bairro" => $dados['bairro'],
                "cidade" => $dados['cidade'],
                "uf" => $dados['uf'],
                "tel1" => $dados['tel1'],
                "tel2" => $dados['tel2'],
                "tel3" => $dados['tel3'],
                "whatsapp" => $dados['whatsapp'],
                "email" => $dados['email'],
                "sislo_status" => $dados['sislo_status']
            );
            echo view('template/empresa_header', $data);
            echo view('template/empresa_menu');
            echo view('template/empresa_content');
            echo view('sislo_loterica_empresa_crud', $data);
            echo view('template/empresa_footer', $data);
            echo view('template/empresa_scripts', $data);
        } else {
            echo view('sislo');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_loterica_model = new \App\Models\Sislo_LotericaEmpresaModel;
            $empresa_login = new \App\Models\Sislo_EmpresaLoginModel;
            $sislo_loterica_model->set('cod_loterico', $this->request
                            ->getPost('cod_loterico'));
            $sislo_loterica_model->set('nome_fantasia', $this->request
                            ->getPost('nome_fantasia'));
            $sislo_loterica_model->set('razao_social', $this->request
                            ->getPost('razao_social'));
            $sislo_loterica_model->set('cnpj', $this->request->getPost('cnpj'));
            $sislo_loterica_model->set('logradouro', $this->request
                            ->getPost('endereco'));
            $sislo_loterica_model->set('numero', $this->request
                            ->getPost('numero'));
            $sislo_loterica_model->set('complemento', $this->request
                            ->getPost('complemento'));
            $sislo_loterica_model->set('cep', $this->request->getPost('cep'));
            $sislo_loterica_model->set('bairro', $this->request
                            ->getPost('bairro'));
            $sislo_loterica_model->set('cidade', $this->request
                            ->getPost('cidade'));
            $sislo_loterica_model->set('uf', $this->request->getPost('uf'));
            $sislo_loterica_model->set('tel1', $this->request->getPost('tel1'));
            $sislo_loterica_model->set('tel2', $this->request->getPost('tel2'));
            $sislo_loterica_model->set('tel3', $this->request->getPost('tel3'));
            $sislo_loterica_model->set('whatsapp', $this->request
                            ->getPost('whatsapp'));
            $sislo_loterica_model->set('email', $this
                    ->request->getPost('email'));
            $sislo_loterica_model->set('data_ultima_alteracao',
                    date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                $sislo_loterica_model->set('sislo_status', 1);
                if ($sislo_loterica_model->insert() == true) {
                    $sucesso = 1;
                    $empresa_login->set('cod_loterico', $this->request
                                    ->getPost('cod_loterico'));
                    $empresa_login->set('pass', sha1("102030", false));
                    $empresa_login->set('status', 1);
                    $empresa_login->set('data_ultima_alteracao',
                            date('Y-m-d H:i:s'));
                    $empresa_login->insert();
                } else {
                    $sucesso = 0;
                }
                echo $sucesso;
            } else {
                $sislo_loterica_model->set('sislo_status', $this->request
                                ->getPost('sislo_status'));
                $sislo_loterica_model->where('idsislo_loterica_empresa',
                        $this->request->getPost('idsislo_loterica_empresa'));
                echo $sislo_loterica_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('sislo');
        }
    }
}
