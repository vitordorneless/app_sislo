<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_CandidatoEntrevistaModel extends Model {

    protected $table = 'sislo_candidato_entrevista';
    protected $primaryKey = 'id_sislo_candidato_entrevista';
    protected $allowedFields = ['id_sislo_candidato', 'id_sislo_vaga',
        'data_entrevista', 'hora_entrevista', 'compareceu',
        'id_sislo_star_metodo_1', 'pontuacao_1', 'id_sislo_star_metodo_2',
        'pontuacao_2', 'id_sislo_star_metodo_3', 'pontuacao_3',
        'id_sislo_star_metodo_4', 'pontuacao_4', 'id_sislo_star_metodo_5',
        'pontuacao_5', 'parecer_rh', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
