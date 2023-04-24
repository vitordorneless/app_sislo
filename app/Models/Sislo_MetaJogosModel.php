<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_MetaJogosModel extends Model {

    protected $table = 'sislo_meta_jogos';
    protected $primaryKey = 'id_sislo_meta_jogos';
    protected $allowedFields = ['id_sislo_jogos_cef','cod_loterico', 'ano', 'janeiro', 'fevereiro', 'marco', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro', 'janeiro_bolao', 'fevereiro_bolao', 'marco_bolao', 'abril_bolao', 'maio_bolao', 'junho_bolao', 'julho_bolao', 'agosto_bolao', 'setembro_bolao', 'outubro_bolao', 'novembro_bolao', 'dezembro_bolao', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
