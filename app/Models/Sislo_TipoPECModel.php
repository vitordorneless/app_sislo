<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_TipoPECModel extends Model {

    protected $table = 'sislo_tipo_pec';
    protected $primaryKey = 'idsislo_tipo_pec';
    protected $allowedFields = ['tipo', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
