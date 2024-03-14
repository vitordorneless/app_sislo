<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_ValoresOutrosModel extends Model {

    protected $table = 'sislo_valores_outros';
    protected $primaryKey = 'id_sislo_valores_outros';
    protected $allowedFields = ['status_liquidacao', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
