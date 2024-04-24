<?php

namespace App\Controllers;

class Sislo_Notificacao extends BaseController {

    public function ajax_list_fechamento_caixa() {
        if ($this->request->isAJAX()) {
            $sislo_fech = $this->carrega_fechamentos()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            $soma = array();
            foreach ($sislo_fech as $value) {
                $row = array();
                $row[] = date("d/m/Y", strtotime($value->data_fechamento));
                $row[] = $value->sislo_nome;
                $row[] = number_format($value->total_credito, 2, ',', '.');
                $row[] = number_format($value->total_debito, 2, ',', '.');
                $row[] = number_format($value->resumo_tfl, 2, ',', '.');
                $row[] = number_format($value->caixa_inicial, 2, ',', '.');
                $row[] = number_format($value->diferenca, 2, ',', '.');
                $soma[] = $value->diferenca;
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_fechamento_caixa/?id=' . $value->idsislo_fechamento_caixa) . '">Editar</a>';
                ++$tt;
                ++$tb;
                $data[] = $row;
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
}
