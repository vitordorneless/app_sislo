<?php

namespace App\Controllers;

class Sislo_Situacao_Geral extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_situacao_geral.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_situacao_geral', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function carrega_ajax_table_sislo_situacao_jogos() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_comissao_jogos as scs');
        $query = $builder->select("sts.nome as nome, SUM(scs.quantidade) as quantidade, SUM(scs.valor) as valor, SUM(scs.comissao) as comissao")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")
                ->where("scs.referencia", $referencia)
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->groupBy("scs.id_sislo_jogos_cef")
                ->orderBy('scs.comissao', 'DESC')
                ->get();
        return $query;
    }

    public function carrega_ajax_table_sislo_situacao_bolao() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $builder = $db->table('sislo_comissao_bolao as scs');
        $query = $builder->select("sts.nome as nome, SUM(scs.cotas) as cotas, SUM(scs.valor_bolao) as valor_bolao, SUM(scs.valor_tarifa) as valor_tarifa")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")
                ->where('MONTH(scs.dia_inicial)', $this->request->getPost('mes'))
                ->where('YEAR(scs.dia_inicial)', $this->request->getPost('ano'))
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->groupBy("scs.id_sislo_jogos_cef")
                ->orderBy('scs.valor_tarifa', 'DESC')
                ->get();
        return $query;
    }

    public function carrega_table_sislo_bilhete_federal() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $builder = $db->table('sislo_loteria_federal');
        $query = $builder->select("extracao, valor_bruto_recibo, (valor_bruto_liquido - valor_liquido_recibo) AS comissao")
                ->where('MONTH(data_extracao)', $this->request->getPost('mes'))
                ->where('YEAR(data_extracao)', $this->request->getPost('ano'))
                ->where("cod_lot", $cod_lot)
                ->orderBy('data_extracao', 'DESC')
                ->get();
        return $query;
    }

    public function ajax_table_sislo_situacao_jogos() {
        if ($this->request->isAJAX()) {
            $sislo_comissao = $this->carrega_ajax_table_sislo_situacao_jogos()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_comissao as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->nome;
                $row[] = trim($value->quantidade);
                $row[] = $this->formataValoresMonetarios($value->valor);
                $row[] = $this->formataValoresMonetarios($value->comissao);
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

    public function carrega_comissoes_silce() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_comissao_silce as scs');
        $query = $builder->select("sts.nome as nome, SUM(scs.comissao_total) as comissao_total, SUM(scs.comissao) as comissao")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")
                ->where("scs.referencia", $referencia)
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->groupBy("scs.id_sislo_jogos_cef")
                ->orderBy('scs.comissao_total', 'DESC')
                ->get();
        return $query;
    }

    public function carrega_comissoes_ibc() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_comissao_ibc as scs');
        $query = $builder->select("sts.nome as nome, SUM(scs.comissao_total) as comissao_total, SUM(scs.comissao) as comissao")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")
                ->where("scs.referencia", $referencia)
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->groupBy("scs.id_sislo_jogos_cef")
                ->orderBy('scs.comissao_total', 'DESC')
                ->get();
        return $query;
    }

    public function carrega_premios_pagos() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_premios_pagos as scs');
        $query = $builder->select("sts.nome as nome, SUM(scs.valor) as valor, scs.quantidade AS quantidade")
                ->join("sislo_jogos_cef as sts", "scs.id_sislo_jogos_cef = sts.idsislo_jogos_cef", "inner")
                ->where("scs.referencia", $referencia)
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->groupBy("scs.id_sislo_jogos_cef")
                ->orderBy('scs.valor', 'DESC')
                ->get();
        return $query;
    }

    public function carrega_não_jogos() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_decendio as scs');
        $query = $builder->select("sts.servico as nome, SUM(scs.valor_total) as valor, scs.quantidade AS quantidade")
                ->join("sislo_servicos_decendio as sts", "scs.id_sislo_servicos_decendio = sts.idsislo_servicos_decendio", "inner")
                ->where("scs.referencia", $referencia)
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->groupBy("scs.id_sislo_servicos_decendio")
                ->orderBy('scs.valor_total', 'DESC')
                ->get();
        return $query;
    }

    public function carrega_caucao() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_caucao as scs');
        $query = $builder->select("scs.valor_caucao as valor_caucao")
                ->where("scs.referencia", $referencia)
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status', 1)
                ->get();
        return $query;
    }

    public function carrega_salarios() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $builder = $db->table('sislo_funcionarios as sf');
        $query = $builder->select("sf.nome as nome, sf.cpf as cpf, sf.salario AS salario")
                ->where("sf.cod_loterico", $cod_lot)
                ->where('sf.status', 1)
                ->orderBy('sf.nome', 'ASC')
                ->get();
        return $query;
    }

    public function carrega_contas_pagar() {
        $db = \Config\Database::connect();
        $cod_lot = $this->session->get('cod_lot');
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_contas_pagar as scs');
        $query = $builder->select("sts.nome as nome, scs.valor_pago as valor")
                ->join("sislo_fornecedores as sts", "scs.id_sislo_fornecedores = sts.idsislo_fornecedores", "inner")
                ->where("scs.referencia", $referencia)
                ->where("scs.cod_loterico", $cod_lot)
                ->where('scs.status_pagamento', 1)
                ->orderBy('scs.valor_pago', 'DESC')
                ->get();
        return $query;
    }

    public function carrega_caixas() {
        $db = \Config\Database::connect();
        $referencia = $this->request->getPost('mes') . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_fechamento_caixa as sfc');
        $query = $builder->select("sf.nome, SUM(sfc.diferenca) AS diferenca")
                        ->join("sislo_funcionarios as sf", "sf.idsislo_funcionarios = sfc.id_usuario", "inner")
                        ->where("sfc.referencia", $referencia)
                        ->where("sfc.cod_loterico", $this->session->get('cod_lot'))
                        ->groupBy('sf.nome', 'asc')
                        ->orderBy('sf.nome', 'asc')->get();
        return $query;
    }

    public function carrega_metas_nao_jogos() {
        $sislo_jogos_cef_model = new \App\Models\Sislo_MetaNaoJogosModel;
        $query = $sislo_jogos_cef_model
                ->where("ano", $this->request->getPost('ano'))
                ->where("cod_loterico", $this->session->get('cod_lot'))
                ->get();
        return $query;
    }

    public function carrega_metas_jogos() {
        $sislo_jogos_cef_model = new \App\Models\Sislo_MetaJogosModel;
        $query = $sislo_jogos_cef_model
                ->select('SUM(janeiro) AS janeiro ,
                        SUM(fevereiro) AS fevereiro ,
                        SUM(marco) AS marco ,
                        SUM(abril) AS abril ,
                        SUM(maio) AS maio ,
                        SUM(junho) AS junho ,
                        SUM(julho) AS julho ,
                        SUM(agosto) AS agosto ,
                        SUM(setembro) AS setembro ,
                        SUM(outubro) AS outubro ,
                        SUM(novembro) AS novembro ,
                        SUM(dezembro) AS dezembro')
                ->where("ano", $this->request->getPost('ano'))
                ->where("cod_loterico", $this->session->get('cod_lot'))
                ->get();
        return $query;
    }

    public function carrega_bobinas() {
        $db = \Config\Database::connect();
        $builder = $db->table('sislo_estoque as mj');
        $query = $builder->select("((IFNULL(SUM(mj.quantidade),0))-(IFNULL(SUM(stsm.quantidade_saida),0))) as saldo")
                        ->join("sislo_item_estoque as sts", "mj.id_sislo_item_estoque = sts.id_sislo_item_estoque", "inner")
                        ->join("sislo_estoque_movimentacao as stsm", "mj.id_sislo_item_estoque = stsm.id_sislo_item_estoque", "left")
                        ->where("mj.cod_loterico", $this->session->get('cod_lot'))
                        ->like('sts.item', 'bobina')
                        ->where('mj.status', 1)
                        ->groupBy('mj.quantidade,stsm.quantidade_saida')
                        ->orderBy('mj.quantidade', 'DESC')->get();
        return $query;
    }

    public function ajax_sislo_situacao_geral() {

        if ($this->request->isAJAX()) {
            $sislo_comissao = $this->carrega_ajax_table_sislo_situacao_jogos()->getResult();
            $sislo_comissao_bilhete_federal = $this->carrega_table_sislo_bilhete_federal()->getResult();
            $sislo_comissao_bolao = $this->carrega_ajax_table_sislo_situacao_bolao()->getResult();
            $sislo_comissao_silce = $this->carrega_comissoes_silce()->getResult();
            $sislo_comissao_ibc = $this->carrega_comissoes_ibc()->getResult();
            $sislo_premios_pagos = $this->carrega_premios_pagos()->getResult();
            $sislo_nao_jogos = $this->carrega_não_jogos()->getResult();
            $sislo_caucao = $this->carrega_caucao()->getResult();
            $sislo_contas_pagar = $this->carrega_contas_pagar()->getResult();
            $sislo_salarios = $this->carrega_salarios()->getResult();
            $sislo_caixas = $this->carrega_caixas()->getResult();
            $total_meta_nao_jogos = $this->carrega_metas_nao_jogos()->getResult();
            $total_meta_jogos = $this->carrega_metas_jogos()->getResult();
            $bobinas = $this->carrega_bobinas()->getResult();

            switch ($this->request->getPost('mes')) {
                case '01':
                    $mes = $total_meta_nao_jogos[0]->janeiro;
                    break;
                case '02':
                    $mes = $total_meta_nao_jogos[0]->fevereiro;
                    break;
                case '03':
                    $mes = $total_meta_nao_jogos[0]->marco;
                    break;
                case "04":
                    $mes = $total_meta_nao_jogos[0]->abril;
                    break;
                case '05':
                    $mes = $total_meta_nao_jogos[0]->maio;
                    break;
                case '06':
                    $mes = $total_meta_nao_jogos[0]->junho;
                    break;
                case '07':
                    $mes = $total_meta_nao_jogos[0]->julho;
                    break;
                case '08':
                    $mes = $total_meta_nao_jogos[0]->agosto;
                    break;
                case '09':
                    $mes = $total_meta_nao_jogos[0]->setembro;
                    break;
                case '10':
                    $mes = $total_meta_nao_jogos[0]->outubro;
                    break;
                case '11':
                    $mes = $total_meta_nao_jogos[0]->novembro;
                    break;
                case '12':
                    $mes = $total_meta_nao_jogos[0]->dezembro;
                    break;
                default :
                    $mes = $total_meta_nao_jogos[0]->janeiro;
            }

            switch ($this->request->getPost('mes')) {
                case '01':
                    $mes_jogos = $total_meta_jogos[0]->janeiro;
                    break;
                case '02':
                    $mes_jogos = $total_meta_jogos[0]->fevereiro;
                    break;
                case '03':
                    $mes_jogos = $total_meta_jogos[0]->marco;
                    break;
                case "04":
                    $mes_jogos = $total_meta_jogos[0]->abril;
                    break;
                case '05':
                    $mes_jogos = $total_meta_jogos[0]->maio;
                    break;
                case '06':
                    $mes_jogos = $total_meta_jogos[0]->junho;
                    break;
                case '07':
                    $mes_jogos = $total_meta_jogos[0]->julho;
                    break;
                case '08':
                    $mes_jogos = $total_meta_jogos[0]->agosto;
                    break;
                case '09':
                    $mes_jogos = $total_meta_jogos[0]->setembro;
                    break;
                case '10':
                    $mes_jogos = $total_meta_jogos[0]->outubro;
                    break;
                case '11':
                    $mes_jogos = $total_meta_jogos[0]->novembro;
                    break;
                case '12':
                    $mes_jogos = $total_meta_jogos[0]->dezembro;
                    break;
                default :
                    $mes_jogos = $total_meta_jogos[0]->janeiro;
            }
            $data = $data_silce = $data_ibc = $data_bilhete_federal = $data_bolao = $data_premios_pagos = $data_nao_jogos = $data_contas_pagar = $data_salarios = $data_caixas = array();
            $comissao_jogos = $comissao_jogos_silce = $comissao_jogos_ibc = $comissao_bilhete_federal = $comissao_jogos_bolao = $premios_pagos = $caucao = $nao_jogos = $contas_pagar = $salarios = $caixas = 0;

            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable

            foreach ($sislo_comissao as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->nome;
                $row[] = trim($value->quantidade);
                $row[] = $this->formataValoresMonetarios($value->valor);
                $row[] = $this->formataValoresMonetarios($value->comissao);
                ++$tt;
                ++$tb;
                $comissao_jogos = bcadd($comissao_jogos, $value->comissao, 2);
                $data[] = $row;
            }

            foreach ($sislo_comissao_bilhete_federal as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->extracao;
                $row[] = $this->formataValoresMonetarios($value->valor_bruto_recibo);
                $row[] = $this->formataValoresMonetarios($value->comissao);
                ++$tt;
                ++$tb;
                $comissao_bilhete_federal = bcadd($comissao_bilhete_federal, $value->comissao, 2);
                $data_bilhete_federal[] = $row;
            }

            foreach ($sislo_caixas as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->nome;
                $row[] = number_format($value->diferenca, 2, ',', '.');
                $row[] = $value->diferenca < 0 ? "<strong>Descontar Salário</strong>" : "<strong>Tudo OK</strong>";
                ++$tt;
                ++$tb;
                $caixas = bcadd($caixas, $value->diferenca, 2);
                $data_caixas[] = $row;
            }

            foreach ($sislo_salarios as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->nome;
                $row[] = $value->cpf;
                $row[] = $this->formataValoresMonetarios($value->salario);
                ++$tt;
                ++$tb;
                $salarios = bcadd($salarios, $value->salario, 2);
                $data_salarios[] = $row;
            }

            foreach ($sislo_contas_pagar as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->nome;
                $row[] = $this->formataValoresMonetarios($value->valor);
                ++$tt;
                ++$tb;
                $contas_pagar = bcadd($contas_pagar, $value->valor, 2);
                $data_contas_pagar[] = $row;
            }

            foreach ($sislo_nao_jogos as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->nome;
                $row[] = trim($value->quantidade);
                $row[] = $this->formataValoresMonetarios($value->valor);
                ++$tt;
                ++$tb;
                $nao_jogos = bcadd($nao_jogos, $value->valor, 2);
                $data_nao_jogos[] = $row;
            }

            foreach ($sislo_caucao as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->valor_caucao;
                $caucao = bcadd($caucao, $value->valor_caucao, 2);
            }

            foreach ($sislo_premios_pagos as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->nome;
                $row[] = trim($value->quantidade);
                $row[] = $this->formataValoresMonetarios($value->valor);
                ++$tt;
                ++$tb;
                $premios_pagos = bcadd($premios_pagos, $value->valor, 2);
                $data_premios_pagos[] = $row;
            }

            foreach ($sislo_comissao_bolao as $value) {
                $row_bolao = array();
                $row_bolao[] = $tt;
                $row_bolao[] = $value->nome;
                $row_bolao[] = trim($value->cotas);
                $row_bolao[] = $this->formataValoresMonetarios($value->valor_bolao);
                $row_bolao[] = $this->formataValoresMonetarios($value->valor_tarifa);
                ++$tt;
                ++$tb;
                $comissao_jogos_bolao = bcadd($comissao_jogos_bolao, $value->valor_tarifa, 2);
                $data_bolao[] = $row_bolao;
            }

            foreach ($sislo_comissao_silce as $value) {
                $row_silce = array();
                $row_silce[] = $tt;
                $row_silce[] = $value->nome;
                $row_silce[] = $this->formataValoresMonetarios($value->comissao);
                $row_silce[] = $this->formataValoresMonetarios($value->comissao_total);
                ++$tt;
                ++$tb;
                $comissao_jogos_silce = bcadd($comissao_jogos_silce, $value->comissao, 2);
                $data_silce[] = $row_silce;
            }

            foreach ($sislo_comissao_ibc as $value) {
                $row_ibc = array();
                $row_ibc[] = $tt;
                $row_ibc[] = $value->nome;
                $row_ibc[] = $this->formataValoresMonetarios($value->comissao);
                $row_ibc[] = $this->formataValoresMonetarios($value->comissao_total);
                ++$tt;
                ++$tb;
                $comissao_jogos_ibc = bcadd($comissao_jogos_ibc, $value->comissao, 2);
                $data_ibc[] = $row_ibc;
            }

            $total_todos_jogoss = bcadd($comissao_jogos_bolao, $comissao_jogos, 2);
            $total_todos_jogosss = bcadd($comissao_jogos_ibc, $comissao_jogos_silce, 2);
            $total_todos_jogossss = bcadd($total_todos_jogoss, $total_todos_jogosss, 2);
            $total_todos_jogos = bcadd($total_todos_jogossss, $comissao_bilhete_federal, 2);

            $total_todos_deveres = bcadd($salarios, $contas_pagar, 2);

            $todos_recebiveis = bcadd(bcsub($nao_jogos, $caucao, 2), $total_todos_jogos, 2);
            $total_todos_situacao = bcsub($todos_recebiveis, $total_todos_deveres, 2);

            $meta_multiplicacao_1 = bcadd($total_todos_jogos, bcsub($nao_jogos, $caucao, 2), 2);
            $meta_multiplicacao_2 = bcadd($mes, $mes_jogos, 2);
            $meta_multiplicacao_3 = bcdiv($meta_multiplicacao_1, $meta_multiplicacao_2, 2);
            $meta_multiplicacao = bcmul($meta_multiplicacao_3, 100, 2);

            $json = array(
                "recordsTotal" => $tb,
                "recordsFiltered" => $tb,
                "comissao_jogos" => 'R$ ' . $this->formataValoresMonetarios($comissao_jogos),
                "comissao_bilhete_federal" => 'R$ ' . $this->formataValoresMonetarios($comissao_bilhete_federal),
                "comissao_bolao" => 'R$ ' . $this->formataValoresMonetarios($comissao_jogos_bolao),
                "total_jogos" => 'R$ ' . $this->formataValoresMonetarios(bcadd($comissao_jogos_bolao, $comissao_jogos, 2)),
                "comissao_jogos_silce" => 'R$ ' . $this->formataValoresMonetarios($comissao_jogos_silce),
                "premios_pagos" => 'R$ ' . $this->formataValoresMonetarios($premios_pagos),
                "nao_jogos" => 'R$ ' . $this->formataValoresMonetarios(bcsub($nao_jogos, $caucao, 2)),
                "contas_pagar" => 'R$ ' . $this->formataValoresMonetarios($contas_pagar),
                "salarios" => 'R$ ' . $this->formataValoresMonetarios($salarios),
                "caixas" => 'R$ ' . $this->formataValoresMonetarios($caixas),
                "comissao_jogos_ibc" => 'R$ ' . $this->formataValoresMonetarios($comissao_jogos_ibc),
                "total_silce" => 'R$ ' . $this->formataValoresMonetarios(bcadd($comissao_jogos_ibc, $comissao_jogos_silce, 2)),
                "data_jogos" => $data,
                "data_silce" => $data_silce,
                "data_bilhete_federal" => $data_bilhete_federal,
                "data_bolao" => $data_bolao,
                "data_premios_pagos" => $data_premios_pagos,
                "data_nao_jogos" => $data_nao_jogos,
                "data_contas_pagar" => $data_contas_pagar,
                "data_salarios" => $data_salarios,
                "data_caixas" => $data_caixas,
                "data_ibc" => $data_ibc,
                "bobinas" => $bobinas[0]->saldo < 20 ? $bobinas[0]->saldo . ' ESTOQUE BAIXO ' : $bobinas[0]->saldo . ' ESTOQUE ESTÁVEL ',
                "total_meta_nao_jogos" => 'R$ ' . $this->formataValoresMonetarios($mes),
                "total_meta_jogos" => 'R$ ' . $this->formataValoresMonetarios($mes_jogos),
                "total_todas_metas" => 'R$ ' . $this->formataValoresMonetarios(bcadd($mes, $mes_jogos, 2)),
                "total_metas_atingido" => $meta_multiplicacao < 0 ? $this->formataValoresMonetarios(0) . ' %' : $this->formataValoresMonetarios($meta_multiplicacao) . ' %',
                "total_todos_jogos" => 'R$ ' . $this->formataValoresMonetarios($total_todos_jogos),
                "total_todos_nao_jogos" => 'R$ ' . $this->formataValoresMonetarios(bcsub($nao_jogos, $caucao, 2)),
                "total_todos_deveres" => 'R$ ' . $this->formataValoresMonetarios($total_todos_deveres),
                "total_todos_situacao" => $total_todos_situacao < 0 ? 'PREJUÍZO<br>' . $this->formataValoresMonetarios($total_todos_situacao) : 'LUCRO<br>' . $this->formataValoresMonetarios($total_todos_situacao)
            );
            echo json_encode($json);
        } else {
            echo view('login');
        }
    }
}
