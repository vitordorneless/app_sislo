<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_MegaSemanaModel extends Model {

    protected $table = 'sislo_mega_semana';
    protected $primaryKey = 'idsislo_mega_semana';
    protected $allowedFields = ['id_sislo_jogos_cef', 'campanha', 'dia_01', 'dia_02', 'dia_03', 'ano_referencia', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
