<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_ComissaoJogosModel extends Model {

    protected $table = 'sislo_comissao_jogos';
    protected $primaryKey = 'idsislo_comissao_jogos';
    protected $allowedFields = ['cod_loterico', 'referencia', 'dia_inicial', 'dia_final', 'id_sislo_jogos_cef', 'concurso', 'quantidade', 'valor', 'comissao', 'percent_comissao', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
