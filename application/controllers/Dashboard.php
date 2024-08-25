<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth'); // Redirect ke halaman login, jika belum login
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('peran_pengguna')->result_array();

        // Ambil jumlah baris data dari tabel 'pendaftaran'
        $this->db->from('pendaftaran'); // Ganti 'pendaftaran' dengan nama tabel Anda jika berbeda
        $query = $this->db->get();
        $data['jumlah_pendaftaran'] = $query->num_rows();

        // Ambil jumlah pendaftaran per hari ini
        $today = date('Y-m-d'); // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
        $this->db->from('pendaftaran');
        $this->db->where('DATE(tgl_pendaftaran)', $today); // Asumsikan kolom tanggal pendaftaran adalah 'tgl_pendaftaran'
        $query_today = $this->db->get();
        $data['jumlah_pendaftaran_hari_ini'] = $query_today->num_rows();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
}
