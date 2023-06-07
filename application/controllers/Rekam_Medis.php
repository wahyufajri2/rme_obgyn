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

    public function deletePasienRM($id_pasien)
    {
        $this->load->model('RekamMedis_model');

        $this->RekamMedis_model->deleteDataPasienRM($id_pasien);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pasien berhasil <strong>dihapus!</strong></div>');
        redirect('rekam_medis');
    }

    // public function edit($id_pasien)
    // {
    //     $data['title'] = 'Edit Data Pasien*';
    //     $data['pasien'] = $this->db->get_where('tb_pasien', ['id_pasien' => $id_pasien])->row_array();

    //     $this->form_validation->set_rules('id_pasien', 'ID Pasien', 'required|trim');
    //     $this->form_validation->set_rules('no_rm', 'No RM', 'required|trim');
    //     $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim');
    //     $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
    //     $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

    //     if ($this->form_validation->run() == false) {
    //         $data['title'] = 'Edit Data Pasien*';
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('rekam_medis/index', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $id_pasien = $this->input->post('id_pasien');
    //         $no_rm = $this->input->post('no_rm');
    //         $nama_pasien = $this->input->post('nama_pasien');
    //         $tgl_lahir = $this->input->post('tgl_lahir');
    //         $alamat = $this->input->post('alamat');

    //         $this->db->set('id_pasien', $id_pasien);
    //         $this->db->set('no_rm', $no_rm);
    //         $this->db->set('nama_pasien', $nama_pasien);
    //         $this->db->set('tgl_lahir', $tgl_lahir);
    //         $this->db->set('alamat', $alamat);
    //         $this->db->where('id_pasien', $id_pasien);
    //         $this->db->update('tb_pasien');

    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Patient Data successfully edited!</div>');
    //         redirect('rekam_medis');
    //     }
    // }

}
