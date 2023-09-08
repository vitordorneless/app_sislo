<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_CandidatoLoginModel extends Model {

    protected $table = 'sislo_candidato_login';
    protected $primaryKey = 'id_sislo_candidato_login';
    protected $allowedFields = ['cpf_sislo_candidato', 'pass'
        , 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
