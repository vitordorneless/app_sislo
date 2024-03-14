<?php

namespace App\Controllers;

class Sislo_FechamentoOutros extends BaseController {

    public function index() {
        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_fechamentos_outros.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js", "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_fechamentos_outros', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    private function carrega_fechamentos_outros() {
        $db = \Config\Database::connect();
        $mes = $this->request->getPost('mes') < 10 ? '0' . $this->request->getPost('mes') : $this->request->getPost('mes');
        $referencia = $mes . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_fechamento_caixa as sfc');
        $query = $builder->select("su.nome as sislo_nome,
                sfc.total_brinde as total_brinde,
                sfc.total_outros as total_outros,
                sfc.total_pix as total_pix,
                sfc.obs_brinde as obs_brinde,
                sfc.obs_outros as obs_outros,
                sfc.idsislo_fechamento_caixa as idsislo_fechamento_caixa,
                if((SELECT COUNT(svo.status_liquidacao) 
                    FROM sislo_valores_outros svo 
                    WHERE svo.id_sislo_fechamento_caixa = sfc.idsislo_fechamento_caixa) > 0,'Liquidado','Devedor') AS devedor")
                        ->join("sislo_funcionarios as su", "sfc.id_usuario = su.idsislo_funcionarios")
                        ->where("sfc.referencia", $referencia)
                        ->where("sfc.cod_loterico", $this->session->get('cod_lot'))
                        ->orderBy('sfc.data_fechamento', 'asc')->get();
        return $query;
    }

    public function ajax_list_fechamento_caixa_outros() {
        if ($this->request->isAJAX()) {
            $sislo_fech = $this->carrega_fechamentos_outros()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            $sominha_pix = $sominha_azulzinha = $sominha_outros = $sominha_brinde = array();
            foreach ($sislo_fech as $value) {
                $row = array();
                $row[] = $value->sislo_nome;
                $row[] = number_format($value->total_pix, 2, ',', '.');
                $row[] = number_format($value->total_outros, 2, ',', '.');
                $row[] = number_format($value->total_outros, 2, ',', '.');
                $row[] = $value->obs_outros;
                $row[] = number_format($value->total_brinde, 2, ',', '.');
                $row[] = $value->obs_brinde;
                $row[] = $value->devedor == 'Devedor' ? '<a class="btn '
                        . 'btn-primary" href="' .
                        base_url('redireciona_fechamento_caixa_outros/?id=' .
                                $value->idsislo_fechamento_caixa) .
                        '">Liquidar</a>' : 'Já Liquidado';
                $sominha_pix[] = $value->total_pix;
                $sominha_azulzinha[] = $value->total_outros;
                $sominha_outros[] = $value->total_outros;
                $sominha_brinde[] = $value->total_brinde;
                ++$tt;
                ++$tb;
                $data[] = $row;
                unset($row);
            }
            $json = array(
                "recordsTotal" => $tb,
                "recordsFiltered" => $tb,
                "sominha_pix" => number_format(array_sum($sominha_pix), 2, ',', '.'),
                "sominha_azulzinha" => number_format(array_sum($sominha_azulzinha), 2, ',', '.'),
                "sominha_outros" => number_format(array_sum($sominha_outros), 2, ',', '.'),
                "sominha_brinde" => number_format(array_sum($sominha_brinde), 2, ',', '.'),
                "data" => $data
            );
            echo json_encode($json);
        } else {
            echo view('login');
        }
    }

    public function redireciona_fechamento_caixa_outros() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_funcionario = new \App\Models\Sislo_FuncionariosModel;
            $sislo_tfl = new \App\Models\Sislo_TflModel;
            $sislo_fechamento = new \App\Models\Sislo_FechamentoCaixaModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $funcionario = $sislo_funcionario->where('cod_loterico', $this->session->get('cod_lot'))->where('status', 1)->orderBy('nome', 'asc')->findAll();
            $tfl = $sislo_tfl->where('cod_loterico', $this->session->get('cod_lot'))->where('status', 1)->orderBy('terminal', 'asc')->findAll();
            $dados = array();

            $dados_fechamento = $sislo_fechamento->find($this->request->getGet('id'));
            $dados['idsislo_fechamento_caixa'] = $dados_fechamento->idsislo_fechamento_caixa;
            $dados['cod_loterico'] = $dados_fechamento->cod_loterico;
            $dados['referencia'] = $dados_fechamento->referencia;
            $dados['data_fechamento'] = $dados_fechamento->data_fechamento;
            $dados['caixa_operador'] = $dados_fechamento->caixa_operador;
            $dados['id_usuario'] = $dados_fechamento->id_usuario;
            $dados['total_credito'] = $dados_fechamento->total_credito;
            $dados['total_debito'] = $dados_fechamento->total_debito;
            $dados['total_suprimento'] = $dados_fechamento->total_suprimento;
            $dados['total_moedas'] = $dados_fechamento->total_moedas;
            $dados['total_dinheiro'] = $dados_fechamento->total_dinheiro;
            $dados['total_bolao'] = $dados_fechamento->total_bolao;
            $dados['total_telesena'] = $dados_fechamento->total_telesena;
            $dados['total_bilhete_federal'] = $dados_fechamento->total_bilhete_federal;
            $dados['total_sangrias'] = $dados_fechamento->total_sangrias;
            $dados['total_sobra_cx'] = $dados_fechamento->total_sobra_cx;
            $dados['total_brinde'] = $dados_fechamento->total_brinde;
            $dados['total_outros'] = $dados_fechamento->total_outros;
            $dados['total_pix'] = $dados_fechamento->total_pix;
            $dados['obs_brinde'] = $dados_fechamento->obs_brinde;
            $dados['obs_outros'] = $dados_fechamento->obs_outros;
            $dados['caixa_inicial'] = $dados_fechamento->caixa_inicial;
            $dados['soma_geral'] = $dados_fechamento->soma_geral;
            $dados['resumo_tfl'] = $dados_fechamento->resumo_tfl;
            $dados['diferenca'] = $dados_fechamento->diferenca;
            unset($dados_fechamento);

            $data = array(
                "scripts" => array(
                    "sislo_fechamento_outros_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "idsislo_fechamento_caixa" => $dados['idsislo_fechamento_caixa'],
                "cod_loterico" => $dados['cod_loterico'],
                "referencia" => $dados['referencia'],
                "data_fechamento" => $dados['data_fechamento'],
                "caixa_operador" => $dados['caixa_operador'],
                "id_usuario" => $dados['id_usuario'],
                "total_credito" => $dados['total_credito'],
                "total_debito" => $dados['total_debito'],
                "total_suprimento" => $dados['total_suprimento'],
                "total_moedas" => $dados['total_moedas'],
                "total_dinheiro" => $dados['total_dinheiro'],
                "total_bolao" => $dados['total_bolao'],
                "total_telesena" => $dados['total_telesena'],
                "total_bilhete_federal" => $dados['total_bilhete_federal'],
                "total_sangrias" => $dados['total_sangrias'],
                "total_sobra_cx" => $dados['total_sobra_cx'],
                "total_brinde" => $dados['total_brinde'],
                "total_outros" => $dados['total_outros'],
                "total_pix" => $dados['total_pix'],
                "obs_brinde" => $dados['obs_brinde'],
                "obs_outros" => $dados['obs_outros'],
                "caixa_inicial" => $dados['caixa_inicial'],
                "soma_geral" => $dados['soma_geral'],
                "resumo_tfl" => $dados['resumo_tfl'],
                "diferenca" => $dados['diferenca'],
                "id_usuario_list" => $funcionario,
                "id_tfl_list" => $tfl
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_fechamento_outros_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function sislo_fechamento_outros_form() {

        if ($this->request->isAJAX()) {
            $sislo_fechamento_model = new \App\Models\Sislo_ValoresOutrosModel;
            $sislo_fechamento_model->set('status_liquidacao', $this->request->getPost('status_liquidacao'));
            $sislo_fechamento_model->set('id_sislo_fechamento_caixa', $this->request->getPost('idsislo_fechamento_caixa'));
            $sislo_fechamento_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_fechamento_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
            $entrou = $sislo_fechamento_model->insert() == true ? 1 : 0;
            echo $entrou;
        } else {
            echo view('login');
        }
    }
}
