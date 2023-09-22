<?php

namespace App\Controllers;

class Sislo_VagasAplicadas extends BaseController {

    public function index() {

        if ($this->session->get('candidato_cpf')) {
            $candidato = new \App\Models\Sislo_CandidatoModel;
            $dados_candidato = $candidato->where('cpf', $this->session
                                    ->get('candidato_cpf'))->first();
            $data = array(
                "scripts" => array(
                    "sislo_vagas_aplicadas.js",
                    "util.js"
                ),
                "user_name" => $dados_candidato->nome,
            );
            echo view('template/candidato_header', $data);
            echo view('template/candidato_menu');
            echo view('template/candidato_content');
            echo view('sislo_vagas_aplicadas', $data);
            echo view('template/candidato_footer', $data);
            echo view('template/candidato_scripts', $data);
        } else {
            echo view('sislo');
        }
    }

    public function carrega_vagas() {
        $candidato = new \App\Models\Sislo_CandidatoModel;
        $dados_candidato = $candidato->where('cpf', $this->session
                                ->get('candidato_cpf'))->first();
        $db = \Config\Database::connect();
        $builder = $db->table('sislo_vagas_aplicadas as sva');
        $query = $builder->select("sle.nome_fantasia as nome_fantasia, 
            sle.cidade as cidade,
            sle.uf as uf,
            sv.data_publicacao as data_publicacao,
            sv.data_limite as data_limite,
            sv.cargo as cargo,
            ssvc.nome_status as nome_status")
                        ->join("sislo_status_vaga_candidato as ssvc",
                                "sva.id_sislo_status_vaga_candidato = "
                                . "ssvc.id_sislo_status_vaga_candidato")
                        ->join("sislo_vagas as sv",
                                "sv.id_sislo_vagas = "
                                . "sva.id_sislo_vagas")
                        ->join("sislo_loterica_empresa as sle",
                                "sle.cod_loterico = "
                                . "sv.cod_loterico")
                        ->where("sva.id_sislo_candidato",
                                $dados_candidato->id_sislo_candidato)
                        ->orderBy('sv.data_publicacao', 'desc')->get();
        return $query;
    }

    public function ajax_list_vaga_aplicada() {
        if ($this->request->isAJAX()) {
            $sislo_fech = $this->carrega_vagas()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_fech as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->nome_fantasia;
                $row[] = $value->cidade . '/' . $value->uf;
                $row[] = date("d/m/Y", strtotime($value->data_publicacao));
                $row[] = date("d/m/Y", strtotime($value->data_limite));
                $row[] = $value->cargo;
                $row[] = $value->nome_status;
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
            echo view('sislo');
        }
    }

    public function ajax_save_form() {
        if ($this->request->isAJAX()) {
            $candidato = new \App\Models\Sislo_VagasAplicadasModel;

            $sislo_statuscandidato = new
                    \App\Models\Sislo_StatusVagaCandidatoModel;
            $sislo_status_candidato = $sislo_statuscandidato
                            ->where('nome_status', 'Aplicada')->first();

            $candidato->set('id_sislo_vagas', $this->request
                            ->getPost('id_sislo_vagas'));
            $candidato->set('id_sislo_candidato', $this->request
                            ->getPost('id_sislo_candidato'));
            $candidato->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                $candidato->set('id_sislo_status_vaga_candidato',
                        $sislo_status_candidato
                        ->id_sislo_status_vaga_candidato);
                echo $candidato->insert() == true ? 1 : 0;
            } else {
                $candidato->where('id_sislo_vagas', $this->request
                                ->getPost('id_sislo_vagas'));
                echo $candidato->update() == true ? 1 : 0;
            }
        } else {
            echo view('sislo');
        }
    }
}
