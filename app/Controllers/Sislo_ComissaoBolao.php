<?php

namespace App\Controllers;

class Sislo_ComissaoBolao extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_comissao_bolao.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_comissao_bolao', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function situacao_boloes() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "situacao_boloes.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('situacao_boloes', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function redireciona_comissao_jogosbolao() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_jogos = new \App\Models\SisloJogosCefModel;
            $jogos = $sislo_jogos->where('status', 1)->orderBy('nome', 'asc')->findAll();
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['cod_loterico'] = $this->session->get('cod_lot');

                $data = array(
                    "scripts" => array(
                        "sislo_comissao_bolao_crud.js",
                        "sweetalert2.all.min.js",
                        "jquery.validate.js",
                        "jquery.mask.min.js",
                        "jquery.maskMoney.min.js",
                        "util.js"
                    ),
                    "user_name" => $dadosuser->sislo_nome,
                    "jogos" => $jogos,
                    "cod_loterico" => $this->session->get('cod_lot'),
                    "incluir" => $incluir
                );

                echo view('template/header', $data);
                echo view('template/menu');
                echo view('template/content');
                echo view('sislo_comissao_bolao_crud', $data);
                echo view('template/footer', $data);
                echo view('template/scripts', $data);
            } else {
                $incluir = 2;
            }
        } else {
            echo view('login');
        }
    }

    public function carrega_comissoes_boloes() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $builder = $db->table('sislo_comissao_bolao as scs');
        $query = $builder->select("scs.idsislo_comissao_bolao as idsislo_comissao_bolao, "
                        . "sts.nome as nome, scs.cotas as cotas, scs.valor_bolao as valor_bolao, "
                        . "scs.valor_tarifa as valor_tarifa, scs.tarifa as tarifa, scs.dia_inicial as dia_inicial")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")
                ->where('MONTH(scs.dia_inicial)', $this->request->getPost('mes'))
                ->where('YEAR(scs.dia_inicial)', $this->request->getPost('ano'))
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->orderBy('scs.dia_inicial', 'asc')
                ->get();
        return $query;
    }

    public function carrega_ajax_table_sislo_situacao_boloes() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $builder = $db->table('sislo_comissao_bolao as scs');
        $query = $builder->select("scs.dia_inicial as dia_inicial, sts.nome as nome, SUM(scs.cotas) as cotas, SUM(scs.valor_tarifa) as valor_tarifa ")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef ", "inner ")
                ->where('MONTH(scs.dia_inicial)', $this->request->getPost('mes'))
                ->where('YEAR(scs.dia_inicial)', $this->request->getPost('ano'))
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->groupBy('scs.id_sislo_jogos_cef')
                ->orderBy('scs.dia_inicial', 'asc')
                ->get();
        return $query;
    }

    public function ajax_table_sislo_situacao_boloes() {
        if ($this->request->isAJAX()) {
            $sislo_comissao = $this->carrega_ajax_table_sislo_situacao_boloes()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_comissao as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $this->formataDataParaDatatable($value->dia_inicial);
                $row[] = $value->nome;
                $row[] = trim($value->cotas);
                $row[] = $this->formataValoresMonetarios($value->valor_tarifa);
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

    public function ajax_list_comissao_bolao() {//fazer o redireciona FAZER o formulario para incluir, form para editar
        if ($this->request->isAJAX()) {
            $sislo_comissao = $this->carrega_comissoes_boloes()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_comissao as $value) {
                $row = array();
                $row[] = $this->formataDataParaDatatable($value->dia_inicial);
                $row[] = $value->nome;
                $row[] = trim($value->cotas);
                $row[] = $this->formataValoresMonetarios($value->valor_bolao);
                $row[] = $this->formataValoresMonetarios($value->valor_tarifa);
                $row[] = $value->tarifa;
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_comissao_jogosbolao/?id=' . $value->idsislo_comissao_bolao) . '">Editar</a>';
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
            $cob = new \App\Models\Sislo_ComissaoBolaoModel;
            $datas = array();
            $datas['cod_loterico'] = $this->request->getPost('cod_loterico');
            $datas['dia_inicial'] = $this->request->getPost('dia_inicial');
            $datas['id_sislo_jogos_cef'] = $this->request->getPost('id_sislo_jogos_cef');
            $datas['cotas'] = $this->request->getPost('cotas');
            $datas['valor_bolao'] = $this->request->getPost('valor_bolao');
            $datas['tarifa'] = $this->request->getPost('tarifa');
            $datas['valor_tarifa'] = $this->request->getPost('valor_tarifa');
            $datas['status'] = 1;
            $datas['data_ultima_alteracao'] = date('Y-m-d H:i:s');
            $insert = array();
            $i = 0;
            foreach ($datas['id_sislo_jogos_cef'] as $value) {
                $conjunto = [
                    'cod_loterico' => $datas['cod_loterico'],
                    'dia_inicial' => $datas['dia_inicial'],
                    'id_sislo_jogos_cef' => $value,
                    'cotas' => $datas['cotas'][$i],
                    'valor_bolao' => $this->limparValoresMonetarios($datas['valor_bolao'][$i]),
                    'tarifa' => $this->limparValoresMonetarios($datas['tarifa'][$i]),
                    'valor_tarifa' => $this->limparValoresMonetarios($datas['valor_tarifa'][$i]),
                    'status' => $datas['status'],
                    'data_ultima_alteracao' => $datas['data_ultima_alteracao']
                ];
                array_push($insert, $conjunto);
                unset($conjunto);
                ++$i;
            }

            if ($this->request->getPost('incluir') == '1') {
                $entrou = $cob->insertBatch($insert) == true ? 1 : 0;
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
