<?php

namespace App\Controllers;

class Sislo_LoteriaFederal extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_loteria_federal.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_loteria_federal', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_loteria_federal() {
        if ($this->request->isAJAX()) {
            $cod_lot = $this->session->get('cod_lot');
            $sislo_jogos_cef_model = new \App\Models\Sislo_LoteriaFederalModel;
            $sislo = $sislo_jogos_cef_model->where("cod_lot", $cod_lot)->orderBy('extracao', 'desc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable

            foreach ($sislo as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->extracao;
                $row[] = $value->total_bilhetes_recibo;
                $row[] = $this->formataValoresMonetarios($value->preco_plano);
                $row[] = $this->formataValoresMonetarios($value->valor_bruto_recibo);
                $row[] = $this->formataValoresMonetarios($value->valor_liquido_recibo);
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_loteria_federal/?id=' . $value->id) . '">Editar</a>';
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

    public function redireciona_loteria_federal() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_LoteriaFederalModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['id'] = '';
                $dados['modalidade'] = '';
                $dados['total_bilhetes_recibo'] = '';
                $dados['total_bilhetes_liquido'] = '';
                $dados['extracao'] = '';
                $dados['data_extracao'] = '';
                $dados['preco_plano'] = '';
                $dados['valor_bruto_recibo'] = '';
                $dados['valor_bruto_liquido'] = '';
                $dados['comissao_recibo'] = '0';
                $dados['valor_liquido_recibo'] = '';
                $dados['valor_liquido_real'] = '';
                $dados['lote'] = '';
                $dados['caixa'] = '';
                $dados['quantidade_encalhe'] = '';
                $dados['status'] = '';
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_model->find($this->request->getGet('id'));
                $dados['id'] = $dados_loterica->idsislo_loteria_federal;
                $dados['modalidade'] = $dados_loterica->modalidade;
                $dados['total_bilhetes_recibo'] = $dados_loterica->total_bilhetes_recibo;
                $dados['total_bilhetes_liquido'] = $dados_loterica->total_bilhetes_liquido;
                $dados['extracao'] = $dados_loterica->extracao;
                $dados['data_extracao'] = $dados_loterica->data_extracao;
                $dados['preco_plano'] = $dados_loterica->preco_plano;
                $dados['valor_bruto_recibo'] = $dados_loterica->valor_bruto_recibo;
                $dados['valor_bruto_liquido'] = $dados_loterica->valor_bruto_liquido;
                $dados['comissao_recibo'] = $dados_loterica->comissao_recibo;
                $dados['valor_liquido_recibo'] = $dados_loterica->valor_liquido_recibo;
                $dados['valor_liquido_real'] = $dados_loterica->valor_liquido_real;
                $dados['lote'] = $dados_loterica->lote;
                $dados['caixa'] = $dados_loterica->caixa;
                $dados['quantidade_encalhe'] = $dados_loterica->quantidade_encalhe;
                $dados['status'] = $dados_loterica->status;
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_loteria_federal_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "cod_loterico" => $this->session->get('cod_lot'),
                "incluir" => $incluir,
                "id" => $dados['id'],
                "modalidade" => $dados['modalidade'],
                "total_bilhetes_recibo" => $dados['total_bilhetes_recibo'],
                "total_bilhetes_liquido" => $dados['total_bilhetes_liquido'],
                "extracao" => $dados['extracao'],
                "data_extracao" => $dados['data_extracao'],
                "preco_plano" => $dados['preco_plano'],
                "valor_bruto_recibo" => $dados['valor_bruto_recibo'],
                "valor_bruto_liquido" => $dados['valor_bruto_liquido'],
                "comissao_recibo" => $dados['comissao_recibo'],
                "valor_liquido_recibo" => $dados['valor_liquido_recibo'],
                "valor_liquido_real" => $dados['valor_liquido_real'],
                "lote" => $dados['lote'],
                "caixa" => $dados['caixa'],
                "quantidade_encalhe" => $dados['quantidade_encalhe'],
                "status" => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_loteria_federal_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_LoteriaFederalModel;
            $sislo_model->set('cod_lot', $this->request->getPost('cod_loterico'));
            $sislo_model->set('modalidade', $this->request->getPost('modalidade'));
            $sislo_model->set('total_bilhetes_recibo', $this->request->getPost('total_bilhetes_recibo'));
            $sislo_model->set('total_bilhetes_liquido', $this->request->getPost('total_bilhetes_liquido'));
            $sislo_model->set('extracao', $this->request->getPost('extracao'));
            $sislo_model->set('data_extracao', $this->request->getPost('data_extracao'));
            $sislo_model->set('preco_plano', $this->limparValoresMonetarios($this->request->getPost('preco_plano')));
            $sislo_model->set('valor_bruto_recibo', $this->limparValoresMonetarios($this->request->getPost('valor_bruto_recibo')));
            $sislo_model->set('valor_bruto_liquido', $this->limparValoresMonetarios($this->request->getPost('valor_bruto_liquido')));
            $sislo_model->set('comissao_recibo', $this->limparValoresMonetarios($this->request->getPost('comissao_recibo')));
            $sislo_model->set('valor_liquido_recibo', $this->limparValoresMonetarios($this->request->getPost('valor_liquido_recibo')));
            $sislo_model->set('valor_liquido_real', $this->limparValoresMonetarios($this->request->getPost('valor_liquido_real')));
            $sislo_model->set('lote', $this->request->getPost('lote'));
            $sislo_model->set('caixa', $this->request->getPost('caixa'));
            $sislo_model->set('quantidade_encalhe', $this->request->getPost('quantidade_encalhe'));
            $sislo_model->set('status', $this->request->getPost('status'));
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('id', $this->request->getPost('id'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

}
