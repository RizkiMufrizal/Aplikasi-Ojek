<?php

/**
 * Author Rizki Mufrizal <mufrizalrizki@gmail.com>
 * Since Apr 17, 2016
 * Time 8:26:19 AM
 * Encoding UTF-8
 * Project Aplikasi-Ojek-Server
 * Package Expression package is undefined on line 12, column 14 in Templates/Scripting/PHPClass.php.
 */
class Pelanggan extends CI_Model
{
    public function register($pelanggan)
    {
        $this->db->insert('tb_pelanggan', $pelanggan);
    }

    public function login($email)
    {
        $this->db->where('email', $email);
        $this->db->select('password');
        $this->db->select('role');

        return $this->db->get('tb_pelanggan')->result();
    }
}
