<?php

namespace App\Controllers;

class Sislo_Loterica extends BaseController {

    public function index() {

        if ($this->session->get('user_id')) {
            $sislo_loterica_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_loterica_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_loterica.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_loterica_list', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_lotericas() {
        if ($this->request->isAJAX()) {
            $sislo_loterica_model = new \App\Models\Sislo_LotericaModel;
            $sislo_lotericas = $sislo_loterica_model->where('sislo_status', 1)->orderBy('nome_fantasia', 'asc')->findAll();
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
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_loterica/?id=' . $value->idsislo_loterica) . '">Editar</a>';
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

    public function redireciona_loterica() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_loterica_model = new \App\Models\Sislo_LotericaModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['razao_social'] = '';
                $dados['idsislo_loterica'] = '';
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
                $dados['agencia_cc'] = '';
                $dados['conta_corrente'] = '';
                $dados['cc_prestacao'] = '';
                $dados['tel_agencia'] = '';
                $dados['proprietario_user'] = '';
                $dados['proprietario_pass'] = '';
                $dados['expresso_login'] = '';
                $dados['expresso_pass'] = '';
                $dados['caixaaqui_cod'] = '';
                $dados['caixaaqui_codlot'] = '';
                $dados['caixaaqui_pass'] = '';
                $dados['sislo_status'] = '';
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_loterica_model->find($this->request->getGet('id'));
                $dados['razao_social'] = $dados_loterica->razao_social;
                $dados['idsislo_loterica'] = $dados_loterica->idsislo_loterica;
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
                $dados['agencia_cc'] = $dados_loterica->agencia_cc;
                $dados['conta_corrente'] = $dados_loterica->conta_corrente;
                $dados['cc_prestacao'] = $dados_loterica->cc_prestacao;
                $dados['tel_agencia'] = $dados_loterica->tel_agencia;
                $dados['proprietario_user'] = $dados_loterica->proprietario_user;
                $dados['proprietario_pass'] = $dados_loterica->proprietario_pass;
                $dados['expresso_login'] = $dados_loterica->expresso_login;
                $dados['expresso_pass'] = $dados_loterica->expresso_pass;
                $dados['caixaaqui_cod'] = $dados_loterica->caixaaqui_cod;
                $dados['caixaaqui_codlot'] = $dados_loterica->caixaaqui_codlot;
                $dados['caixaaqui_pass'] = $dados_loterica->caixaaqui_pass;
                $dados['sislo_status'] = $dados_loterica->sislo_status;
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_loterica_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "razao_social" => $dados['razao_social'],
                "idsislo_loterica" => $dados['idsislo_loterica'],
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
                "agencia_cc" => $dados['agencia_cc'],
                "conta_corrente" => $dados['conta_corrente'],
                "cc_prestacao" => $dados['cc_prestacao'],
                "tel_agencia" => $dados['tel_agencia'],
                "proprietario_user" => $dados['proprietario_user'],
                "proprietario_pass" => $dados['proprietario_pass'],
                "expresso_login" => $dados['expresso_login'],
                "expresso_pass" => $dados['expresso_pass'],
                "caixaaqui_cod" => $dados['caixaaqui_cod'],
                "caixaaqui_codlot" => $dados['caixaaqui_codlot'],
                "caixaaqui_pass" => $dados['caixaaqui_pass'],
                "sislo_status" => $dados['sislo_status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_loterica_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_loterica_model = new \App\Models\Sislo_LotericaModel;            
            
            $sislo_loterica_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_loterica_model->set('nome_fantasia', $this->request->getPost('nome_fantasia'));
            $sislo_loterica_model->set('razao_social', $this->request->getPost('razao_social'));
            $sislo_loterica_model->set('cnpj', $this->request->getPost('cnpj'));
            $sislo_loterica_model->set('logradouro', $this->request->getPost('logradouro'));
            $sislo_loterica_model->set('numero', $this->request->getPost('numero'));
            $sislo_loterica_model->set('complemento', $this->request->getPost('complemento'));
            $sislo_loterica_model->set('cep', $this->request->getPost('cep'));
            $sislo_loterica_model->set('bairro', $this->request->getPost('bairro'));
            $sislo_loterica_model->set('cidade', $this->request->getPost('cidade'));
            $sislo_loterica_model->set('uf', $this->request->getPost('uf'));
            $sislo_loterica_model->set('tel1', $this->request->getPost('tel1'));
            $sislo_loterica_model->set('tel2', $this->request->getPost('tel2'));
            $sislo_loterica_model->set('tel3', $this->request->getPost('tel3'));
            $sislo_loterica_model->set('whatsapp', $this->request->getPost('whatsapp'));
            $sislo_loterica_model->set('email', $this->request->getPost('email'));
            $sislo_loterica_model->set('agencia_cc', $this->request->getPost('agencia_cc'));
            $sislo_loterica_model->set('conta_corrente', $this->request->getPost('conta_corrente'));
            $sislo_loterica_model->set('cc_prestacao', $this->request->getPost('cc_prestacao'));
            $sislo_loterica_model->set('tel_agencia', $this->request->getPost('tel_agencia'));
            $sislo_loterica_model->set('proprietario_user', $this->request->getPost('proprietario_user'));
            $sislo_loterica_model->set('proprietario_pass', $this->request->getPost('proprietario_pass'));
            $sislo_loterica_model->set('expresso_login', $this->request->getPost('expresso_login'));
            $sislo_loterica_model->set('expresso_pass', $this->request->getPost('expresso_pass'));
            $sislo_loterica_model->set('caixaaqui_cod', $this->request->getPost('caixaaqui_cod'));
            $sislo_loterica_model->set('caixaaqui_codlot', $this->request->getPost('caixaaqui_codlot'));
            $sislo_loterica_model->set('caixaaqui_pass', $this->request->getPost('caixaaqui_pass'));
            $sislo_loterica_model->set('sislo_status', $this->request->getPost('sislo_status'));
            $sislo_loterica_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
            
            if ($this->request->getPost('incluir') == '1') {                
                echo $sislo_loterica_model->insert() == true ? 1 : 0;
            } else {
                $sislo_loterica_model->where('idsislo_loterica', $this->request->getPost('idsislo_loterica'));
                echo $sislo_loterica_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

}
