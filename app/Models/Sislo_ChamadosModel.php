<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_ChamadosModel extends Model {

    protected $table = 'sislo_chamados';
    protected $primaryKey = 'idsislo_chamados';
    protected $allowedFields = ['numero_chamado', 'titulo_chamado', 'texto_chamado', 'conclusao_chamado', 'status'];
    protected $returnType = 'object';

}
