<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_PECDestinacaoModel extends Model {

    protected $table = 'sislo_pec_destinacao';
    protected $primaryKey = 'idsislo_pec_destinacao';
    protected $allowedFields = ['tipo', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
