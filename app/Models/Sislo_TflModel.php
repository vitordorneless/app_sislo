<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_TflModel extends Model {

    protected $table = 'sislo_tfl';
    protected $primaryKey = 'idsislo_tfl';
    protected $allowedFields = ['cod_loterico', 'terminal', 'serie', 'caixa_numero', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
