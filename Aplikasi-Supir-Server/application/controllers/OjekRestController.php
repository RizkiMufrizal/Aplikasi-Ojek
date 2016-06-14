<?php

/**
 *
 * Author Rizki Mufrizal <mufrizalrizki@gmail.com>
 * Since Jun 8, 2016
 * Time 12:42:12 PM
 * Encoding UTF-8
 * Project Aplikasi-Ojek-Server
 * Package Expression package is undefined on line 14, column 14 in Templates/Scripting/PHPClass.php.
 *
 */
class OjekRestController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Ojek');

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'OPTIONS') {
            die();
        }
    }

    public function ojek($idOjek) {
        $response = $this->Ojek->getOjek($idOjek);
        $this->output
                ->set_status_header(201)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response[0], JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function register() {

        $data = (array) json_decode(file_get_contents('php://input'));

        $uuid = $this->uuid->v4();

        $idOjek = explode('-', $uuid)[1];

        $val = array(
            'id_ojek' => 'Ojek-' . $idOjek,
            'nama' => $data['nama'],
            'password' => $this->bcrypt->hash_password($data['password']),
            'no_telpon' => $data['noTelpon'],
            'role' => 'ROLE_OJEK',
        );
        $this->Ojek->register($val);

        $response = array('info' => 'anda berhasil melakukan register, id ojek anda adalah Ojek-' . $idOjek);

        $this->output
                ->set_status_header(201)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

}
