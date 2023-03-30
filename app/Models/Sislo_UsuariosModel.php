<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_UsuariosModel extends Model {

    protected $table = 'sislo_usuarios';
    protected $primaryKey = 'sislo_usuarios_id';
    protected $allowedFields = ['sislo_id_loterica', 'sislo_login', 'sislo_nome', 'sislo_pass', 'sislo_email', 'sislo_status', 'sislo_data_ultima_alteracao'];
    protected $returnType = 'object';

}
