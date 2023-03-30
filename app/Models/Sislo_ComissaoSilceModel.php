<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_ComissaoSilceModel extends Model {

    protected $table = 'sislo_comissao_silce';
    protected $primaryKey = 'idsislo_comissao_silce';
    protected $allowedFields = ['cod_loterico', 'referencia', 'dia_inicial', 'dia_final', 'id_sislo_jogos_cef', 'concurso', 'comissao_total', 'participacao', 'comissao', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
