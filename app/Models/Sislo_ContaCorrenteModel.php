<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_ContaCorrenteModel extends Model {

    protected $table = 'sislo_conta_corrente';
    protected $primaryKey = 'idsislo_conta_corrente';
    protected $allowedFields = ['cod_loterico', 'referencia', 'data_transacao', 'origem', 'valor', 'entrada_saida', 'status', 'data_pagamento', 'status_pagamento', 'tipo_pagamento', 'referencia', 'forma_pagamento', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
