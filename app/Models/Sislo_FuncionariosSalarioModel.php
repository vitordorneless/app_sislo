<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_FuncionariosSalarioModel extends Model {

    protected $table = 'sislo_funcionarios_salario';
    protected $primaryKey = 'id_sislo_funcionarios_salario';
    protected $allowedFields = ['cpf_sislo_funcionario', 'salario', 'status', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
