<?php

namespace App\Controllers;

class Home extends BaseController {

    public function index() {

        echo view('home.php');
    }
    
    public function vagas_aberto() {

        echo view('vagas_aberto.php');
    }

    public function carrega_vagas() {
        $db = \Config\Database::connect();
        $builder = $db->table('sislo_vagas as sv');
        $query = $builder->select("sv.cod_loterico as cod_loterico,
            sv.id_sislo_vagas as id_sislo_vagas,
            sv.data_publicacao as data_publicacao,
            sv.data_limite as data_limite,
            sv.cargo as cargo,
            ssv.nome_status as nome_status, sle.cidade as cidade,sle.uf as uf,
            sle.nome_fantasia as nome_fantasia")
                        ->join("sislo_status_vaga as ssv",
                                "sv.id_sislo_status_vaga = "
                                . "ssv.id_sislo_status_vaga")
                        ->join("sislo_loterica_empresa as sle",
                                "sv.cod_loterico = "
                                . "sle.cod_loterico")
                        ->orderBy('sv.data_publicacao', 'desc')->get();
        return $query;
    }

    public function ajax_list_site_vaga() {
        if ($this->request->isAJAX()) {
            $sislo_fech = $this->carrega_vagas()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_fech as $value) {
                $data_inicio = new \DateTime($value->data_publicacao);
                $data_fim = new \DateTime($value->data_limite);
                $dateInterval = $data_inicio->diff($data_fim);
                $row = array();
                $row[] = $tt;
                $row[] = strtoupper($value->nome_fantasia);
                $row[] = strtoupper($value->cidade) . '/' . strtoupper($value->uf);
                $row[] = date("d/m/Y", strtotime($value->data_publicacao));
                $row[] = date("d/m/Y", strtotime($value->data_limite));
                $row[] = $dateInterval->days;
                $row[] = strtoupper($value->cargo);
                $row[] = $value->nome_status;
                $row[] = '<a class="btn btn-primary" href="' .
                        base_url('area_candidato') . '">Ver Vaga</a>';

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
            echo view('Home');
        }
    }
}
