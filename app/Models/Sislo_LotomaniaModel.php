<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_LotomaniaModel extends Model {

    protected $table = 'sislo_lotomania';
    protected $primaryKey = 'idsislo_lotomania';
    protected $allowedFields = ['id_sislo_jogos_cef', 'concurso', 'data_concurso', 'dez_01', 'dez_02', 'dez_03', 'dez_04', 'dez_05', 'dez_06', 'dez_07', 'dez_08', 'dez_09', 'dez_10', 'dez_11', 'dez_12', 'dez_13', 'dez_14', 'dez_15', 'dez_16', 'dez_17', 'dez_18', 'dez_19', 'dez_20', 'saiu_ganhador', 'premio_atual', 'premio_acumulado', 'arrecadacao_total'];
    protected $returnType = 'object';

}
