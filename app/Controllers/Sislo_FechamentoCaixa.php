<?php

namespace App\Controllers;

class Sislo_FechamentoCaixa extends BaseController {

    public function index() {

        if ($this->session->get('user_id')) {
            $sislo_fechamento = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_fechamento->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_fechamento_caixa.js",
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_fechamento_caixa', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function carrega_fechamentos() {
        $db = \Config\Database::connect();
        $mes = $this->request->getPost('mes') < 10 ? '0'.$this->request->getPost('mes') : $this->request->getPost('mes');
        $referencia = $mes . '/' . $this->request->getPost('ano');
        $builder = $db->table('sislo_fechamento_caixa as sfc');
        $query = $builder->select("su.nome as sislo_nome, sfc.data_fechamento as data_fechamento,
                sfc.total_credito as total_credito,
                sfc.total_debito as total_debito,
                sfc.resumo_tfl as resumo_tfl,
                sfc.caixa_inicial as caixa_inicial,
                sfc.diferenca as diferenca,
                sfc.idsislo_fechamento_caixa as idsislo_fechamento_caixa")                        
                        ->join("sislo_funcionarios as su", "sfc.id_usuario = su.idsislo_funcionarios")
                        ->where("sfc.referencia", $referencia)
                        ->where("sfc.cod_loterico", $this->session->get('cod_lot'))
                        ->orderBy('sfc.data_fechamento', 'asc')->get();
        return $query;
    }

    public function ajax_list_fechamento_caixa() {
        if ($this->request->isAJAX()) {
            $sislo_fech = $this->carrega_fechamentos()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            $soma = array();
            foreach ($sislo_fech as $value) {
                $row = array();
                $row[] = date("d/m/Y", strtotime($value->data_fechamento));
                $row[] = $value->sislo_nome;                
                $row[] = number_format($value->total_credito, 2, ',', '.');
                $row[] = number_format($value->total_debito, 2, ',', '.');
                $row[] = number_format($value->resumo_tfl, 2, ',', '.');
                $row[] = number_format($value->caixa_inicial, 2, ',', '.');
                $row[] = number_format($value->diferenca, 2, ',', '.');
                $soma[] = $value->diferenca;
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_fechamento_caixa/?id=' . $value->idsislo_fechamento_caixa) . '">Editar</a>';
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

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $datas = array();
            $data_fechamento = new \Datetime($this->request->getPost('data_fechamento'));
            $datas['total_credito'] = $this->limparValoresMonetarios($this->request->getPost('total_credito'));
            $datas['total_debito'] = $this->limparValoresMonetarios($this->request->getPost('total_debito'));
            $datas['total_suprimento'] = $this->limparValoresMonetarios(empty($this->request->getPost('total_suprimento')) ? 0 : $this->request->getPost('total_suprimento'));
            $datas['total_moedas'] = $this->limparValoresMonetarios(empty($this->request->getPost('total_moedas')) ? 0 : $this->request->getPost('total_moedas'));
            $datas['total_dinheiro'] = $this->limparValoresMonetarios(empty($this->request->getPost('total_dinheiro')) ? 0 : $this->request->getPost('total_dinheiro'));
            $datas['total_bolao'] = $this->limparValoresMonetarios(empty($this->request->getPost('total_bolao')) ? 0 : $this->request->getPost('total_bolao'));
            $datas['total_telesena'] = $this->limparValoresMonetarios(empty($this->request->getPost('total_telesena')) ? 0 : $this->request->getPost('total_telesena'));
            $datas['total_bilhete_federal'] = $this->limparValoresMonetarios(empty($this->request->getPost('total_bilhete_federal')) ? 0 : $this->request->getPost('total_bilhete_federal'));
            $datas['total_sangrias'] = $this->limparValoresMonetarios(empty($this->request->getPost('total_sangrias')) ? 0 : $this->request->getPost('total_sangrias'));
            $datas['total_sobra_cx'] = $this->limparValoresMonetarios(empty($this->request->getPost('total_sobra_cx')) ? 0 : $this->request->getPost('total_sobra_cx'));
            $datas['total_brinde'] = $this->limparValoresMonetarios(empty($this->request->getPost('total_brinde')) ? 0 : $this->request->getPost('total_brinde'));
            $datas['total_outros'] = $this->limparValoresMonetarios(empty($this->request->getPost('total_outros')) ? 0 : $this->request->getPost('total_outros'));
            $datas['total_pix'] = $this->limparValoresMonetarios(empty($this->request->getPost('total_pix')) ? 0 : $this->request->getPost('total_pix'));
            $datas['caixa_inicial'] = $this->limparValoresMonetarios(empty($this->request->getPost('caixa_inicial')) ? 0 : $this->request->getPost('caixa_inicial'));
            $datas['resumo_tfl'] = $datas['total_credito'] - $datas['total_debito'];

            $datas['dinheiro'] = $datas['total_moedas'] + $datas['total_dinheiro'] + $datas['total_bolao'] + $datas['total_telesena'] + $datas['total_bilhete_federal'];
            $datas['excedente'] = $datas['total_sangrias'] + $datas['total_sobra_cx'] + $datas['total_brinde'] + $datas['total_outros'] + $datas['total_pix'];
            $datas['sup_caixa'] = $datas['caixa_inicial'] + $datas['total_suprimento'];
            $datas['soma_geral'] = ($datas['dinheiro'] + $datas['excedente']) - $datas['sup_caixa'];
            $datas['diferenca'] = ($datas['soma_geral'] - $datas['resumo_tfl']);

            $sislo_fechamento_model = new \App\Models\Sislo_FechamentoCaixaModel;
            $sislo_fechamento_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_fechamento_model->set('referencia', $data_fechamento->format('m/Y'));
            $sislo_fechamento_model->set('data_fechamento', $this->request->getPost('data_fechamento'));
            $sislo_fechamento_model->set('caixa_operador', $this->request->getPost('caixa_operador'));
            $sislo_fechamento_model->set('id_usuario', $this->request->getPost('id_usuario'));
            $sislo_fechamento_model->set('total_credito', $datas['total_credito']);
            $sislo_fechamento_model->set('total_debito', $datas['total_debito']);
            $sislo_fechamento_model->set('total_suprimento', $datas['total_suprimento']);
            $sislo_fechamento_model->set('total_moedas', $datas['total_moedas']);
            $sislo_fechamento_model->set('total_dinheiro', $datas['total_dinheiro']);
            $sislo_fechamento_model->set('total_bolao', $datas['total_bolao']);
            $sislo_fechamento_model->set('total_telesena', $datas['total_telesena']);
            $sislo_fechamento_model->set('total_bilhete_federal', $datas['total_bilhete_federal']);
            $sislo_fechamento_model->set('total_sangrias', $datas['total_sangrias']);
            $sislo_fechamento_model->set('total_sobra_cx', $datas['total_sobra_cx']);
            $sislo_fechamento_model->set('total_brinde', $datas['total_brinde']);
            $sislo_fechamento_model->set('total_outros', $datas['total_outros']);
            $sislo_fechamento_model->set('total_pix', $datas['total_pix']);
            $sislo_fechamento_model->set('obs_brinde', $this->request->getPost('obs_brinde'));
            $sislo_fechamento_model->set('obs_outros', $this->request->getPost('obs_outros'));
            $sislo_fechamento_model->set('caixa_inicial', $datas['caixa_inicial']);
            $sislo_fechamento_model->set('soma_geral', $datas['soma_geral']);
            $sislo_fechamento_model->set('resumo_tfl', $datas['resumo_tfl']);
            $sislo_fechamento_model->set('diferenca', $datas['diferenca']);
            $sislo_fechamento_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                $entrou = $sislo_fechamento_model->insert() == true ? 1 : 0;
                $sislo_contacorrente43_model = new \App\Models\Sislo_PrestacaoContasModel;
                $sislo_contacorrente43_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
                $sislo_contacorrente43_model->set('referencia', $data_fechamento->format('m/Y'));
                $sislo_contacorrente43_model->set('data_transacao', $this->request->getPost('data_fechamento'));
                $sislo_contacorrente43_model->set('origem', 'Fechamento de Caixa nº ' . $this->request->getPost('caixa_operador'));
                $sislo_contacorrente43_model->set('valor', $datas['diferenca']);
                $sislo_contacorrente43_model->set('entrada_saida', $datas['diferenca'] < 0 ? 2 : 1); //1 - entrada; 2 - saída
                $sislo_contacorrente43_model->set('status', 1);
                $sislo_contacorrente43_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                $sislo_contacorrente43_model->insert();
                unset($datas);
                echo $entrou;
            } else {
                $sislo_fechamento_model->where('idsislo_fechamento_caixa', $this->request->getPost('idsislo_fechamento_caixa'));
                $entrou = $sislo_fechamento_model->update() == true ? 1 : 0;
                unset($datas);
                echo $entrou;
            }
        } else {
            echo view('login');
        }
    }

    public function redireciona_fechamento_caixa() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_funcionario = new \App\Models\Sislo_FuncionariosModel;
            $sislo_tfl = new \App\Models\Sislo_TflModel;
            $sislo_fechamento = new \App\Models\Sislo_FechamentoCaixaModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $funcionario = $sislo_funcionario->where('cod_loterico', $this->session->get('cod_lot'))->where('status', 1)->orderBy('nome', 'asc')->findAll();
            $tfl = $sislo_tfl->where('cod_loterico', $this->session->get('cod_lot'))->where('status', 1)->orderBy('terminal', 'asc')->findAll();
            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['idsislo_fechamento_caixa'] = '';
                $dados['cod_loterico'] = $this->session->get('cod_lot');
                $dados['referencia'] = '';
                $dados['data_fechamento'] = '';
                $dados['caixa_operador'] = '';
                $dados['id_usuario'] = '';
                $dados['total_credito'] = '';
                $dados['total_debito'] = '';
                $dados['total_suprimento'] = '';
                $dados['total_moedas'] = '';
                $dados['total_dinheiro'] = '';
                $dados['total_bolao'] = '';
                $dados['total_telesena'] = '';
                $dados['total_bilhete_federal'] = '';
                $dados['total_sangrias'] = '';
                $dados['total_sobra_cx'] = '';
                $dados['total_brinde'] = '';
                $dados['total_outros'] = '';
                $dados['total_pix'] = '';
                $dados['obs_brinde'] = '';
                $dados['obs_outros'] = '';
                $dados['caixa_inicial'] = '';
                $dados['soma_geral'] = '';
                $dados['resumo_tfl'] = '';
                $dados['diferenca'] = '';
            } else {
                $incluir = 2;
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
            }
            $data = array(
                "scripts" => array(
                    "sislo_fechamento_caixa_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
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
            echo view('sislo_fechamento_caixa_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

}
