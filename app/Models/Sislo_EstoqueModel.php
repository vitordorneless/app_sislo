<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_EstoqueModel extends Model {

    protected $table = 'sislo_estoque';
    protected $primaryKey = 'id_sislo_estoque';
    protected $allowedFields = ['cod_loterico', 'id_sislo_item_estoque', 'quantidade', 'data_entrada', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
