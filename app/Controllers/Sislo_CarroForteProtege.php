<?php

namespace App\Controllers;

class Sislo_CarroForteProtege extends BaseController {

    public function index() {

        if ($this->session->get('user_id')) {
            $sislo_loterica_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_loterica_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_protege.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_protege', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function protege_senha() {

        if ($this->session->get('user_id')) {
            $sislo_loterica_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_loterica_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "protege_senha.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('protege_senha', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_protege() {
        if ($this->request->isAJAX()) {
            $sislo_protege_model = new \App\Models\Sislo_CarroForteProtegeModel;
            $sislo_protege = $sislo_protege_model->where('cod_loterico', $this->session->get('cod_lot'))->where('status', 1)->orderBy('validade', 'desc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_protege as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->cod_loterico;
                $row[] = $value->fixo;
                $row[] = $value->dependencia;
                $row[] = $value->validade;
                $row[] = $value->status == 1 ? "Ativo" : "Inativo";
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_protege/?id=' . $value->idsislo_protege) . '">Editar</a>';
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

    public function ajax_data_senha() {
        if ($this->request->isAJAX()) {
            $data_senha = new \Datetime($this->request->getPost('data_senha'));
            $sislo_protege_model = new \App\Models\Sislo_CarroForteProtegeModel;
            $sislo_protege = $sislo_protege_model->where('cod_loterico', $this->session->get('cod_lot'))
                            ->where('validade', $data_senha->format('Y'))->where('status', 1)
                            ->orderBy('validade', 'desc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_protege as $value) {
                switch ($data_senha->format('l')) {
                    case 'Monday':
                        $selectweek = $value->seg;
                        break;
                    case 'Tuesday':
                        $selectweek = $value->ter;
                        break;
                    case 'Wednesday':
                        $selectweek = $value->qua;
                        break;
                    case 'Thursday':
                        $selectweek = $value->qui;
                        break;
                    case 'Friday':
                        $selectweek = $value->sex;
                        break;
                    case 'Saturday':
                        $selectweek = $value->sab;
                        break;
                    case 'Sunday':
                        $selectweek = $value->dom;
                        break;
                }
                switch ($data_senha->format('m')) {
                    case '01':
                        $selectmonth = $value->jan;
                        break;
                    case '02':
                        $selectmonth = $value->fev;
                        break;
                    case '03':
                        $selectmonth = $value->mar;
                        break;
                    case '04':
                        $selectmonth = $value->abr;
                        break;
                    case '05':
                        $selectmonth = $value->mai;
                        break;
                    case '06':
                        $selectmonth = $value->jun;
                        break;
                    case '07':
                        $selectmonth = $value->jul;
                        break;
                    case '08':
                        $selectmonth = $value->ago;
                        break;
                    case '09':
                        $selectmonth = $value->set;
                        break;
                    case '10':
                        $selectmonth = $value->out;
                        break;
                    case '11':
                        $selectmonth = $value->nov;
                        break;
                    case '12':
                        $selectmonth = $value->dez;
                        break;
                }
                switch ($data_senha->format('d')) {
                    case '01':
                        $selectday = $value->d01;
                        break;
                    case '02':
                        $selectday = $value->d02;
                        break;
                    case '03':
                        $selectday = $value->d03;
                        break;
                    case '04':
                        $selectday = $value->d04;
                        break;
                    case '05':
                        $selectday = $value->d05;
                        break;
                    case '06':
                        $selectday = $value->d06;
                        break;
                    case '07':
                        $selectday = $value->d07;
                        break;
                    case '08':
                        $selectday = $value->d08;
                        break;
                    case '09':
                        $selectday = $value->d09;
                        break;
                    case '10':
                        $selectday = $value->d10;
                        break;
                    case '11':
                        $selectday = $value->d11;
                        break;
                    case '12':
                        $selectday = $value->d12;
                        break;
                    case '13':
                        $selectday = $value->d13;
                        break;
                    case '14':
                        $selectday = $value->d14;
                        break;
                    case '15':
                        $selectday = $value->d15;
                        break;
                    case '16':
                        $selectday = $value->d16;
                        break;
                    case '17':
                        $selectday = $value->d17;
                        break;
                    case '18':
                        $selectday = $value->d18;
                        break;
                    case '19':
                        $selectday = $value->d19;
                        break;
                    case '20':
                        $selectday = $value->d20;
                        break;
                    case '21':
                        $selectday = $value->d21;
                        break;
                    case '22':
                        $selectday = $value->d22;
                        break;
                    case '23':
                        $selectday = $value->d23;
                        break;
                    case '24':
                        $selectday = $value->d24;
                        break;
                    case '25':
                        $selectday = $value->d25;
                        break;
                    case '26':
                        $selectday = $value->d26;
                        break;
                    case '27':
                        $selectday = $value->d27;
                        break;
                    case '28':
                        $selectday = $value->d28;
                        break;
                    case '29':
                        $selectday = $value->d29;
                        break;
                    case '30':
                        $selectday = $value->d30;
                        break;
                    case '31':
                        $selectday = $value->d31;
                        break;
                }

                $soma = array($value->fixo, $value->dependencia, $selectmonth, $selectweek, $selectday);
                $row = array();
                $row[] = $tt;
                $row[] = $value->fixo;
                $row[] = $value->dependencia;
                $row[] = $selectmonth;
                $row[] = $selectweek;
                $row[] = $selectday;
                $row[] = array_sum($soma);
                ++$tt;
                ++$tb;
                $data[] = $row;
                unset($soma);
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
            $sislo_protege_model = new \App\Models\Sislo_CarroForteProtegeModel;
            $sislo_protege_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_protege_model->set('fixo', $this->request->getPost('fixo'));
            $sislo_protege_model->set('dependencia', $this->request->getPost('dependencia'));
            $sislo_protege_model->set('jan', $this->request->getPost('jan'));
            $sislo_protege_model->set('fev', $this->request->getPost('fev'));
            $sislo_protege_model->set('mar', $this->request->getPost('mar'));
            $sislo_protege_model->set('abr', $this->request->getPost('abr'));
            $sislo_protege_model->set('mai', $this->request->getPost('mai'));
            $sislo_protege_model->set('jun', $this->request->getPost('jun'));
            $sislo_protege_model->set('jul', $this->request->getPost('jul'));
            $sislo_protege_model->set('ago', $this->request->getPost('ago'));
            $sislo_protege_model->set('set', $this->request->getPost('set'));
            $sislo_protege_model->set('out', $this->request->getPost('out'));
            $sislo_protege_model->set('nov', $this->request->getPost('nov'));
            $sislo_protege_model->set('dez', $this->request->getPost('dez'));
            $sislo_protege_model->set('seg', $this->request->getPost('seg'));
            $sislo_protege_model->set('ter', $this->request->getPost('ter'));
            $sislo_protege_model->set('qua', $this->request->getPost('qua'));
            $sislo_protege_model->set('qui', $this->request->getPost('qui'));
            $sislo_protege_model->set('sex', $this->request->getPost('sex'));
            $sislo_protege_model->set('sab', $this->request->getPost('sab'));
            $sislo_protege_model->set('dom', $this->request->getPost('dom'));
            $sislo_protege_model->set('d01', $this->request->getPost('d01'));
            $sislo_protege_model->set('d02', $this->request->getPost('d02'));
            $sislo_protege_model->set('d03', $this->request->getPost('d03'));
            $sislo_protege_model->set('d04', $this->request->getPost('d04'));
            $sislo_protege_model->set('d05', $this->request->getPost('d05'));
            $sislo_protege_model->set('d06', $this->request->getPost('d06'));
            $sislo_protege_model->set('d07', $this->request->getPost('d07'));
            $sislo_protege_model->set('d08', $this->request->getPost('d08'));
            $sislo_protege_model->set('d09', $this->request->getPost('d09'));
            $sislo_protege_model->set('d10', $this->request->getPost('d10'));
            $sislo_protege_model->set('d11', $this->request->getPost('d11'));
            $sislo_protege_model->set('d12', $this->request->getPost('d12'));
            $sislo_protege_model->set('d13', $this->request->getPost('d13'));
            $sislo_protege_model->set('d14', $this->request->getPost('d14'));
            $sislo_protege_model->set('d15', $this->request->getPost('d15'));
            $sislo_protege_model->set('d16', $this->request->getPost('d16'));
            $sislo_protege_model->set('d17', $this->request->getPost('d17'));
            $sislo_protege_model->set('d18', $this->request->getPost('d18'));
            $sislo_protege_model->set('d19', $this->request->getPost('d19'));
            $sislo_protege_model->set('d20', $this->request->getPost('d20'));
            $sislo_protege_model->set('d21', $this->request->getPost('d21'));
            $sislo_protege_model->set('d22', $this->request->getPost('d22'));
            $sislo_protege_model->set('d23', $this->request->getPost('d23'));
            $sislo_protege_model->set('d24', $this->request->getPost('d24'));
            $sislo_protege_model->set('d25', $this->request->getPost('d25'));
            $sislo_protege_model->set('d26', $this->request->getPost('d26'));
            $sislo_protege_model->set('d27', $this->request->getPost('d27'));
            $sislo_protege_model->set('d28', $this->request->getPost('d28'));
            $sislo_protege_model->set('d29', $this->request->getPost('d29'));
            $sislo_protege_model->set('d30', $this->request->getPost('d30'));
            $sislo_protege_model->set('d31', $this->request->getPost('d31'));
            $sislo_protege_model->set('validade', $this->request->getPost('validade'));
            $sislo_protege_model->set('status', 1);
            $sislo_protege_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_protege_model->insert() == true ? 1 : 0;
            } else {
                $sislo_protege_model->where('idsislo_protege', $this->request->getPost('idsislo_protege'));
                echo $sislo_protege_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('login');
        }
    }

    public function redireciona_protege() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_protege_model = new \App\Models\Sislo_CarroForteProtegeModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['idsislo_protege'] = '';
                $dados['cod_loterico'] = $this->session->get('cod_lot');
                $dados['fixo'] = '';
                $dados['jan'] = '';
                $dados['fev'] = '';
                $dados['mar'] = '';
                $dados['abr'] = '';
                $dados['mai'] = '';
                $dados['jun'] = '';
                $dados['jul'] = '';
                $dados['ago'] = '';
                $dados['set'] = '';
                $dados['out'] = '';
                $dados['nov'] = '';
                $dados['dez'] = '';
                $dados['seg'] = '';
                $dados['ter'] = '';
                $dados['qua'] = '';
                $dados['qui'] = '';
                $dados['sex'] = '';
                $dados['sab'] = '';
                $dados['dom'] = '';
                $dados['d01'] = '';
                $dados['d02'] = '';
                $dados['d03'] = '';
                $dados['d04'] = '';
                $dados['d05'] = '';
                $dados['d06'] = '';
                $dados['d07'] = '';
                $dados['d08'] = '';
                $dados['d09'] = '';
                $dados['d10'] = '';
                $dados['d11'] = '';
                $dados['d12'] = '';
                $dados['d13'] = '';
                $dados['d14'] = '';
                $dados['d15'] = '';
                $dados['d16'] = '';
                $dados['d17'] = '';
                $dados['d18'] = '';
                $dados['d19'] = '';
                $dados['d20'] = '';
                $dados['d21'] = '';
                $dados['d22'] = '';
                $dados['d23'] = '';
                $dados['d24'] = '';
                $dados['d25'] = '';
                $dados['d26'] = '';
                $dados['d27'] = '';
                $dados['d28'] = '';
                $dados['d29'] = '';
                $dados['d30'] = '';
                $dados['d31'] = '';
                $dados['validade'] = '';
                $dados['dependencia'] = '';
            } else {
                $incluir = 2;
                $dados_protege = $sislo_protege_model->find($this->request->getGet('id'));
                $dados['idsislo_protege'] = $dados_protege->idsislo_protege;
                $dados['cod_loterico'] = $dados_protege->cod_loterico;
                $dados['fixo'] = $dados_protege->fixo;
                $dados['jan'] = $dados_protege->jan;
                $dados['fev'] = $dados_protege->fev;
                $dados['mar'] = $dados_protege->mar;
                $dados['abr'] = $dados_protege->abr;
                $dados['mai'] = $dados_protege->mai;
                $dados['jun'] = $dados_protege->jun;
                $dados['jul'] = $dados_protege->jul;
                $dados['ago'] = $dados_protege->ago;
                $dados['set'] = $dados_protege->set;
                $dados['out'] = $dados_protege->out;
                $dados['nov'] = $dados_protege->nov;
                $dados['dez'] = $dados_protege->dez;
                $dados['seg'] = $dados_protege->seg;
                $dados['ter'] = $dados_protege->ter;
                $dados['qua'] = $dados_protege->qua;
                $dados['qui'] = $dados_protege->qui;
                $dados['sex'] = $dados_protege->sex;
                $dados['sab'] = $dados_protege->sab;
                $dados['dom'] = $dados_protege->dom;
                $dados['d01'] = $dados_protege->d01;
                $dados['d02'] = $dados_protege->d02;
                $dados['d03'] = $dados_protege->d03;
                $dados['d04'] = $dados_protege->d04;
                $dados['d05'] = $dados_protege->d05;
                $dados['d06'] = $dados_protege->d06;
                $dados['d07'] = $dados_protege->d07;
                $dados['d08'] = $dados_protege->d08;
                $dados['d09'] = $dados_protege->d09;
                $dados['d10'] = $dados_protege->d10;
                $dados['d11'] = $dados_protege->d11;
                $dados['d12'] = $dados_protege->d12;
                $dados['d13'] = $dados_protege->d13;
                $dados['d14'] = $dados_protege->d14;
                $dados['d15'] = $dados_protege->d15;
                $dados['d16'] = $dados_protege->d16;
                $dados['d17'] = $dados_protege->d17;
                $dados['d18'] = $dados_protege->d18;
                $dados['d19'] = $dados_protege->d19;
                $dados['d20'] = $dados_protege->d20;
                $dados['d21'] = $dados_protege->d21;
                $dados['d22'] = $dados_protege->d22;
                $dados['d23'] = $dados_protege->d23;
                $dados['d24'] = $dados_protege->d24;
                $dados['d25'] = $dados_protege->d25;
                $dados['d26'] = $dados_protege->d26;
                $dados['d27'] = $dados_protege->d27;
                $dados['d28'] = $dados_protege->d28;
                $dados['d29'] = $dados_protege->d29;
                $dados['d30'] = $dados_protege->d30;
                $dados['d31'] = $dados_protege->d31;
                $dados['dependencia'] = $dados_protege->dependencia;
                $dados['validade'] = $dados_protege->validade;
                unset($dados_protege);
            }
            $data = array(
                "scripts" => array(
                    "sislo_protege_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "idsislo_protege" => $dados['idsislo_protege'],
                "cod_loterico" => $dados['cod_loterico'],
                "fixo" => $dados['fixo'],
                "jan" => $dados['jan'],
                "fev" => $dados['fev'],
                "mar" => $dados['mar'],
                "abr" => $dados['abr'],
                "mai" => $dados['mai'],
                "jun" => $dados['jun'],
                "jul" => $dados['jul'],
                "ago" => $dados['ago'],
                "set" => $dados['set'],
                "out" => $dados['out'],
                "nov" => $dados['nov'],
                "dez" => $dados['dez'],
                "seg" => $dados['seg'],
                "ter" => $dados['ter'],
                "qua" => $dados['qua'],
                "qui" => $dados['qui'],
                "sex" => $dados['sex'],
                "sab" => $dados['sab'],
                "dom" => $dados['dom'],
                "d01" => $dados['d01'],
                "d02" => $dados['d02'],
                "d03" => $dados['d03'],
                "d04" => $dados['d04'],
                "d05" => $dados['d05'],
                "d06" => $dados['d06'],
                "d07" => $dados['d07'],
                "d08" => $dados['d08'],
                "d09" => $dados['d09'],
                "d10" => $dados['d10'],
                "d11" => $dados['d11'],
                "d12" => $dados['d12'],
                "d13" => $dados['d13'],
                "d14" => $dados['d14'],
                "d15" => $dados['d15'],
                "d16" => $dados['d16'],
                "d17" => $dados['d17'],
                "d18" => $dados['d18'],
                "d19" => $dados['d19'],
                "d20" => $dados['d20'],
                "d21" => $dados['d21'],
                "d22" => $dados['d22'],
                "d23" => $dados['d23'],
                "d24" => $dados['d24'],
                "d25" => $dados['d25'],
                "d26" => $dados['d26'],
                "d27" => $dados['d27'],
                "d28" => $dados['d28'],
                "d29" => $dados['d29'],
                "d30" => $dados['d30'],
                "d31" => $dados['d31'],
                "dependencia" => $dados['dependencia'],
                "validade" => $dados['validade']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_protege_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

}
