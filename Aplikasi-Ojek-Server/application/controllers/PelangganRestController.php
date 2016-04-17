<?php

/**
 *
 * Author Rizki Mufrizal <mufrizalrizki@gmail.com>
 * Since Apr 17, 2016
 * Time 8:29:25 AM
 * Encoding UTF-8
 * Project Aplikasi-Ojek-Server
 * Package Expression package is undefined on line 12, column 14 in Templates/Scripting/PHPClass.php.
 * 
 */
require APPPATH . '/libraries/REST_Controller.php';

class PelangganRestController extends REST_Controller {

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('Pelanggan');
        $this->load->model('Ojek');

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
    }

    public function register_post() {
        $val = array(
            'email' => $this->post('email'),
            'nama' => $this->post('nama'),
            'password' => $this->bcrypt->hash_password($this->post('password')),
            'role' => 'ROLE_PELANGGAN'
        );
        $this->Pelanggan->register($val);

        $response = array('info' => 'anda berhasil melakukan register');
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function login_post() {
        $email = $this->post('email');
        $password = $this->post('password');

        $pelanggan = $this->Pelanggan->login($email);

        if (sizeof($pelanggan) == 0) {

            $ojek = $this->Ojek->login($email);

            if (sizeof($ojek) == 0) {
                $response = array('info' => 'anda belum melakukan registrasi');
            } else {
                if ($this->bcrypt->check_password($password, $ojek[0]->password)) {
                    $this->session->set_userdata(array(
                        'isLogin' => TRUE,
                        'id_ojek' => $email,
                    ));
                    $response = array(
                        'id_ojek' => $email,
                        'role' => $ojek[0]->role,
                        'login' => TRUE,
                        'info' => 'anda berhasil login'
                    );
                } else {
                    $response = array('info' => 'username dan password anda salah');
                }
            }
        } else {
            if ($this->bcrypt->check_password($password, $pelanggan[0]->password)) {
                $this->session->set_userdata(array(
                    'isLogin' => TRUE,
                    'email' => $email,
                ));
                $response = array(
                    'email' => $email,
                    'role' => $pelanggan[0]->role,
                    'login' => TRUE,
                    'info' => 'anda berhasil login'
                );
            } else {
                $response = array('info' => 'username dan password anda salah');
            }
        }

        $this->response($response, REST_Controller::HTTP_OK);
    }

}
