<?php

namespace App\Controllers;

class Sislo_FechamentoCofre extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_protege_model = new \App\Models\Sislo_CarroForteProtegeModel;
            $sislo_fechamento_model = new \App\Models\Sislo_FechamentoCaixaModel;
            $result = $sislo_model->find($this->session->get('user_id'));

            $data_senha = new \Datetime('now');
            $sislo_protege = $sislo_protege_model->where('cod_loterico', $this->session->get('cod_lot'))
                            ->where('validade', $data_senha->format('Y'))->where('status', 1)
                            ->orderBy('validade', 'desc')->findAll();

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
            }

            $data_fechamento = $sislo_fechamento_model->select("MAX(data_fechamento) AS 'data_fechamento'")
                    ->where("cod_loterico", $this->session->get('cod_lot'))
                    ->find();

            $sislo_fechamentos = $sislo_fechamento_model->select("caixa_operador, total_sobra_cx")
                    ->where("cod_loterico", $this->session->get('cod_lot'))
                    ->where('data_fechamento', $data_fechamento[0]->data_fechamento)
                    ->groupBy('caixa_operador')
                    ->orderBy('caixa_operador', 'asc')
                    ->get();

            $data = array(
                "scripts" => array(
                    "sislo_fechamento_cofre.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome,
                "cod_loterico" => $this->session->get('cod_lot'),
                "senha_protege" => array_sum($soma),
                "dados_remessas" => $this->carrega_sangrias()->getResult(),
                "dados_sobra_cx" => $sislo_fechamentos->getResult()
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_fechamento_cofre', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function carrega_sangrias() {
        $db = \Config\Database::connect();
        $data_senha = new \Datetime('now');
        $builder = $db->table('sislo_sangria as ss');
        $query = $builder->select("st.caixa_numero AS caixa_numero, SUM(ss.valor) AS valor")
                ->join("sislo_tfl as st", "st.idsislo_tfl = ss.idsislo_tfl", "inner")
                ->where("ss.data_coleta", $data_senha->format('Y-m-d'))
                ->where("ss.cod_loterico", $this->session->get('cod_lot'))
                ->groupBy('st.caixa_numero')
                ->orderBy('st.caixa_numero', 'asc')
                ->get();
        return $query;
    }

    public function sislo_fechamento_cofre_novo_execute() {
        if ($this->request->isAJAX()) {
            $sislo_model = new \App\Models\Sislo_FechamentoCofreModel;

            $datas = array();
            $remessa = $sobra_cx = $somatudo = 0;

            foreach ($this->request->getPost('remessa') as $remessas) {
                $remessa = bcadd($remessa, $this->limparValoresMonetarios($remessas), 2);
            }
            $datas['remessa'] = !empty($remessa) ? $remessa : 0;

            foreach ($this->request->getPost('sobra_cx') as $sobra_cxs) {
                $sobra_cx = bcadd($sobra_cx, $this->limparValoresMonetarios($sobra_cxs), 2);
            }
            $datas['sobra_cx'] = !empty($sobra_cx) ? $sobra_cx : 0;

            $sislo_model->set('data_fechamento', $this->request->getPost('data_fechamento'));
            $sislo_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_model->set('senha_protege', $this->request->getPost('senha_protege'));
            $sislo_model->set('os_gtv', $this->request->getPost('os_gtv'));
            $sislo_model->set('guia_gtv', $this->request->getPost('guia_gtv'));
            $sislo_model->set('remessa', $datas['remessa']);
            $sislo_model->set('sobra_cx', $datas['sobra_cx']);
            $sislo_model->set('acumulado_comissao', $this->limparValoresMonetarios($this->request->getPost('acumulado_comissao')));
            $sislo_model->set('comissao', $this->limparValoresMonetarios($this->request->getPost('comissao')));
            $sislo_model->set('pag_lot_fed', $this->limparValoresMonetarios($this->request->getPost('pag_lot_fed')));
            $sislo_model->set('pag_telesena', $this->limparValoresMonetarios($this->request->getPost('pag_telesena')));
            $sislo_model->set('pag_outros', $this->limparValoresMonetarios($this->request->getPost('pag_outros')));
            $sislo_model->set('obs_outros', $this->request->getPost('obs_outros'));
            $sislo_model->set('status', 1);
            $sislo_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($sislo_model->insert() == true) {

                $mostra_tela_remessa = !empty($datas['remessa']) ? $datas['remessa'] : 0;
                $mostra_tela_sobracaixa = !empty($datas['sobra_cx']) ? $datas['sobra_cx'] : 0;
                $mostra_tela_pag_lot_fed = $this->limparValoresMonetarios(!empty($this->request->getPost('pag_lot_fed')) ? $this->request->getPost('pag_lot_fed') : 0);
                $mostra_tela_pag_outros = $this->limparValoresMonetarios(!empty($this->request->getPost('pag_outros')) ? $this->request->getPost('pag_outros') : 0);
                $mostra_tela_pag_telesena = $this->limparValoresMonetarios(!empty($this->request->getPost('pag_telesena')) ? $this->request->getPost('pag_telesena') : 0);
                $mostra_tela_comissao = $this->limparValoresMonetarios(!empty($this->request->getPost('comissao')) ? $this->request->getPost('comissao') : 0);                

                $somatudo = bcadd($somatudo, $mostra_tela_remessa);
                $somatudo = bcadd($somatudo, $mostra_tela_sobracaixa);

                $total_outros = 0;
                $total_outros = bcadd($total_outros, $mostra_tela_pag_lot_fed,2);
                $total_outros = bcadd($total_outros, $mostra_tela_pag_outros,2);
                $total_outros = bcadd($total_outros, $mostra_tela_pag_telesena,2);

                $somatudo = bcadd($somatudo, $total_outros,2);
                $total_cofrinho = bcsub($somatudo, $mostra_tela_comissao,2);
                $porextenso = $this->Extenso($total_cofrinho, 2);                

                $table = '<div class="col-sm-12">';
                $table .= '<table class="table table-striped table-bordered table-responsive text text-sm text-center">';
                $table .= '<thead><tr><th colspan="2">Resumo</th></tr></thead>';
                $table .= '<tbody>';
                $table .= '<tr>';
                $table .= '<td>';
                $table .= 'Senha Protege';
                $table .= '</td>';
                $table .= '<td>';
                $table .= $this->request->getPost('senha_protege');
                $table .= '</td>';
                $table .= '</tr>';
                $table .= '<tr>';
                $table .= '<td>';
                $table .= 'Remessas';
                $table .= '</td>';
                $table .= '<td>';
                $table .= $this->formataValoresMonetarios($datas['remessa']);
                $table .= '</td>';
                $table .= '</tr>';
                $table .= '<tr>';
                $table .= '<td>';
                $table .= 'Sobras de Caixa';
                $table .= '</td>';
                $table .= '<td>';
                $table .= $this->formataValoresMonetarios($datas['sobra_cx']);
                $table .= '</td>';
                $table .= '</tr>';
                $table .= '<tr>';
                $table .= '<td>';
                $table .= 'Total Outros';
                $table .= '</td>';
                $table .= '<td>';
                $table .= $this->formataValoresMonetarios($total_outros);
                $table .= '</td>';
                $table .= '</tr>';
                $table .= '<tr>';
                $table .= '<td>';
                $table .= 'Comissão Jogos';
                $table .= '</td>';
                $table .= '<td>';
                $table .= $this->formataValoresMonetarios($mostra_tela_comissao);
                $table .= '</td>';
                $table .= '</tr>';
                $table .= '<tr>';
                $table .= '<td>';
                $table .= 'Total Cofre';
                $table .= '</td>';
                $table .= '<td>';
                $table .= $this->formataValoresMonetarios($total_cofrinho);
                $table .= '</td>';
                $table .= '</tr>';
                $table .= '<tr>';
                $table .= '<td>';
                $table .= 'Por Extenso';
                $table .= '</td>';
                $table .= '<td>';
                $table .= $porextenso;
                $table .= '</td>';
                $table .= '</tr>';
                $table .= '</tbody>';
                $table .= '</table>';
                echo $table;
            } else {
                echo '<h1 class="text text-danger">Houve um erro ao salvar!!</h1>';
            }
        } else {
            echo view('login');
        }
    }

}
