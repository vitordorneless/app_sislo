<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_VagasModel extends Model {

    protected $table = 'sislo_vagas';
    protected $primaryKey = 'id_sislo_vagas';
    protected $allowedFields = ['nome_status', 'cod_loterico'
        , 'data_publicacao', 'data_limite', 'cargo', 'responsabilidades'
        , 'requisitos', 'beneficios', 'salario', 'diferenciais'
        , 'vaga_promovida', 'carga_horaria', 'forma_contratacao'
        , 'id_sislo_status_vaga', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
