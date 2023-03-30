<?php

namespace App\Controllers;

class Sislo_Funcionarios extends BaseController {

    public function index() {

        if ($this->session->get('user_id')) {
            $sislo_loterica_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_loterica_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_funcionarios.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_funcionarios', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_list_funcionarios() {
        if ($this->request->isAJAX()) {
            $sislo_funcionarios_model = new \App\Models\Sislo_FuncionariosModel;
            $sislo_funcionarios = $sislo_funcionarios_model->where('status', 1)->orderBy('nome', 'asc')->findAll();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_funcionarios as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->cod_loterico;
                $row[] = $value->nome;
                $row[] = date("d/m/Y", strtotime($value->nascimento));
                $row[] = date("d/m/Y", strtotime($value->admissao));
                $row[] = $value->status == 1 ? "Ativo" : "Inativo";
                $row[] = '<a class="btn btn-primary" href="' . base_url('redireciona_funcionarios/?id=' . $value->idsislo_funcionarios) . '">Editar</a>';
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

    public function redireciona_funcionarios() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_funcionarios_model = new \App\Models\Sislo_FuncionariosModel;
            $sislo_escolaridade_model = new \App\Models\Sislo_EscolaridadeModel;
            $sislo_estadocivil_model = new \App\Models\Sislo_EstadoCivilModel;
            $sislo_motivodemissao_model = new \App\Models\Sislo_MotivoDemissaoModel;
            $sislo_cargo_model = new \App\Models\Sislo_CargoModel;
            $sislo_cor_model = new \App\Models\Sislo_CorModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $dados_escolaridade = $sislo_escolaridade_model->where('status', 1)->orderBy('escolaridade', 'asc')->findAll();
            $dados_cor = $sislo_cor_model->where('status', 1)->orderBy('cor', 'asc')->findAll();
            $dados_cargo = $sislo_cargo_model->where('status', 1)->orderBy('cargo', 'asc')->findAll();
            $dados_estadocivil = $sislo_estadocivil_model->where('status', 1)->orderBy('estadocivil', 'asc')->findAll();
            $dados_motivodemissao = $sislo_motivodemissao_model->where('status', 1)->orderBy('motivo_demissao', 'asc')->findAll();

            $incluir = NULL;
            $dados = array();
            if ($this->request->getGet('id') == '0') {
                $incluir = 1;
                $dados['idsislo_funcionarios'] = '';
                $dados['cod_loterico'] = $this->session->get('cod_lot');
                $dados['genero'] = '';
                $dados['nome'] = '';
                $dados['nascimento'] = '';
                $dados['local_nascimento'] = '';
                $dados['id_escolaridade'] = '';
                $dados['id_estado_civil'] = '';
                $dados['id_cor'] = '';
                $dados['nome_mae'] = '';
                $dados['nome_pai'] = '';
                $dados['endereco'] = '';
                $dados['numero'] = '';
                $dados['complemento'] = '';
                $dados['cep'] = '';
                $dados['bairro'] = '';
                $dados['cidade'] = '';
                $dados['uf'] = '';
                $dados['tel1'] = '';
                $dados['tel2'] = '';
                $dados['tel3'] = '';
                $dados['email'] = '';
                $dados['identidade'] = '';
                $dados['orgao_emissor'] = '';
                $dados['identidade_emissao'] = '';
                $dados['pis'] = '';
                $dados['ctps'] = '';
                $dados['serie'] = '';
                $dados['ctps_emissao'] = '';
                $dados['cpf'] = '';
                $dados['titulo_eleitor'] = '';
                $dados['zona'] = '';
                $dados['secao'] = '';
                $dados['cnh'] = '';
                $dados['cnh_emissao'] = '';
                $dados['nome_conjuge'] = '';
                $dados['nascimento_conjuge'] = '';
                $dados['cpf_conjuge'] = '';
                $dados['nome_filho1'] = '';
                $dados['cpf_filho1'] = '';
                $dados['nascimento_filho1'] = '';
                $dados['nome_filho2'] = '';
                $dados['cpf_filho2'] = '';
                $dados['nascimento_filho2'] = '';
                $dados['nome_filho3'] = '';
                $dados['cpf_filho3'] = '';
                $dados['nascimento_filho3'] = '';
                $dados['nome_filho4'] = '';
                $dados['cpf_filho4'] = '';
                $dados['nascimento_filho4'] = '';
                $dados['optante_VT'] = '';
                $dados['linha1'] = '';
                $dados['valor_linha1'] = '';
                $dados['linha2'] = '';
                $dados['valor_linha2'] = '';
                $dados['linha3'] = '';
                $dados['valor_linha3'] = '';
                $dados['reemprego'] = '';
                $dados['id_cargo'] = '';
                $dados['admissao'] = '';
                $dados['data_demissao'] = '';
                $dados['id_motivo_demissao'] = '';
                $dados['salario'] = '';
                $dados['adicional'] = '';
                $dados['insalubridade'] = '';
                $dados['insalubridade_percent'] = '';
                $dados['entrada'] = '';
                $dados['almoco'] = '';
                $dados['volta_almoco'] = '';
                $dados['saida'] = '';
                $dados['id_contrato_experiencia'] = '';
                $dados['status'] = '';
            } else {
                $incluir = 2;
                $dados_loterica = $sislo_funcionarios_model->find($this->request->getGet('id'));
                $dados['idsislo_funcionarios'] = $dados_loterica->idsislo_funcionarios;
                $dados['cod_loterico'] = $dados_loterica->cod_loterico;
                $dados['genero'] = $dados_loterica->genero;
                $dados['nome'] = $dados_loterica->nome;
                $dados['nascimento'] = $dados_loterica->nascimento;
                $dados['local_nascimento'] = $dados_loterica->local_nascimento;
                $dados['id_escolaridade'] = $dados_loterica->id_escolaridade;
                $dados['id_estado_civil'] = $dados_loterica->id_estado_civil;
                $dados['id_cor'] = $dados_loterica->id_cor;
                $dados['nome_mae'] = $dados_loterica->nome_mae;
                $dados['nome_pai'] = $dados_loterica->nome_pai;
                $dados['endereco'] = $dados_loterica->endereco;
                $dados['numero'] = $dados_loterica->numero;
                $dados['complemento'] = $dados_loterica->complemento;
                $dados['cep'] = $dados_loterica->cep;
                $dados['bairro'] = $dados_loterica->bairro;
                $dados['cidade'] = $dados_loterica->cidade;
                $dados['uf'] = $dados_loterica->uf;
                $dados['tel1'] = $dados_loterica->tel1;
                $dados['tel2'] = $dados_loterica->tel2;
                $dados['tel3'] = $dados_loterica->tel3;
                $dados['email'] = $dados_loterica->email;
                $dados['identidade'] = $dados_loterica->identidade;
                $dados['orgao_emissor'] = $dados_loterica->orgao_emissor;
                $dados['identidade_emissao'] = $dados_loterica->identidade_emissao;
                $dados['pis'] = $dados_loterica->pis;
                $dados['ctps'] = $dados_loterica->ctps;
                $dados['serie'] = $dados_loterica->serie;
                $dados['ctps_emissao'] = $dados_loterica->ctps_emissao;
                $dados['cpf'] = $dados_loterica->cpf;
                $dados['titulo_eleitor'] = $dados_loterica->titulo_eleitor;
                $dados['zona'] = $dados_loterica->zona;
                $dados['secao'] = $dados_loterica->secao;
                $dados['cnh'] = $dados_loterica->cnh;
                $dados['cnh_emissao'] = $dados_loterica->cnh_emissao;
                $dados['nome_conjuge'] = $dados_loterica->nome_conjuge;
                $dados['nascimento_conjuge'] = $dados_loterica->nascimento_conjuge;
                $dados['cpf_conjuge'] = $dados_loterica->cpf_conjuge;
                $dados['nome_filho1'] = $dados_loterica->nome_filho1;
                $dados['cpf_filho1'] = $dados_loterica->cpf_filho1;
                $dados['nascimento_filho1'] = $dados_loterica->nascimento_filho1;
                $dados['nome_filho2'] = $dados_loterica->nome_filho2;
                $dados['cpf_filho2'] = $dados_loterica->cpf_filho2;
                $dados['nascimento_filho2'] = $dados_loterica->nascimento_filho2;
                $dados['nome_filho3'] = $dados_loterica->nome_filho3;
                $dados['cpf_filho3'] = $dados_loterica->cpf_filho3;
                $dados['nascimento_filho3'] = $dados_loterica->nascimento_filho3;
                $dados['nome_filho4'] = $dados_loterica->nome_filho4;
                $dados['cpf_filho4'] = $dados_loterica->cpf_filho4;
                $dados['nascimento_filho4'] = $dados_loterica->nascimento_filho4;
                $dados['optante_VT'] = $dados_loterica->optante_VT;
                $dados['linha1'] = $dados_loterica->linha1;
                $dados['valor_linha1'] = $dados_loterica->valor_linha1;
                $dados['linha2'] = $dados_loterica->linha2;
                $dados['valor_linha2'] = $dados_loterica->valor_linha2;
                $dados['linha3'] = $dados_loterica->linha3;
                $dados['valor_linha3'] = $dados_loterica->valor_linha3;
                $dados['reemprego'] = $dados_loterica->reemprego;
                $dados['id_cargo'] = $dados_loterica->id_cargo;
                $dados['admissao'] = $dados_loterica->admissao;
                $dados['data_demissao'] = $dados_loterica->data_demissao;
                $dados['id_motivo_demissao'] = $dados_loterica->id_motivo_demissao;
                $dados['salario'] = $dados_loterica->salario;
                $dados['adicional'] = $dados_loterica->adicional;
                $dados['insalubridade'] = $dados_loterica->insalubridade;
                $dados['insalubridade_percent'] = $dados_loterica->insalubridade_percent;
                $dados['entrada'] = $dados_loterica->entrada;
                $dados['almoco'] = $dados_loterica->almoco;
                $dados['volta_almoco'] = $dados_loterica->volta_almoco;
                $dados['saida'] = $dados_loterica->saida;
                $dados['id_contrato_experiencia'] = $dados_loterica->id_contrato_experiencia;
                $dados['status'] = $dados_loterica->status;
                unset($dados_loterica);
            }
            $data = array(
                "scripts" => array(
                    "sislo_funcionarios_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.mask.min.js",
                    "jquery.validate.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "idsislo_funcionarios" => $dados['idsislo_funcionarios'],
                'cod_loterico' => $dados['cod_loterico'],
                'genero' => $dados['genero'],
                'nome' => $dados['nome'],
                'nascimento' => $dados['nascimento'],
                'local_nascimento' => $dados['local_nascimento'],
                'id_escolaridade' => $dados['id_escolaridade'],
                'id_escolaridade_list' => $dados_escolaridade,
                'id_estado_civil' => $dados['id_estado_civil'],
                'id_estadocivil_list' => $dados_estadocivil,
                'id_cargo_list' => $dados_cargo,
                'id_cor' => $dados['id_cor'],
                'id_cor_list' => $dados_cor,
                'nome_mae' => $dados['nome_mae'],
                'nome_pai' => $dados['nome_pai'],
                'endereco' => $dados['endereco'],
                'numero' => $dados['numero'],
                'complemento' => $dados['complemento'],
                'cep' => $dados['cep'],
                'bairro' => $dados['bairro'],
                'cidade' => $dados['cidade'],
                'uf' => $dados['uf'],
                'tel1' => $dados['tel1'],
                'tel2' => $dados['tel2'],
                'tel3' => $dados['tel3'],
                'email' => $dados['email'],
                'identidade' => $dados['identidade'],
                'orgao_emissor' => $dados['orgao_emissor'],
                'identidade_emissao' => $dados['identidade_emissao'],
                'pis' => $dados['pis'],
                'ctps' => $dados['ctps'],
                'serie' => $dados['serie'],
                'ctps_emissao' => $dados['ctps_emissao'],
                'cpf' => $dados['cpf'],
                'titulo_eleitor' => $dados['titulo_eleitor'],
                'zona' => $dados['zona'],
                'secao' => $dados['secao'],
                'cnh' => $dados['cnh'],
                'cnh_emissao' => $dados['cnh_emissao'],
                'nome_conjuge' => $dados['nome_conjuge'],
                'nascimento_conjuge' => $dados['nascimento_conjuge'],
                'cpf_conjuge' => $dados['cpf_conjuge'],
                'nome_filho1' => $dados['nome_filho1'],
                'cpf_filho1' => $dados['cpf_filho1'],
                'nascimento_filho1' => $dados['nascimento_filho1'],
                'nome_filho2' => $dados['nome_filho2'],
                'cpf_filho2' => $dados['cpf_filho2'],
                'nascimento_filho2' => $dados['nascimento_filho2'],
                'nome_filho3' => $dados['nome_filho3'],
                'cpf_filho3' => $dados['cpf_filho3'],
                'nascimento_filho3' => $dados['nascimento_filho3'],
                'nome_filho4' => $dados['nome_filho4'],
                'cpf_filho4' => $dados['cpf_filho4'],
                'nascimento_filho4' => $dados['nascimento_filho4'],
                'optante_VT' => $dados['optante_VT'],
                'linha1' => $dados['linha1'],
                'valor_linha1' => $dados['valor_linha1'],
                'linha2' => $dados['linha2'],
                'valor_linha2' => $dados['valor_linha2'],
                'linha3' => $dados['linha3'],
                'valor_linha3' => $dados['valor_linha3'],
                'reemprego' => $dados['reemprego'],
                'id_cargo' => $dados['id_cargo'],
                'admissao' => $dados['admissao'],
                'data_demissao' => $dados['data_demissao'],
                'id_motivo_demissao' => $dados['id_motivo_demissao'],
                'motivo_demissao_list' => $dados_motivodemissao,
                'salario' => $dados['salario'],
                'adicional' => $dados['adicional'],
                'insalubridade' => $dados['insalubridade'],
                'insalubridade_percent' => $dados['insalubridade_percent'],
                'entrada' => $dados['entrada'],
                'almoco' => $dados['almoco'],
                'volta_almoco' => $dados['volta_almoco'],
                'saida' => $dados['saida'],
                'id_contrato_experiencia' => $dados['id_contrato_experiencia'],
                'status' => $dados['status']
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_funcionarios_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function ajax_save_form() {
        if ($this->request->isAJAX()) {
            $sislo_funcionarios_model = new \App\Models\Sislo_FuncionariosModel;
            $sislo_usuarios = new \App\Models\Sislo_UsuariosModel;
            $sislo_salario = new \App\Models\Sislo_FuncionariosSalarioModel;
            $datas = array();
            $datas['valor_linha1'] = $this->request->getPost('valor_linha1');
            $datas['valor_linha2'] = $this->request->getPost('valor_linha2');
            $datas['valor_linha3'] = $this->request->getPost('valor_linha3');
            $datas['salario'] = $this->request->getPost('salario');
            $datas['insalubridade'] = $this->request->getPost('insalubridade');
            $datas['adicional'] = $this->request->getPost('adicional');
            $datas['valor_linha1'] = str_replace('.', '', $datas['valor_linha1']);
            $datas['valor_linha1'] = str_replace(',', '.', $datas['valor_linha1']);
            $datas['valor_linha2'] = str_replace('.', '', $datas['valor_linha2']);
            $datas['valor_linha2'] = str_replace(',', '.', $datas['valor_linha2']);
            $datas['valor_linha3'] = str_replace('.', '', $datas['valor_linha3']);
            $datas['valor_linha3'] = str_replace(',', '.', $datas['valor_linha3']);
            $datas['salario'] = str_replace('.', '', $datas['salario']);
            $datas['salario'] = str_replace(',', '.', $datas['salario']);
            $datas['insalubridade'] = str_replace('.', '', $datas['insalubridade']);
            $datas['insalubridade'] = str_replace(',', '.', $datas['insalubridade']);
            $datas['adicional'] = str_replace('.', '', $datas['adicional']);
            $datas['adicional'] = str_replace(',', '.', $datas['adicional']);
            $sislo_funcionarios_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_funcionarios_model->set('genero', $this->request->getPost('genero'));
            $sislo_funcionarios_model->set('nome', $this->request->getPost('nome'));
            $sislo_funcionarios_model->set('nascimento', $this->request->getPost('nascimento'));
            $sislo_funcionarios_model->set('local_nascimento', $this->request->getPost('local_nascimento'));
            $sislo_funcionarios_model->set('id_escolaridade', $this->request->getPost('id_escolaridade'));
            $sislo_funcionarios_model->set('id_estado_civil', $this->request->getPost('id_estado_civil'));
            $sislo_funcionarios_model->set('id_cor', $this->request->getPost('id_cor'));
            $sislo_funcionarios_model->set('nome_mae', $this->request->getPost('nome_mae'));
            $sislo_funcionarios_model->set('nome_pai', $this->request->getPost('nome_pai'));
            $sislo_funcionarios_model->set('endereco', $this->request->getPost('endereco'));
            $sislo_funcionarios_model->set('numero', $this->request->getPost('numero'));
            $sislo_funcionarios_model->set('complemento', $this->request->getPost('complemento'));
            $sislo_funcionarios_model->set('cep', $this->request->getPost('cep'));
            $sislo_funcionarios_model->set('bairro', $this->request->getPost('bairro'));
            $sislo_funcionarios_model->set('cidade', $this->request->getPost('cidade'));
            $sislo_funcionarios_model->set('uf', $this->request->getPost('uf'));
            $sislo_funcionarios_model->set('tel1', $this->request->getPost('tel1'));
            $sislo_funcionarios_model->set('tel2', $this->request->getPost('tel2'));
            $sislo_funcionarios_model->set('tel3', $this->request->getPost('tel3'));
            $sislo_funcionarios_model->set('email', $this->request->getPost('email'));
            $sislo_funcionarios_model->set('identidade', $this->request->getPost('identidade'));
            $sislo_funcionarios_model->set('orgao_emissor', $this->request->getPost('orgao_emissor'));
            $sislo_funcionarios_model->set('identidade_emissao', $this->request->getPost('identidade_emissao'));
            $sislo_funcionarios_model->set('pis', $this->request->getPost('pis'));
            $sislo_funcionarios_model->set('ctps', $this->request->getPost('ctps'));
            $sislo_funcionarios_model->set('serie', $this->request->getPost('serie'));
            $sislo_funcionarios_model->set('ctps_emissao', $this->request->getPost('ctps_emissao'));
            $sislo_funcionarios_model->set('cpf', $this->request->getPost('cpf'));
            $sislo_funcionarios_model->set('titulo_eleitor', $this->request->getPost('titulo_eleitor'));
            $sislo_funcionarios_model->set('zona', $this->request->getPost('zona'));
            $sislo_funcionarios_model->set('secao', $this->request->getPost('secao'));
            $sislo_funcionarios_model->set('cnh', $this->request->getPost('cnh'));
            $sislo_funcionarios_model->set('cnh_emissao', $this->request->getPost('cnh_emissao'));
            $sislo_funcionarios_model->set('nome_conjuge', $this->request->getPost('nome_conjuge'));
            $sislo_funcionarios_model->set('nascimento_conjuge', $this->request->getPost('nascimento_conjuge'));
            $sislo_funcionarios_model->set('cpf_conjuge', $this->request->getPost('cpf_conjuge'));
            $sislo_funcionarios_model->set('nome_filho1', $this->request->getPost('nome_filho1'));
            $sislo_funcionarios_model->set('cpf_filho1', $this->request->getPost('cpf_filho1'));
            $sislo_funcionarios_model->set('nascimento_filho1', $this->request->getPost('nascimento_filho1'));
            $sislo_funcionarios_model->set('nome_filho2', $this->request->getPost('nome_filho2'));
            $sislo_funcionarios_model->set('cpf_filho2', $this->request->getPost('cpf_filho2'));
            $sislo_funcionarios_model->set('nascimento_filho2', $this->request->getPost('nascimento_filho2'));
            $sislo_funcionarios_model->set('nome_filho3', $this->request->getPost('nome_filho3'));
            $sislo_funcionarios_model->set('cpf_filho3', $this->request->getPost('cpf_filho3'));
            $sislo_funcionarios_model->set('nascimento_filho3', $this->request->getPost('nascimento_filho3'));
            $sislo_funcionarios_model->set('nome_filho4', $this->request->getPost('nome_filho4'));
            $sislo_funcionarios_model->set('cpf_filho4', $this->request->getPost('cpf_filho4'));
            $sislo_funcionarios_model->set('nascimento_filho4', $this->request->getPost('nascimento_filho4'));
            $sislo_funcionarios_model->set('optante_VT', $this->request->getPost('optante_VT'));
            $sislo_funcionarios_model->set('linha1', $this->request->getPost('linha1'));
            $sislo_funcionarios_model->set('valor_linha1', $this->request->getPost('valor_linha1'));
            $sislo_funcionarios_model->set('linha2', $this->request->getPost('linha2'));
            $sislo_funcionarios_model->set('valor_linha2', $datas['valor_linha2']);
            $sislo_funcionarios_model->set('linha3', $this->request->getPost('linha3'));
            $sislo_funcionarios_model->set('valor_linha3', $datas['valor_linha3']);
            $sislo_funcionarios_model->set('reemprego', $this->request->getPost('reemprego'));
            $sislo_funcionarios_model->set('razao_social', $this->request->getPost('razao_social'));
            $sislo_funcionarios_model->set('id_cargo', $this->request->getPost('id_cargo'));
            $sislo_funcionarios_model->set('admissao', $this->request->getPost('admissao'));
            $sislo_funcionarios_model->set('data_demissao', $this->request->getPost('data_demissao'));
            $sislo_funcionarios_model->set('id_motivo_demissao', $this->request->getPost('id_motivo_demissao'));
            $sislo_funcionarios_model->set('salario', $datas['salario']);
            $sislo_funcionarios_model->set('adicional', $datas['adicional']);
            $sislo_funcionarios_model->set('insalubridade', $datas['insalubridade']);
            $sislo_funcionarios_model->set('insalubridade_percent', $this->request->getPost('insalubridade_percent'));
            $sislo_funcionarios_model->set('entrada', $this->request->getPost('entrada'));
            $sislo_funcionarios_model->set('almoco', $this->request->getPost('almoco'));
            $sislo_funcionarios_model->set('volta_almoco', $this->request->getPost('volta_almoco'));
            $sislo_funcionarios_model->set('saida', $this->request->getPost('saida'));
            $sislo_funcionarios_model->set('id_contrato_experiencia', $this->request->getPost('id_contrato_experiencia'));
            $sislo_funcionarios_model->set('status', $this->request->getPost('status'));
            $sislo_funcionarios_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                //salva usuario
                $login = trim(str_replace(' ', '', $this->request->getPost('nome')));
                $sislo_usuarios->set('sislo_login', $login);
                $sislo_usuarios->set('sislo_id_loterica', $this->request->getPost('cod_loterico'));
                $sislo_usuarios->set('sislo_nome', $this->request->getPost('nome'));
                $sislo_usuarios->set('sislo_pass', '07917207');
                $sislo_usuarios->set('sislo_email', $this->request->getPost('email'));
                $sislo_usuarios->set('sislo_status', $this->request->getPost('status'));
                $sislo_usuarios->set('sislo_data_ultima_alteracao', date('Y-m-d H:i:s'));
                $sislo_usuarios->insert();
                //fecha salva usuario
                //salva salario
                $sislo_salario->set('cpf_sislo_funcionario', $this->request->getPost('cpf'));
                $sislo_salario->set('salario', $datas['salario']);
                $sislo_salario->set('status', 1);
                $sislo_salario->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                $sislo_salario->insert();
                //fecha salva salario
                echo $sislo_funcionarios_model->insert() == true ? 1 : 0;
            } else {
                if ($this->request->getPost('reemprego') == '1') {                    
                    $sislo_funcionarios_model->where('idsislo_funcionarios', $this->request->getPost('idsislo_funcionarios'));                    
                    //salva salario
                    $sislo_salario->set('cpf_sislo_funcionario', $this->request->getPost('cpf'));
                    $sislo_salario->set('salario', $datas['salario']);
                    $sislo_salario->set('status', 1);
                    $sislo_salario->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                    $sislo_salario->insert();
                    //fecha salva salario
                    echo $sislo_funcionarios_model->update() == true ? 1 : 0;
                } else {
                    //salva salario
                    $sislo_salario->set('cpf_sislo_funcionario', $this->request->getPost('cpf'));
                    $sislo_salario->set('salario', $datas['salario']);
                    $sislo_salario->set('status', 1);
                    $sislo_salario->set('data_ultima_alteracao', date('Y-m-d H:i:s'));
                    $sislo_salario->insert();
                    //fecha salva salario                    
                    $sislo_funcionarios_model->where('idsislo_funcionarios', $this->request->getPost('idsislo_funcionarios'));
                    echo $sislo_funcionarios_model->update() == true ? 1 : 0;
                }
            }
        } else {
            echo view('login');
        }
    }

}
