<?php

namespace App\Controllers;

class Sislo_MetaNaoJogos extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_meta_nao_jogos.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_meta_nao_jogos', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_meta_nao_jogos() {
        if ($this->request->isAJAX()) {
            $sislo_jogos_cef_model = new \App\Models\Sislo_MetaNaoJogosModel;
            $sislo = $sislo_jogos_cef_model->orderBy('ano', 'desc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable

            foreach ($sislo as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->ano;
                $row[] = $this->formataValoresMonetarios($value->janeiro);
                $row[] = $this->formataValoresMonetarios($value->fevereiro);
                $row[] = $this->formataValoresMonetarios($value->marco);
                $row[] = $this->formataValoresMonetarios($value->abril);
                $row[] = $this->formataValoresMonetarios($value->maio);
                $row[] = $this->formataValoresMonetarios($value->junho);
                $row[] = $this->formataValoresMonetarios($value->julho);
                $row[] = $this->formataValoresMonetarios($value->agosto);
                $row[] = $this->formataValoresMonetarios($value->setembro);
                $row[] = $this->formataValoresMonetarios($value->outubro);
                $row[] = $this->formataValoresMonetarios($value->novembro);
                $row[] = $this->formataValoresMonetarios($value->dezembro);
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_meta_nao_jogos/?id=' . $value->id_sislo_meta_nao_jogos) . '">Editar</a>';
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

    public function redireciona_meta_nao_jogos() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_MetaNaoJogosModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['id_sislo_meta_nao_jogos'] = '';
                $dados['ano'] = '';
                $dados['janeiro'] = '';
                $dados['fevereiro'] = '';
                $dados['marco'] = '';
                $dados['abril'] = '';
                $dados['maio'] = '';
                $dados['junho'] = '';
                $dados['julho'] = '';
                $dados['agosto'] = '';
                $dados['setembro'] = '';
                $dados['outubro'] = '';
                $dados['novembro'] = '';
                $dados['dezembro'] = '';
                $dados['status'] = '';
            } else {
                $incluir = 2;
                $dados_novembrorica = $sislo_model->find($this->request->getGet('id'));
                $dados['id_sislo_meta_nao_jogos'] = $dados_novembrorica->id_sislo_meta_nao_jogos;
                $dados['ano'] = $dados_novembrorica->ano;
                $dados['janeiro'] = $dados_novembrorica->janeiro;
                $dados['fevereiro'] = $dados_novembrorica->fevereiro;
                $dados['marco'] = $dados_novembrorica->marco;
                $dados['abril'] = $dados_novembrorica->abril;
                $dados['maio'] = $dados_novembrorica->maio;
                $dados['junho'] = $dados_novembrorica->junho;
                $dados['julho'] = $dados_novembrorica->julho;
                $dados['agosto'] = $dados_novembrorica->agosto;
                $dados['setembro'] = $dados_novembrorica->setembro;
                $dados['outubro'] = $dados_novembrorica->outubro;
                $dados['novembro'] = $dados_novembrorica->novembro;
                $dados['dezembro'] = $dados_novembrorica->dezembro;
                $dados['status'] = $dados_novembrorica->status;
                unset($dados_novembrorica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_meta_nao_jogos_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "cod_loterico" => $this->session->get('cod_lot'),
                "incluir" => $incluir,
                "id_sislo_meta_nao_jogos" => $dados['id_sislo_meta_nao_jogos'],
                "ano" => $dados['ano'],
                "janeiro" => $dados['janeiro'],
                "fevereiro" => $dados['fevereiro'],
                "marco" => $dados['marco'],
                "abril" => $dados['abril'],
                "maio" => $dados['maio'],
                "junho" => $dados['junho'],
                "julho" => $dados['julho'],
                "agosto" => $dados['agosto'],
                "setembro" => $dados['setembro'],
                "outubro" => $dados['outubro'],
                "novembro" => $dados['novembro'],
                "dezembro" => $dados['dezembro'],
                "status" => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_meta_nao_jogos_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_MetaNaoJogosModel;
            $sislo_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_model->set('ano', $this->request->getPost('ano'));
            $sislo_model->set('janeiro', $this->limparValoresMonetarios($this->request->getPost('janeiro')));
            $sislo_model->set('fevereiro', $this->limparValoresMonetarios($this->request->getPost('fevereiro')));
            $sislo_model->set('marco', $this->limparValoresMonetarios($this->request->getPost('marco')));
            $sislo_model->set('abril', $this->limparValoresMonetarios($this->request->getPost('abril')));
            $sislo_model->set('maio', $this->limparValoresMonetarios($this->request->getPost('maio')));
            $sislo_model->set('junho', $this->limparValoresMonetarios($this->request->getPost('junho')));
            $sislo_model->set('agosto', $this->limparValoresMonetarios($this->request->getPost('agosto')));
            $sislo_model->set('setembro', $this->limparValoresMonetarios($this->request->getPost('setembro')));
            $sislo_model->set('outubro', $this->limparValoresMonetarios($this->request->getPost('outubro')));
            $sislo_model->set('novembro', $this->limparValoresMonetarios($this->request->getPost('novembro')));
            $sislo_model->set('dezembro', $this->limparValoresMonetarios($this->request->getPost('dezembro')));
            $sislo_model->set('status', $this->request->getPost('status'));
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('id', $this->request->getPost('id'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

}
