<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_ContasPagarModel extends Model {

    protected $table = 'sislo_contas_pagar';
    protected $primaryKey = 'idsislo_contas_pagar';
    protected $allowedFields = ['cod_loterico', 'id_sislo_fornecedores', 'vencimento', 'valor_pagar', 'descontos', 'juros', 'valor_pago', 'data_pagamento', 'status_pagamento', 'tipo_pagamento', 'referencia', 'forma_pagamento', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
