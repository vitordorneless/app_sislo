<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_FornecedoresModel extends Model {

    protected $table = 'sislo_fornecedores';
    protected $primaryKey = 'idsislo_fornecedores';
    protected $allowedFields = ['cod_loterico', 'nome', 'cnpj', 'contato', 'tel', 'whats', 'email', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
