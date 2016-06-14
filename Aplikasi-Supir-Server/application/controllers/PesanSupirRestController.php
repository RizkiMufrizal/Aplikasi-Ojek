<?php

/**
 *
 * Author Rizki Mufrizal <mufrizalrizki@gmail.com>
 * Since Jun 8, 2016
 * Time 12:57:44 PM
 * Encoding UTF-8
 * Project Aplikasi-Supir-Server
 * Package Expression package is undefined on line 14, column 14 in Templates/Scripting/PHPClass.php.
 *
 */
class PesanSupirRestController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PesanSupir');

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'OPTIONS') {
            die();
        }
    }

    public function pesanSupirs() {
        $response = $this->PesanSupir->selectPesanSupir();
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function pesanSupir($email) {
        $response = $this->PesanSupir->selectPesanSupirByPelanggan($email);
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response[0], JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function pesanSupir1($email) {
        $response = $this->PesanSupir->selectPesanSupirByPelanggan1($email);
        ;

        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response[0], JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function pesanSupirBySupir($idSupir) {
        $response = $this->PesanSupir->selectPesanSupirBySupir($idSupir);

        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function pesanSupirPost() {

        $data = (array) json_decode(file_get_contents('php://input'));

        $jam = $data['jumlahJam'];

        $val = array(
            'id_pesan_supir' => $this->uuid->v4(),
            'tanggal' => date('Y-m-d H:i:s'),
            'lokasi_awal' => $data['lokasiAwal'],
            'lokasi_akhir' => $data['lokasiAkhir'],
            'jumlah_jam' => $jam,
            'harga' => $jam * 100000,
            'status' => false,
            'email' => $data['email'],
            'id_supir' => null,
        );
        $this->PesanSupir->insertPesanSupir($val);
        $response = array('info' => 'anda berhasil melakukan pesan supir, silahkan tunggu sejenak :)');

        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function pesanSupirPut() {

        $data = (array) json_decode(file_get_contents('php://input'));

        $val = array(
            'tanggal' => $data['tanggal'],
            'lokasi_awal' => $data['lokasi_awal'],
            'lokasi_akhir' => $data['lokasi_akhir'],
            'status' => true,
            'email' => $data['email'],
            'id_supir' => $data['id_supir'],
        );
        $this->PesanSupir->updatePesanSupir($val, $data['id_pesan_supir']);

        $response = array('info' => 'anda berhasil memilih pelanggan :)');

        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

}
