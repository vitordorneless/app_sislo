<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_FechamentoCofreModel extends Model {

    protected $table = 'sislo_fechamento_cofre';
    protected $primaryKey = 'idsislo_fechamento_cofre';
    protected $allowedFields = ['data_fechamento', 'cod_loterico', 'senha_protege', 'os_gtv', 'guia_gtv', 'remessa', 'sobra_cx', 'acumulado_comissao', 'comissao', 'pix', 'pag_lot_fed', 'pag_telesena', 'pag_outros', 'obs_outros', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
