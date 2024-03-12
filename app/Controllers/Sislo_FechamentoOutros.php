<?php

namespace App\Controllers;

class Sislo_FechamentoOutros extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_fechamentos_outros.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js", "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_fechamentos_outros', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    private function carrega_fechamentos_outros() {
        $db = \Config\Database::connect();
        $mes = $this->request->getPost('mes') < 10 ? '0' . $this->request->getPost('mes') : $this->request->getPost('mes');
        $referencia = $mes . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_fechamento_caixa as sfc');
        $query = $builder->select("su.nome as sislo_nome,
                sfc.total_brinde as total_brinde,
                sfc.total_outros as total_outros,
                sfc.total_pix as total_pix,
                sfc.obs_brinde as obs_brinde,
                sfc.obs_outros as obs_outros,
                sfc.idsislo_fechamento_caixa as idsislo_fechamento_caixa")
                        ->join("sislo_funcionarios as su", "sfc.id_usuario = su.idsislo_funcionarios")
                        ->where("sfc.referencia", $referencia)
                        ->where("sfc.cod_loterico", $this->session->get('cod_lot'))
                        ->orderBy('sfc.data_fechamento', 'asc')->get();
        return $query;
    }

    public function ajax_list_fechamento_caixa_outros() {
        if ($this->request->isAJAX()) {
            $sislo_fech = $this->carrega_fechamentos_outros()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            $sominha_pix = $sominha_azulzinha = $sominha_outros = $sominha_brinde = array();
            foreach ($sislo_fech as $value) {
                $row = array();
                $row[] = $value->sislo_nome;
                $row[] = number_format($value->total_pix, 2, ',', '.');
                $row[] = number_format($value->total_outros, 2, ',', '.');
                $row[] = number_format($value->total_outros, 2, ',', '.');
                $row[] = $value->obs_outros;
                $row[] = number_format($value->total_brinde, 2, ',', '.');
                $row[] = $value->obs_brinde;
                //$row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_fechamento_caixa/?id=' . $value->idsislo_fechamento_caixa) . '">Liquidar</a>';
                $sominha_pix[] = $value->total_pix;
                $sominha_azulzinha[] = $value->total_outros;
                $sominha_outros[] = $value->total_outros;
                $sominha_brinde[] = $value->total_brinde;
                ++$tt;
                ++$tb;
                $data[] = $row;
                unset($row);
            }
            $json = array(
                "recordsTotal" => $tb,
                "recordsFiltered" => $tb,
                "sominha_pix" => number_format(array_sum($sominha_pix), 2, ',', '.'),
                "sominha_azulzinha" => number_format(array_sum($sominha_azulzinha), 2, ',', '.'),
                "sominha_outros" => number_format(array_sum($sominha_outros), 2, ',', '.'),
                "sominha_brinde" => number_format(array_sum($sominha_brinde), 2, ',', '.'),
                "data" => $data
            );
            echo json_encode($json);
        } else {
            echo view('login');
        }
    }
}
