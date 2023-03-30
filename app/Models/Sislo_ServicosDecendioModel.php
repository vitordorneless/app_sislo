<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_ServicosDecendioModel extends Model {

    protected $table = 'sislo_servicos_decendio';
    protected $primaryKey = 'idsislo_servicos_decendio';
    protected $allowedFields = ['id_sislo_tipo_servico', 'id_sislo_tipos_convenio', 'servico', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
