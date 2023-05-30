<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_model extends CI_Model
{
    public function getPendaftaran()
    {
        $this->db->select('a.no_rm, b.no_rg, a.nama_pasien, a.alamat, c.nama_dokter, b.periksa_tgl');
        $this->db->from('tb_pasien AS a');
        $this->db->join('tb_kunjungan AS b', 'a.id_pasien = b.pasien_id');
        $this->db->join('tb_dokter AS c', 'b.dokter_id = c.id_dokter');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getDataPasienDaftar()
    {
        $this->db->select('id_pasien, no_rm, nama_pasien, alamat, tgl_lahir');
        $this->db->from('tb_pasien');
        $query = $this->db->get();

        return $query->result_array();
    }
}
