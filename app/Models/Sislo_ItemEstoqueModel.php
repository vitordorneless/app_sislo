<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_ItemEstoqueModel extends Model {

    protected $table = 'sislo_item_estoque';
    protected $primaryKey = 'id_sislo_item_estoque';
    protected $allowedFields = ['cod_loterico', 'item', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
