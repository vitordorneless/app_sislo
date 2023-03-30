<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controllers;

/**
 * Description of SisloTesteController
 *
 * @author vitor
 */
class SisloTesteController extends BaseController {
    public function index() {

        if ($this->session->get('user_id')) {
            $sislo_contaspagar = new \App\Models\Sislo_UsuariosModel;
            $result = $sislo_contaspagar->find($this->session->get('user_id'));
            $data = array(
                "scripts" => array(                    
                    "jquery.validate.js",
                    "sweetalert2.all.min.js",
                    "util.js"
                ),
                "user_name" => $result->sislo_nome
            );
            echo view('template/header', $data);
            echo view('template/menu');
            echo view('template/content');
            echo view('sislo_tests', $data);
            echo view('template/footer', $data);
            echo view('template/scripts', $data);
        } else {
            echo view('login');
        }
    }
}
