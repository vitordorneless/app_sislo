<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_MetaNaoJogosModel extends Model {

    protected $table = 'sislo_meta_nao_jogos';
    protected $primaryKey = 'id_sislo_meta_nao_jogos';
    protected $allowedFields = ['cod_loterico', 'ano', 'janeiro', 'fevereiro', 'marco', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
