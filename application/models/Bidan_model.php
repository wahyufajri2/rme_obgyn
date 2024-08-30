<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidan_model extends CI_Model
{
    public function getKebidanan()
    {
        $this->db->select('a.nama_pasien, b.no_rm, c.status, d.nama AS nama_bidan');
        $this->db->from('pasien AS a');
        $this->db->join('inti_rekam_medis AS b', 'a.nik = b.nik');
        $this->db->join('pendaftaran AS c', 'a.nik = c.nik');
        $this->db->join('pengguna AS d', 'b.id_pengguna = d.id');
        $this->db->join('peran_pengguna AS e', 'd.id_peran = e.id');
        $this->db->where('e.peran', 'Bidan');

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
        $this->db->from('pasien AS a');
        $this->db->join('tb_kunjungan AS b', 'a.id_pasien = b.pasien_id');
        $query = $this->db->get();

        return $query->result_array();
    }
}
