<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use AllowDynamicProperties; 

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller {

    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url', 'form'];
    protected $viewData = [];
    protected $session = [];


    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        $this->session = \Config\Services::session();
    }

    public function limparValoresMonetarios($valor) {
        $sempontos = str_replace('.', '', $valor);
        $semvirgulas = str_replace(',', '.', $sempontos);
        return $semvirgulas;
    }

    public function Extenso($value, $uppercase = 0) {

        if (strpos($value, ",") > 0) {
            $value = str_replace(".", "", $value);
            $value = str_replace(",", ".", $value);
        }
        $singular = ["centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão", "quintolhão"];
        $plural = ["centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões", "quintolhões"];

        $c = ["", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos"];
        $d = ["", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa"];
        $d10 = ["dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove"];
        $u = ["", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove"];

        $z = 0;

        $values = number_format($value, 2, ".", ".");
        $integer = explode(".", $values);
        $cont = count($integer);
        for ($i = 0; $i < $cont; $i++) {
            for ($ii = strlen($integer[$i]); $ii < 3; $ii++) {
                $integer[$i] = "0" . $integer[$i];
            }
        }

        $fim = $cont - ($integer[$cont - 1] > 0 ? 1 : 2);
        $rt = '';
        for ($i = 0; $i < $cont; $i++) {
            $value = $integer[$i];
            $rc = (($value > 100) && ($value < 200)) ? "cento" : $c[$value[0]];
            $rd = ($value[1] < 2) ? "" : $d[$value[1]];
            $ru = ($value > 0) ? (($value[1] == 1) ? $d10[$value[2]] : $u[$value[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                    $ru) ? " e " : "") . $ru;
            $t = $cont - 1 - $i;
            $r .= $r ? " " . ($value > 1 ? $plural[$t] : $singular[$t]) : "";
            if ($value == "000") {
                $z++;
            } elseif ($z > 0) {
                $z--;
            }
            if (($t == 1) && ($z > 0) && ($integer[0] > 0)) {
                $r .= ( ($z > 1) ? " de " : "") . $plural[$t];
            }
            if ($r) {
                $rt = $rt . ((($i > 0) && ($i <= $fim) && ($integer[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
            }
        }

        if (!$uppercase) {
            return trim($rt ? $rt : "zero");
        } elseif ($uppercase == "2") {
            return trim(strtoupper($rt) ? strtoupper(strtoupper($rt)) : "Zero");
        } else {
            return trim(ucwords($rt) ? ucwords($rt) : "Zero");
        }
    }

    public function formataValoresMonetarios($valor) {
        $semvirgulas = number_format($valor, 2, ',', '.');
        return $semvirgulas;
    }

    public function formataDataParaDatatable($data) {
        $sem = date("d/m/Y", strtotime($data));
        return $sem;
    }

    public function HoraPesquisa() {
        $data = new \DateTime();
        $pesquisa = 'Pesquisa realizada em ' . $data->format('d/m/Y') . ' as ' . $data->format('H:i:s');
        return $pesquisa;
    }

    public function calculaTempo($hora_inicial, $hora_final) {
        $i = 1;
        $tempo_total = array();
        $tempos = array($hora_final, $hora_inicial);
        foreach ($tempos as $tempo) {
            $segundos = 0;
            list($h, $m, $s) = explode(':', $tempo);
            $segundos += $h * 3600;
            $segundos += $m * 60;
            $segundos += $s;
            $tempo_total[$i] = $segundos;
            $i++;
        }
        $segundos = $tempo_total[1] - $tempo_total[2];
        $horas = floor($segundos / 3600);
        $segundos -= $horas * 3600;
        $minutos = str_pad((floor($segundos / 60)), 2, '0', STR_PAD_LEFT);
        $segundos -= $minutos * 60;
        $segundos = str_pad($segundos, 2, '0', STR_PAD_LEFT);
        return "$horas:$minutos:$segundos";
    }

}
