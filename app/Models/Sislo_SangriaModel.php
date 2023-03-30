<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_SangriaModel extends Model {

    protected $table = 'sislo_sangria';
    protected $primaryKey = 'idsislo_sangria';
    protected $allowedFields = ['cod_loterico', 'data_registro', 'data_coleta', 'caixa_operador', 'idsislo_tfl', 'valor', 'num_controle', 'numerario_02', 'numerario_05', 'numerario_10', 'numerario_20', 'numerario_50', 'numerario_100', 'numerario_200', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
