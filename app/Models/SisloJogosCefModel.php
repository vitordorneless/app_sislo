<?php

namespace App\Models;

use CodeIgniter\Model;

class SisloJogosCefModel extends Model {

    protected $table = 'sislo_jogos_cef';
    protected $primaryKey = 'idsislo_jogos_cef';
    protected $allowedFields = ['nome', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab', 'dom', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
