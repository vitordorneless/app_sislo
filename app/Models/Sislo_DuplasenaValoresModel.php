<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_DuplasenaValoresModel extends Model {

    protected $table = 'sislo_duplasena_valores';
    protected $primaryKey = 'id_sislo_duplasena_valores';
    protected $allowedFields = ['jogo', 'dezenas', 'valor', 'status', 
        'data_ultima_alteracao'];
    protected $returnType = 'object';
}
