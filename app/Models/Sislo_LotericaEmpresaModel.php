<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_LotericaEmpresaModel extends Model {

    protected $table = 'sislo_loterica_empresa';
    protected $primaryKey = 'idsislo_loterica_empresa';
    protected $allowedFields = ['cod_loterico', 'nome_fantasia', 'razao_social',
        'cnpj', 'logradouro', 'numero', 'complemento', 'cep', 'bairro',
        'cidade', 'uf', 'tel1', 'tel2', 'tel3', 'whatsapp', 'email',
        'sislo_status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
