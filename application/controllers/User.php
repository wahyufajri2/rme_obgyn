<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        // Load file model User_model.php
        parent::__construct();
        is_logged_in();
    }

    public function pasien()
    {
        $data['title'] = 'Master Data Pasien';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/pasien', $data);
        $this->load->view('templates/footer');
    }

    public function tranfusi()
    {
        $data['title'] = 'Tranfusi Darah';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['tranfusi'] = $this->db->get('tranfusi')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/tranfusi', $data);
        $this->load->view('templates/footer');
    }

    public function kebidanan()
    {
        $data['title'] = 'Asesment Kebidanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Kasus_model', 'kasus');


        $data['Kebidanan'] = $this->kasus->getKebidanan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/kebidanan', $data);
        $this->load->view('templates/footer');
    }

    public function persalinan()
    {
        $data['title'] = 'Catatan Persalinan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['persalinan'] = $this->db->get('persalinan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/persalinan', $data);
        $this->load->view('templates/footer');
    }
}
