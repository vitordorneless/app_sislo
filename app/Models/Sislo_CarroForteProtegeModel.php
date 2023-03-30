<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_CarroForteProtegeModel extends Model {

    protected $table = 'sislo_protege';
    protected $primaryKey = 'idsislo_protege';
    protected $allowedFields = ['cod_loterico', 'fixo', 'dependencia', 'jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab', 'dom', 'd01', 'd02', 'd03', 'd04', 'd05', 'd06', 'd07', 'd08', 'd09', 'd10', 'd11', 'd12', 'd13', 'd14', 'd15', 'd16', 'd17', 'd18', 'd19', 'd20', 'd21', 'd22', 'd23', 'd24', 'd25', 'd26', 'd27', 'd28', 'd29', 'd30', 'd31', 'validade', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
