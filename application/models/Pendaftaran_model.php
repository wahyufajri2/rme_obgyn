<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model
{
    //Ambil data dari tabel pasien, pendaftaran, pengguna, dan peran_pengguna yang di-join
    public function getDataPendaftaran()
    {
        $this->db->select('a.*, b.no_rg, b.tgl_periksa, b.status, b.tgl_pendaftaran, b.id_pengguna, c.nama AS nama_dokter');
        $this->db->from('pasien AS a');
        $this->db->join('pendaftaran AS b', 'a.no_rm = b.no_rm');
        $this->db->join('pengguna AS c', 'b.id_pengguna = c.id');
        $this->db->join('peran_pengguna AS d', 'c.id_peran = d.id');


        // Kemudian urutkan berdasarkan tgl_dibuat dari tabel pasien, dari yang terbaru ke yang terlama
        $this->db->order_by('b.tgl_pendaftaran', 'DESC');

        $query = $this->db->get();

        return $query->result_array();
    }


    //Ambil data dokter dari tabel pengguna dan peran_pengguna yang di-join
    public function getDataDokter()
    {
        $this->db->select('a.id, a.nama');
        $this->db->from('pengguna AS a');
        $this->db->join('peran_pengguna AS b', 'a.id_peran = b.id');
        $this->db->where('b.peran', 'Dokter');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getDataMasterPasien()
    {
        // Mengurutkan data berdasarkan tgl_dibuat, data terbaru di atas
        $this->db->order_by('tgl_dibuat', 'DESC');

        // Mendapatkan data dari tabel pasien
        $query = $this->db->get('pasien');

        // Mengembalikan hasil query sebagai array
        return $query->result_array();
    }
}
