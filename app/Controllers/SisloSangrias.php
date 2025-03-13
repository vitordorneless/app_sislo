<?php

namespace App\Controllers;

class SisloSangrias extends BaseController {

    public function index() {
        
        if ($this->session->get('user_id')) {
            $sislo_sangriaspagar = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_sangriaspagar->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_sangrias.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_sangrias', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function carrega_sangrias() {
        $db = \Config\Database::connect();
        $coleta = $this->request->getPost('coleta');
        $builder = $db->table('sislo_sangria as ss');
        $query = $builder->select("ss.data_registro AS data_registro, ss.data_coleta AS data_coleta,
                                    sf.nome AS nome, st.caixa_numero AS caixa_numero,
                                    ss.num_controle AS num_controle, ss.valor AS valor, ss.idsislo_sangria AS idsislo_sangria")                
                ->join("sislo_funcionarios as sf", "sf.idsislo_funcionarios = ss.caixa_operador", "inner")
                ->join("sislo_tfl as st", "st.idsislo_tfl = ss.idsislo_tfl", "inner")
                ->where("ss.data_coleta", $coleta)
                ->where("ss.cod_loterico", $this->session->get('cod_lot'))
                ->orderBy('ss.data_coleta', 'asc')
                ->orderBy('st.caixa_numero', 'asc')
                ->orderBy('ss.valor', 'asc')
                ->get();
        return $query;
    }

    public function ajax_list_sangria() {
        if ($this->request->isAJAX()) {
            $sislo_sangrias = $this->carrega_sangrias()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            $soma = array();
            foreach ($sislo_sangrias as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $this->formataDataParaDatatable($value->data_registro);
                $row[] = $this->formataDataParaDatatable($value->data_coleta);
                $row[] = $value->nome;
                $row[] = $value->caixa_numero;
                $row[] = $value->num_controle;
                $row[] = $this->formataValoresMonetarios($value->valor);
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_sangria/?id=' . $value->idsislo_sangria) . '">Editar</a>';
                ++$tt;
                ++$tb;
                $data[] = $row;
                $soma[] = $value->valor;
                unset($row);
            }
            $json = array(
                "recordsTotal" => $tb,
                "recordsFiltered" => $tb,
                "sominha" => number_format(array_sum($soma), 2, ',', '.'),
                "data" => $data
            );
            echo json_encode($json);
        } else {
            echo view('login');
        }
    }

    public function redireciona_sangria() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_sangria = new \App\Models\Sislo_SangriaModel;
            $sislo_operador = new \App\Models\Sislo_FuncionariosModel;
            $operadores = $sislo_operador->where('cod_loterico', $this->session->get('cod_lot'))->where('status', 1)->orderBy('nome', 'asc')->findAll();
            $sislo_tfl = new \App\Models\Sislo_TflModel;
            $tfls = $sislo_tfl->where('cod_loterico', $this->session->get('cod_lot'))->where('status', 1)->orderBy('caixa_numero', 'asc')->findAll();
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['idsislo_sangria'] = '';
                $dados['cod_loterico'] = $this->session->get('cod_lot');
                $dados['data_registro'] = '';
                $dados['data_coleta'] = '';
                $dados['caixa_operador'] = '';
                $dados['idsislo_tfl'] = '';
                $dados['valor'] = '';
                $dados['num_controle'] = '';
                $dados['numerario_02'] = '';
                $dados['numerario_05'] = '';
                $dados['numerario_10'] = '';
                $dados['numerario_20'] = '';
                $dados['numerario_50'] = '';
                $dados['numerario_100'] = '';
                $dados['numerario_200'] = '';
            } else {
                $incluir = 2;
                $dados_sangrias = $sislo_sangria->find($this->request->getGet('id'));
                $dados['idsislo_sangria'] = $dados_sangrias->idsislo_sangria;
                $dados['cod_loterico'] = $dados_sangrias->cod_loterico;
                $dados['data_registro'] = $dados_sangrias->data_registro;
                $dados['data_coleta'] = $dados_sangrias->data_coleta;
                $dados['caixa_operador'] = $dados_sangrias->caixa_operador;
                $dados['idsislo_tfl'] = $dados_sangrias->idsislo_tfl;
                $dados['valor'] = $dados_sangrias->valor;
                $dados['num_controle'] = $dados_sangrias->num_controle;
                $dados['numerario_02'] = $dados_sangrias->numerario_02;
                $dados['numerario_05'] = $dados_sangrias->numerario_05;
                $dados['numerario_10'] = $dados_sangrias->numerario_10;
                $dados['numerario_20'] = $dados_sangrias->numerario_20;
                $dados['numerario_50'] = $dados_sangrias->numerario_50;
                $dados['numerario_100'] = $dados_sangrias->numerario_100;
                $dados['numerario_200'] = $dados_sangrias->numerario_200;
                unset($dados_sangrias);
            }
            $data = array(
                "scripts" => array(
                    "sislo_sangrias_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "operadores" => $operadores,
                "tfls" => $tfls,
                "incluir" => $incluir,
                "idsislo_sangria" => $dados['idsislo_sangria'],
                "cod_loterico" => $dados['cod_loterico'],
                "data_registro" => $dados['data_registro'],
                "data_coleta" => $dados['data_coleta'],
                "caixa_operador" => $dados['caixa_operador'],
                "idsislo_tfl" => $dados['idsislo_tfl'],
                "valor" => str_replace('.', '', $dados['valor']),
                "num_controle" => $dados['num_controle'],
                "numerario_02" => $dados['numerario_02'],
                "numerario_05" => $dados['numerario_05'],
                "numerario_10" => $dados['numerario_10'],
                "numerario_20" => $dados['numerario_20'],
                "numerario_50" => $dados['numerario_50'],
                "numerario_100" => $dados['numerario_100'],
                "numerario_200" => $dados['numerario_200']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_sangrias_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_SangriaModel;
            $sislo_model->set('data_registro', $this->request->getPost('data_registro'));
            $sislo_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_model->set('data_coleta', $this->request->getPost('data_coleta'));
            $sislo_model->set('caixa_operador', $this->request->getPost('caixa_operador'));
            $sislo_model->set('idsislo_tfl', $this->request->getPost('idsislo_tfl'));
            $sislo_model->set('numerario_02', $this->request->getPost('numerario_02'));
            $sislo_model->set('numerario_05', $this->request->getPost('numerario_05'));
            $sislo_model->set('numerario_10', $this->request->getPost('numerario_10'));
            $sislo_model->set('numerario_20', $this->request->getPost('numerario_20'));
            $sislo_model->set('numerario_50', $this->request->getPost('numerario_50'));
            $sislo_model->set('numerario_100', $this->request->getPost('numerario_100'));
            $sislo_model->set('numerario_200', $this->request->getPost('numerario_200'));
            $sislo_model->set('valor', $this->limparValoresMonetarios($this->request->getPost('valor')));
            $sislo_model->set('num_controle', $this->request->getPost('num_controle'));
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('idsislo_sangria', $this->request->getPost('idsislo_sangria'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

}
