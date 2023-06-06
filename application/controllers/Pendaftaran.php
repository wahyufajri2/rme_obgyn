<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
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
        $this->load->model('Daftar_model', 'daftar');


        $data['Pendaftaran'] = $this->daftar->getPendaftaran();
        $data['dokter'] = $this->db->get('tb_dokter')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pendaftaran/index', $data);
        $this->load->view('templates/footer');
    }

    public function dataPasien()
    {
        $data['title'] = 'Master Data Pasien';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Daftar_model', 'dpd');


        $data['DataPasienDaftar'] = $this->dpd->getDataPasienDaftar();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pendaftaran/dataPasien', $data);
        $this->load->view('templates/footer');
    }

    public function createKunjungan()
    {
        $data['title'] = 'Entri Kunjungan';
        $this->form_validation->set_rules('no_rm', 'No RM', 'required|trim|is_unique[tb_kunjungan.no_rm]', [
            'is_unique' => 'RM number already registered!'
        ]);
        $this->form_validation->set_rules('no_rg', 'No RG', 'required|trim|is_unique[tb_kunjungan.no_rg]', [
            'is_unique' => 'Registration number already registered!'
        ]);
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('id_dokter', 'Dokter', 'required|trim');
        $this->form_validation->set_rules('periksa_tgl', 'Tanggal Periksa', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Entri Kunjungan';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->model('Kunjungan_model', 'kunjungan');


            $data['Pendaftaran'] = $this->kunjungan->getKunjungan();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pendaftaran/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('tb_kunjungan', [
                'no_rm' => htmlspecialchars($this->input->post('no_rm', true)),
                'no_rg' => htmlspecialchars($this->input->post('no_rg', true)),
                'nama_pasien' => htmlspecialchars($this->input->post('nama_pasien', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'id_dokter' => htmlspecialchars($this->input->post('id_dokter', true)),
                'periksa_tgl' => htmlspecialchars($this->input->post('periksa_tgl', true))
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Patient Data successfully added!</div>');
            redirect('pendaftaran');
        }
    }

    public function createPasien()
    {
        $data['title'] = 'Tambah Data Pasien';
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
            $data['title'] = 'Tambah Data Pasien';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pendaftaran/dataPasien', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('tb_pasien', [
                'id_pasien' => htmlspecialchars($this->input->post('id_pasien', true)),
                'no_rm' => htmlspecialchars($this->input->post('no_rm', true)),
                'nama_pasien' => htmlspecialchars($this->input->post('nama_pasien', true)),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true))
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pasien berhasil <strong>ditambahkan!</strong></div>');
            redirect('pendaftaran/dataPasien');
        }
    }

    public function deletePasien($id_pasien)
    {
        $this->load->model('Daftar_model');

        $this->Daftar_model->deleteDataPasien($id_pasien);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pasien berhasil <strong>dihapus!</strong></div>');
        redirect('pendaftaran/dataPasien');
    }
}
