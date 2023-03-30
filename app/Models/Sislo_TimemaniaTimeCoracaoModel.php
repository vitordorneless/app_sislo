<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_TimemaniaTimeCoracaoModel extends Model {

    protected $table = 'sislo_timemania_time_coracao';
    protected $primaryKey = 'idsislo_timemania_time_coracao';
    protected $allowedFields = ['time_coracao'];
    protected $returnType = 'object';

}
