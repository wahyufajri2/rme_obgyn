<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index() //Untuk menampilkan data kunjungan di menu pendaftaran
    {
        $data['title'] = 'Pendaftaran pasien';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Pendaftaran_model', 'daftar');

        $data['Kunjungan'] = $this->daftar->getDataKunjungan();
        $data['pasien'] = $this->db->get('pasien')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pendaftaran/index', $data);
        $this->load->view('templates/footer');
    }

    public function createKunjungan() //Untuk menambahkan data kunjungan di menu pendaftaran
    {
        $data['title'] = 'Tambah Kunjungan';
        $this->form_validation->set_rules('no_rm', 'No RM', 'required|trim|is_unique[pendaftaran.no_rm]', [
            'is_unique' => 'Nomor RM sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('no_rg', 'No RG', 'required|trim|is_unique[pendaftaran.no_rg]', [
            'is_unique' => 'Nomor registrasi sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('tgl_periksa', 'Tanggal Periksa', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tambah Kunjungan';
            $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->model('Pendaftaran_model', 'kunjungan');


            $data['Pendaftaran'] = $this->kunjungan->getCreateKunjungan();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pendaftaran/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('pendaftaran', [
                'no_rm' => htmlspecialchars($this->input->post('no_rm', true)),
                'no_rg' => htmlspecialchars($this->input->post('no_rg', true)),
                // 'nama_pasien' => htmlspecialchars($this->input->post('nama_pasien', true)),
                // 'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'tgl_periksa' => htmlspecialchars($this->input->post('tgl_periksa', true))
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kunjungan berhasil <strong>ditambahkan!</strong></div>');
            redirect('pendaftaran');
        }
    }

    public function deleteKunjungan($id_kunjungan)
    {
        $this->load->model('Pendaftaran_model', 'delete');

        $this->delete->getDeleteKunjungan($id_kunjungan);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kunjungan berhasil <strong>dihapus!</strong></div>');
        redirect('pendaftaran');
    }



    //Controller untuk submenu Master Data Pasien

    public function masterPasien() //Untuk menampilkan data master pasien di menu Pendaftaran
    {
        $data['title'] = 'Master Data Pasien';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Pendaftaran_model', 'dpd');

        $data['DataPasienDaftar'] = $this->dpd->getMasterPasien();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pendaftaran/masterPasien', $data);
        $this->load->view('templates/footer');
    }

    public function createMasterPasien() //Untuk menambahkan data master pasien di menu pendaftaran
    {
        $data['title'] = 'Tambah Master Data Pasien';
        $this->form_validation->set_rules('nik', 'ID Pasien', 'required|trim|is_unique[pasien.nik]', [
            'is_unique' => 'ID Pasien sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('no_rm', 'No RM', 'required|trim|is_unique[pasien.no_rm]', [
            'is_unique' => 'Nomor RM sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Coba ulangi dengan mengklik tombol <strong>Tambah master data pasien</strong></div>');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tambah Master Data Pasien';
            $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->model('Pendaftaran_model', 'dpd');

            $data['DataPasienDaftar'] = $this->dpd->getMasterPasien();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pendaftaran/masterPasien', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('pasien', [
                'nik' => htmlspecialchars($this->input->post('nik', true)),
                'no_rm' => htmlspecialchars($this->input->post('no_rm', true)),
                'nama_pasien' => htmlspecialchars($this->input->post('nama_pasien', true)),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true))
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pasien berhasil <strong>ditambahkan!</strong></div>');
            redirect('pendaftaran/masterPasien');
        }
    }

    public function editMasterPasien($id_pasien) //Untuk mengubah data master pasien di menu pendaftaran
    {
        $data['title'] = 'Edit master data pasien';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Pendaftaran_model', 'praEdit');

        $data['DataPasienDaftar'] = $this->praEdit->getMasterPasien();
        // $data['EditMasterPasien'] = $this->emp->getMasterPasienById($id_pasien);

        $this->form_validation->set_rules('nik', 'ID Pasien', 'required|trim');
        $this->form_validation->set_rules('no_rm', 'No RM', 'required|trim');
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit master data pasien';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pendaftaran/masterPasien', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('Pendaftaran_model', 'edit');

            $this->edit->getEditMasterPasien($id_pasien);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pasien berhasil <strong>diubah!</strong></div>');
            redirect('pendaftaran/masterPasien');
        }
    }

    public function deleteMasterPasien($id_pasien) //Untuk menghapus data master pasien di menu pendaftaran
    {
        $this->load->model('Pendaftaran_model', 'delete');

        $this->delete->getDeleteMasterPasien($id_pasien);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pasien berhasil <strong>dihapus!</strong></div>');
        redirect('pendaftaran/masterPasien');
    }
}
