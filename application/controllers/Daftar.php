<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar extends CI_Controller
{

    public function __construct()
    {
        // Load file model User_model.php
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Entri Kunjungan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('daftar/index', $data);
        $this->load->view('templates/footer');
    }

    public function data_pasien()
    {
        $data['title'] = 'Master Data Pasien';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('daftar/data_pasien', $data);
        $this->load->view('templates/footer');
    }
}
