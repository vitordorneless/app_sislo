<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_CandidatoExperienciaModel extends Model {

    protected $table = 'sislo_candidato_experiencia';
    protected $primaryKey = 'id_sislo_candidato_experiencia';
    protected $allowedFields = ['cpf_sislo_candidato', 'nome_empresa'
        , 'data_inicial', 'data_final', 'emprego_atual', 'cargo', 'funcoes'
        , 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
