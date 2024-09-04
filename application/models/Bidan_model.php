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

        // Tambahkan pengurutan berdasarkan status
        $this->db->order_by('FIELD(b.status, "Belum periksa", "Sedang periksa", "Selesai periksa")');

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
