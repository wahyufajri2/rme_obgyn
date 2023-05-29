<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasus_model extends CI_Model
{
    public function getKebidanan()
    {
        $this->db->select('a.no_rm, b.no_rg, b.status, a.nama_pasien, a.alamat');
        $this->db->from('tb_pasien AS a');
        $this->db->join('tb_kunjungan AS b', 'a.id_pasien = b.pasien_id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getPersalinan()
    {
        $this->db->select('a.no_rm, b.no_rg, b.status, a.nama_pasien, a.alamat');
        $this->db->from('tb_pasien AS a');
        $this->db->join('tb_kunjungan AS b', 'a.id_pasien = b.pasien_id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getTranfusi()
    {
        $this->db->select('a.no_rm, b.no_rg, b.status, a.nama_pasien, a.alamat');
        $this->db->from('tb_pasien AS a');
        $this->db->join('tb_kunjungan AS b', 'a.id_pasien = b.pasien_id');
        $query = $this->db->get();

        return $query->result_array();
    }
}
