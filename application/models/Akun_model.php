<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun_model extends CI_Model
{
    public function getAkun()
    {
        $query = "SELECT `pengguna`.*, `peran_pengguna`.`peran` 
                    FROM `pengguna` JOIN `peran_pengguna` 
                    ON `pengguna`.`id_peran` = `peran_pengguna`.`id`
        ";
        return $this->db->query($query)->result_array();
    }
}
