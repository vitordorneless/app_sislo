<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_ComissaoBolaoOnlineModel extends Model {

    protected $table = 'sislo_comissao_bolao_online';
    protected $primaryKey = 'idsislo_comissao_bolao';
    protected $allowedFields = ['cod_loterico', 'dia_inicial', 'id_sislo_jogos_cef', 'cotas', 'valor_bolao', 'tarifa', 'valor_tarifa', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
