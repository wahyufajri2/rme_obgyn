<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model
{
    public function getDataKunjungan() //Mengambil data hasil join tabel pasien, kunjungan, dan dokter untuk ditampilkan di halaman kunjungan pada menu pendaftaran
    {
        $this->db->select('a.no_rm, b.no_rg, a.nama_pasien, a.alamat, c.nama_dokter, b.periksa_tgl');
        $this->db->from('tb_pasien AS a');
        $this->db->join('tb_kunjungan AS b', 'a.id_pasien = b.pasien_id');
        $this->db->join('tb_dokter AS c', 'b.dokter_id = c.id_dokter');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getCreateKunjungan()
    {
        // $data = [
        //     'no_rm' => htmlspecialchars($this->input->post('no_rm', true)),
        //     'no_rg' => htmlspecialchars($this->input->post('no_rg', true)),
        //     'pasien_id' => htmlspecialchars($this->input->post('id_pasien', true)),
        //     'dokter_id' => htmlspecialchars($this->input->post('id_dokter', true)),
        //     'periksa_tgl' => htmlspecialchars($this->input->post('periksa_tgl', true))
        // ];

        // $this->db->insert('tb_kunjungan', $data);
    }

    public function getMasterPasien() //Mengambil data tabel pasien untuk ditampilkan di master pasien pada menu pendaftaran
    {
        $this->db->select('id_pasien, no_rm, nama_pasien, alamat, tgl_lahir');
        $this->db->from('tb_pasien');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getMasterPasienById($id_pasien)
    {
        return $this->db->get_where('tb_pasien', ['id_pasien' => $id_pasien])->row_array();
    }

    public function getDeleteMasterPasien($id_pasien) //Menghapus data master pasien pada menu pendaftaran
    {
        $this->db->where('id_pasien', $id_pasien);
        $this->db->delete('tb_pasien');
    }

    public function getEditMasterPasien($id_pasien)
    {
        $id_pasien = $this->input->post('id_pasien');
        $no_rm = $this->input->post('no_rm');
        $nama_pasien = $this->input->post('nama_pasien');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $alamat = $this->input->post('alamat');

        $this->db->set('id_pasien', $id_pasien);
        $this->db->set('no_rm', $no_rm);
        $this->db->set('nama_pasien', $nama_pasien);
        $this->db->set('tgl_lahir', $tgl_lahir);
        $this->db->set('alamat', $alamat);
        $this->db->where('id_pasien', $id_pasien);
        $this->db->update('tb_pasien');
    }
}