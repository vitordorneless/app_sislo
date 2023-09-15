<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_EmpresaLoginModel extends Model {

    protected $table = 'sislo_empresa_login';
    protected $primaryKey = 'id_sislo_empresa_login';
    protected $allowedFields = ['cod_loterico', 'pass'
        , 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
