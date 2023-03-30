<?php

namespace App\Controllers;

class Sislo_PEC extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_pec.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_pec', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function carrega_pec() {
        $db = \Config\Database::connect();
        $builder = $db->table('sislo_pec as pec');
        $query = $builder
                        ->select("pec.idsislo_pec as idsislo_pec,tipo_pec.tipo as tipo_de_pec, op_entrada.tipo as operacao_entrada, pec.nome_convenio as nome_convenio, pec.convenio as convenio,pec_destinacao.tipo as destinacao, pec_identificador.tipo as identificador")
                        ->join("sislo_tipo_pec as tipo_pec", "pec.id_sislo_tipo_pec = tipo_pec.idsislo_tipo_pec", "inner")
                        ->join("sislo_op_entrada as op_entrada", "pec.id_sislo_op_entrada = op_entrada.idsislo_op_entrada", "inner")
                        ->join("sislo_pec_destinacao as pec_destinacao", "pec.id_sislo_pec_destinacao = pec_destinacao.idsislo_pec_destinacao", "inner")
                        ->join("sislo_pec_identificador as pec_identificador", "pec.id_sislo_pec_identificador = pec_identificador.idsislo_pec_identificador", "inner")
                        ->where("pec.status", 1)
                        ->orderBy('pec.id_sislo_tipo_pec', 'asc')->get();
        return $query;
    }

    public function ajax_list() {
        if ($this->request->isAJAX()) {
            $sislo = $this->carrega_pec()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->tipo_de_pec;                
                $row[] = $value->nome_convenio;
                $row[] = $value->convenio;                
                $row[] = $value->identificador;
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_pec/?id=' . $value->idsislo_pec) . '">Editar</a>';
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

    public function redireciona() {//arrumar fazer as views e routes
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_PECModel;
            $sislo_op_entrada = new \App\Models\Sislo_OPEntradaModel;
            $sislo_tipo_pec = new \App\Models\Sislo_TipoPECModel;
            $sislo_destinacao = new \App\Models\Sislo_PECDestinacaoModel;
            $sislo_identificador = new \App\Models\Sislo_PECIdentificadorModel;
            $entrada = $sislo_op_entrada->where('status', 1)->orderBy('tipo', 'asc')->findAll();
            $tipo_pec = $sislo_tipo_pec->where('status', 1)->orderBy('tipo', 'asc')->findAll();
            $destinacao = $sislo_destinacao->where('status', 1)->orderBy('tipo', 'asc')->findAll();
            $identificador = $sislo_identificador->where('status', 1)->orderBy('tipo', 'asc')->findAll();
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['idsislo_pec'] = '';
                $dados['id_sislo_tipo_pec'] = '';
                $dados['id_sislo_op_entrada'] = '';
                $dados['nome_convenio'] = '';
                $dados['convenio'] = '';
                $dados['id_sislo_pec_destinacao'] = '';
                $dados['id_sislo_pec_identificador'] = '';
                $dados['vigencia'] = '';
                $dados['status'] = '1';
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_model->find($this->request->getGet('id'));
                $dados['idsislo_pec'] = $dados_loterica->idsislo_pec;
                $dados['id_sislo_tipo_pec'] = $dados_loterica->id_sislo_tipo_pec;
                $dados['id_sislo_op_entrada'] = $dados_loterica->id_sislo_op_entrada;
                $dados['nome_convenio'] = $dados_loterica->nome_convenio;
                $dados['convenio'] = $dados_loterica->convenio;
                $dados['id_sislo_pec_destinacao'] = $dados_loterica->id_sislo_pec_destinacao;
                $dados['id_sislo_pec_identificador'] = $dados_loterica->id_sislo_pec_identificador;
                $dados['vigencia'] = $dados_loterica->vigencia;
                $dados['status'] = $dados_loterica->status;
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_pec_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "entrada" => $entrada,
                "tipo_pec" => $tipo_pec,
                "destinacao" => $destinacao,
                "identificador" => $identificador,
                "id_sislo_tipo_pec" => $dados['id_sislo_tipo_pec'],
                "id_sislo_op_entrada" => $dados['id_sislo_op_entrada'],
                "nome_convenio" => $dados['nome_convenio'],
                "convenio" => $dados['convenio'],
                "id_sislo_pec_destinacao" => $dados['id_sislo_pec_destinacao'],
                "id_sislo_pec_identificador" => $dados['id_sislo_pec_identificador'],
                "vigencia" => $dados['vigencia'],
                "status" => $dados['status'],
                "idsislo_pec" => $dados['idsislo_pec']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_pec_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_PECModel();
            $sislo_model->set('id_sislo_tipo_pec', $this->request->getPost('id_sislo_tipo_pec'));
            $sislo_model->set('id_sislo_op_entrada', $this->request->getPost('id_sislo_op_entrada'));
            $sislo_model->set('nome_convenio', $this->request->getPost('nome_convenio'));
            $sislo_model->set('convenio', $this->request->getPost('convenio'));
            $sislo_model->set('id_sislo_pec_destinacao', $this->request->getPost('id_sislo_pec_destinacao'));
            $sislo_model->set('id_sislo_pec_identificador', $this->request->getPost('id_sislo_pec_identificador'));
            $sislo_model->set('vigencia', $this->request->getPost('vigencia'));
            $sislo_model->set('status', $this->request->getPost('status'));
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('idsislo_pec', $this->request->getPost('idsislo_pec'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

}
