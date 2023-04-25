<?php

namespace App\Controllers;

class Sislo_MetaJogos extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_meta_jogos.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_meta_jogos', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }
    
    public function carrega_jogos() {
        $db = \Config\Database::connect();
        $builder = $db->table('sislo_meta_jogos as mj');
        $query = $builder->select("mj.id_sislo_meta_jogos as id_sislo_meta_jogos,sts.nome as nome, mj.ano as ano, "
                . "mj.janeiro,mj.fevereiro,mj.marco,mj.abril,mj.maio,mj.junho,"
                . "mj.julho,mj.agosto,mj.setembro,mj.outubro,mj.novembro,mj.dezembro")
                        ->join("sislo_jogos_cef as sts", "mj.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")                        
                        ->where("mj.cod_loterico", $this->session->get('cod_lot'))
                        ->where('mj.status', 1)
                        ->orderBy('mj.data_ultima_alteracao', 'asc')->get();
        return $query;
    }

    public function ajax_list_meta_jogos() {
        if ($this->request->isAJAX()) {            
            $sislo = $this->carrega_jogos()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable

            foreach ($sislo as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->ano;
                $row[] = $value->nome;
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
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_meta_jogos/?id=' . $value->id_sislo_meta_jogos) . '">Editar</a>';
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

    public function redireciona_meta_jogos() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_MetaJogosModel;
            $sislo_jogos = new \App\Models\SisloJogosCefModel;
            $jogos = $sislo_jogos->where('status', 1)->orderBy('nome', 'asc')->findAll();
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['id_sislo_meta_jogos'] = '';
                $dados['id_sislo_jogos_cef'] = '';
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
                $dados['janeiro_bolao'] = '';
                $dados['fevereiro_bolao'] = '';
                $dados['marco_bolao'] = '';
                $dados['abril_bolao'] = '';
                $dados['maio_bolao'] = '';
                $dados['junho_bolao'] = '';
                $dados['julho_bolao'] = '';
                $dados['agosto_bolao'] = '';
                $dados['setembro_bolao'] = '';
                $dados['outubro_bolao'] = '';
                $dados['novembro_bolao'] = '';
                $dados['dezembro_bolao'] = '';
                $dados['status'] = '';
            } else {
                $incluir = 2;
                $dados_lot = $sislo_model->find($this->request->getGet('id'));
                $dados['id_sislo_meta_jogos'] = $dados_lot->id_sislo_meta_jogos;
                $dados['id_sislo_jogos_cef'] = $dados_lot->id_sislo_jogos_cef;
                $dados['ano'] = $dados_lot->ano;
                $dados['janeiro'] = $dados_lot->janeiro;
                $dados['fevereiro'] = $dados_lot->fevereiro;
                $dados['marco'] = $dados_lot->marco;
                $dados['abril'] = $dados_lot->abril;
                $dados['maio'] = $dados_lot->maio;
                $dados['junho'] = $dados_lot->junho;
                $dados['julho'] = $dados_lot->julho;
                $dados['agosto'] = $dados_lot->agosto;
                $dados['setembro'] = $dados_lot->setembro;
                $dados['outubro'] = $dados_lot->outubro;
                $dados['novembro'] = $dados_lot->novembro;
                $dados['dezembro'] = $dados_lot->dezembro;
                $dados['janeiro_bolao'] = $dados_lot->janeiro_bolao;
                $dados['fevereiro_bolao'] = $dados_lot->fevereiro_bolao;
                $dados['marco_bolao'] = $dados_lot->marco_bolao;
                $dados['abril_bolao'] = $dados_lot->abril_bolao;
                $dados['maio_bolao'] = $dados_lot->maio_bolao;
                $dados['junho_bolao'] = $dados_lot->junho_bolao;
                $dados['julho_bolao'] = $dados_lot->julho_bolao;
                $dados['agosto_bolao'] = $dados_lot->agosto_bolao;
                $dados['setembro_bolao'] = $dados_lot->setembro_bolao;
                $dados['outubro_bolao'] = $dados_lot->outubro_bolao;
                $dados['novembro_bolao'] = $dados_lot->novembro_bolao;
                $dados['dezembro_bolao'] = $dados_lot->dezembro_bolao;
                $dados['status'] = $dados_lot->status;
                unset($dados_lot);
            }
            $data = array(
                "scripts" => array(
                    "sislo_meta_jogos_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "cod_loterico" => $this->session->get('cod_lot'),
                "incluir" => $incluir,
                "jogos" => $jogos,
                "id_sislo_meta_jogos" => $dados['id_sislo_meta_jogos'],
                "id_sislo_jogos_cef" => $dados['id_sislo_jogos_cef'],
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
                "janeiro_bolao" => $dados['janeiro_bolao'],
                "fevereiro_bolao" => $dados['fevereiro_bolao'],
                "marco_bolao" => $dados['marco_bolao'],
                "abril_bolao" => $dados['abril_bolao'],
                "maio_bolao" => $dados['maio_bolao'],
                "junho_bolao" => $dados['junho_bolao'],
                "julho_bolao" => $dados['julho_bolao'],
                "agosto_bolao" => $dados['agosto_bolao'],
                "setembro_bolao" => $dados['setembro_bolao'],
                "outubro_bolao" => $dados['outubro_bolao'],
                "novembro_bolao" => $dados['novembro_bolao'],
                "dezembro_bolao" => $dados['dezembro_bolao'],
                "status" => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_meta_jogos_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_MetaJogosModel;
            $sislo_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_model->set('ano', $this->request->getPost('ano'));
            $sislo_model->set('id_sislo_jogos_cef', $this->request->getPost('id_sislo_jogos_cef'));
            $sislo_model->set('janeiro', $this->limparValoresMonetarios($this->request->getPost('janeiro')));
            $sislo_model->set('fevereiro', $this->limparValoresMonetarios($this->request->getPost('fevereiro')));
            $sislo_model->set('marco', $this->limparValoresMonetarios($this->request->getPost('marco')));
            $sislo_model->set('abril', $this->limparValoresMonetarios($this->request->getPost('abril')));
            $sislo_model->set('maio', $this->limparValoresMonetarios($this->request->getPost('maio')));
            $sislo_model->set('junho', $this->limparValoresMonetarios($this->request->getPost('junho')));
            $sislo_model->set('julho', $this->limparValoresMonetarios($this->request->getPost('julho')));
            $sislo_model->set('agosto', $this->limparValoresMonetarios($this->request->getPost('agosto')));
            $sislo_model->set('setembro', $this->limparValoresMonetarios($this->request->getPost('setembro')));
            $sislo_model->set('outubro', $this->limparValoresMonetarios($this->request->getPost('outubro')));
            $sislo_model->set('novembro', $this->limparValoresMonetarios($this->request->getPost('novembro')));
            $sislo_model->set('dezembro', $this->limparValoresMonetarios($this->request->getPost('dezembro')));
            $sislo_model->set('janeiro_bolao', $this->limparValoresMonetarios($this->request->getPost('janeiro_bolao')));
            $sislo_model->set('fevereiro_bolao', $this->limparValoresMonetarios($this->request->getPost('fevereiro_bolao')));
            $sislo_model->set('marco_bolao', $this->limparValoresMonetarios($this->request->getPost('marco_bolao')));
            $sislo_model->set('abril_bolao', $this->limparValoresMonetarios($this->request->getPost('abril_bolao')));
            $sislo_model->set('maio_bolao', $this->limparValoresMonetarios($this->request->getPost('maio_bolao')));
            $sislo_model->set('junho_bolao', $this->limparValoresMonetarios($this->request->getPost('junho_bolao')));
            $sislo_model->set('julho_bolao', $this->limparValoresMonetarios($this->request->getPost('julho_bolao')));
            $sislo_model->set('agosto_bolao', $this->limparValoresMonetarios($this->request->getPost('agosto_bolao')));
            $sislo_model->set('setembro_bolao', $this->limparValoresMonetarios($this->request->getPost('setembro_bolao')));
            $sislo_model->set('outubro_bolao', $this->limparValoresMonetarios($this->request->getPost('outubro_bolao')));
            $sislo_model->set('novembro_bolao', $this->limparValoresMonetarios($this->request->getPost('novembro_bolao')));
            $sislo_model->set('dezembro_bolao', $this->limparValoresMonetarios($this->request->getPost('dezembro_bolao')));
            $sislo_model->set('status', $this->request->getPost('status'));
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_model->insert() == true ? 1 : 0;
            } else {
                $sislo_model->where('id_sislo_meta_jogos', $this->request->getPost('id_sislo_meta_jogos'));
                echo $sislo_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

}
