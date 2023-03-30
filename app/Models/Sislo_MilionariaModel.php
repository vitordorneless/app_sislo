<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_MilionariaModel extends Model {

    protected $table = 'sislo_milionaria';
    protected $primaryKey = 'idsislo_milionaria';
    protected $allowedFields = ['id_sislo_jogos_cef', 'concurso', 'data_concurso', 'dez_01', 'dez_02', 'dez_03', 'dez_04', 'dez_05', 'dez_06', 'trevo_01', 'trevo_02', 'saiu_ganhador', 'premio_atual', 'premio_acumulado', 'arrecadacao_total'];
    protected $returnType = 'object';

}
