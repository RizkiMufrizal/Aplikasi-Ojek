<?php

/**
 *
 * Author Rizki Mufrizal <mufrizalrizki@gmail.com>
 * Since Apr 17, 2016
 * Time 10:16:13 AM
 * Encoding UTF-8
 * Project Aplikasi-Ojek-Server
 * Package Expression package is undefined on line 12, column 14 in Templates/Scripting/PHPClass.php.
 * 
 */
class PesanOjek extends CI_Model {

    //ojek
    public function selectPesanOjek() {
        $this->db->order_by('tanggal', 'desc');
        $this->db->where('status', 0);
        return $this->db->get('tb_pelanggan_pesan_ojek')->result();
    }

    //ojek
    public function selectPesanOjekByOjek($idOjek) {
        $this->db->order_by('tanggal', 'desc');
        $this->db->where('id_ojek', $idOjek);
        return $this->db->get('tb_pelanggan_pesan_ojek')->result();
    }

    //pelanggan
    public function selectPesanOjekByPelanggan($email) {
        $this->db->order_by('tanggal', 'desc');
        $this->db->where('email', $email);
        return $this->db->get('tb_ojek_pesan_ojek')->result();
    }

    //pelanggan
    public function insertPesanOjek($pesanOjek) {
        $this->db->insert('tb_pesan_ojek', $pesanOjek);
    }

    //ojek
    public function updatePesanOjek($pesanOjek, $id_pesan_ojek) {
        $this->db->where('id_pesan_ojek', $id_pesan_ojek);
        $this->db->update('tb_pesan_ojek', $pesanOjek);
    }

    //pelanggan
    public function deletePesanOjek($id_pesan_ojek) {
        $val = array(
            'id_pesan_ojek' => $id_pesan_ojek
        );
        $this->db->delete('tb_pesan_ojek', $val);
    }

}
