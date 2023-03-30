<?php

namespace App\Controllers;

class Sislo_Chamados extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_chamados.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_chamados', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_chamados() {
        if ($this->request->isAJAX()) {
            $sislo_chamados = new \App\Models\Sislo_ChamadosModel;
            $sislo = $sislo_chamados->orderBy('numero_chamado', 'asc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = trim($value->numero_chamado);
                $row[] = $value->titulo_chamado;
                $row[] = $value->texto_chamado;
                $row[] = $value->conclusao_chamado;
                $row[] = $value->status == 1 ? "Concluído" : "Para Fazer";
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_sislo_chamados/?id=' . $value->idsislo_chamados) . '">Editar</a>';
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

    public function redireciona_sislo_chamados() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_ChamadosModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['idsislo_chamados'] = '';
                $dados['numero_chamado'] = date('YmdHisdd');
                $dados['titulo_chamado'] = '';
                $dados['texto_chamado'] = '';
                $dados['conclusao_chamado'] = '';
                $dados['status'] = '0';
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_model->find($this->request->getGet('id'));
                $dados['idsislo_chamados'] = $dados_loterica->idsislo_chamados;
                $dados['numero_chamado'] = $dados_loterica->numero_chamado;
                $dados['titulo_chamado'] = $dados_loterica->titulo_chamado;
                $dados['texto_chamado'] = $dados_loterica->texto_chamado;
                $dados['conclusao_chamado'] = $dados_loterica->conclusao_chamado;
                $dados['status'] = $dados_loterica->status;
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_chamados_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,                
                "numero_chamado" => $dados['numero_chamado'],
                "titulo_chamado" => $dados['titulo_chamado'],
                "texto_chamado" => $dados['texto_chamado'],
                "conclusao_chamado" => $dados['conclusao_chamado'],
                "idsislo_chamados" => $dados['idsislo_chamados'],
                "status" => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_chamados_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_ChamadosModel;
            $sislo_model->set('numero_chamado', $this->request->getPost('numero_chamado'));
            $sislo_model->set('status', $this->request->getPost('status'));
            $sislo_model->set('titulo_chamado', $this->request->getPost('titulo_chamado'));
            $sislo_model->set('texto_chamado', $this->request->getPost('texto_chamado'));
            $sislo_model->set('conclusao_chamado', $this->request->getPost('conclusao_chamado'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('idsislo_chamados', $this->request->getPost('idsislo_chamados'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

}
