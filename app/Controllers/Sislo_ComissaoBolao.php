<?php

namespace App\Controllers;

class Sislo_ComissaoBolao extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_comissao_bolao.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_comissao_bolao', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function sislo_calculadora_boloes() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_calculadora_bolao.js",
                    "jquery.validate.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_calculadora_bolao', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function situacao_boloes() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "situacao_boloes.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('situacao_boloes', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function redireciona_comissao_jogosbolao() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_jogos = new \App\Models\SisloJogosCefModel;
            $jogos = $sislo_jogos->where('status', 1)->orderBy('nome', 'asc')->findAll();
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['cod_loterico'] = $this->session->get('cod_lot');

                $data = array(
                    "scripts" => array(
                        "sislo_comissao_bolao_crud.js",
                        "sweetalert2.all.min.js",
                        "jquery.validate.js",
                        "jquery.mask.min.js",
                        "jquery.maskMoney.min.js",
                        "util.js"
                    ),
                    "user_name" => $dadosuser->sislo_nome,
                    "jogos" => $jogos,
                    "cod_loterico" => $this->session->get('cod_lot'),
                    "incluir" => $incluir
                );

                echo view('template/header', $data);
                echo view('template/menu');
                echo view('template/content');
                echo view('sislo_comissao_bolao_crud', $data);
                echo view('template/footer', $data);
                echo view('template/scripts', $data);
            } else {
                $incluir = 2;
            }
        } else {
            echo view('login');
        }
    }

    public function carrega_comissoes_boloes() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $builder = $db->table('sislo_comissao_bolao as scs');
        $query = $builder->select("scs.idsislo_comissao_bolao as idsislo_comissao_bolao, "
                        . "sts.nome as nome, scs.cotas as cotas, scs.valor_bolao as valor_bolao, "
                        . "scs.valor_tarifa as valor_tarifa, scs.tarifa as tarifa, scs.dia_inicial as dia_inicial")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")
                ->where('MONTH(scs.dia_inicial)', $this->request->getPost('mes'))
                ->where('YEAR(scs.dia_inicial)', $this->request->getPost('ano'))
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->orderBy('scs.dia_inicial', 'asc')
                ->get();
        return $query;
    }

    public function carrega_ajax_table_sislo_situacao_boloes() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $builder = $db->table('sislo_comissao_bolao as scs');
        $query = $builder->select("sts.nome as nome, SUM(scs.cotas) as cotas, SUM(scs.valor_tarifa) as valor_tarifa ")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef ", "inner ")
                ->where('MONTH(scs.dia_inicial)', $this->request->getPost('mes'))
                ->where('YEAR(scs.dia_inicial)', $this->request->getPost('ano'))
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->groupBy('scs.id_sislo_jogos_cef')
                ->orderBy('scs.dia_inicial', 'asc')
                ->get();
        return $query;
    }

    public function ajax_table_sislo_situacao_boloes() {
        if ($this->request->isAJAX()) {
            $sislo_comissao = $this->carrega_ajax_table_sislo_situacao_boloes()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            $soma = array();
            foreach ($sislo_comissao as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $this->formataDataParaDatatable($value->dia_inicial);
                $row[] = $value->nome;
                $row[] = trim($value->cotas);
                $row[] = $this->formataValoresMonetarios($value->valor_tarifa);
                $soma[] = $value->valor_tarifa;
                ++$tt;
                ++$tb;
                $data[] = $row;
            }
            $json = array(
                "recordsTotal" => $tb,
                "recordsFiltered" => $tb,
                "sominha" => number_format(array_sum($soma), 2, ',', '.'),
                "data" => $data
            );
            echo json_encode($json);
        } else {
            echo view('login');
        }
    }

    public function carrega_tfl() {
        $cod_lot = $this->session->get('cod_lot');
        $sislo_tfl = new \App\Models\Sislo_TflModel;

        $tfl = $sislo_tfl->select('COUNT(terminal) AS tfl')
                ->where("cod_loterico", $cod_lot)
                ->where('status', 1)
                ->first();
        return $tfl->tfl;
    }

    public function carrega_acumulados() {
        $sislo_acumulado_mega = new \App\Models\Sislo_MegaSenaModel;
        $sislo_acumulado_quina = new \App\Models\Sislo_QuinaModel;
        $sislo_acumulado_lotofacil = new \App\Models\Sislo_LotofacilModel;
        $sislo_acumulado_dia = new \App\Models\Sislo_DiaDeSorteModel;
        $sislo_acumulado_dupla = new \App\Models\Sislo_DuplaSenaModel;
        $acumulados = array();

        $megasena = $sislo_acumulado_mega->select('premio_acumulado')
                ->orderBy('idsislo_megasena', 'desc')
                ->first();
        $acumulados['mega'] = $megasena->premio_acumulado ?? 0;

        $quina = $sislo_acumulado_quina->select('premio_acumulado')
                ->orderBy('idsislo_quina', 'desc')
                ->first();
        $acumulados['quina'] = $quina->premio_acumulado ?? 0;

        $lotofacil = $sislo_acumulado_lotofacil->select('premio_acumulado')
                ->orderBy('idsislo_lotofacil', 'desc')
                ->first();
        $acumulados['lotofacil'] = $lotofacil->premio_acumulado ?? 0;

        $dia = $sislo_acumulado_dia->select('premio_acumulado')
                ->orderBy('idsislo_diadesorte', 'desc')
                ->first();
        $acumulados['dia'] = $dia->premio_acumulado ?? 0;

        $dupla = $sislo_acumulado_dupla->select('premio_acumulado')
                ->orderBy('idsislo_duplasena', 'desc')
                ->first();
        $acumulados['dupla'] = $dupla->premio_acumulado ?? 0;

        return $acumulados;
    }

    public function carrega_valores_jogos() {
        $sislo_valor_mega = new \App\Models\Sislo_MegasenaValoresModel;
        $sislo_valor_quina = new \App\Models\Sislo_QuinaValoresModel;
        $sislo_valor_lotofacil = new \App\Models\Sislo_LotofacilValoresModel;
        $sislo_valor_dia = new \App\Models\Sislo_DiaDeSorteValoresModel;
        $sislo_valor_dupla = new \App\Models\Sislo_DuplasenaValoresModel;
        $valores = array();

        $megasena = $sislo_valor_mega->select('valor,dezenas')
                ->where('dezenas > ', 6)
                ->orderBy('id_sislo_megasena_valores', 'desc')
                ->findAll();
        $valores['mega'] = $megasena;

        $quina = $sislo_valor_quina->select('valor,dezenas')
                ->where('dezenas > ', 5)
                ->orderBy('id_sislo_quina_valores', 'desc')
                ->findAll();
        $valores['quina'] = $quina;

        $lotofacil = $sislo_valor_lotofacil->select('valor,dezenas')
                ->where('dezenas > ', 15)
                ->orderBy('id_sislo_lotofacil_valores', 'desc')
                ->findAll();
        $valores['lotofacil'] = $lotofacil;

        $dia = $sislo_valor_dia->select('valor,dezenas')
                ->where('dezenas > ', 7)
                ->orderBy('id_sislo_diadesorte_valores', 'desc')
                ->findAll();
        $valores['dia'] = $dia;

        $dupla = $sislo_valor_dupla->select('valor,dezenas')
                ->where('dezenas > ', 6)
                ->orderBy('id_sislo_duplasena_valores', 'desc')
                ->findAll();
        $valores['dupla'] = $dupla;

        return $valores;
    }

    public function calcula_boloes_mega($acumulado, $valores, $cotas,
            $comissao_desejada) {
        $desejo_de_comissao = bcmul($this->limparValoresMonetarios(
                        $comissao_desejada), 0.70, 0);
        $comissao_soma = 0;
        switch ($acumulado) {
            case $acumulado < 5000000:
                $aviso = "A";
                //está entrando aqui certinho, agora pegar os valores e começar a calcular
                //usando a comissão desejada como critério para continuar o calculo
                //isso será dentro de um loop
                break;
            case $acumulado > 5000001 and $acumulado < 10000000:
                $aviso = "B";
                break;
            case $acumulado > 10000001 and $acumulado < 30000000:
                $aviso = "C";
                break;
            case $acumulado > 30000001 and $acumulado < 50000000:
                $aviso = "C";
                break;
            case $acumulado > 50000001 and $acumulado < 60000000:
                $aviso = "C";
                break;
            case $acumulado > 60000001 and $acumulado < 80000000:
                $aviso = "faixa que eu";
                break;
            case $acumulado > 80000001 and $acumulado < 100000000:
                $aviso = '654';
                break;
            case $acumulado > 100000001:
                $aviso = "faixa acima de 100 milhos" . $desejo_de_comissao;
                
                while ($desejo_de_comissao <= $comissao_soma){
                    //aqui monta o bolão
                }
                break;
        }
        return $aviso;
    }

    public function ajax_list_calculadora_bolao() {//aqui começa a calculadora
        if ($this->request->isAJAX()) {
            $cod_lot = $this->session->get('cod_lot');
            $data_atual = new \Datetime($this->request->getPost('data_atual'));
            $cotas = $this->request->getPost('cotas');
            $comissao_desejada = $this->request->getPost('comissao_desejada');

            $tfl = $this->carrega_tfl();
            $acumulados = $this->carrega_acumulados();
            $valores = $this->carrega_valores_jogos();

            $mega_boloes = $this->calcula_boloes_mega($acumulados['mega'],
                    $valores['mega'], $cotas, $comissao_desejada);
            var_dump($mega_boloes);
            die();

            $sislo_comissao = $this->carrega_ajax_table_sislo_situacao_boloes()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            $soma = array();
            foreach ($sislo_comissao as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $this->formataDataParaDatatable($value->dia_inicial);
                $row[] = $value->nome;
                $row[] = trim($value->cotas);
                $row[] = $this->formataValoresMonetarios($value->valor_tarifa);
                $soma[] = $value->valor_tarifa;
                ++$tt;
                ++$tb;
                $data[] = $row;
            }
            $json = array(
                "recordsTotal" => $tb,
                "recordsFiltered" => $tb,
                "sominha" => number_format(array_sum($soma), 2, ',', '.'),
                "data" => $data
            );
            echo json_encode($json);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_comissao_bolao() {//fazer o redireciona FAZER o formulario para incluir, form para editar
        if ($this->request->isAJAX()) {
            $sislo_comissao = $this->carrega_comissoes_boloes()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_comissao as $value) {
                $row = array();
                $row[] = $this->formataDataParaDatatable($value->dia_inicial);
                $row[] = $value->nome;
                $row[] = trim($value->cotas);
                $row[] = $this->formataValoresMonetarios($value->valor_bolao);
                $row[] = $this->formataValoresMonetarios($value->valor_tarifa);
                $row[] = $value->tarifa;
                $row[] = '<a class="btn btn-primary" href="' .
                        base_url('redireciona_comissao_jogosbolao/?id=' .
                                $value->idsislo_comissao_bolao) .
                        '">Editar</a>';
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
            $cob = new \App\Models\Sislo_ComissaoBolaoModel;
            $datas = array();
            $datas['cod_loterico'] = $this->request->getPost('cod_loterico');
            $datas['dia_inicial'] = $this->request->getPost('dia_inicial');
            $datas['id_sislo_jogos_cef'] = $this->request->getPost('id_sislo_jogos_cef');
            $datas['cotas'] = $this->request->getPost('cotas');
            $datas['valor_bolao'] = $this->request->getPost('valor_bolao');
            $datas['tarifa'] = $this->request->getPost('tarifa');
            $datas['valor_tarifa'] = $this->request->getPost('valor_tarifa');
            $datas['status'] = 1;
            $datas['data_ultima_alteracao'] = date('Y-m-d H:i:s');
            $insert = array();
            $i = 0;
            foreach ($datas['id_sislo_jogos_cef'] as $value) {
                $conjunto = [
                    'cod_loterico' => $datas['cod_loterico'],
                    'dia_inicial' => $datas['dia_inicial'],
                    'id_sislo_jogos_cef' => $value,
                    'cotas' => $datas['cotas'][$i],
                    'valor_bolao' => $this->limparValoresMonetarios($datas['valor_bolao'][$i]),
                    'tarifa' => $this->limparValoresMonetarios($datas['tarifa'][$i]),
                    'valor_tarifa' => $this->limparValoresMonetarios($datas['valor_tarifa'][$i]),
                    'status' => $datas['status'],
                    'data_ultima_alteracao' => $datas['data_ultima_alteracao']
                ];
                array_push($insert, $conjunto);
                unset($conjunto);
                ++$i;
            }

            if ($this->request->getPost('incluir') == '1') {
                $entrou = $cob->insertBatch($insert) == true ? 1 : 0;
                echo $entrou;
            } else {//este else trabalhar emcima do editar que vai ser criado
                //$sislo_contaspagar_model->where('idsislo_contas_pagar', $this->request->getPost('idsislo_contas_pagar'));
                echo $entrou;
            }
        } else {
            echo view('login');
        }
    }
}
