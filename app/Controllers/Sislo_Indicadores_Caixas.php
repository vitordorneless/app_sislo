<?php

namespace App\Controllers;

class Sislo_Indicadores_Caixas extends BaseController {

    public function index() {

        if ($this->session->get('user_id')) {
            $sislo_contaspagar = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_contaspagar->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_indicadores_caixa.js",
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
            echo view('sislo_indicadores_caixa', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function carrega_indicadores() {
        $db = \Config\Database::connect();
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_fechamento_caixa as sfc');
        $query = $builder->select("sf.nome, SUM(sfc.diferenca) AS diferenca")
                        ->join("sislo_funcionarios as sf", "sf.idsislo_funcionarios = sfc.id_usuario", "inner")
                        ->where("sfc.referencia", $referencia)
                        ->where("sfc.cod_loterico", $this->session->get('cod_lot'))
                        ->groupBy('sf.nome', 'asc')
                        ->orderBy('sf.nome', 'asc')->get();
        return $query;
    }

    public function ajax_sislo_indicadores_caixa() {
        if ($this->request->isAJAX()) {
            $sislo_contas = $this->carrega_indicadores()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_contas as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->nome;                
                $row[] = number_format($value->diferenca, 2, ',', '.');                
                $row[] = $value->diferenca < 0 ? "<strong>Descontar Salário</strong>" : "<strong>Tudo OK</strong>";
                ++$tt;
                ++$tb;
                $data[] = $row;
            }
            $json = array("recordsTotal" => $tb,"recordsFiltered" => $tb,"data" => $data);
            echo json_encode($json);
        } else {
            echo view('login');
        }
    }

}
