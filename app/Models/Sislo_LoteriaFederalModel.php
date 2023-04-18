<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_LoteriaFederalModel extends Model {

    protected $table = 'sislo_loteria_federal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['cod_lot', 'modalidade', 'total_bilhetes_recibo', 'total_bilhetes_liquido', 'extracao', 'data_extracao', 'preco_plano', 'valor_bruto_recibo', 'valor_bruto_liquido', 'comissao_recibo', 'valor_liquido_recibo', 'valor_liquido_real', 'lote', 'caixa', 'quantidade_encalhe', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
