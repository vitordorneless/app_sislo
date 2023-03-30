<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_OPEntradaModel extends Model {

    protected $table = 'sislo_op_entrada';
    protected $primaryKey = 'idsislo_op_entrada';
    protected $allowedFields = ['tipo', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
