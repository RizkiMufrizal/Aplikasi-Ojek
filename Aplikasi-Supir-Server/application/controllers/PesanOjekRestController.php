<?php

/**
 *
 * Author Rizki Mufrizal <mufrizalrizki@gmail.com>
 * Since Jun 8, 2016
 * Time 12:57:44 PM
 * Encoding UTF-8
 * Project Aplikasi-Ojek-Server
 * Package Expression package is undefined on line 14, column 14 in Templates/Scripting/PHPClass.php.
 *
 */
class PesanOjekRestController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PesanOjek');

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'OPTIONS') {
            die();
        }
    }

    public function pesanOjeks() {
        $response = $this->PesanOjek->selectPesanOjek();
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function pesanOjek($email) {
        $response = $this->PesanOjek->selectPesanOjekByPelanggan($email);
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response[0], JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function pesanOjek1($email) {
        $response = $this->PesanOjek->selectPesanOjekByPelanggan1($email);
        ;

        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response[0], JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function pesanOjekByOjek($idOjek) {
        $response = $this->PesanOjek->selectPesanOjekByOjek($idOjek);

        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function pesanOjekPost() {

        $data = (array) json_decode(file_get_contents('php://input'));

        $jam = $data['jumlahJam'];

        $val = array(
            'id_pesan_ojek' => $this->uuid->v4(),
            'tanggal' => date('Y-m-d H:i:s'),
            'lokasi_awal' => $data['lokasiAwal'],
            'lokasi_akhir' => $data['lokasiAkhir'],
            'jumlah_jam' => $jam,
            'harga' => $jam * 100000,
            'status' => false,
            'email' => $data['email'],
            'id_ojek' => null,
        );
        $this->PesanOjek->insertPesanOjek($val);
        $response = array('info' => 'anda berhasil melakukan pesan ojek, silahkan tunggu sejenak :)');

        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function pesanOjekPut() {

        $data = (array) json_decode(file_get_contents('php://input'));

        $val = array(
            'tanggal' => $data['tanggal'],
            'lokasi_awal' => $data['lokasi_awal'],
            'lokasi_akhir' => $data['lokasi_akhir'],
            'status' => true,
            'email' => $data['email'],
            'id_ojek' => $data['id_ojek'],
        );
        $this->PesanOjek->updatePesanOjek($val, $data['id_pesan_ojek']);

        $response = array('info' => 'anda berhasil memilih pelanggan :)');

        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

}
