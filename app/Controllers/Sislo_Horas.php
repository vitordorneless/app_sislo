<?php

namespace App\Controllers;

class Sislo_Horas extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_horas.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_horas', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajuste_horas_index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_funcionario = new \App\Models\Sislo_FuncionariosModel;
            $funcionario = $sislo_funcionario->where('cod_loterico', $this->session->get('cod_lot'))->where('status', 1)->orderBy('nome', 'asc')->findAll();
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_ajuste_horas.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome,
                "funcionario" => $funcionario
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_ajuste_horas', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function carrega_horas() {
        $db = \Config\Database::connect();
        $builder = $db->table('sislo_horas as sh');
        $query = $builder->select("sh.idsislo_horas as idsislo_horas,sf.nome as nome, sh.data_ponto AS data_ponto, sh.entrada AS entrada,sh.ida_almoco AS ida_almoco,sh.volta_almoco AS volta_almoco,sh.saida AS saida,sh.saldo AS saldo,sh.data_ponto AS data_ponto")
                ->join("sislo_funcionarios as sf", "sf.idsislo_funcionarios = sh.id_sislo_funcionarios", "inner")
                ->where('MONTH(sh.data_ponto)', $this->request->getPost('mes'))
                ->where('YEAR(sh.data_ponto)', $this->request->getPost('ano'))
                ->where('sh.cod_loterico', $this->session->get('cod_lot'))
                ->where('sh.id_sislo_funcionarios', $this->request->getPost('id_usuario'))
                ->orderBy('sf.nome', 'asc')
                ->orderBy('sh.data_ponto', 'asc')
                ->get();
        return $query;
    }

    public function ajax_list_ajuste_horas() {
        if ($this->request->isAJAX()) {
            $sislo = $this->carrega_horas()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->nome;
                $row[] = $this->formataDataParaDatatable($value->data_ponto);
                $row[] = $value->entrada;
                $row[] = $value->ida_almoco;
                $row[] = $value->volta_almoco;
                $row[] = $value->saida;
                $row[] = $value->saldo;
                $row[] = $value->saldo < 0 ? 'Pagar Horas' : 'Pagar Hora Extra';
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_horas/?id=' . $value->idsislo_horas) . '">Editar</a>';
                ++$tt;
                ++$tb;
                $data[] = $row;
            }//fazer redireciona e o crud
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

    public function ajax_list_horas() {
        if ($this->request->isAJAX()) {
            $sislo_horas = new \App\Models\Sislo_HorasModel;
            $mes = new \DateTime();
            $sislo = $sislo_horas->where('MONTH(data_ponto)', $mes->format('m'))->where('YEAR(data_ponto)', $mes->format('Y'))->orderBy('data_ponto', 'asc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $this->formataDataParaDatatable($value->data_ponto);
                $row[] = $value->entrada;
                $row[] = $value->ida_almoco;
                $row[] = $value->volta_almoco;
                $row[] = $value->saida;
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

    public function ajax_save_form() {
        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_HorasModel;
            $datas = new \DateTime();
            $duashoras = new \DateInterval('PT02H');
            $datasa = $datas->add($duashoras);
            switch ($this->request->getPost('evento')) {
                case 1:
                    $jamarcou = $sislo_model->where('cod_loterico', $this->session->get('cod_lot'))->where('id_sislo_funcionarios', $this->session->get('user_id'))->where('data_ponto', $datas->format('Y-m-d'))->find();
                    if (empty($jamarcou)) {
                        $sislo_model->set('cod_loterico', $this->session->get('cod_lot'));
                        $sislo_model->set('id_sislo_funcionarios', $this->session->get('user_id'));
                        $sislo_model->set('data_ponto', $datas->format('Y-m-d'));
                        $sislo_model->set('entrada', $datasa->format('H:i'));
                        $sislo_model->set('status', 1);
                        $sislo_model->set('id_usuario_bater_ponto', $this->session->get('user_id'));
                        $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                        echo $sislo_model->insert() == true ? 1 : 0;
                    } else {
                        echo 0;
                    }
                    break;
                case 2:
                    $jamarcou = $sislo_model->where('cod_loterico', $this->session->get('cod_lot'))->where('id_sislo_funcionarios', $this->session->get('user_id'))->where('data_ponto', $datas->format('Y-m-d'))->find();
                    if ($jamarcou[0]->ida_almoco === '00:00:00') {
                        $sislo_model->set('cod_loterico', $this->session->get('cod_lot'));
                        $sislo_model->set('ida_almoco', $datasa->format('H:i'));
                        $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                        $sislo_model->where('idsislo_horas', $jamarcou[0]->idsislo_horas);
                        echo $sislo_model->update() == true ? 1 : 0;
                    } else {
                        echo 0;
                    }
                    break;
                case 3:
                    $jamarcou = $sislo_model->where('cod_loterico', $this->session->get('cod_lot'))->where('id_sislo_funcionarios', $this->session->get('user_id'))->where('data_ponto', $datas->format('Y-m-d'))->find();
                    if ($jamarcou[0]->volta_almoco === '00:00:00') {
                        $sislo_model->set('cod_loterico', $this->session->get('cod_lot'));
                        $sislo_model->set('volta_almoco', $datasa->format('H:i'));
                        $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                        $sislo_model->where('idsislo_horas', $jamarcou[0]->idsislo_horas);
                        echo $sislo_model->update() == true ? 1 : 0;
                    } else {
                        echo 0;
                    }
                    break;
                case 4:
                    $jamarcou = $sislo_model->where('cod_loterico', $this->session->get('cod_lot'))->where('id_sislo_funcionarios', $this->session->get('user_id'))->where('data_ponto', $datas->format('Y-m-d'))->find();
                    if ($jamarcou[0]->saida === '00:00:00') {
                        $sislo_model->set('cod_loterico', $this->session->get('cod_lot'));
                        $sislo_model->set('saida', $datasa->format('H:i'));
                        $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                        $sislo_model->where('idsislo_horas', $jamarcou[0]->idsislo_horas);

                        $entradas = new \DateTime($jamarcou[0]->entrada);
                        $ida_almocos = new \DateTime($jamarcou[0]->ida_almoco);
                        $volta_almocos = new \DateTime($jamarcou[0]->volta_almoco);
                        $saidas = new \DateTime($jamarcou[0]->saida);

                        $primeiro_calculo = $entradas->diff($ida_almocos);
                        $segundo_calculo = $volta_almocos->diff($saidas);

                        $saida = new \DateInterval('PT' . $segundo_calculo->h . 'H' . $segundo_calculo->i . 'M');
                        $calculosaldo = new \Datetime($primeiro_calculo->h . ':' . $primeiro_calculo->i);
                        $oitohoras = new \DateInterval('PT08H');

                        $calculosaldo->add($saida);
                        $horas_extras = $calculosaldo->sub($oitohoras);

                        $sislo_model->set('saldo', $horas_extras->format('H:i:s'));
                        echo $sislo_model->update() == true ? 1 : 0;
                    } else {
                        echo 0;
                    }
                    break;
            }
        } else {
            echo view('login');
        }
    }

    public function sislo_ajustahora() {
        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_HorasModel;
            $entrada = new \DateTime($this->request->getPost('entrada'));
            $ida_almoco = new \DateTime($this->request->getPost('ida_almoco'));
            $volta_almoco = new \DateTime($this->request->getPost('volta_almoco'));
            $saida = new \DateTime($this->request->getPost('saida'));

            $sislo_model->set('cod_loterico', $this->session->get('cod_lot'));
            $sislo_model->set('data_ponto', $this->request->getPost('data_ponto'));
            $sislo_model->set('entrada', $entrada->format('H:i'));
            $sislo_model->set('ida_almoco', $ida_almoco->format('H:i'));
            $sislo_model->set('volta_almoco', $volta_almoco->format('H:i'));
            $sislo_model->set('saida', $saida->format('H:i'));
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
            $sislo_model->where('idsislo_horas', $this->request->getPost('idsislo_horas'));
            $sislo_model->where('id_sislo_funcionarios', $this->request->getPost('id_sislo_funcionarios'));

            $entradas = new \DateTime($this->request->getPost('entrada'));
            $ida_almocos = new \DateTime($this->request->getPost('ida_almoco'));
            $volta_almocos = new \DateTime($this->request->getPost('volta_almoco'));
            $saidas = new \DateTime($this->request->getPost('saida'));

            $primeiro_calculo = $entradas->diff($ida_almocos);
            $segundo_calculo = $volta_almocos->diff($saidas);

            $saidaa = new DateInterval('PT' . $segundo_calculo->h . 'H' . $segundo_calculo->i . 'M');
            $calculosaldo = new \Datetime($primeiro_calculo->h . ':' . $primeiro_calculo->i);
            $oitohoras = new \DateInterval('PT08H');

            $calculosaldo->add($saidaa);
            $horas_extras = $calculosaldo->sub($oitohoras);

            $sislo_model->set('saldo', $horas_extras->format('H:i:s'));
            echo $sislo_model->update() == true ? 1 : 0;
        } else {
            echo view('login');
        }
    }

    public function redireciona_horas() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_horas_model = new \App\Models\Sislo_HorasModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $dados_contas = $sislo_horas_model->find($this->request->getGet('id'));
            $data = array(
                "scripts" => array(
                    "sislo_horas_adm_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "idsislo_horas" => $dados_contas->idsislo_horas,
                "id_sislo_funcionarios" => $dados_contas->id_sislo_funcionarios,
                "data_ponto" => $dados_contas->data_ponto,
                "entrada" => $dados_contas->entrada,
                "ida_almoco" => $dados_contas->ida_almoco,
                "volta_almoco" => $dados_contas->volta_almoco,
                "saida" => $dados_contas->saida);
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_horas_adm_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

}
