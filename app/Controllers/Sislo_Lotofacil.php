<?php

namespace App\Controllers;

class Sislo_Lotofacil extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_lotofacil.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_lotofacil', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_lotofacil() {
        if ($this->request->isAJAX()) {
            $sislo_jogos_cef_model = new \App\Models\Sislo_LotofacilModel;
            $sislo = $sislo_jogos_cef_model->orderBy('concurso', 'desc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable

            foreach ($sislo as $value) {
                $row = array();
                $row[] = $value->concurso;
                $row[] = $value->dez_01;
                $row[] = $value->dez_02;
                $row[] = $value->dez_03;
                $row[] = $value->dez_04;
                $row[] = $value->dez_05;
                $row[] = $value->dez_06;
                $row[] = $value->dez_07;
                $row[] = $value->dez_08;
                $row[] = $value->dez_09;
                $row[] = $value->dez_10;
                $row[] = $value->dez_11;
                $row[] = $value->dez_12;
                $row[] = $value->dez_13;
                $row[] = $value->dez_14;
                $row[] = $value->dez_15;
                $row[] = $value->saiu_ganhador == 1 ? 'Sim' : 'Não';
                $row[] = $this->formataValoresMonetarios($value->premio_atual);
                $row[] = $this->formataValoresMonetarios($value->premio_acumulado);
                $row[] = $this->formataValoresMonetarios($value->arrecadacao_total);
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_lotofacil/?id=' . $value->idsislo_lotofacil) . '">Editar</a>';
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

    public function redireciona_lotofacil() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_LotofacilModel;
            $sislo_jogos = new \App\Models\SisloJogosCefModel;
            $jogos = $sislo_jogos->where('status', 1)->orderBy('nome', 'asc')->findAll();
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['id_sislo_jogos_cef'] = 28;
                $dados['idsislo_lotofacil'] = '';
                $dados['concurso'] = '';
                $dados['data_concurso'] = '';
                $dados['dez_01'] = '';
                $dados['dez_02'] = '';
                $dados['dez_03'] = '';
                $dados['dez_04'] = '';
                $dados['dez_05'] = '';
                $dados['dez_06'] = '';
                $dados['dez_07'] = '';
                $dados['dez_08'] = '';
                $dados['dez_09'] = '';
                $dados['dez_10'] = '';
                $dados['dez_11'] = '';
                $dados['dez_12'] = '';
                $dados['dez_13'] = '';
                $dados['dez_14'] = '';
                $dados['dez_15'] = '';
                $dados['saiu_ganhador'] = '0';
                $dados['premio_atual'] = '';
                $dados['premio_acumulado'] = '';
                $dados['arrecadacao_total'] = '';
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_model->find($this->request->getGet('id'));
                $dados['id_sislo_jogos_cef'] = $dados_loterica->id_sislo_jogos_cef;
                $dados['idsislo_lotofacil'] = $dados_loterica->idsislo_lotofacil;
                $dados['concurso'] = $dados_loterica->concurso;
                $dados['data_concurso'] = $dados_loterica->data_concurso;
                $dados['dez_01'] = $dados_loterica->dez_01;
                $dados['dez_02'] = $dados_loterica->dez_02;
                $dados['dez_03'] = $dados_loterica->dez_03;
                $dados['dez_04'] = $dados_loterica->dez_04;
                $dados['dez_05'] = $dados_loterica->dez_05;
                $dados['dez_06'] = $dados_loterica->dez_06;
                $dados['dez_07'] = $dados_loterica->dez_07;
                $dados['dez_08'] = $dados_loterica->dez_08;
                $dados['dez_09'] = $dados_loterica->dez_09;
                $dados['dez_10'] = $dados_loterica->dez_10;
                $dados['dez_11'] = $dados_loterica->dez_11;
                $dados['dez_12'] = $dados_loterica->dez_12;
                $dados['dez_13'] = $dados_loterica->dez_13;
                $dados['dez_14'] = $dados_loterica->dez_14;
                $dados['dez_15'] = $dados_loterica->dez_15;
                $dados['saiu_ganhador'] = $dados_loterica->saiu_ganhador;
                $dados['premio_atual'] = $dados_loterica->premio_atual;
                $dados['premio_acumulado'] = $dados_loterica->premio_acumulado;
                $dados['arrecadacao_total'] = $dados_loterica->arrecadacao_total;
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_lotofacil_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "jogos" => $jogos,
                "idsislo_lotofacil" => $dados['idsislo_lotofacil'],
                "id_sislo_jogos_cef" => $dados['id_sislo_jogos_cef'],
                "concurso" => $dados['concurso'],
                "data_concurso" => $dados['data_concurso'],
                "dez_01" => $dados['dez_01'],
                "dez_02" => $dados['dez_02'],
                "dez_03" => $dados['dez_03'],
                "dez_04" => $dados['dez_04'],
                "dez_05" => $dados['dez_05'],
                "dez_06" => $dados['dez_06'],
                "dez_07" => $dados['dez_07'],
                "dez_08" => $dados['dez_08'],
                "dez_09" => $dados['dez_09'],
                "dez_10" => $dados['dez_10'],
                "dez_11" => $dados['dez_11'],
                "dez_12" => $dados['dez_12'],
                "dez_13" => $dados['dez_13'],
                "dez_14" => $dados['dez_14'],
                "dez_15" => $dados['dez_15'],
                "saiu_ganhador" => $dados['saiu_ganhador'],
                "premio_atual" => $dados['premio_atual'],
                "premio_acumulado" => $dados['premio_acumulado'],
                "arrecadacao_total" => $dados['arrecadacao_total']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_lotofacil_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_LotofacilModel;
            $sislo_model->set('id_sislo_jogos_cef', $this->request->getPost('id_sislo_jogos_cef'));
            $sislo_model->set('concurso', $this->request->getPost('concurso'));
            $sislo_model->set('data_concurso', $this->request->getPost('data_concurso'));
            $sislo_model->set('dez_01', $this->request->getPost('dez_01'));
            $sislo_model->set('dez_02', $this->request->getPost('dez_02'));
            $sislo_model->set('dez_03', $this->request->getPost('dez_03'));
            $sislo_model->set('dez_04', $this->request->getPost('dez_04'));
            $sislo_model->set('dez_05', $this->request->getPost('dez_05'));
            $sislo_model->set('dez_06', $this->request->getPost('dez_06'));
            $sislo_model->set('dez_07', $this->request->getPost('dez_07'));
            $sislo_model->set('dez_08', $this->request->getPost('dez_08'));
            $sislo_model->set('dez_09', $this->request->getPost('dez_09'));
            $sislo_model->set('dez_10', $this->request->getPost('dez_10'));
            $sislo_model->set('dez_11', $this->request->getPost('dez_11'));
            $sislo_model->set('dez_12', $this->request->getPost('dez_12'));
            $sislo_model->set('dez_13', $this->request->getPost('dez_13'));
            $sislo_model->set('dez_14', $this->request->getPost('dez_14'));
            $sislo_model->set('dez_15', $this->request->getPost('dez_15'));
            $sislo_model->set('saiu_ganhador', $this->request->getPost('saiu_ganhador'));
            $sislo_model->set('premio_atual', $this->limparValoresMonetarios($this->request->getPost('premio_atual')));
            $sislo_model->set('premio_acumulado', $this->limparValoresMonetarios($this->request->getPost('premio_acumulado')));
            $sislo_model->set('arrecadacao_total', $this->limparValoresMonetarios($this->request->getPost('arrecadacao_total')));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('idsislo_lotofacil', $this->request->getPost('idsislo_lotofacil'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

}
