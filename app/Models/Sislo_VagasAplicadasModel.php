<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_VagasAplicadasModel extends Model {

    protected $table = 'sislo_vagas_aplicadas';
    protected $primaryKey = 'id_sislo_vagas_aplicadas';
    protected $allowedFields = ['id_sislo_vagas', 'id_sislo_candidato', 'id_sislo_status_vaga_candidato', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
