<?php

/**
 * Author Rizki Mufrizal <mufrizalrizki@gmail.com>
 * Since Apr 17, 2016
 * Time 8:30:29 AM
 * Encoding UTF-8
 * Project Aplikasi-Ojek-Server
 * Package Expression package is undefined on line 12, column 14 in Templates/Scripting/PHPClass.php.
 */
require APPPATH.'/libraries/REST_Controller.php';

class OjekRestController extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('Ojek');

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'OPTIONS') {
            die();
        }
    }

    public function ojek_get($idOjek)
    {
        $response = $this->Ojek->getOjek($idOjek);
        $this->response($response[0], REST_Controller::HTTP_OK);
    }

    public function register_post()
    {
        $uuid = $this->uuid->v4();

        $idOjek = explode('-', $uuid)[1];

        $val = array(
            'id_ojek' => 'Ojek-'.$idOjek,
            'nama' => $this->post('nama'),
            'password' => $this->bcrypt->hash_password($this->post('password')),
            'no_telpon' => $this->post('noTelpon'),
            'role' => 'ROLE_OJEK',
        );
        $this->Ojek->register($val);

        $response = array('info' => 'anda berhasil melakukan register, id ojek anda adalah Ojek-'.$idOjek);
        $this->response($response, REST_Controller::HTTP_OK);
    }
}
