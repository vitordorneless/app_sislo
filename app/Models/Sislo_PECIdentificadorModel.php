<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_PECIdentificadorModel extends Model {

    protected $table = 'sislo_pec_identificador';
    protected $primaryKey = 'idsislo_pec_identificador';
    protected $allowedFields = ['tipo', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
