<?php

namespace App\Controllers;

class Sislo_MovimentacaoEstoque extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_movimentacao_estoque.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_movimentacao_estoque', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function carrega() {
        $db = \Config\Database::connect();
        $builder = $db->table('sislo_estoque as mj');
        $query = $builder->select("mj.id_sislo_item_estoque,mj.id_sislo_estoque as id_sislo_estoque,IFNULL(SUM(mj.quantidade),0) as quantidade,IFNULL(SUM(stsm.quantidade_saida),0) as quantidade_saida,sts.item as item")
                        ->join("sislo_item_estoque as sts", "mj.id_sislo_item_estoque = sts.id_sislo_item_estoque", "inner")
                        ->join("sislo_estoque_movimentacao as stsm", "mj.id_sislo_item_estoque = stsm.id_sislo_item_estoque", "left")
                        ->where("mj.cod_loterico", $this->session->get('cod_lot'))
                        ->where('mj.status', 1)
                        ->groupBy('mj.quantidade,stsm.quantidade_saida')
                        ->orderBy('mj.quantidade', 'DESC')->get();
        return $query;
    }

    public function ajax_list_movimentacao_estoque() {
        if ($this->request->isAJAX()) {
            $sislo = $this->carrega()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->item;
                $row[] = $value->quantidade;
                $row[] = $value->quantidade_saida;
                $row[] = bcsub($value->quantidade, $value->quantidade_saida, 0);
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_movimentacao_estoque/?id=' . $value->id_sislo_item_estoque) . '">Movimentar</a>';
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

    public function redireciona_movimentacao_estoque() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_item_estoque_model = new \App\Models\Sislo_ItemEstoqueModel;
            $sislo_tfl = new \App\Models\Sislo_TflModel;
            $tfl = $sislo_tfl->where('cod_loterico', $this->session->get('cod_lot'))->where('status', 1)->orderBy('terminal', 'asc')->findAll();
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $item = $sislo_item_estoque_model->where('id_sislo_item_estoque', $this->request->getGet('id'))->where('cod_loterico', $this->session->get('cod_lot'))->where('status', 1)->orderBy('item', 'asc')->findAll();

            $dados = array();
            $incluir = 1;
            $dados['id_sislo_item_estoque'] = $this->request->getGet('id');

            $data = array(
                "scripts" => array(
                    "sislo_movimentacao_estoque_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "item" => $item,
                "cod_loterico" => $this->session->get('cod_lot'),
                "tfl_list" => $tfl,
                "id_sislo_item_estoque" => $dados['id_sislo_item_estoque']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_movimentacao_estoque_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_EstoqueMovimentacaoModel();
            $sislo_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_model->set('id_sislo_item_estoque', $this->request->getPost('id_sislo_item_estoque'));
            $sislo_model->set('quantidade_saida', $this->request->getPost('quantidade_saida'));
            $sislo_model->set('id_sislo_tfl', $this->request->getPost('id_sislo_tfl'));
            $sislo_model->set('externo', $this->request->getPost('externo'));
            $sislo_model->set('status', 1);
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }
}
