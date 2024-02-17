<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_DiaDeSorteValoresModel extends Model {

    protected $table = 'sislo_diadesorte_valores';
    protected $primaryKey = 'id_sislo_diadesorte_valores';
    protected $allowedFields = ['jogo', 'dezenas', 'valor', 'status',
        'data_ultima_alteracao'];
    protected $returnType = 'object';
}
