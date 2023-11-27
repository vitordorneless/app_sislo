<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_StarMetodoModel extends Model {

    protected $table = 'sislo_star_metodo';
    protected $primaryKey = 'id_sislo_star_metodo';
    protected $allowedFields = ['pergunta', 'resposta_1', 'pontuacao_1',
        'resposta_2', 'pontuacao_2', 'resposta_3', 'pontuacao_3', 'resposta_4',
        'pontuacao_4', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
