<?php

namespace App\Controllers;

class Sislo_TiposConvenio extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_tiposconvenio.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_tiposconvenio', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_tiposconvenio() {
        if ($this->request->isAJAX()) {
            $sislo_tiposconvenio_model = new \App\Models\Sislo_TiposConvenioModel;
            $sislo = $sislo_tiposconvenio_model->where('status', 1)->orderBy('convenio', 'asc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->convenio;
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value->valor_global);
                $row[] = $value->status == 1 ? "Ativo" : "Inativo";
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_tiposconvenio/?id=' . $value->idsislo_tipos_convenio) . '">Editar</a>';
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

    public function redireciona_tiposconvenio() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_TiposConvenioModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['idsislo_tipos_convenio'] = '';
                $dados['convenio'] = '';
                $dados['valor_global'] = '';
                $dados['status'] = '';
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_model->find($this->request->getGet('id'));
                $dados['idsislo_tipos_convenio'] = $dados_loterica->idsislo_tipos_convenio;
                $dados['convenio'] = $dados_loterica->convenio;
                $dados['valor_global'] = $dados_loterica->valor_global;
                $dados['status'] = $dados_loterica->status;
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_tiposconvenio_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "convenio" => $dados['convenio'],
                "valor_global" => $dados['valor_global'],
                "idsislo_tipos_convenio" => $dados['idsislo_tipos_convenio'],
                "status" => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_tiposconvenio_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_TiposConvenioModel;
            $sislo_model->set('convenio', $this->request->getPost('convenio'));
            $sislo_model->set('valor_global', $this->limparValoresMonetarios($this->request->getPost('valor_global')));
            $sislo_model->set('status', $this->request->getPost('status'));
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('idsislo_tipos_convenio', $this->request->getPost('idsislo_tipos_convenio'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

}
