<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_EstoqueMovimentacaoModel extends Model {

    protected $table = 'sislo_estoque_movimentacao';
    protected $primaryKey = 'id_sislo_estoque_movimentacao';
    protected $allowedFields = ['cod_loterico', 'id_sislo_estoque', 'quantidade_saida', 'id_sislo_tfl', 'externo', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
