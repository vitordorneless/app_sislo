<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_FuncionariosModel extends Model {

    protected $table = 'sislo_funcionarios';
    protected $primaryKey = 'idsislo_funcionarios';
    protected $allowedFields = ['cod_loterico', 'genero', 'nome', 'nascimento', 'local_nascimento', 'id_escolaridade', 'id_estado_civil', 'id_cor', 'nome_mae', 'nome_pai', 'endereco','numero', 'complemento', 'cep', 'bairro', 'cidade', 'uf', 'tel1', 'tel2', 'tel3', 'email', 'identidade', 'orgao_emissor', 'identidade_emissao', 'pis', 'ctps', 'serie', 'ctps_emissao', 'cpf', 'titulo_eleitor', 'zona', 'secao', 'cnh', 'cnh_emissao', 'nome_conjuge', 'nascimento_conjuge', 'cpf_conjuge', 'nome_filho1', 'cpf_filho1', 'nascimento_filho1', 'nome_filho2', 'cpf_filho2', 'nascimento_filho2', 'nome_filho3', 'cpf_filho3', 'nascimento_filho3', 'nome_filho4', 'cpf_filho4', 'nascimento_filho4', 'optante_VT', 'linha1', 'valor_linha1', 'linha2', 'valor_linha2', 'linha3', 'valor_linha3', 'reemprego', 'id_cargo', 'admissao', 'data_demissao', 'id_motivo_demissao', 'salario', 'adicional', 'insalubridade', 'insalubridade_percent', 'entrada', 'almoco', 'volta_almoco', 'saida', 'id_contrato_experiencia', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
