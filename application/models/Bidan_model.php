<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidan_model extends CI_Model
{
    public function getKebidanan()
    {
        $this->db->select('a.nama_pasien, a.no_rm, a.suami, a.alamat, a.tgl_lahir, b.no_rg, b.tgl_periksa, b.status, b.id_pengguna, c.nama AS nama_bidan');
        $this->db->from('pasien AS a');
        $this->db->join('pendaftaran AS b', 'a.no_rm = b.no_rm');
        $this->db->join('pengguna AS c', 'b.id_pengguna = c.id');
        $this->db->join('peran_pengguna AS d', 'c.id_peran = d.id');

        $query = $this->db->get();
        return $query->result_array();
    }
}
