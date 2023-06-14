<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekamMedis_model extends CI_Model
{
    public function getPasienRM()
    {
        $this->db->select('id_pasien, no_rm, nama_pasien, alamat, tgl_lahir');
        $this->db->from('tb_pasien');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getDeletePasienRM($id_pasien)
    {
        $this->db->where('id_pasien', $id_pasien);
        $this->db->delete('tb_pasien');
    }

    public function getEditPasienRM($id_pasien)
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
