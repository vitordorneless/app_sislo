<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_CargoModel extends Model {

    protected $table = 'sislo_cargo';
    protected $primaryKey = 'id_sislo_cargo';
    protected $allowedFields = ['cargo', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
