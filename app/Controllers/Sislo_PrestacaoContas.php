<?php

namespace App\Controllers;

class Sislo_PrestacaoContas extends BaseController {
//criar arquivos na view e na router
    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_contaspagar = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_contaspagar->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_prestacao_conta.js", "jquery.validate.js",
                    "sweetalert2.all.min.js", "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_prestacao_conta', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_prestacao_conta() {
        if ($this->request->isAJAX()) {
            $sislo_prestacao_conta = new \App\Models\Sislo_PrestacaoContasModel;
            $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
            $sislo_contas = $sislo_prestacao_conta->where('referencia', $referencia)->where('status', 1)->orderBy('data_transacao', 'asc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_contas as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->cod_loterico;
                $row[] = $value->referencia;
                $row[] = date("d/m/Y", strtotime($value->data_transacao));
                $row[] = $value->origem;
                $row[] = number_format($value->valor, 2, ',', '.');
                $row[] = $value->entrada_saida == 1 ? "Creditado em Conta <strong>(&plus;)</strong>" : "...";
                $row[] = $value->entrada_saida == 2 ? "Debitado em Conta <strong>(&ndash;)</strong>" : "...";
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

}
