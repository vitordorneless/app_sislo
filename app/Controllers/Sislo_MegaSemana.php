<?php

namespace App\Controllers;

class Sislo_MegaSemana extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_megasemana.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_megasemana', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_megasemana() {
        if ($this->request->isAJAX()) {            
            $sislo_jogos_cef_model = new \App\Models\Sislo_MegaSemanaModel;
            $sislo = $sislo_jogos_cef_model->where('ano_referencia',date('Y'))->orderBy('dia_01', 'asc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable

            foreach ($sislo as $value) {                
                $row = array();
                $row[] = trim('MEGA-SENA');
                $row[] = $value->campanha;
                $row[] = date("d/m/Y", strtotime($value->dia_01));
                $row[] = date("d/m/Y", strtotime($value->dia_02));
                $row[] = date("d/m/Y", strtotime($value->dia_03));
                $row[] = $value->status == 1 ? "Ativo" : "Inativo";
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_megasemana/?id=' . $value->idsislo_mega_semana) . '">Editar</a>';
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

    public function redireciona_megasemana() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_MegaSemanaModel;            
            $sislo_jogos = new \App\Models\SisloJogosCefModel;            
            $jogos = $sislo_jogos->where('status', 1)->orderBy('nome', 'asc')->findAll();
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['id_sislo_jogos_cef'] = 0;
                $dados['idsislo_mega_semana'] = '';
                $dados['campanha'] = '';
                $dados['dia_01'] = '';
                $dados['dia_02'] = '';
                $dados['dia_03'] = '';
                $dados['ano_referencia'] = '';
                $dados['status'] = '';
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_model->find($this->request->getGet('id'));
                $dados['id_sislo_jogos_cef'] = $dados_loterica->id_sislo_jogos_cef;
                $dados['idsislo_mega_semana'] = $dados_loterica->idsislo_mega_semana;
                $dados['campanha'] = $dados_loterica->campanha;
                $dados['dia_01'] = $dados_loterica->dia_01;
                $dados['dia_02'] = $dados_loterica->dia_02;
                $dados['dia_03'] = $dados_loterica->dia_03;
                $dados['ano_referencia'] = $dados_loterica->ano_referencia;
                $dados['status'] = $dados_loterica->status;
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_megasemana_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,    
                "jogos" => $jogos,
                "campanha" => $dados['campanha'],
                "dia_01" => $dados['dia_01'],
                "dia_02" => $dados['dia_02'],
                "dia_03" => $dados['dia_03'],
                "ano_referencia" => $dados['ano_referencia'],
                "idsislo_mega_semana" => $dados['idsislo_mega_semana'],
                "id_sislo_jogos_cef" => $dados['id_sislo_jogos_cef'],
                "status" => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_megasemana_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_MegaSemanaModel;            
            $sislo_model->set('campanha', $this->request->getPost('campanha'));
            $sislo_model->set('status', $this->request->getPost('status'));
            $sislo_model->set('dia_01', $this->request->getPost('dia_01'));
            $sislo_model->set('dia_02', $this->request->getPost('dia_02'));
            $sislo_model->set('dia_03', $this->request->getPost('dia_03'));
            $sislo_model->set('ano_referencia', $this->request->getPost('ano_referencia'));
            $sislo_model->set('id_sislo_jogos_cef', $this->request->getPost('id_sislo_jogos_cef'));
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('idsislo_mega_semana', $this->request->getPost('idsislo_mega_semana'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

}