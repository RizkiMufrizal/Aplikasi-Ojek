<?php

/**
 *
 * Author Rizki Mufrizal <mufrizalrizki@gmail.com>
 * Since Jun 8, 2016
 * Time 12:50:59 PM
 * Encoding UTF-8
 * Project Aplikasi-Ojek-Server
 * Package Expression package is undefined on line 14, column 14 in Templates/Scripting/PHPClass.php.
 *
 */
class PelangganRestController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pelanggan');
        $this->load->model('Ojek');

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'OPTIONS') {
            die();
        }
    }

    public function register() {
        
        $data = (array) json_decode(file_get_contents('php://input'));
        
        $val = array(
            'email' => $data['email'],
            'nama' => $data['nama'],
            'password' => $this->bcrypt->hash_password($data['password']),
            'no_telpon' => $data['noTelpon'],
            'role' => 'ROLE_PELANGGAN',
        );
        $this->Pelanggan->register($val);

        $response = array('info' => 'anda berhasil melakukan register');
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function login() {
        
        $data = (array) json_decode(file_get_contents('php://input'));
        
        $email = $data['email'];
        $password = $data['password'];

        $pelanggan = $this->Pelanggan->login($email);

        if (sizeof($pelanggan) == 0) {
            $ojek = $this->Ojek->login($email);

            if (sizeof($ojek) == 0) {
                $response = array('info' => 'anda belum melakukan registrasi');
            } else {
                if ($this->bcrypt->check_password($password, $ojek[0]->password)) {
                    $this->session->set_userdata(array(
                        'isLogin' => true,
                        'id_ojek' => $email,
                    ));
                    $response = array(
                        'id_ojek' => $email,
                        'role' => $ojek[0]->role,
                        'login' => true,
                        'info' => 'anda berhasil login',
                    );
                } else {
                    $response = array('info' => 'username dan password anda salah1');
                }
            }
        } else {
            if ($this->bcrypt->check_password($password, $pelanggan[0]->password)) {
                $this->session->set_userdata(array(
                    'isLogin' => true,
                    'email' => $email,
                ));
                $response = array(
                    'email' => $email,
                    'role' => $pelanggan[0]->role,
                    'login' => true,
                    'info' => 'anda berhasil login',
                );
            } else {
                $response = array('info' => 'username dan password anda salah');
            }
        }

        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

}
