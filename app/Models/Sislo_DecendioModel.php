<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_DecendioModel extends Model {

    protected $table = 'sislo_decendio';
    protected $primaryKey = 'idsislo_decendio';
    protected $allowedFields = ['referencia', 'cod_loterico', 'id_sislo_servicos_decendio', 'quantidade', 'valor_total', 'valor_unitario', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
