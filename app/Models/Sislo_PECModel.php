<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_PECModel extends Model {

    protected $table = 'sislo_pec';
    protected $primaryKey = 'idsislo_pec';
    protected $allowedFields = ['id_sislo_tipo_pec', 'id_sislo_op_entrada', 'nome_convenio', 'convenio', 'id_sislo_pec_destinacao', 'id_sislo_pec_identificador', 'status', 'vigencia', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
