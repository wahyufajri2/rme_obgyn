<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidan_model extends CI_Model
{
    public function getKebidanan()
    {
        $this->db->select('a.no_rm, b.no_rg, b.status, a.nama_pasien, a.alamat');
        $this->db->from('tb_pasien AS a');
        $this->db->join('tb_kunjungan AS b', 'a.id_pasien = b.pasien_id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getEntriKebidanan($data, $table)
    {
        $table = 'tb_kunjungan_dtl';
        $this->db->insert($table, $data);
    }

    public function getKunjunganDetail()
    {
        // $query = $this->db->get('tb_kunjungan_dtl');

        // return $query->result_array();
        $this->db->select('a.no_rm, b.no_rg, b.status, a.nama_pasien, a.alamat');
        $this->db->from('tb_pasien AS a');
        $this->db->join('tb_kunjungan AS b', 'a.id_pasien = b.pasien_id');
        $query = $this->db->get();

        return $query->result_array();
    }



    // Modal untuk kasus persalinan

    public function getPersalinan()
    {
        $this->db->select('a.no_rm, b.no_rg, b.status, a.nama_pasien, a.alamat');
        $this->db->from('tb_pasien AS a');
        $this->db->join('tb_kunjungan AS b', 'a.id_pasien = b.pasien_id');
        $query = $this->db->get();

        return $query->result_array();
    }
}
