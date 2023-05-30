<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekamMedis_model extends CI_Model
{
    public function getDataPasienRM()
    {
        $this->db->select('id_pasien, no_rm, nama_pasien, alamat, tgl_lahir');
        $this->db->from('tb_pasien');
        $query = $this->db->get();

        return $query->result_array();
    }
}
