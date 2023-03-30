<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_MotivoDemissaoModel extends Model {

    protected $table = 'sislo_motivo_demissao';
    protected $primaryKey = 'id_motivo_demissao';
    protected $allowedFields = ['motivo_demissao', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
