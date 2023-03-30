<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_EscolaridadeModel extends Model {

    protected $table = 'sislo_escolaridade';
    protected $primaryKey = 'id_sislo_escolaridade';
    protected $allowedFields = ['escolaridade', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
