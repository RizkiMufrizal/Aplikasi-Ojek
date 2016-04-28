<?php

/**
 *
 * Author Rizki Mufrizal <mufrizalrizki@gmail.com>
 * Since Apr 17, 2016
 * Time 8:27:51 AM
 * Encoding UTF-8
 * Project Aplikasi-Ojek-Server
 * Package Expression package is undefined on line 12, column 14 in Templates/Scripting/PHPClass.php.
 * 
 */
class Ojek extends CI_Model {

    public function getOjek($idOjek) {
        $this->db->where('id_ojek', $idOjek);
        $this->db->select('nama');
        return $this->db->get('tb_ojek')->result();
    }

    public function login($idOjek) {
        $this->db->where('id_ojek', $idOjek);
        return $this->db->get('tb_ojek')->result();
    }

    public function register($ojek) {
        $this->db->insert('tb_ojek', $ojek);
    }

}
