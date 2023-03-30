<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_TiposConvenioModel extends Model {

    protected $table = 'sislo_tipos_convenio';
    protected $primaryKey = 'idsislo_tipos_convenio';
    protected $allowedFields = ['convenio', 'valor_global', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
