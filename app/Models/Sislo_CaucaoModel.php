<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_CaucaoModel extends Model {

    protected $table = 'sislo_caucao';
    protected $primaryKey = 'idsislo_caucao';
    protected $allowedFields = ['cod_loterico', 'referencia', 'valor_caucao', 'tributos_federais', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
