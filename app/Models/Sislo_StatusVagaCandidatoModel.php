<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_StatusVagaCandidatoModel extends Model {

    protected $table = 'sislo_status_vaga_candidato';
    protected $primaryKey = 'id_sislo_status_vaga_candidato';
    protected $allowedFields = ['nome_status', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
