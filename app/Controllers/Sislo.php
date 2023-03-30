<?php

namespace App\Controllers;

class Sislo extends BaseController {

    public function index() {

        $hj = new \DateTime('now');
        switch ($hj->format('l')) {
            case 'Monday':
                $selectweek = 'seg';
                $dia = 'Segunda-Feira';
                break;
            case 'Tuesday':
                $selectweek = 'ter';
                $dia = 'Terça-Feira';
                break;
            case 'Wednesday':
                $selectweek = 'qua';
                $dia = 'Quarta-Feira';
                break;
            case 'Thursday':
                $selectweek = 'qui';
                $dia = 'Quinta-Feira';
                break;
            case 'Friday':
                $selectweek = 'sex';
                $dia = 'Sexta-Feira';
                break;
            case 'Saturday':
                $selectweek = 'sab';
                $dia = 'Sábado';
                break;
            case 'Sunday':
                $selectweek = 'dom';
                $dia = 'Domingo';
                break;
        }
        
        $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
        $sislo_jogos_cef_model = new \App\Models\SisloJogosCefModel;
        $sislo_megasemana_model = new \App\Models\Sislo_MegaSemanaModel;
        
        $dados_mega_semana = $sislo_megasemana_model->where('ano_referencia',date('Y'))->orderBy('dia_01', 'asc')->findAll();
        $dados_jogos = $sislo_jogos_cef_model->where($selectweek, 1)->orderBy('nome', 'asc')->findAll();
        $dados_contas = $this->carrega_fornecedores()->getResult();
        $dados_caixas = $this->carrega_situacao_caixas()->getResult();
        $result = $sislo_usuarios_model->find($this->session->get('user_id'));

        $data = array(
            "scripts" => array(
                "sislo.js",
                "slick.js",
                "util.js"
            ),
            "user_name" => $result->sislo_nome,
            "dia" => $dia,
            "dados_jogos" => $dados_jogos,
            "dados_contas" => $dados_contas,
            "dados_caixas" => $dados_caixas,
            "dados_mega_semana" => $dados_mega_semana,
            "dados_fechamento_cofre" => '0',
            "dados_fechamento" => '0'
        );
        echo view('template/header', $data);
        echo view('template/menu');
        echo view('template/content');
        echo view('sislo', $data);
        echo view('template/footer', $data);
        echo view('template/scripts', $data);
    }
    
    public function carrega_situacao_caixas() {
        $db = \Config\Database::connect();
        $referencia = date('m') . '/' . date('Y');
        $builder = $db->table('sislo_fechamento_caixa as sfc');
        $query = $builder->select("sf.nome, SUM(sfc.diferenca) AS diferenca")
                        ->join("sislo_funcionarios as sf", "sf.idsislo_funcionarios = sfc.id_usuario", "inner")
                        ->where("sfc.referencia", $referencia)
                        ->where("sfc.cod_loterico", $this->session->get('cod_lot'))
                        ->groupBy('sf.nome', 'asc')
                        ->orderBy('sf.nome', 'asc')->get();
        return $query;
    }
    
    public function carrega_fornecedores() {
        $db = \Config\Database::connect();        
        $builder = $db->table('sislo_contas_pagar as scp');
        $query = $builder->select("sf.nome as nome, scp.vencimento as vencimento, scp.valor_pagar as valor_pagar")
                ->join("sislo_fornecedores as sf", "sf.idsislo_fornecedores = scp.id_sislo_fornecedores", "inner")                
                ->where("scp.cod_loterico", $this->session->get('cod_lot'))
                ->where("scp.status_pagamento", 1)
                ->orderBy('scp.vencimento', 'desc')
                ->orderBy('sf.nome', 'asc')
                ->limit(4)
                ->get();
        return $query;
    }
    
    public function sair() {                
        $this->session->destroy();
        echo view('login');        
    }

}
