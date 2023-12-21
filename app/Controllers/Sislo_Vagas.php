<?php

namespace App\Controllers;

class Sislo_Vagas extends BaseController {

    public function index() {

        if ($this->session->get('codigo_loterico')) {
            $sislo_loterica_model = new \App\Models\Sislo_LotericaEmpresaModel;
            $result = $sislo_loterica_model->where('cod_loterico', $this->session->get('codigo_loterico'))->first();
            $data = array(
                "scripts" => array(
                    "sislo_vagas.js",
                    "util.js"
                ),
                "user_name" => $result->nome_fantasia
            );
            echo view('template/empresa_header', $data);
            echo view('template/empresa_menu');
            echo view('template/empresa_content');
            echo view('sislo_vagas', $data);
            echo view('template/empresa_footer', $data);
            echo view('template/empresa_scripts', $data);
        } else {
            echo view('sislo');
        }
    }

    public function index_sislo() {
        if ($this->session->get('user_id')) {
            $sislo_model = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_model->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(
                    "sislo_rh_vagas.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_rh_vagas', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }

    public function carrega_vagas() {
        $db = \Config\Database::connect();
        $builder = $db->table('sislo_vagas as sv');
        $query = $builder->select("sv.cod_loterico as cod_loterico, 
            sv.id_sislo_vagas as id_sislo_vagas,
            sv.data_publicacao as data_publicacao,
            sv.data_limite as data_limite,
            sv.cargo as cargo,
            ssv.nome_status as nome_status")
                        ->join("sislo_status_vaga as ssv",
                                "sv.id_sislo_status_vaga = "
                                . "ssv.id_sislo_status_vaga")
                        ->where("sv.cod_loterico", $this->session
                                ->get('codigo_loterico'))
                        ->orderBy('sv.data_publicacao', 'desc')->get();
        return $query;
    }

    public function carrega_vagas_sislo() {
        $db = \Config\Database::connect();
        $builder = $db->table('sislo_vagas as sv');
        $query = $builder->select("sv.cod_loterico as cod_loterico, 
            sv.id_sislo_vagas as id_sislo_vagas,
            sv.data_publicacao as data_publicacao,
            sv.data_limite as data_limite,
            sv.cargo as cargo,
            ssv.nome_status as nome_status")
                        ->join("sislo_status_vaga as ssv",
                                "sv.id_sislo_status_vaga = "
                                . "ssv.id_sislo_status_vaga")
                        ->orderBy('sv.data_publicacao', 'desc')->get();
        return $query;
    }

    public function ajax_list_vaga() {
        if ($this->request->isAJAX()) {
            $sislo_fech = $this->carrega_vagas()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_fech as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->cod_loterico;
                $row[] = date("d/m/Y", strtotime($value->data_publicacao));
                $row[] = date("d/m/Y", strtotime($value->data_limite));
                $row[] = $value->cargo;
                $row[] = $value->nome_status;
                $row[] = '<a class="btn btn-primary" href="' .
                        base_url('redireciona_vaga/?id=' .
                                $value->id_sislo_vagas) . '">Editar</a>';
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
            echo view('sislo');
        }
    }

    public function ajax_list_vaga_sislo() {
        if ($this->request->isAJAX()) {
            $sislo_fech = $this->carrega_vagas_sislo()->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_fech as $value) {
                $row = array();
                $row[] = $tt;
                $row[] = $value->cod_loterico;
                $row[] = date("d/m/Y", strtotime($value->data_publicacao));
                $row[] = date("d/m/Y", strtotime($value->data_limite));
                $row[] = $value->cargo;
                $row[] = $value->nome_status;
                if ($value->nome_status == 'Fechada' or 
                        $value->nome_status == 'Processo de Contratação') {
                    $parecer = '<a class="btn btn-danger" href="' .
                            base_url('redireciona_fechamento_vaga/?id=' .
                                    $value->id_sislo_vagas) . '">Parecer</a>';
                } else {
                    $parecer = '';
                }
                $row[] = '<a class="btn btn-primary" href="' .
                        base_url('redireciona_candidato/?id=' .
                                $value->id_sislo_vagas) .
                        '">Candidatos</a>' . PHP_EOL .
                        '<a class="btn btn-info" href="' .
                        base_url('redireciona_status_vaga/?id=' .
                                $value->id_sislo_vagas) .
                        '">Vaga</a>' . PHP_EOL .
                        $parecer;
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
            echo view('sislo');
        }
    }

    public function carrega_candidatos_vagas_sislo($id_vagas) {
        $db = \Config\Database::connect();
        $builder = $db->table('sislo_vagas_aplicadas as sva');
        $query = $builder->select("sva.id_sislo_candidato as id_sislo_candidato, 
            sva.id_sislo_vagas as id_sislo_vagas,
            sc.nome as nome_candidato")
                        ->join("sislo_candidato as sc",
                                "sva.id_sislo_candidato = "
                                . "sc.id_sislo_candidato")
                        ->where('sva.id_sislo_vagas', $id_vagas)
                        ->orderBy('sva.data_ultima_alteracao', 'desc')->get();
        return $query;
    }
    
    public function carrega_candidatos_vagas_pontuacao_sislo($id_vagas) {
        $db = \Config\Database::connect();
        $builder = $db->table('sislo_vagas_aplicadas as sva');
        $query = $builder->select("sva.id_sislo_candidato as id_sislo_candidato, 
            sva.id_sislo_vagas as id_sislo_vagas,
            sc.nome as nome_candidato, sce.pontuacao_1 as pontuacao_1,
            sce.pontuacao_2 as pontuacao_2,sce.pontuacao_3 as pontuacao_3,
            sce.pontuacao_4 as pontuacao_4,
            sce.pontuacao_5 as pontuacao_5, sce.parecer_rh, 
            sc.email as email, sc.telefone as telefone")
                        ->join("sislo_candidato as sc",
                                "sva.id_sislo_candidato = "
                                . "sc.id_sislo_candidato")
                        ->join("sislo_candidato_entrevista as sce",
                                "sva.id_sislo_candidato = "
                                . "sce.id_sislo_candidato")
                        ->where('sva.id_sislo_vagas', $id_vagas)
                        ->orderBy('sva.data_ultima_alteracao', 'desc')->get();
        return $query;
    }

    public function ajax_list_candidatos_sislo() {
        if ($this->request->isAJAX()) {
            $sislo_candidatos = $this->carrega_candidatos_vagas_sislo($this->request->getGet('id'))->getResult();
            $data = array();
            $tt = 1; //mostra contagem na datatable
            $tb = 0; //carrega campos de footer do datatable
            foreach ($sislo_candidatos as $value) {
                $row = array();
                $row[] = $value->nome_candidato;
                $row[] = '<a class="btn btn-primary" href="' .
                        base_url('redireciona_entrevista/?id=' .
                                $value->id_sislo_vagas . '&id_sislo_candidato=' . $value->id_sislo_candidato) . '">Entrevistar</a>';
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
            echo view('sislo');
        }
    }

    public function redireciona_candidato() {
        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_VagasModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $sislo_status = new \App\Models\Sislo_StatusVagaModel;
            $status = $sislo_status->where('status', 1)->orderBy('nome_status', 'asc')->findAll();
            $dados = array();
            $sislo_candidatos = $this->carrega_candidatos_vagas_sislo($this->request->getGet('id'))->getResult();

            $dados_loterica = $sislo_model->find($this->request->getGet('id'));
            $dados['id_sislo_vagas'] = $dados_loterica->id_sislo_vagas;
            $dados['cod_loterico'] = $dados_loterica->cod_loterico;
            $dados['data_publicacao'] = $dados_loterica->data_publicacao;
            $dados['data_limite'] = $dados_loterica->data_limite;
            $dados['cargo'] = $dados_loterica->cargo;
            $dados['responsabilidades'] = $dados_loterica->responsabilidades;
            $dados['requisitos'] = $dados_loterica->requisitos;
            $dados['beneficios'] = $dados_loterica->beneficios;
            $dados['salario'] = $dados_loterica->salario;
            $dados['diferenciais'] = $dados_loterica->diferenciais;
            $dados['vaga_promovida'] = $dados_loterica->vaga_promovida;
            $dados['carga_horaria'] = $dados_loterica->carga_horaria;
            $dados['forma_contratacao'] = $dados_loterica->forma_contratacao;
            $dados['id_sislo_status_vaga'] = $dados_loterica->id_sislo_status_vaga;
            unset($dados_loterica);

            $data = array(
                "scripts" => array(
                    "sislo_candidatos_vaga.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "id_sislo_vagas" => $dados['id_sislo_vagas'],
                "cod_loterico" => $dados['cod_loterico'],
                "data_publicacao" => $dados['data_publicacao'],
                "data_limite" => $dados['data_limite'],
                "cargo" => $dados['cargo'],
                "responsabilidades" => $dados['responsabilidades'],
                "requisitos" => $dados['requisitos'],
                "beneficios" => $dados['beneficios'],
                "salario" => $dados['salario'],
                "diferenciais" => $dados['diferenciais'],
                "vaga_promovida" => $dados['vaga_promovida'],
                "carga_horaria" => $dados['carga_horaria'],
                "forma_contratacao" => $dados['forma_contratacao'],
                "id_sislo_status_vaga" => $dados['id_sislo_status_vaga'],
                "status" => $status,
                "candidatos" => $sislo_candidatos
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_candidatos_vaga', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('sislo');
        }
    }

    public function redireciona_vaga() {
        if ($this->session->get('codigo_loterico')) {
            $sislo_usuarios_model = new \App\Models\Sislo_LotericaEmpresaModel;
            $sislo_model = new \App\Models\Sislo_VagasModel;
            $dadosuser = $sislo_usuarios_model->where('cod_loterico', $this->session->get('codigo_loterico'))->first();
            $sislo_status = new \App\Models\Sislo_StatusVagaModel;
            $status = $sislo_status->where('status', 1)->orderBy('nome_status', 'asc')->findAll();
            $dados = array();
            $incluir = 1;
            $dados_loterica = $sislo_model->find($this->request->getGet('id'));
            $dados['id_sislo_vagas'] = $dados_loterica->id_sislo_vagas;
            $dados['cod_loterico'] = $dados_loterica->cod_loterico;
            $dados['data_publicacao'] = $dados_loterica->data_publicacao;
            $dados['data_limite'] = $dados_loterica->data_limite;
            $dados['cargo'] = $dados_loterica->cargo;
            $dados['responsabilidades'] = $dados_loterica->responsabilidades;
            $dados['requisitos'] = $dados_loterica->requisitos;
            $dados['beneficios'] = $dados_loterica->beneficios;
            $dados['salario'] = $dados_loterica->salario;
            $dados['diferenciais'] = $dados_loterica->diferenciais;
            $dados['vaga_promovida'] = $dados_loterica->vaga_promovida;
            $dados['carga_horaria'] = $dados_loterica->carga_horaria;
            $dados['forma_contratacao'] = $dados_loterica->forma_contratacao;
            $dados['id_sislo_status_vaga'] = $dados_loterica->id_sislo_status_vaga;
            unset($dados_loterica);

            $data = array(
                "scripts" => array(
                    "sislo_vagas_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->nome_fantasia,
                "id_sislo_vagas" => $dados['id_sislo_vagas'],
                "incluir" => $incluir,
                "cod_loterico" => $dados['cod_loterico'],
                "data_publicacao" => $dados['data_publicacao'],
                "data_limite" => $dados['data_limite'],
                "cargo" => $dados['cargo'],
                "responsabilidades" => $dados['responsabilidades'],
                "requisitos" => $dados['requisitos'],
                "beneficios" => $dados['beneficios'],
                "salario" => $dados['salario'],
                "diferenciais" => $dados['diferenciais'],
                "vaga_promovida" => $dados['vaga_promovida'],
                "carga_horaria" => $dados['carga_horaria'],
                "forma_contratacao" => $dados['forma_contratacao'],
                "id_sislo_status_vaga" => $dados['id_sislo_status_vaga'],
                "status" => $status
            );
            echo view('template/empresa_header', $data);
            echo view('template/empresa_menu');
            echo view('template/empresa_content');
            echo view('sislo_vagas_crud', $data);
            echo view('template/empresa_footer', $data);
            echo view('template/empresa_scripts', $data);
        } else {
            echo view('sislo');
        }
    }

    public function redireciona_status_vaga() {

        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_VagasModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $sislo_status = new \App\Models\Sislo_StatusVagaModel;
            $status = $sislo_status->where('status', 1)->orderBy('nome_status', 'asc')->findAll();
            $dados = array();
            $incluir = 2;
            $dados_loterica = $sislo_model->find($this->request->getGet('id'));
            $dados['id_sislo_vagas'] = $dados_loterica->id_sislo_vagas;
            $dados['cod_loterico'] = $dados_loterica->cod_loterico;
            $dados['data_publicacao'] = $dados_loterica->data_publicacao;
            $dados['data_limite'] = $dados_loterica->data_limite;
            $dados['cargo'] = $dados_loterica->cargo;
            $dados['responsabilidades'] = $dados_loterica->responsabilidades;
            $dados['requisitos'] = $dados_loterica->requisitos;
            $dados['beneficios'] = $dados_loterica->beneficios;
            $dados['salario'] = $dados_loterica->salario;
            $dados['diferenciais'] = $dados_loterica->diferenciais;
            $dados['vaga_promovida'] = $dados_loterica->vaga_promovida;
            $dados['carga_horaria'] = $dados_loterica->carga_horaria;
            $dados['forma_contratacao'] = $dados_loterica->forma_contratacao;
            $dados['id_sislo_status_vaga'] = $dados_loterica->id_sislo_status_vaga;
            unset($dados_loterica);

            $data = array(
                "scripts" => array(
                    "sislo_vagas_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "id_sislo_vagas" => $dados['id_sislo_vagas'],
                "cod_loterico" => $dados['cod_loterico'],
                "data_publicacao" => $dados['data_publicacao'],
                "data_limite" => $dados['data_limite'],
                "cargo" => $dados['cargo'],
                "responsabilidades" => $dados['responsabilidades'],
                "requisitos" => $dados['requisitos'],
                "beneficios" => $dados['beneficios'],
                "salario" => $dados['salario'],
                "diferenciais" => $dados['diferenciais'],
                "vaga_promovida" => $dados['vaga_promovida'],
                "carga_horaria" => $dados['carga_horaria'],
                "forma_contratacao" => $dados['forma_contratacao'],
                "id_sislo_status_vaga" => $dados['id_sislo_status_vaga'],
                "status" => $status
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_vagas_crud', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('sislo');
        }
    }
    
    public function redireciona_fechamento_vaga() {

        if ($this->session->get('user_id')) {
            $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;
            $sislo_model = new \App\Models\Sislo_VagasModel;
            $dadosuser = $sislo_usuarios_model->find($this->session->get('user_id'));
            $sislo_status = new \App\Models\Sislo_StatusVagaModel;
            $status = $sislo_status->where('status', 1)->orderBy('nome_status', 'asc')->findAll();
            $sislo_candidatos = $this->carrega_candidatos_vagas_pontuacao_sislo($this->request->getGet('id'))->getResult();
            $dados = array();
            $incluir = 2;
            $dados_loterica = $sislo_model->find($this->request->getGet('id'));
            $dados['id_sislo_vagas'] = $dados_loterica->id_sislo_vagas;
            $dados['cod_loterico'] = $dados_loterica->cod_loterico;
            $dados['data_publicacao'] = $dados_loterica->data_publicacao;
            $dados['data_limite'] = $dados_loterica->data_limite;
            $dados['cargo'] = $dados_loterica->cargo;
            $dados['responsabilidades'] = $dados_loterica->responsabilidades;
            $dados['requisitos'] = $dados_loterica->requisitos;
            $dados['beneficios'] = $dados_loterica->beneficios;
            $dados['salario'] = $dados_loterica->salario;
            $dados['diferenciais'] = $dados_loterica->diferenciais;
            $dados['vaga_promovida'] = $dados_loterica->vaga_promovida;
            $dados['carga_horaria'] = $dados_loterica->carga_horaria;
            $dados['forma_contratacao'] = $dados_loterica->forma_contratacao;
            $dados['id_sislo_status_vaga'] = $dados_loterica->id_sislo_status_vaga;
            unset($dados_loterica);

            $data = array(
                "scripts" => array(
                    "sislo_vagas_crud.js",
                    "sweetalert2.all.min.js",
                    "jquery.validate.js",
                    "jquery.mask.min.js",
                    "jquery.maskMoney.min.js",
                    "util.js"
                ),
                "user_name" => $dadosuser->sislo_nome,
                "incluir" => $incluir,
                "id_sislo_vagas" => $dados['id_sislo_vagas'],
                "cod_loterico" => $dados['cod_loterico'],
                "data_publicacao" => $dados['data_publicacao'],
                "data_limite" => $dados['data_limite'],
                "cargo" => $dados['cargo'],
                "responsabilidades" => $dados['responsabilidades'],
                "requisitos" => $dados['requisitos'],
                "beneficios" => $dados['beneficios'],
                "salario" => $dados['salario'],
                "diferenciais" => $dados['diferenciais'],
                "vaga_promovida" => $dados['vaga_promovida'],
                "carga_horaria" => $dados['carga_horaria'],
                "forma_contratacao" => $dados['forma_contratacao'],
                "id_sislo_status_vaga" => $dados['id_sislo_status_vaga'],
                "status" => $status,
                "candidatos" => $sislo_candidatos
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_fechamento_vaga', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('sislo');
        }
    }

    public function ajax_save_form() {

        if ($this->request->isAJAX()) {
            $sislo_loterica_model = new \App\Models\Sislo_VagasModel;

            $sislo_loterica_model->set('cod_loterico', $this->request->getPost('cod_loterico'));
            $sislo_loterica_model->set('data_publicacao', $this->request->getPost('data_publicacao'));
            $sislo_loterica_model->set('data_limite', $this->request->getPost('data_limite'));
            $sislo_loterica_model->set('cargo', $this->request->getPost('cargo'));
            $sislo_loterica_model->set('responsabilidades', $this->request->getPost('responsabilidades'));
            $sislo_loterica_model->set('requisitos', $this->request->getPost('requisitos'));
            $sislo_loterica_model->set('beneficios', $this->request->getPost('beneficios'));
            $sislo_loterica_model->set('salario', $this->limparValoresMonetarios($this->request->getPost('salario')));
            $sislo_loterica_model->set('diferenciais', $this->request->getPost('diferenciais'));
            $sislo_loterica_model->set('vaga_promovida', $this->request->getPost('vaga_promovida'));
            $sislo_loterica_model->set('carga_horaria', $this->request->getPost('carga_horaria'));
            $sislo_loterica_model->set('forma_contratacao', $this->request->getPost('forma_contratacao'));
            $sislo_loterica_model->set('id_sislo_status_vaga', $this->request->getPost('id_sislo_status_vaga'));
            $sislo_loterica_model->set('data_ultima_alteracao', date('Y-m-d H:i:s'));

            if ($this->request->getPost('incluir') == '1') {
                echo $sislo_loterica_model->insert() == true ? 1 : 0;
            } else {
                $sislo_loterica_model->where('id_sislo_vagas', $this->request->getPost('id_sislo_vagas'));
                echo $sislo_loterica_model->update() == true ? 1 : 0;
            }
        } else {
            echo view('sislo');
        }
    }
}
