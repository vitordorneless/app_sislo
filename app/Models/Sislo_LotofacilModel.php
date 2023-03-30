<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_LotofacilModel extends Model {

    protected $table = 'sislo_lotofacil';
    protected $primaryKey = 'idsislo_lotofacil';
    protected $allowedFields = ['id_sislo_jogos_cef', 'concurso', 'data_concurso', 'dez_01', 'dez_02', 'dez_03', 'dez_04', 'dez_05', 'dez_06', 'dez_07', 'dez_08', 'dez_09', 'dez_10', 'dez_11', 'dez_12', 'dez_13', 'dez_14', 'dez_15', 'saiu_ganhador', 'premio_atual', 'premio_acumulado', 'arrecadacao_total'];
    protected $returnType = 'object';

}
