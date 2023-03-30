<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_Premios_PagosModel extends Model {

    protected $table = 'sislo_premios_pagos';
    protected $primaryKey = 'idsislo_premios_pagos';
    protected $allowedFields = ['cod_loterico', 'referencia', 'dia_inicial', 'dia_final', 'id_sislo_jogos_cef', 'quantidade', 'valor', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
