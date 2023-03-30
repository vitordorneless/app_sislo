<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_CorModel extends Model {

    protected $table = 'sislo_cor';
    protected $primaryKey = 'id_sislo_cor';
    protected $allowedFields = ['cor', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
