<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_EstadoCivilModel extends Model {

    protected $table = 'sislo_estadocivil';
    protected $primaryKey = 'id_sislo_estadocivil';
    protected $allowedFields = ['estadocivil', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
