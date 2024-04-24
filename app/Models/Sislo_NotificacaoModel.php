<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_NotificacaoModel extends Model {

    protected $table = 'sislo_notificacao';
    protected $primaryKey = 'id_sislo_notificacao';
    protected $allowedFields = ['cod_loterico', 'notificacao', 'valor'
        , 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
