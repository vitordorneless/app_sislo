<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_cob_diaria_conta_servicoModel extends Model {

    protected $table = 'sislo_cob_diaria_conta_servico';
    protected $primaryKey = 'idsislo_cob_diaria_conta_servico';
    protected $allowedFields = ['cod_loterico', 'referencia', 'data_inicial', 'data_final', 'id_sislo_tipo_servico', 'quantidade', 'valor', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
