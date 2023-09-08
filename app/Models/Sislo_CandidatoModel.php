<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_CandidatoModel extends Model {

    protected $table = 'sislo_candidato';
    protected $primaryKey = 'id_sislo_candidato';
    protected $allowedFields = ['cpf', 'nome', 'nascimento', 'telefone', 'email'
        , 'cep', 'endereco', 'numero', 'complemento', 'bairro', 'cidade', 'sexo'
        , 'escolaridade', 'uf', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';
}
