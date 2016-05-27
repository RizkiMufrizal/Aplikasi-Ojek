<?php

/**
 * Author Rizki Mufrizal <mufrizalrizki@gmail.com>
 * Since Apr 17, 2016
 * Time 10:22:47 AM
 * Encoding UTF-8
 * Project Aplikasi-Ojek-Server
 * Package Expression package is undefined on line 12, column 14 in Templates/Scripting/PHPClass.php.
 */
require APPPATH.'/libraries/REST_Controller.php';

class PesanOjekRestController extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('PesanOjek');

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'OPTIONS') {
            die();
        }
    }

    public function pesanOjeks_get()
    {
        $response = $this->PesanOjek->selectPesanOjek();
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function pesanOjek_get($email)
    {
        $response = $this->PesanOjek->selectPesanOjekByPelanggan($email);
        $this->response($response[0], REST_Controller::HTTP_OK);
    }

    public function pesanOjek1_get($email)
    {
        $response = $this->PesanOjek->selectPesanOjekByPelanggan1($email);
        $this->response($response[0], REST_Controller::HTTP_OK);
    }

    public function pesanOjekByOjek_get($idOjek)
    {
        $response = $this->PesanOjek->selectPesanOjekByOjek($idOjek);
        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function pesanOjek_post()
    {
        $jam = $this->post('jumlahJam');

        $val = array(
            'id_pesan_ojek' => $this->uuid->v4(),
            'tanggal' => date('Y-m-d H:i:s'),
            'lokasi_awal' => $this->post('lokasiAwal'),
            'lokasi_akhir' => $this->post('lokasiAkhir'),
            'jumlah_jam' => $jam,
            'harga' => $jam * 100000,
            'status' => false,
            'email' => $this->post('email'),
            'id_ojek' => null,
        );
        $this->PesanOjek->insertPesanOjek($val);
        $response = array('info' => 'anda berhasil melakukan pesan ojek, silahkan tunggu sejenak :)');

        $this->response($response, REST_Controller::HTTP_CREATED);
    }

    public function pesanOjek_put()
    {
        $val = array(
            'tanggal' => $this->put('tanggal'),
            'lokasi_awal' => $this->put('lokasi_awal'),
            'lokasi_akhir' => $this->put('lokasi_akhir'),
            'status' => true,
            'email' => $this->put('email'),
            'id_ojek' => $this->put('id_ojek'),
        );
        $this->PesanOjek->updatePesanOjek($val, $this->put('id_pesan_ojek'));

        $response = array('info' => 'anda berhasil memilih pelanggan :)');

        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function pesanOjek_delete($idPesanOjek)
    {
        $this->PesanOjek->deletePesanOjek($idPesanOjek);

        $response = array('info' => 'anda berhasil menghapus pesanan :)');

        $this->response($response, REST_Controller::HTTP_OK);
    }
}
