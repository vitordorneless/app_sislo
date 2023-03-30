<?php

namespace App\Controllers;

//use CodeIgniter\I18n\Time;

class Sislo_ContasPagar extends BaseController {

    public function index() {

        if ($this->session->get('user_id')) {
            $sislo_contaspagar = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_contaspagar->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_contas_pagar.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome,
                "cod_lot" => $result->sislo_id_loterica
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_contaspagar', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function carrega_fornecedores() {
        $db = \Config\Database::connect();
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_contas_pagar as scp');
        $query = $builder->select("scp.idsislo_contas_pagar as idsislo_contas_pagar, sf.nome as nome, scp.vencimento as vencimento, scp.valor_pagar as valor_pagar,scp.valor_pago as valor_pago, scp.status_pagamento as status_pagamento")
                ->join("sislo_fornecedores as sf", "sf.idsislo_fornecedores = scp.id_sislo_fornecedores", "inner")
                ->where("scp.referencia", $referencia)
                ->where("scp.cod_loterico", $this->session->get('cod_lot'))
                ->orderBy('scp.vencimento', 'asc')
                ->orderBy('sf.nome', 'asc')->get();
        return $query;
    }

    public function ajax_list_contas_pagar() {
        if ($this->request->isAJAX()) {
            $sislo_contas = $this->carrega_fornecedores()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_contas as $value) {
                $row = array();                
                $row[] = $value->nome;
                $row[] = date("d/m/Y", strtotime($value->vencimento));
                $row[] = number_format($value->valor_pagar, 2, ',', '.');
                $row[] = number_format($value->valor_pago, 2, ',', '.');
                $row[] = $value->status_pagamento == 1 ? "Pago" : "Aguarda Pagamento";
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_contas_pagar/?id=' . $value->idsislo_contas_pagar) . '">Editar</a>';
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

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $datas = array();
            $datas['valor_pagar'] = $this->request->getPost('valor_pagar');
            $datas['valor_pagar'] = str_replace('.', '', $datas['valor_pagar']);
            $datas['valor_pagar'] = str_replace(',', '.', $datas['valor_pagar']);
            $datas['descontos'] = empty($this->request->getPost('descontos')) ? 0 : $this->request->getPost('descontos');
            $datas['descontos'] = str_replace('.', '', $datas['descontos']);
            $datas['descontos'] = str_replace(',', '.', $datas['descontos']);
            $datas['juros'] = empty($this->request->getPost('juros')) ? 0 : $this->request->getPost('juros');
            $datas['juros'] = str_replace('.', '', $datas['juros']);
            $datas['juros'] = str_replace(',', '.', $datas['juros']);
            $datas['valor_pago'] = (($datas['valor_pagar'] + $datas['juros']) - ($datas['descontos']));

            $sislo_contaspagar_model = new \App\Models\Sislo_ContasPagarModel;
            $sislo_contaspagar_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_contaspagar_model->set('id_sislo_fornecedores', $this->request->getPost('id_sislo_fornecedores'));
            $sislo_contaspagar_model->set('vencimento', $this->request->getPost('vencimento'));
            $sislo_contaspagar_model->set('valor_pagar', $datas['valor_pagar']);
            $sislo_contaspagar_model->set('descontos', $datas['descontos']);
            $sislo_contaspagar_model->set('juros', $datas['juros']);
            $sislo_contaspagar_model->set('valor_pago', $datas['valor_pago']);
            $sislo_contaspagar_model->set('data_pagamento', $this->request->getPost('data_pagamento'));
            $sislo_contaspagar_model->set('status_pagamento', $this->request->getPost('status_pagamento'));
            $sislo_contaspagar_model->set('tipo_pagamento', $this->request->getPost('tipo_pagamento'));
            $sislo_contaspagar_model->set('referencia', $this->request->getPost('referencia'));
            $sislo_contaspagar_model->set('forma_pagamento', $this->request->getPost('forma_pagamento'));
            $sislo_contaspagar_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                $entrou = $sislo_contaspagar_model->insert() == true ? 1 : 0;
                if ($this->request->getPost('status_pagamento') == '1') {
                    $sislo_contacorrente_model = new \App\Models\Sislo_ContaCorrenteModel;
                    $sislo_contacorrente_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
                    $sislo_contacorrente_model->set('referencia', $this->request->getPost('referencia'));
                    $sislo_contacorrente_model->set('data_transacao', date('Y-m-d H:i:s'));
                    $sislo_contacorrente_model->set('origem', 'Contas para Pagar');
                    $sislo_contacorrente_model->set('valor', $datas['valor_pago']);
                    $sislo_contacorrente_model->set('entrada_saida', 2); //1 - entrada; 2 - saída
                    $sislo_contacorrente_model->set('status', 1);
                    $sislo_contacorrente_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                    $sislo_contacorrente_model->insert();
                }
                echo $entrou;
            } else {
                $sislo_contaspagar_model->where('idsislo_contas_pagar', $this->request->getPost('idsislo_contas_pagar'));
                $entrou = $sislo_contaspagar_model->update() == true ? 1 : 0;
                if ($this->request->getPost('status_pagamento') == '1') {
                    $sislo_contacorrente_model = new \App\Models\Sislo_ContaCorrenteModel;
                    $sislo_contacorrente_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
                    $sislo_contacorrente_model->set('referencia', $this->request->getPost('referencia'));
                    $sislo_contacorrente_model->set('data_transacao', date('Y-m-d H:i:s'));
                    $sislo_contacorrente_model->set('origem', 'Contas para Pagar');
                    $sislo_contacorrente_model->set('valor', $datas['valor_pago']);
                    $sislo_contacorrente_model->set('entrada_saida', 2); //1 - entrada; 2 - saída
                    $sislo_contacorrente_model->set('status', 1);
                    $sislo_contacorrente_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                    $sislo_contacorrente_model->insert();
                }
                echo $entrou;
            }
        } else {
            echo view('login');
        }
    }

    public function redireciona_contas_pagar() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_fornecedor = new \App\Models\Sislo_FornecedoresModel;
            $sislo_contas = new \App\Models\Sislo_ContasPagarModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $fornecedores = $sislo_fornecedor->where('cod_loterico', $this->session->get('cod_lot'))->where('status', 1)->orderBy('nome', 'asc')->findAll();
            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['idsislo_contas_pagar'] = '';
                $dados['cod_loterico'] = $this->session->get('cod_lot');
                $dados['id_sislo_fornecedores'] = '';
                $dados['vencimento'] = '';
                $dados['valor_pagar'] = '';
                $dados['descontos'] = '';
                $dados['juros'] = '';
                $dados['valor_pago'] = '';
                $dados['data_pagamento'] = '';
                $dados['status_pagamento'] = '';
                $dados['tipo_pagamento'] = '';
                $dados['referencia'] = '';
                $dados['forma_pagamento'] = '';
            } else {
                $incluir = 2;
                $dados_contas = $sislo_contas->find($this->request->getGet('id'));
                $dados['idsislo_contas_pagar'] = $dados_contas->idsislo_contas_pagar;
                $dados['cod_loterico'] = $dados_contas->cod_loterico;
                $dados['id_sislo_fornecedores'] = $dados_contas->id_sislo_fornecedores;
                $dados['vencimento'] = $dados_contas->vencimento;
                $dados['valor_pagar'] = $dados_contas->valor_pagar;
                $dados['descontos'] = $dados_contas->descontos;
                $dados['juros'] = $dados_contas->juros;
                $dados['valor_pago'] = $dados_contas->valor_pago;
                $dados['data_pagamento'] = $dados_contas->data_pagamento;
                $dados['status_pagamento'] = $dados_contas->status_pagamento;
                $dados['tipo_pagamento'] = $dados_contas->tipo_pagamento;
                $dados['referencia'] = $dados_contas->referencia;
                $dados['forma_pagamento'] = $dados_contas->forma_pagamento;
                unset($dados_contas);
            }
            $data = array(
                "scripts" => array(
                    "sislo_contaspagar_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "fornecedores" => $fornecedores,
                "incluir" => $incluir,
                "idsislo_contas_pagar" => $dados['idsislo_contas_pagar'],
                "cod_loterico" => $dados['cod_loterico'],
                "id_sislo_fornecedores" => $dados['id_sislo_fornecedores'],
                "vencimento" => $dados['vencimento'],                
                "valor_pagar" => str_replace('.', '', $dados['valor_pagar']),
                "descontos" => str_replace('.', '', $dados['descontos']),
                "juros" => str_replace('.', '', $dados['juros']),
                "valor_pago" => $dados['valor_pago'],
                "data_pagamento" => $dados['data_pagamento'],
                "status_pagamento" => $dados['status_pagamento'],
                "tipo_pagamento" => $dados['tipo_pagamento'],
                "referencia" => $dados['referencia'],
                "forma_pagamento" => $dados['forma_pagamento']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_contaspagar_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

}
