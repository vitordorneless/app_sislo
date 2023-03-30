<?php

namespace App\Models;

use CodeIgniter\Model;
class Sislo_Tipo_ServicoModel extends Model {
    protected $table = 'sislo_tipo_servico';
    protected $primaryKey = 'idsislo_tipo_servico';
    protected $allowedFields = ['servico', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
