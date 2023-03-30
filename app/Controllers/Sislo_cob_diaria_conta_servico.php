<?php

namespace App\Controllers;

class Sislo_cob_diaria_conta_servico extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_cob_diaria_conta_servico.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_cob_diaria_conta_servico', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function carrega_servicos() {
        $db = \Config\Database::connect();
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $cod_lot = $this->session->get('cod_lot');
        $builder = $db->table('sislo_cob_diaria_conta_servico as scs');
        $query = $builder->select("scs.idsislo_cob_diaria_conta_servico as idsislo_cob_diaria_conta_servico, scs.data_inicial as data_inicial, scs.data_final as data_final, sts.servico as servico, scs.quantidade as quantidade, scs.valor as valor")                
                ->join("sislo_tipo_servico as sts", "scs.id_sislo_tipo_servico = sts.idsislo_tipo_servico", "inner")
                ->where("scs.referencia", $referencia)
                ->where("scs.cod_loterico", $cod_lot)                
                ->orderBy('scs.data_inicial', 'asc')
                ->get();
        return $query;
    }

    public function redireciona_cob_servicos() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_tipos = new \App\Models\Sislo_Tipo_ServicoModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $tipos = $sislo_tipos->where('status', 1)->orderBy('servico', 'asc')->findAll();
            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['cod_loterico'] = $this->session->get('cod_lot');

                $data = array(
                    "scripts" => array(
                        "sislo_cob_diaria_conta_servico_crud.js",
                        "sweetalert2.all.min.js",
                        "jquery.validate.js",
                        "jquery.mask.min.js",
                        "jquery.maskMoney.min.js",
                        "util.js"
                    ),
                    "user_name" => $dadosuser->sislo_nome,
                    "tipos" => $tipos,
                    "cod_loterico" => $this->session->get('cod_lot'),
                    "incluir" => $incluir
                );

                echo view('template/header', $data);
                echo view('template/menu');
                echo view('template/content');
                echo view('sislo_cob_diaria_conta_servico_crud', $data);
                echo view('template/footer', $data);
                echo view('template/scripts', $data);
            } else {
                $incluir = 2;
            }
        } else {
            echo view('login');
        }
    }

    public function ajax_list_servicos() {//fazer o redireciona FAZER o formulario para incluir, form para editar
        if ($this->request->isAJAX()) {
            $sislo_list_servicos = $this->carrega_servicos()->getResult();            
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_list_servicos as $value) {
                $row = array();
                $row[] = $this->formataDataParaDatatable($value->data_inicial);
                $row[] = $this->formataDataParaDatatable($value->data_final);
                $row[] = trim($value->servico);                
                $row[] = trim($value->quantidade);
                $row[] = $this->formataValoresMonetarios($value->valor);
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_cob_servicos/?id=' . $value->idsislo_cob_diaria_conta_servico) . '">Editar</a>';
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
            $cob_diaria_conta_model = new \App\Models\Sislo_cob_diaria_conta_servicoModel;
            $datas = array();
            $datas['referencia'] = $this->request->getPost('referencia');
            $datas['data_inicial'] = $this->request->getPost('data_inicial');
            $datas['data_final'] = $this->request->getPost('data_final');
            $datas['cod_loterico'] = $this->request->getPost('cod_loterico');
            $datas['quantidade'] = $this->request->getPost('quantidade');
            $datas['valor'] = $this->request->getPost('valor');
            $datas['data_ultima_alteracao'] = date('Y-m-d H:i:s');
            $datas['id_sislo_tipo_servico'] = $this->request->getPost('id_sislo_tipo_servico');
            $insert = $insertprestacao = [];
            $i = 0;
            foreach ($datas['id_sislo_tipo_servico'] as $value) {
                $conjunto = [
                    'cod_loterico' => $datas['cod_loterico'],
                    'referencia' => $datas['referencia'],
                    'data_inicial' => $datas['data_inicial'],
                    'data_final' => $datas['data_final'],
                    'id_sislo_tipo_servico' => $value,
                    'quantidade' => $datas['quantidade'][$i],
                    'valor' => $this->limparValoresMonetarios($datas['valor'][$i]),
                    'data_ultima_alteracao' => $datas['data_ultima_alteracao']
                ];
                switch ($value) {
                    case 1:
                        $entrada_saida = 1;
                        break;
                    case 2:
                        $entrada_saida = 2;
                        break;
                    case 3:
                        $entrada_saida = 2;
                        break;
                    case 4:
                        $conjunto_prestacao = [
                            'cod_loterico' => $datas['cod_loterico'],
                            'referencia' => $datas['referencia'],
                            'data_transacao' => date('Y-m-d H:i:s'),
                            'origem' => 'Cobrança Diária Serviços',
                            'valor' => $this->limparValoresMonetarios($datas['valor'][$i]),
                            'entrada_saida' => 1,
                            'status' => 1,
                            'data_ultima_alteracao' => $datas['data_ultima_alteracao']
                        ];
                        array_push($insertprestacao, $conjunto_prestacao);
                        unset($conjunto_prestacao);
                        $entrada_saida = 2;
                        break;
                    case 5:
                        $entrada_saida = 2;
                        break;
                }

                $conjunto_prestacao = [
                    'cod_loterico' => $datas['cod_loterico'],
                    'referencia' => $datas['referencia'],
                    'data_transacao' => date('Y-m-d H:i:s'),
                    'origem' => 'Cobrança Diária Serviços',
                    'valor' => $this->limparValoresMonetarios($datas['valor'][$i]),
                    'entrada_saida' => $entrada_saida,
                    'status' => 1,
                    'data_ultima_alteracao' => $datas['data_ultima_alteracao']
                ];
                array_push($insert, $conjunto);
                array_push($insertprestacao, $conjunto_prestacao);
                unset($conjunto);
                unset($conjunto_prestacao);
                ++$i;
            }

            if ($this->request->getPost('incluir') == '1') {
                $entrou = $cob_diaria_conta_model->insertBatch($insert) == true ? 1 : 0;
                $sislo_contacorrente_model = new \App\Models\Sislo_PrestacaoContasModel;
                $sislo_contacorrente_model->insertBatch($insertprestacao);
                echo $entrou;
            } else {//este else trabalhar emcima do editar que vai ser criado
                //$sislo_contaspagar_model->where('idsislo_contas_pagar', $this->request->getPost('idsislo_contas_pagar'));
                echo $entrou;
            }
        } else {
            echo view('login');
        }
    }

}
