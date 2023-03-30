<?php

namespace App\Controllers;

class Login extends BaseController {

    public function index() {
        echo view('login.php');
    }

    public function ajax_login() {

        $json = array();
        $json['status'] = 0;
        $json['error_list'] = array();

        $cod_lot = $this->request->getPost('cod_lot');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $sislo_usuarios_model = new \App\Models\Sislo_UsuariosModel;        
        $result = $sislo_usuarios_model->where('sislo_id_loterica',$cod_lot)->where('sislo_login',$username)->where('sislo_pass',$password)->first();
        
        if (!empty($result->sislo_usuarios_id)) {
            $newdata = ['user_id'  => $result->sislo_usuarios_id];
            $codigo = ['cod_lot'  => $cod_lot];
            $this->session->set($newdata);
            $this->session->set($codigo);
            $json['status'] = 1;
        } else {
            $json['status'] = 0;
        }

        if ($json['status'] === 0) {
            $json['error_list'] = 'Preencher novamente, dados incorretos';
        }

        echo json_encode($json);
    }

}
