<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model
{
    public function getDataPendaftaran()
    {
        $this->db->select('a.*, b.no_rg, b.tgl_periksa, b.status, b.tgl_pendaftaran, c.nama');
        $this->db->from('pasien AS a');
        $this->db->join('pendaftaran AS b', 'a.nik = b.nik');
        $this->db->join('pengguna AS c', 'b.id_pengguna = c.id');
        $this->db->join('peran_pengguna AS d', 'c.id_peran = d.id');
        $query = $this->db->get();

        return $query->result_array();
    }

    // public function getCreateKunjungan()
    // {
    //     $data = [
    //         'id_kunjungan' => htmlspecialchars($this->input->post('id_kunjungan', true)),
    //         'no_rm' => htmlspecialchars($this->input->post('no_rm', true)),
    //         'no_rg' => htmlspecialchars($this->input->post('no_rg', true)),
    //         'nama_pasien' => htmlspecialchars($this->input->post('pasien_id', true)),
    //         'alamat' => htmlspecialchars($this->input->post('alamat', true)),
    //         'nama_dokter' => htmlspecialchars($this->input->post('dokter_id', true)),
    //         'periksa_tgl' => htmlspecialchars($this->input->post('periksa_tgl', true))
    //     ];

    //     $this->db->insert('tb_kunjungan', $data);
    // }

    // public function getDeleteKunjungan($id_kunjungan)
    // {
    //     $this->db->where('id_kunjungan', $id_kunjungan);
    //     $this->db->delete('tb_kunjungan');
    // }



    //Model untuk submenu Master Data Pasien

    public function getDaftarPasien($data_pasien, $data_pendaftaran)
    {
        // Cek apakah pasien sudah ada berdasarkan NIK
        $existing_pasien = $this->db->get_where('pasien', ['nik' => $data_pasien['nik']])->row_array();

        if (!$existing_pasien) {
            // Jika pasien belum ada, masukkan data ke tabel pasien
            $this->db->insert('pasien', $data_pasien);
        }

        // Masukkan data ke tabel pendaftaran
        $this->db->insert('pendaftaran', $data_pendaftaran);

        return $this->db->insert_id(); // Mengembalikan ID pendaftaran yang baru dibuat
    }


    // public function getDeleteMasterPasien($id_pasien) //Menghapus data master pasien pada menu pendaftaran
    // {
    //     $this->db->where('id_pasien', $id_pasien);
    //     $this->db->delete('tb_pasien');
    // }

    // public function getEditMasterPasien($id_pasien)
    // {
    //     $id_pasien = $this->input->post('id_pasien');
    //     $no_rm = $this->input->post('no_rm');
    //     $nama_pasien = $this->input->post('nama_pasien');
    //     $tgl_lahir = $this->input->post('tgl_lahir');
    //     $alamat = $this->input->post('alamat');

    //     $this->db->set('id_pasien', $id_pasien);
    //     $this->db->set('no_rm', $no_rm);
    //     $this->db->set('nama_pasien', $nama_pasien);
    //     $this->db->set('tgl_lahir', $tgl_lahir);
    //     $this->db->set('alamat', $alamat);
    //     $this->db->where('id_pasien', $id_pasien);
    //     $this->db->update('tb_pasien');
    // }
}
