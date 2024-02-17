<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_LotofacilValoresModel extends Model {

    protected $table = 'sislo_lotofacil_valores';
    protected $primaryKey = 'id_sislo_lotofacil_valores';
    protected $allowedFields = ['jogo', 'dezenas', 'valor', 'status', 
        'data_ultima_alteracao'];
    protected $returnType = 'object';
}
