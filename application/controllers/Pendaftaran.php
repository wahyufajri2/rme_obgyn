<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Pendaftaran_model', 'daftar'); // Load model pendaftaran
    }

    //Awal fungsi untuk mengelola submenu pendaftaran periksa pasien
    public function index() //Untuk menampilkan tabel awal data pasien di menu pendaftaran
    {
        //Menyimpan data judul, data user, data role, dan data master pasien
        $data['title'] = 'Daftar Periksa Pasien';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('peran_pengguna')->result_array();

        //Ambil data dari model pendafataran_model
        $data['daftar'] = $this->daftar->getDataPendaftaran();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pendaftaran/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambahPeriksaPasien() //Untuk menambahkan data periksa pasien di menu pendaftaran
    {
        $this->form_validation->set_rules('id', 'Nama dokter', 'required|trim', ['required' => 'Nama dokter harus diisi!']);
        $this->form_validation->set_rules('tgl_periksa', 'Tanggal Periksa', 'required|trim', ['required' => 'Tanggal periksa harus diisi!']);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Daftar Periksa Pasien';
            $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
            $data['role'] = $this->db->get('peran_pengguna')->result_array();
            $data['dataMasterPasien'] = $this->db->get('pasien')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pendaftaran/index', $data);
            $this->load->view('templates/footer');
        } else {
            // Generate nomor registrasi dari helper rme_helper.php
            $no_rg = generate_no_rg();
            // Ambil data dari formulir
            $dataPeriksaPasien = [
                'no_rg' => $no_rg, // Tambahkan no_rg ke data yang akan disimpan
                'no_rm' => $this->input->post('no_rm', true), // Asumsikan 'no_rm' ada di formulir
                'id_pengguna' => $this->input->post('id', true), // Asumsikan 'id' adalah ID dokter dari formulir
                'tgl_periksa' => strtotime($this->input->post('tgl_periksa', true)),
                'status' => 'Belum periksa',
                'no_kamar' => $this->input->post('no_kamar', true),
                'tgl_pendaftaran' => time()
            ];
            //Simpan ke tabel pendaftaran
            $this->db->insert('pendaftaran', $dataPeriksaPasien);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data periksa pasien berhasil ditambahkan!</div>');
            redirect('pendaftaran');
        }
    }

    public function ubahPeriksaPasien($nik) //Untuk mengubah data periksa pasien beradasarkan nik yang dipilih di menu pendaftaran
    {
        $this->form_validation->set_rules('id', 'Nama dokter', 'required|trim', ['required' => 'Nama dokter harus diisi!']);
        $this->form_validation->set_rules('tgl_periksa', 'Tanggal Periksa', 'required|trim', ['required' => 'Tanggal periksa harus diisi!']);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Daftar Periksa Pasien';
            $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
            $data['role'] = $this->db->get('peran_pengguna')->result_array();
            $data['dataMasterPasien'] = $this->db->get('pasien')->result_array();

            //Ambil data dari model pendafataran_model
            $data['daftar_dokter'] = $this->daftar->getDataDokter();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pendaftaran/index', $data);
            $this->load->view('templates/footer');
        } else {
            // Ambil data dari formulir
            $dataPeriksaPasien = [
                'nik' => $this->input->post('nik'), // Asumsikan 'nik' ada di formulir
                'id_pengguna' => $this->input->post('id'), // Asumsikan 'id' adalah ID dokter dari formulir
                'tgl_periksa' => strtotime($this->input->post('tgl_periksa')),
                'status' => 'Belum periksa',
                'tgl_pendaftaran' => time()
            ];
            //Update ke tabel pendaftaran
            $this->db->where('nik', $nik);
            $this->db->update('pendaftaran', $dataPeriksaPasien);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data periksa pasien berhasil diubah!</div>');
            redirect('pendaftaran');
        }
    }
    //Akhir fungsi untuk mengelola submenu pendaftaran periksa pasien



    //Awal fungsi untuk mengelola submenu Master Data Pasien
    public function masterPasien() //Untuk menampilkan data master pasien di menu Pendaftaran
    {
        //Menyimpan data judul, data user, data role, dan data master pasien
        $data['title'] = 'Master Data Pasien';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('peran_pengguna')->result_array();
        $data['dataMasterPasien'] = $this->db->get('pasien')->result_array();

        //Ambil data dari model pendafataran_model
        $data['daftar'] = $this->daftar->getDataPendaftaran();

        //Ambil data dari model pendafataran_model
        $data['daftar_dokter'] = $this->daftar->getDataDokter();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pendaftaran/masterPasien', $data);
        $this->load->view('templates/footer');
    }

    public function tambahMasterPasien() //Untuk menambahkan data master pasien di menu pendaftaran
    {
        $this->form_validation->set_rules('nik', 'NIK Pasien', 'required|trim|is_unique[pasien.nik]', [
            'is_unique' => 'NIK Pasien sudah terdaftar!',
            'required' => 'NIK Pasien harus diisi!'
        ]);
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim', ['required' => 'Nama pasien harus diisi!']);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => 'Tanggal lahir harus diisi!']);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'required|trim|in_list[Perempuan,Laki-laki]', ['required' => 'Pilih jenis kelamin!']);
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim', ['required' => 'No HP harus diisi!']);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat harus diisi!']);
        $this->form_validation->set_rules('suami', 'Nama suami', 'required|trim', ['required' => 'Nama suami harus diisi!']);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Master Data Pasien';
            $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
            $data['role'] = $this->db->get('peran_pengguna')->result_array();
            $data['dataMasterPasien'] = $this->db->get('pasien')->result_array();

            //Ambil data dari model pendafataran_model
            $data['daftar'] = $this->daftar->getDataPendaftaran();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pendaftaran/masterPasien', $data);
            $this->load->view('templates/footer');
        } else {
            // Generate nomor rekam medis dari helper rme_helper.php
            $no_rm = generate_no_rm();
            // Ambil data dari formulir
            $dataMasterPasien = [
                'no_rm' => $no_rm, // Tambahkan no_rm ke data yang akan disimpan
                'nik' => htmlspecialchars($this->input->post('nik'), ENT_QUOTES, 'UTF-8'),
                'nama_pasien' => htmlspecialchars($this->input->post('nama_pasien'), ENT_QUOTES, 'UTF-8'),
                'tgl_lahir' => htmlspecialchars(strtotime($this->input->post('tgl_lahir')), ENT_QUOTES, 'UTF-8'),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin'), ENT_QUOTES, 'UTF-8'),
                'no_hp' => htmlspecialchars($this->input->post('no_hp'), ENT_QUOTES, 'UTF-8'),
                'alamat' => htmlspecialchars($this->input->post('alamat'), ENT_QUOTES, 'UTF-8'),
                'suami' => htmlspecialchars($this->input->post('suami'), ENT_QUOTES, 'UTF-8'),
                'tgl_dibuat' => time()
            ];
            //Simpan ke tabel pasien
            $this->db->insert('pasien', $dataMasterPasien);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data master pasien berhasil ditambahkan!</div>');
            redirect('pendaftaran/masterPasien');
        }
    }

    public function ubahMasterPasien($no_rm) //Untuk mengubah data master pasien berdasarkan nik yang dipilih di menu pendaftaran
    {
        $this->form_validation->set_rules('nik', 'NIK Pasien', 'required|trim', ['required' => 'NIK Pasien harus diisi!']);
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim', ['required' => 'Nama pasien harus diisi!']);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => 'Tanggal lahir harus diisi!']);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'required|trim|in_list[Perempuan,Laki-laki]', ['required' => 'Pilih jenis kelamin!']);
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim', ['required' => 'No HP harus diisi!']);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat harus diisi!']);
        $this->form_validation->set_rules('suami', 'Nama suami', 'required|trim', ['required' => 'Nama suami harus diisi!']);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Master Data Pasien';
            $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
            $data['role'] = $this->db->get('peran_pengguna')->result_array();
            $data['dataMasterPasien'] = $this->db->get('pasien')->result_array();

            //Ambil data dari model pendafataran_model
            $data['daftar'] = $this->daftar->getDataPendaftaran();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pendaftaran/masterPasien', $data);
            $this->load->view('templates/footer');
        } else {
            // Ambil data dari formulir
            $dataMasterPasien = [
                'nik' => htmlspecialchars($this->input->post('nik'), ENT_QUOTES, 'UTF-8'),
                'nama_pasien' => htmlspecialchars($this->input->post('nama_pasien'), ENT_QUOTES, 'UTF-8'),
                'tgl_lahir' => htmlspecialchars(strtotime($this->input->post('tgl_lahir')), ENT_QUOTES, 'UTF-8'),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin'), ENT_QUOTES, 'UTF-8'),
                'no_hp' => htmlspecialchars($this->input->post('no_hp'), ENT_QUOTES, 'UTF-8'),
                'alamat' => htmlspecialchars($this->input->post('alamat'), ENT_QUOTES, 'UTF-8'),
                'suami' => htmlspecialchars($this->input->post('suami'), ENT_QUOTES, 'UTF-8'),
                'tgl_dibuat' => time()
            ];
            //Update ke tabel pasien
            $this->db->where('no_rm', $no_rm);
            $this->db->update('pasien', $dataMasterPasien);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data master pasien berhasil diubah!</div>');
            redirect('pendaftaran/masterPasien');
        }
    }
    //Akhir fungsi untuk mengelola submenu Master Data Pasien
}
