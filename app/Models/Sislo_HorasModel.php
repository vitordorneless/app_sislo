<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_HorasModel extends Model {

    protected $table = 'sislo_horas';
    protected $primaryKey = 'idsislo_horas';
    protected $allowedFields = ['cod_loterico', 'id_sislo_funcionarios', 'data_ponto', 'entrada', 'ida_almoco', 'volta_almoco', 'saida', 'saldo', 'status', 'id_usuario_bater_ponto', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
