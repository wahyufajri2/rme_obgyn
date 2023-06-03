<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekam_Medis extends CI_Controller
{

    public function __construct()
    {
        // Load file model User_model.php
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Master Data Pasien*';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('RekamMedis_model', 'rm');


        $data['DataPasienRM'] = $this->rm->getDataPasienRM();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekam_medis/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Pasien*';
        $this->form_validation->set_rules('id_pasien', 'ID Pasien', 'required|trim|is_unique[tb_pasien.id_pasien]', [
            'is_unique' => 'Patient ID already registered!'
        ]);
        $this->form_validation->set_rules('no_rm', 'No RM', 'required|trim|is_unique[tb_pasien.no_rm]', [
            'is_unique' => 'RM number already registered!'
        ]);
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tambah Data Pasien*';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('rekam_medis/create', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('tb_pasien', [
                'id_pasien' => htmlspecialchars($this->input->post('id_pasien', true)),
                'no_rm' => htmlspecialchars($this->input->post('no_rm', true)),
                'nama_pasien' => htmlspecialchars($this->input->post('nama_pasien', true)),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true))
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Patient Data successfully added!</div>');
            redirect('rekam_medis');
        }
    }
}
