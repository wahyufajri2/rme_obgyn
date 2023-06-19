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

    public function index() //Untuk menampilkan data pasien di menu rekam medis
    {
        $data['title'] = 'Master Data Pasien*';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('RekamMedis_model', 'dataRM');


        $data['DataPasienRM'] = $this->dataRM->getPasienRM();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekam_medis/index', $data);
        $this->load->view('templates/footer');
    }

    public function createPasienRM() //Untuk menambahkan data pasien di menu rekam medis
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
            $this->load->view('templates/topbar', $data);
            $this->load->view('rekam_medis/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('tb_pasien', [
                'id_pasien' => htmlspecialchars($this->input->post('id_pasien', true)),
                'no_rm' => htmlspecialchars($this->input->post('no_rm', true)),
                'nama_pasien' => htmlspecialchars($this->input->post('nama_pasien', true)),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true))
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pasien berhasil <strong>ditambahkan!</strong></div>');
            redirect('rekam_medis');
        }
    }

    public function deletePasienRM($id_pasien) //Untuk menghapus data master pasien di menu Rekam Medis
    {
        $this->load->model('RekamMedis_model');

        $this->RekamMedis_model->getDeletePasienRM($id_pasien);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pasien berhasil <strong>dihapus!</strong></div>');
        redirect('rekam_medis');
    }

    public function editPasienRM($id_pasien) //Untuk mengubah data master pasien di menu Rekam Medis
    {
        $data['title'] = 'Edit Master Data Pasien';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('RekamMedis_model', 'praEdit');

        $data['DataPasienRM'] = $this->praEdit->getPasienRM();

        $this->form_validation->set_rules('id_pasien', 'ID Pasien', 'required|trim');
        $this->form_validation->set_rules('no_rm', 'No RM', 'required|trim');
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Master Data Pasien';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('rekam_medis/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('RekamMedis_model', 'edit');

            $this->edit->getEditPasienRM($id_pasien);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pasien berhasil <strong>diubah!</strong></div>');
            redirect('rekam_medis');
        }
    }
}
