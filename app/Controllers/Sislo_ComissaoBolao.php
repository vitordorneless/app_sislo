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
                ->orderBy('id_sislo_megasena_valores', 'asc')
                ->findAll();
        $valores['mega'] = $megasena;

        $quina = $sislo_valor_quina->select('valor,dezenas')
                ->where('dezenas > ', 5)
                ->orderBy('id_sislo_quina_valores', 'asc')
                ->findAll();
        $valores['quina'] = $quina;

        $lotofacil = $sislo_valor_lotofacil->select('valor,dezenas')
                ->where('dezenas > ', 15)
                ->orderBy('id_sislo_lotofacil_valores', 'asc')
                ->findAll();
        $valores['lotofacil'] = $lotofacil;

        $dia = $sislo_valor_dia->select('valor,dezenas')
                ->where('dezenas > ', 7)
                ->orderBy('id_sislo_diadesorte_valores', 'asc')
                ->findAll();
        $valores['dia'] = $dia;

        $dupla = $sislo_valor_dupla->select('valor,dezenas')
                ->where('dezenas > ', 6)
                ->orderBy('id_sislo_duplasena_valores', 'asc')
                ->findAll();
        $valores['dupla'] = $dupla;

        return $valores;
    }

    public function calcula_boloes_mega($acumulado, $valores, $cotas,
            $comissao_desejada) {
        $desejo_de_comissao = bcmul($this->limparValoresMonetarios(
                        $comissao_desejada), 0.70, 2);
        $comissao_soma = 0;
        $cotas_metade = $cotas % 2 == 0 ? bcdiv($cotas, 2, 0) :
                bcdiv(bcadd($cotas, 1, 0), 2, 0);
        $lista_boloes = array();
        switch ($acumulado) {
            case $acumulado < 5000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //7 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //7 dezenas fim
                    //8 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //8 dezenas fim                    
                    ++$cont_bolao;
                }
                break;
            case $acumulado > 5000001 and $acumulado < 10000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //7 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //7 dezenas fim
                    //8 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //8 dezenas fim
                    //9 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(1, 5);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //9 dezenas fim                    
                    ++$cont_bolao;
                }
                break;
            case $acumulado > 10000001 and $acumulado < 30000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //7 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //7 dezenas fim
                    //8 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //8 dezenas fim
                    //9 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(1, 5);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //9 dezenas fim
                    //10 dezenas
                    if ($cont_bolao === 3) {
                        $quantidade_de_jogos = mt_rand(1, 3);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //10 dezenas fim
                    //11 dezenas
                    if ($cont_bolao === 4) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //11 dezenas fim
                    //12 dezenas
                    if ($cont_bolao === 5) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //12 dezenas fim                    
                    ++$cont_bolao;
                }
                break;
            case $acumulado > 30000001 and $acumulado < 50000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //7 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //7 dezenas fim
                    //8 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //8 dezenas fim
                    //9 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(1, 5);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //9 dezenas fim
                    //10 dezenas
                    if ($cont_bolao === 3) {
                        $quantidade_de_jogos = mt_rand(1, 3);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //10 dezenas fim
                    //11 dezenas
                    if ($cont_bolao === 4) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //11 dezenas fim
                    //12 dezenas
                    if ($cont_bolao === 5) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //12 dezenas fim
                    //13 dezenas
                    if ($cont_bolao === 6) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //13 dezenas fim
                    //14 dezenas
                    if ($cont_bolao === 7) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //14 dezenas fim
                    //15 dezenas
                    if ($cont_bolao === 8) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //15 dezenas fim
                    //16 dezenas
                    if ($cont_bolao === 9) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //16 dezenas fim
                    //17 dezenas
                    if ($cont_bolao === 10) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //17 dezenas fim
                    //18 dezenas
                    if ($cont_bolao === 11) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //18 dezenas fim
                    //19 dezenas
                    if ($cont_bolao === 12) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //19 dezenas fim
                    //20 dezenas
                    if ($cont_bolao === 13) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    ++$cont_bolao;
                }
                break;
            case $acumulado > 50000001 and $acumulado < 60000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //7 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //7 dezenas fim
                    //8 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //8 dezenas fim
                    //9 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(1, 5);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //9 dezenas fim
                    //10 dezenas
                    if ($cont_bolao === 3) {
                        $quantidade_de_jogos = mt_rand(1, 3);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //10 dezenas fim
                    //11 dezenas
                    if ($cont_bolao === 4) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //11 dezenas fim
                    //12 dezenas
                    if ($cont_bolao === 5) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //12 dezenas fim
                    //13 dezenas
                    if ($cont_bolao === 6) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //13 dezenas fim
                    //14 dezenas
                    if ($cont_bolao === 7) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //14 dezenas fim
                    //15 dezenas
                    if ($cont_bolao === 8) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //15 dezenas fim
                    //16 dezenas
                    if ($cont_bolao === 9) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //16 dezenas fim
                    //17 dezenas
                    if ($cont_bolao === 10) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //17 dezenas fim
                    //18 dezenas
                    if ($cont_bolao === 11) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //18 dezenas fim
                    //19 dezenas
                    if ($cont_bolao === 12) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //19 dezenas fim
                    //20 dezenas
                    if ($cont_bolao === 13) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    ++$cont_bolao;
                }
                break;
            case $acumulado > 60000001 and $acumulado < 80000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //7 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //7 dezenas fim
                    //8 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //8 dezenas fim
                    //9 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(1, 5);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //9 dezenas fim
                    //10 dezenas
                    if ($cont_bolao === 3) {
                        $quantidade_de_jogos = mt_rand(1, 3);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //10 dezenas fim
                    //11 dezenas
                    if ($cont_bolao === 4) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //11 dezenas fim
                    //12 dezenas
                    if ($cont_bolao === 5) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //12 dezenas fim
                    //13 dezenas
                    if ($cont_bolao === 6) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //13 dezenas fim
                    //14 dezenas
                    if ($cont_bolao === 7) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //14 dezenas fim
                    //15 dezenas
                    if ($cont_bolao === 8) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //15 dezenas fim
                    //16 dezenas
                    if ($cont_bolao === 9) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //16 dezenas fim
                    //17 dezenas
                    if ($cont_bolao === 10) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //17 dezenas fim
                    //18 dezenas
                    if ($cont_bolao === 11) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //18 dezenas fim
                    //19 dezenas
                    if ($cont_bolao === 12) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //19 dezenas fim
                    //20 dezenas
                    if ($cont_bolao === 13) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    ++$cont_bolao;
                }
                break;
            case $acumulado > 80000001 and $acumulado < 100000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //7 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //7 dezenas fim
                    //8 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //8 dezenas fim
                    //9 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(1, 5);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //9 dezenas fim
                    //10 dezenas
                    if ($cont_bolao === 3) {
                        $quantidade_de_jogos = mt_rand(1, 3);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //10 dezenas fim
                    //11 dezenas
                    if ($cont_bolao === 4) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //11 dezenas fim
                    //12 dezenas
                    if ($cont_bolao === 5) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //12 dezenas fim
                    //13 dezenas
                    if ($cont_bolao === 6) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //13 dezenas fim
                    //14 dezenas
                    if ($cont_bolao === 7) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //14 dezenas fim
                    //15 dezenas
                    if ($cont_bolao === 8) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //15 dezenas fim
                    //16 dezenas
                    if ($cont_bolao === 9) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //16 dezenas fim
                    //17 dezenas
                    if ($cont_bolao === 10) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //17 dezenas fim
                    //18 dezenas
                    if ($cont_bolao === 11) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //18 dezenas fim
                    //19 dezenas
                    if ($cont_bolao === 12) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //19 dezenas fim
                    //20 dezenas
                    if ($cont_bolao === 13) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    ++$cont_bolao;
                }
                break;
            case $acumulado > 100000001:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //7 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //7 dezenas fim
                    //8 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //8 dezenas fim
                    //9 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(1, 5);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //9 dezenas fim
                    //10 dezenas
                    if ($cont_bolao === 3) {
                        $quantidade_de_jogos = mt_rand(1, 3);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //10 dezenas fim
                    //11 dezenas
                    if ($cont_bolao === 4) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //11 dezenas fim
                    //12 dezenas
                    if ($cont_bolao === 5) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //12 dezenas fim
                    //13 dezenas
                    if ($cont_bolao === 6) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //13 dezenas fim
                    //14 dezenas
                    if ($cont_bolao === 7) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //14 dezenas fim
                    //15 dezenas
                    if ($cont_bolao === 8) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //15 dezenas fim
                    //16 dezenas
                    if ($cont_bolao === 9) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //16 dezenas fim
                    //17 dezenas
                    if ($cont_bolao === 10) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //17 dezenas fim
                    //18 dezenas
                    if ($cont_bolao === 11) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //18 dezenas fim
                    //19 dezenas
                    if ($cont_bolao === 12) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //19 dezenas fim
                    //20 dezenas
                    if ($cont_bolao === 13) {
                        $quantidade_de_jogos = mt_rand(1, 2);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //20 dezenas fim
                    ++$cont_bolao;
                    //depois criar function nova, para transformar esse array com indices em um unico
                    //para poder alimentar a datatable
                }
                break;
        }
        return $lista_boloes;
    }

    public function calcula_boloes_lotofacil($acumulado, $valores, $cotas,
            $comissao_desejada) {
        $desejo_de_comissao = bcmul($this->limparValoresMonetarios(
                        $comissao_desejada), 0.10, 2);
        $comissao_soma = 0;
        $cotas_metade = $cotas % 2 == 0 ? bcdiv($cotas, 2, 0) :
                bcdiv(bcadd($cotas, 1, 0), 2, 0);
        $lista_boloes = array();
        switch ($acumulado) {
            case $acumulado < 2000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //16 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //16 dezenas fim
                    //17 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //17 dezenas fim                    
                    ++$cont_bolao;
                }
                break;
            case $acumulado > 2000001 and $acumulado < 5000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //16 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //16 dezenas fim
                    //17 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //17 dezenas fim                    
                    //18 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //18 dezenas fim                    
                    ++$cont_bolao;
                }
                break;
            case $acumulado > 5000001:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //16 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //16 dezenas fim
                    //17 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //17 dezenas fim                    
                    //18 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //18 dezenas fim                    
                    //19 dezenas
                    if ($cont_bolao === 3) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //19 dezenas fim                    
                    //20 dezenas
                    if ($cont_bolao === 4) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //20 dezenas fim                    
                    ++$cont_bolao;
                }
                break;
            default :
                $quantidade_de_jogos = mt_rand(8, 10);
                $bolao = $this->calculodobolao($valores[2]
                        ->valor,
                        $quantidade_de_jogos,
                        $cotas_metade,
                        $porcentagem);
                $comissao_soma = bcadd($bolao['valor_comissao'],
                        $comissao_soma, 2);
                $lista_boloes[$cont_bolao] = array(
                    'valor_jogo' => $valores[2]->valor,
                    'dezenas' => $valores[2]->dezenas,
                    'valor_cota' => $bolao['valor_cota'],
                    'valor_comissao' => $bolao['valor_comissao'],
                    'qtd_jogos' => $quantidade_de_jogos,
                    'cont_bolao' => $cont_bolao,
                    'qtd_cotas' => $cotas_metade);
        }
        return $lista_boloes;
    }

    public function calcula_boloes_quina($acumulado, $valores, $cotas,
            $comissao_desejada) {
        $desejo_de_comissao = bcmul($this->limparValoresMonetarios(
                        $comissao_desejada), 0.10, 2);
        $comissao_soma = 0;
        $cotas_metade = $cotas % 2 == 0 ? bcdiv($cotas, 2, 0) :
                bcdiv(bcadd($cotas, 1, 0), 2, 0);
        $lista_boloes = array();
        switch ($acumulado) {
            case $acumulado < 1000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //6 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //6 dezenas fim
                    //7 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    ++$cont_bolao;
                }
                break;
            case $acumulado > 1000001 and $acumulado < 5000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //6 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(9, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //6 dezenas fim
                    //7 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(5, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //7 dezenas fim                    
                    //8 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //8 dezenas fim                    
                    ++$cont_bolao;
                }
                break;
            case $acumulado > 5000001:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //6 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //6 dezenas fim
                    //7 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //7 dezenas fim                    
                    //8 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //8 dezenas fim                    
                    //9 dezenas
                    if ($cont_bolao === 3) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //9 dezenas fim                    
                    //10 dezenas
                    if ($cont_bolao === 4) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //10 dezenas fim                    
                    //10 dezenas
                    if ($cont_bolao === 4) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //10 dezenas fim                    
                    //11 dezenas
                    if ($cont_bolao === 5) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //11 dezenas fim                    
                    //12 dezenas
                    if ($cont_bolao === 6) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //12 dezenas fim                    
                    //13 dezenas
                    if ($cont_bolao === 7) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //13 dezenas fim                    
                    //14 dezenas
                    if ($cont_bolao === 8) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //14 dezenas fim                    
                    //15 dezenas
                    if ($cont_bolao === 9) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //15 dezenas fim                    
                    ++$cont_bolao;
                }
                break;
            default :
                $quantidade_de_jogos = mt_rand(8, 10);
                $bolao = $this->calculodobolao($valores[2]
                        ->valor,
                        $quantidade_de_jogos,
                        $cotas_metade,
                        $porcentagem);
                $comissao_soma = bcadd($bolao['valor_comissao'],
                        $comissao_soma, 2);
                $lista_boloes[$cont_bolao] = array(
                    'valor_jogo' => $valores[2]->valor,
                    'dezenas' => $valores[2]->dezenas,
                    'valor_cota' => $bolao['valor_cota'],
                    'valor_comissao' => $bolao['valor_comissao'],
                    'qtd_jogos' => $quantidade_de_jogos,
                    'cont_bolao' => $cont_bolao,
                    'qtd_cotas' => $cotas_metade);
        }
        return $lista_boloes;
    }

    public function calcula_boloes_dia($acumulado, $valores, $cotas,
            $comissao_desejada) {
        $desejo_de_comissao = bcmul($this->limparValoresMonetarios(
                        $comissao_desejada), 0.10, 2);
        $comissao_soma = 0;
        $cotas_metade = $cotas % 2 == 0 ? bcdiv($cotas, 2, 0) :
                bcdiv(bcadd($cotas, 1, 0), 2, 0);
        $lista_boloes = array();
        switch ($acumulado) {
            case $acumulado < 1000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //8 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(1, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //8 dezenas fim                    
                }
                break;
            case $acumulado > 1000001 and $acumulado < 5000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //8 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //8 dezenas fim
                    //9 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //9 dezenas fim                    
                    //10 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(3, 6);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //10 dezenas fim                    
                    ++$cont_bolao;
                }
                break;
            case $acumulado > 5000001:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //8 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //8 dezenas fim
                    //9 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //9 dezenas fim                    
                    //10 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //10 dezenas fim                    
                    //11 dezenas
                    if ($cont_bolao === 3) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //11 dezenas fim                    
                    //12 dezenas
                    if ($cont_bolao === 4) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //12 dezenas fim                    
                    ++$cont_bolao;
                }
                break;
            default :
                $quantidade_de_jogos = mt_rand(8, 10);
                $bolao = $this->calculodobolao($valores[2]
                        ->valor,
                        $quantidade_de_jogos,
                        $cotas_metade,
                        $porcentagem);
                $comissao_soma = bcadd($bolao['valor_comissao'],
                        $comissao_soma, 2);
                $lista_boloes[$cont_bolao] = array(
                    'valor_jogo' => $valores[2]->valor,
                    'dezenas' => $valores[2]->dezenas,
                    'valor_cota' => $bolao['valor_cota'],
                    'valor_comissao' => $bolao['valor_comissao'],
                    'qtd_jogos' => $quantidade_de_jogos,
                    'cont_bolao' => $cont_bolao,
                    'qtd_cotas' => $cotas_metade);
        }
        return $lista_boloes;
    }

    public function calcula_boloes_dupla($acumulado, $valores, $cotas,
            $comissao_desejada) {
        $desejo_de_comissao = bcmul($this->limparValoresMonetarios(
                        $comissao_desejada), 0.10, 2);
        $comissao_soma = 0;
        $cotas_metade = $cotas % 2 == 0 ? bcdiv($cotas, 2, 0) :
                bcdiv(bcadd($cotas, 1, 0), 2, 0);
        $lista_boloes = array();
        switch ($acumulado) {
            case $acumulado < 1000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //7 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(1, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //7 dezenas fim                    
                }
                break;
            case $acumulado > 1000001 and $acumulado < 5000000:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //7 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //7 dezenas fim
                    //8 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //8 dezenas fim                    
                    //9 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(3, 6);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //9 dezenas fim                    
                    ++$cont_bolao;
                }
                break;
            case $acumulado > 5000001:
                $aviso = $cotas_metade;
                $cont_bolao = 0;
                $porcentagem = 0.35;
                while ($comissao_soma <= $desejo_de_comissao) {
                    //7 dezenas
                    if ($cont_bolao === 0) {
                        $quantidade_de_jogos = mt_rand(7, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos,
                                $cotas_metade,
                                $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'cont_bolao' => $cont_bolao,
                            'qtd_cotas' => $cotas_metade);
                    }
                    //7 dezenas fim
                    //8 dezenas
                    if ($cont_bolao === 1) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //8 dezenas fim                    
                    //9 dezenas
                    if ($cont_bolao === 2) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //9 dezenas fim                    
                    //10 dezenas
                    if ($cont_bolao === 3) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //10 dezenas fim                    
                    //11 dezenas
                    if ($cont_bolao === 4) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //11 dezenas fim                    
                    //12 dezenas
                    if ($cont_bolao === 5) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //12 dezenas fim                    
                    //13 dezenas
                    if ($cont_bolao === 6) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //13 dezenas fim                    
                    //14 dezenas
                    if ($cont_bolao === 7) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //14 dezenas fim                    
                    //15 dezenas
                    if ($cont_bolao === 4) {
                        $quantidade_de_jogos = mt_rand(3, 10);
                        $bolao = $this->calculodobolao($valores[$cont_bolao]
                                ->valor,
                                $quantidade_de_jogos, $cotas, $porcentagem);
                        $comissao_soma = bcadd($bolao['valor_comissao'],
                                $comissao_soma, 2);
                        $lista_boloes[$cont_bolao] = array(
                            'valor_jogo' => $valores[$cont_bolao]->valor, 'dezenas' => $valores[$cont_bolao]->dezenas,
                            'valor_cota' => $bolao['valor_cota'], 'valor_comissao' => $bolao['valor_comissao'],
                            'qtd_jogos' => $quantidade_de_jogos,
                            'qtd_cotas' => $cotas);
                    }
                    //15 dezenas fim                    
                    ++$cont_bolao;
                }
                break;
            default :
                $quantidade_de_jogos = mt_rand(8, 10);
                $bolao = $this->calculodobolao($valores[2]
                        ->valor,
                        $quantidade_de_jogos,
                        $cotas_metade,
                        $porcentagem);
                $comissao_soma = bcadd($bolao['valor_comissao'],
                        $comissao_soma, 2);
                $lista_boloes[$cont_bolao] = array(
                    'valor_jogo' => $valores[2]->valor,
                    'dezenas' => $valores[2]->dezenas,
                    'valor_cota' => $bolao['valor_cota'],
                    'valor_comissao' => $bolao['valor_comissao'],
                    'qtd_jogos' => $quantidade_de_jogos,
                    'cont_bolao' => $cont_bolao,
                    'qtd_cotas' => $cotas_metade);
        }
        return $lista_boloes;
    }

    private function calculodobolao($valor_jogo, $quantidade_de_jogos,
            $quantidade_de_cotas, $porcentagem) {
        $calculo_bolao = array();
        $valor_quantidade = bcmul($valor_jogo, $quantidade_de_jogos, 2);
        $lucroporcentagem = bcadd($valor_quantidade,
                bcmul($valor_quantidade, $porcentagem, 2), 2);
        $calculo_bolao['valor_cota'] = bcdiv($lucroporcentagem,
                $quantidade_de_cotas, 2);
        $calculo_bolao['valor_comissao'] = bcsub($lucroporcentagem,
                $valor_quantidade, 2);
        return $calculo_bolao;
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
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            $soma = array();
            $row = array();

            $mega_boloes = $this->calcula_boloes_mega($acumulados['mega'],
                    $valores['mega'], $cotas, $comissao_desejada);

            $lotofacil_boloes = $this->calcula_boloes_lotofacil($acumulados['lotofacil'],
                    $valores['lotofacil'], $cotas, $comissao_desejada);

            $quina_boloes = $this->calcula_boloes_quina($acumulados['quina'],
                    $valores['quina'], $cotas, $comissao_desejada);

            $dia_boloes = $this->calcula_boloes_dia($acumulados['dia'],
                    $valores['dia'], $cotas, $comissao_desejada);

            $dupla_boloes = $this->calcula_boloes_dupla($acumulados['dia'],
                    $valores['dupla'], $cotas, $comissao_desejada);

            foreach ($mega_boloes as $value) {
                $row[] = $tt;
                $row[] = 'Mega-Sena';
                $row[] = $value['dezenas'];
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_jogo']);
                $row[] = $value['qtd_jogos'];
                $row[] = $value['qtd_cotas'];
                $row[] = 'R$ ' . $this->formataValoresMonetarios(bcmul($value['qtd_cotas'], $value['valor_cota'], 2));
                $row[] = 35;
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_cota']);
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_comissao']);
                $data[] = $row;
                $soma[] = $value['valor_comissao'];
                unset($row);
                ++$tt;
                ++$tb;
            }

            foreach ($lotofacil_boloes as $value) {
                $row[] = $tt;
                $row[] = 'Lotofácil';
                $row[] = $value['dezenas'];
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_jogo']);
                $row[] = $value['qtd_jogos'];
                $row[] = $value['qtd_cotas'];
                $row[] = 'R$ ' . $this->formataValoresMonetarios(bcmul($value['qtd_cotas'], $value['valor_cota'], 2));
                $row[] = 35;
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_cota']);
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_comissao']);
                $data[] = $row;
                $soma[] = $value['valor_comissao'];
                unset($row);
                ++$tt;
                ++$tb;
            }
            foreach ($quina_boloes as $value) {
                $row[] = $tt;
                $row[] = 'Quina';
                $row[] = $value['dezenas'];
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_jogo']);
                $row[] = $value['qtd_jogos'];
                $row[] = $value['qtd_cotas'];
                $row[] = 'R$ ' . $this->formataValoresMonetarios(bcmul($value['qtd_cotas'], $value['valor_cota'], 2));
                $row[] = 35;
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_cota']);
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_comissao']);
                $data[] = $row;
                $soma[] = $value['valor_comissao'];
                unset($row);
                ++$tt;
                ++$tb;
            }
            foreach ($dia_boloes as $value) {
                $row[] = $tt;
                $row[] = 'Dia de Sorte';
                $row[] = $value['dezenas'];
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_jogo']);
                $row[] = $value['qtd_jogos'];
                $row[] = $value['qtd_cotas'];
                $row[] = 'R$ ' . $this->formataValoresMonetarios(bcmul($value['qtd_cotas'], $value['valor_cota'], 2));
                $row[] = 35;
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_cota']);
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_comissao']);
                $data[] = $row;
                $soma[] = $value['valor_comissao'];
                unset($row);
                ++$tt;
                ++$tb;
            }
            foreach ($dupla_boloes as $value) {
                $row[] = $tt;
                $row[] = 'Dupla-Sena';
                $row[] = $value['dezenas'];
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_jogo']);
                $row[] = $value['qtd_jogos'];
                $row[] = $value['qtd_cotas'];
                $row[] = 'R$ ' . $this->formataValoresMonetarios(bcmul($value['qtd_cotas'], $value['valor_cota'], 2));
                $row[] = 35;
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_cota']);
                $row[] = 'R$ ' . $this->formataValoresMonetarios($value['valor_comissao']);
                $data[] = $row;
                $soma[] = $value['valor_comissao'];
                unset($row);
                ++$tt;
                ++$tb;
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

    public function redireciona_bolao_edit() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_ComissaoBolaoModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $sislo_jogos = new \App\Models\SisloJogosCefModel;
            $jogos = $sislo_jogos->where('status', 1)->orderBy('nome', 'asc')->findAll();

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                echo view('login');
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_model->find($this->request->getGet('id'));
                $dados['idsislo_comissao_bolao'] = $dados_loterica->idsislo_comissao_bolao;
                $dados['cod_loterico'] = $dados_loterica->cod_loterico;
                $dados['dia_inicial'] = $dados_loterica->dia_inicial;
                $dados['id_sislo_jogos_cef'] = $dados_loterica->id_sislo_jogos_cef;
                $dados['cotas'] = $dados_loterica->cotas;
                $dados['valor_bolao'] = $this->limparPontosMonetarios($dados_loterica->valor_bolao);
                $dados['tarifa'] = $this->limparPontosMonetarios($dados_loterica->tarifa);
                $dados['valor_tarifa'] = $this->limparPontosMonetarios($dados_loterica->valor_tarifa);
                $dados['status'] = $dados_loterica->status;
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_comissao_bolao_crud_edit.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "idsislo_comissao_bolao" => $dados['idsislo_comissao_bolao'],
                "cod_loterico" => $dados['cod_loterico'],
                "dia_inicial" => $dados['dia_inicial'],
                "id_sislo_jogos_cef" => $dados['id_sislo_jogos_cef'],
                "cotas" => $dados['cotas'],
                "valor_bolao" => $dados['valor_bolao'],
                "tarifa" => $dados['tarifa'],
                "valor_tarifa" => $dados['valor_tarifa'],
                "jogos" => $jogos,
                "status" => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_comissao_bolao_crud_edit', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
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
                        base_url('redireciona_bolao_edit/?id=' .
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

            if ($this->request->getPost('incluir') == '1') {
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
                $entrou = $cob->insertBatch($insert) == true ? 1 : 0;
                $sislo_notificacao_model = new \App\Models\Sislo_NotificacaoModel();
                $sislo_notificacao_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
                $sislo_notificacao_model->set('notificacao', 'Comissão de Bolão Inserida');
                $sislo_notificacao_model->set('valor', array_sum($datas['valor_tarifa']));
                $sislo_notificacao_model->set('status', 1);
                $sislo_notificacao_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                $sislo_notificacao_model->insert();
                echo $entrou;
            } else {
                $cob->set('cod_loterico', $this->request->getPost('cod_loterico'));
                $cob->set('dia_inicial', $this->request->getPost('dia_inicial'));
                $cob->set('id_sislo_jogos_cef', $this->request->getPost('id_sislo_jogos_cef'));
                $cob->set('cotas', $this->request->getPost('cotas'));
                $cob->set('valor_bolao', $this->limparValoresMonetarios($this->request->getPost('valor_bolao')));
                $cob->set('tarifa', $this->request->getPost('tarifa'));
                $cob->set('valor_tarifa', $this->limparValoresMonetarios($this->request->getPost('valor_tarifa')));
                $cob->set('status', 1);
                $cob->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                $cob->where('idsislo_comissao_bolao', $this->request->getPost('idsislo_comissao_bolao'));
                $entrou = $cob->update() == true ? 1 : 0;
                echo $entrou;
            }
        } else {
            echo view('login');
        }
    }
}
