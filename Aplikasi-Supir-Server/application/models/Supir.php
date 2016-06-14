<?php

/**
 * Author Rizki Mufrizal <mufrizalrizki@gmail.com>
 * Since Apr 17, 2016
 * Time 8:27:51 AM
 * Encoding UTF-8
 * Project Aplikasi-Supir-Server
 * Package Expression package is undefined on line 12, column 14 in Templates/Scripting/PHPClass.php.
 */
class Supir extends CI_Model {

    public function getSupir($idSupir) {
        $this->db->where('id_supir', $idSupir);
        $this->db->select('nama');

        return $this->db->get('tb_supir')->result();
    }

    public function login($idSupir) {
        $this->db->where('id_supir', $idSupir);

        return $this->db->get('tb_supir')->result();
    }

    public function register($supir) {
        $this->db->insert('tb_supir', $supir);
    }

}
