<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function rekamMedis()
    {
        $data['title'] = 'Rekam Medis';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Dokter_model', 'dokter');

        $data['RekamMedis'] = $this->dokter->getRekamMedis();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dokter/rekam_medis', $data);
        $this->load->view('templates/footer');
    }
}