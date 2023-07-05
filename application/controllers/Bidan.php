<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidan extends CI_Controller
{

    public function __construct()
    {
        // Load file model User_model.php
        parent::__construct();
        is_logged_in();
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
        $this->load->view('bidan/kebidanan', $data);
        $this->load->view('templates/footer');
    }

    public function entriKebidanan()
    {
    }

    public function print()
    {
        $this->load->model('Kasus_model', 'print');

        $data['Kebidanan'] = $this->print->getKebidanan();
        $this->load->view('templates/header', $data);
        $this->load->view('bidan/print_kebidanan', $data);
    }









    //Controller untuk kasus persalinan

    public function persalinan()
    {
        $data['title'] = 'Catatan Persalinan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Kasus_model', 'kasus');


        $data['Persalinan'] = $this->kasus->getPersalinan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bidan/persalinan', $data);
        $this->load->view('templates/footer');
    }
}
