<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_LotericaModel extends Model {

    protected $table = 'sislo_loterica';
    protected $primaryKey = 'idsislo_loterica';
    protected $allowedFields = ['cod_loterico', 'nome_fantasia', 'razao_social', 'cnpj', 'logradouro', 'numero', 'complemento', 'cep', 'bairro', 'cidade', 'uf', 'tel1', 'tel2', 'tel3', 'whatsapp', 'email', 'agencia_cc', 'conta_corrente', 'cc_prestacao', 'tel_agencia', 'proprietario_user', 'proprietario_pass', 'expresso_login', 'expresso_pass', 'caixaaqui_cod', 'caixaaqui_codlot', 'caixaaqui_pass', 'plano', 'sislo_status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
