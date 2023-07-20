<?php

namespace App\Controllers;

class Sislo_Estoque extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_estoque.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_estoque', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function carrega() {
        $db = \Config\Database::connect();
        $builder = $db->table('sislo_estoque as mj');
        $query = $builder->select("mj.id_sislo_estoque as id_sislo_estoque,mj.quantidade as quantidade,sts.item as item, mj.data_entrada as data_entrada, mj.status as status")
                        ->join("sislo_item_estoque as sts", "mj.id_sislo_item_estoque = sts.id_sislo_item_estoque", "inner")                        
                        ->where("mj.cod_loterico", $this->session->get('cod_lot'))
                        ->where('mj.status', 1)
                        ->orderBy('mj.data_ultima_alteracao', 'DESC')->get();
        return $query;
    }

    public function ajax_list_estoque() {
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
                $row[] = date("d/m/Y", strtotime($value->data_entrada));
                $row[] = $value->status == 1 ? "Ativo" : "Inativo";
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_estoque/?id=' . $value->id_sislo_estoque) . '">Editar</a>';
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

    public function redireciona_estoque() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_estoque_model = new \App\Models\Sislo_ItemEstoqueModel;
            $sislo_model = new \App\Models\Sislo_EstoqueModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $itens = $sislo_estoque_model->where('cod_loterico', $this->session->get('cod_lot'))->where('status', 1)->orderBy('item', 'asc')->findAll();

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['id_sislo_estoque'] = '';
                $dados['id_sislo_item_estoque'] = '';
                $dados['quantidade'] = '';
                $dados['data_entrada'] = '';
                $dados['status'] = '';
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_model->find($this->request->getGet('id'));
                $dados['id_sislo_estoque'] = $dados_loterica->id_sislo_estoque;
                $dados['id_sislo_item_estoque'] = $dados_loterica->id_sislo_item_estoque;
                $dados['quantidade'] = $dados_loterica->quantidade;
                $dados['data_entrada'] = $dados_loterica->data_entrada;
                $dados['status'] = $dados_loterica->status;
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_estoque_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "itens" => $itens,
                "cod_loterico" => $this->session->get('cod_lot'),
                "id_sislo_item_estoque" => $dados['id_sislo_item_estoque'],
                "id_sislo_estoque" => $dados['id_sislo_estoque'],
                "quantidade" => $dados['quantidade'],
                "data_entrada" => $dados['data_entrada'],
                "status" => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_estoque_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_EstoqueModel();
            $sislo_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_model->set('id_sislo_item_estoque', $this->request->getPost('id_sislo_item_estoque'));
            $sislo_model->set('quantidade', $this->request->getPost('quantidade'));
            $sislo_model->set('data_entrada', $this->request->getPost('data_entrada'));
            $sislo_model->set('status', $this->request->getPost('status'));
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('id_sislo_estoque', $this->request->getPost('id_sislo_estoque'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }
}
