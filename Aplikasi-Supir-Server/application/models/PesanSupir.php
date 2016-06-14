<?php

/**
 * Author Rizki Mufrizal <mufrizalrizki@gmail.com>
 * Since Apr 17, 2016
 * Time 10:16:13 AM
 * Encoding UTF-8
 * Project Aplikasi-Supir-Server
 * Package Expression package is undefined on line 12, column 14 in Templates/Scripting/PHPClass.php.
 */
class PesanSupir extends CI_Model {

    //supir
    public function selectPesanSupir() {
        $this->db->order_by('tanggal', 'desc');
        $this->db->where('status', 0);

        return $this->db->get('tb_pelanggan_pesan_supir')->result();
    }

    //supir
    public function selectPesanSupirBySupir($idSupir) {
        $this->db->order_by('tanggal', 'desc');
        $this->db->where('id_supir', $idSupir);

        return $this->db->get('tb_pelanggan_supir')->result();
    }

    //pelanggan
    public function selectPesanSupirByPelanggan($email) {
        $this->db->order_by('tanggal', 'desc');
        $this->db->where('email', $email);

        return $this->db->get('tb_pelanggan_pesan_supir')->result();
    }

    public function selectPesanSupirByPelanggan1($email) {
        $this->db->order_by('tanggal', 'desc');
        $this->db->where('email', $email);

        return $this->db->get('tb_supir_pesan_supir')->result();
    }

    //pelanggan
    public function insertPesanSupir($pesanSupir) {
        $this->db->insert('tb_pesan_supir', $pesanSupir);
    }

    //supir
    public function updatePesanSupir($pesanSupir, $id_pesan_supir) {
        $this->db->where('id_pesan_supir', $id_pesan_supir);
        $this->db->update('tb_pesan_supir', $pesanSupir);
    }

    //pelanggan
    public function deletePesanSupir($id_pesan_supir) {
        $val = array(
            'id_pesan_supir' => $id_pesan_supir,
        );
        $this->db->delete('tb_pesan_supir', $val);
    }

}
