<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_QuinaValoresModel extends Model {

    protected $table = 'sislo_quina_valores';
    protected $primaryKey = 'id_sislo_quina_valores';
    protected $allowedFields = ['jogo', 'dezenas', 'valor', 'status', 
        'data_ultima_alteracao'];
    protected $returnType = 'object';
}
