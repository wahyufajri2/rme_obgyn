<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidan_model extends CI_Model
{
    public function getKebidanan()
    {
        $this->db->select('pasien.nama_pasien, inti_rekam_medis.no_rm, pendaftaran.status, pengguna.nama AS nama_bidan');
        $this->db->from('pasien');
        $this->db->join('inti_rekam_medis', 'pasien.nik = inti_rekam_medis.nik');
        $this->db->join('pendaftaran', 'pasien.nik = pendaftaran.nik');
        $this->db->join('pengguna', 'inti_rekam_medis.id_pengguna = pengguna.id');
        $this->db->join('peran_pengguna', 'pengguna.id_peran = peran_pengguna.id');
        $this->db->where('peran_pengguna.peran', 'Bidan');

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
