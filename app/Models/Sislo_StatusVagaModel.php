<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_StatusVagaModel extends Model {

    protected $table = 'sislo_status_vaga';
    protected $primaryKey = 'id_sislo_status_vaga';
    protected $allowedFields = ['nome_status', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
