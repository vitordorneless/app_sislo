<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_MegasenaValoresModel extends Model {

    protected $table = 'sislo_megasena_valores';
    protected $primaryKey = 'id_sislo_megasena_valores';
    protected $allowedFields = ['jogo', 'dezenas', 'valor', 'sena', 'quina', 
        'quadra', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
