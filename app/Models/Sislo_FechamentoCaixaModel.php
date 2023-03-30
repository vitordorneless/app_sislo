<?php

namespace App\Models;

use CodeIgniter\Model;

class Sislo_FechamentoCaixaModel extends Model {

    protected $table = 'sislo_fechamento_caixa';
    protected $primaryKey = 'idsislo_fechamento_caixa';
    protected $allowedFields = ['cod_loterico', 'referencia', 'data_fechamento', 'caixa_operador', 'id_usuario', 'total_credito', 'total_debito', 'total_suprimento', 'total_moedas', 'total_dinheiro', 'total_bolao', 'total_telesena', 'total_bilhete_federal', 'total_sangrias', 'total_sobra_cx', 'total_brinde', 'total_outros', 'total_pix', 'obs_brinde', 'obs_outros', 'caixa_inicial', 'soma_geral', 'resumo_tfl', 'diferenca', 'data_ultima_alteracao'];
    protected $returnType = 'object';

}
