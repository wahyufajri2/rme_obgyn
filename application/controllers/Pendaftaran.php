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

    public function index() //Untuk menampilkan data pasien di menu pendaftaran
    {
        $data['title'] = 'Daftar Periksa Pasien';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('peran_pengguna')->result_array();
        $data['pasien'] = $this->db->get('pasien')->result_array();

        //Ambil data dari model pendafataran_model
        $data['daftar'] = $this->daftar->getDataPendaftaran();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pendaftaran/index', $data);
        $this->load->view('templates/footer');
    }

    // public function createKunjungan() //Untuk menambahkan data kunjungan di menu pendaftaran
    // {
    //     $data['title'] = 'Tambah Kunjungan';
    //     $this->form_validation->set_rules('no_rm', 'No RM', 'required|trim|is_unique[pendaftaran.no_rm]', [
    //         'is_unique' => 'Nomor RM sudah terdaftar!'
    //     ]);
    //     $this->form_validation->set_rules('no_rg', 'No RG', 'required|trim|is_unique[pendaftaran.no_rg]', [
    //         'is_unique' => 'Nomor registrasi sudah terdaftar!'
    //     ]);
    //     $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim');
    //     $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
    //     $this->form_validation->set_rules('tgl_periksa', 'Tanggal Periksa', 'required|trim');

    //     if ($this->form_validation->run() == false) {
    //         $data['title'] = 'Tambah Kunjungan';
    //         $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
    //         $this->load->model('Pendaftaran_model', 'kunjungan');


    //         $data['Pendaftaran'] = $this->kunjungan->getCreateKunjungan();
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('pendaftaran/index', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $this->db->insert('pendaftaran', [
    //             'no_rm' => htmlspecialchars($this->input->post('no_rm', true)),
    //             'no_rg' => htmlspecialchars($this->input->post('no_rg', true)),
    //             // 'nama_pasien' => htmlspecialchars($this->input->post('nama_pasien', true)),
    //             // 'alamat' => htmlspecialchars($this->input->post('alamat', true)),
    //             'tgl_periksa' => htmlspecialchars($this->input->post('tgl_periksa', true))
    //         ]);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kunjungan berhasil <strong>ditambahkan!</strong></div>');
    //         redirect('pendaftaran');
    //     }
    // }

    // public function deleteKunjungan($id_kunjungan)
    // {
    //     $this->load->model('Pendaftaran_model', 'delete');

    //     $this->delete->getDeleteKunjungan($id_kunjungan);
    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kunjungan berhasil <strong>dihapus!</strong></div>');
    //     redirect('pendaftaran');
    // }



    //Controller untuk submenu Master Data Pasien

    public function masterPasien() //Untuk menampilkan data master pasien di menu Pendaftaran
    {
        $data['title'] = 'Master Data Pasien';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('peran_pengguna')->result_array();
        $data['DataPasienDaftar'] = $this->db->get('pasien')->result_array();
        //Ambil data dari model pendafataran_model
        $data['daftar'] = $this->daftar->getDataPendaftaran();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pendaftaran/masterPasien', $data);
        $this->load->view('templates/footer');
    }

    public function tambahPasien() //Untuk menambahkan data master pasien dan data periksa pasien di menu pendaftaran
    {
        $this->form_validation->set_rules('nik', 'NIK Pasien', 'required|trim|is_unique[pasien.nik]', [
            'is_unique' => 'NIK Pasien sudah terdaftar!',
            'required' => 'NIK Pasien harus diisi!'
        ]);
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim', ['required' => 'Nama pasien harus diisi!']);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => 'Tanggal lahir harus diisi!']);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'required|trim', ['required' => 'Pilih jenis kelamin!']);
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim', ['required' => 'No HP harus diisi!']);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat harus diisi!']);
        $this->form_validation->set_rules('suami', 'Nama suami', 'required|trim', ['required' => 'Nama suami harus diisi!']);
        $this->form_validation->set_rules('tgl_periksa', 'Tanggal periksa', 'required|trim', ['required' => 'Tanggal periksa harus diisi!']);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Master Data Pasien';
            $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
            $data['DataPasienDaftar'] = $this->db->get('pasien')->result_array();

            //Ambil data dari model pendafataran_model
            $data['daftar'] = $this->daftar->getDataPendaftaran();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pendaftaran/masterPasien', $data);
            $this->load->view('templates/footer');
        } else {
            // Ambil data dari formulir
            $data_pasien = [
                'nik' => $this->input->post('nik'),
                'nama_pasien' => $this->input->post('nama_pasien'),
                'tgl_lahir' => strtotime($this->input->post('tgl_lahir')),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'no_hp' => $this->input->post('no_hp'),
                'alamat' => $this->input->post('alamat'),
                'suami' => $this->input->post('suami')
            ];

            // Ambil ID peran "Dokter" dari tabel peran_pengguna
            $this->db->select('id');
            $this->db->from('peran_pengguna');
            $this->db->where('peran', 'Dokter');
            $query = $this->db->get();
            $dokterRoleId = $query->row_array()['id'];

            // Ambil ID pengguna dokter dengan jumlah pasien paling sedikit
            $this->db->select('p.id_pengguna, COUNT(pd.id) AS jumlah_pasien');
            $this->db->from('pengguna AS p');
            $this->db->join('pendaftaran AS pd', 'p.id = pd.id_pengguna', 'left');
            $this->db->where('p.id_peran', $dokterRoleId);
            $this->db->where('pd.status !=', 'selesai periksa'); // Hanya pasien yang belum selesai periksa
            $this->db->group_by('p.id_pengguna');
            $this->db->order_by('jumlah_pasien', 'asc'); // Urutkan berdasarkan jumlah pasien ascending (sedikit dulu)
            $this->db->limit(1); // Ambil hanya satu dokter
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $id_pengguna_untuk_pendaftaran = $query->row_array()['id_pengguna'];
            } else {
                // Tangani kasus di mana tidak ada dokter yang tersedia
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak ada dokter yang tersedia saat ini!</div>');
                redirect('pendaftaran/masterPasien');
                return;
            }

            // 3. Buat array data_pendaftaran dengan id_pengguna yang sesuai
            $data_pendaftaran = [
                'tgl_periksa' => $this->input->post('tgl_periksa'),
                'status' => 'belum periksa',
                'tgl_pendaftaran' => time(),
                'nik' => $data_pasien['nik'],
                'id_pengguna' => $id_pengguna_untuk_pendaftaran
            ];

            // Proses pendaftaran menggunakan model
            $id_pendaftaran = $this->daftar->getDaftarPasien($data_pasien, $data_pendaftaran);

            // Ambil data dari model pendaftaran_model (setelah berhasil menyimpan)
            $data['daftar'] = $this->daftar->getDataPendaftaran($id_pendaftaran); // Gunakan $id_pendaftaran yang baru saja dibuat

            //Berikan respons atau redirect
            if ($id_pendaftaran) {
                $this->session->set_flashdata('message', 'Pendaftaran master data pasien berhasil!');
                redirect('pendaftaran/masterPasien/' . $id_pendaftaran);
            } else {
                $this->session->set_flashdata('message', 'Pendaftaran master data pasien gagal!');
                redirect('pendaftaran/masterPasien');
            }
        }
    }

    // public function editMasterPasien($id_pasien) //Untuk mengubah data master pasien di menu pendaftaran
    // {
    //     $data['title'] = 'Edit master data pasien';
    //     $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
    //     $this->load->model('Pendaftaran_model', 'praEdit');

    //     $data['DataPasienDaftar'] = $this->praEdit->getMasterPasien();
    //     // $data['EditMasterPasien'] = $this->emp->getMasterPasienById($id_pasien);

    //     $this->form_validation->set_rules('nik', 'ID Pasien', 'required|trim');
    //     $this->form_validation->set_rules('no_rm', 'No RM', 'required|trim');
    //     $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim');
    //     $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
    //     $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

    //     if ($this->form_validation->run() == false) {
    //         $data['title'] = 'Edit master data pasien';
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('pendaftaran/masterPasien', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $this->load->model('Pendaftaran_model', 'edit');

    //         $this->edit->getEditMasterPasien($id_pasien);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pasien berhasil <strong>diubah!</strong></div>');
    //         redirect('pendaftaran/masterPasien');
    //     }
    // }

    // public function deleteMasterPasien($id_pasien) //Untuk menghapus data master pasien di menu pendaftaran
    // {
    //     $this->load->model('Pendaftaran_model', 'delete');

    //     $this->delete->getDeleteMasterPasien($id_pasien);
    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pasien berhasil <strong>dihapus!</strong></div>');
    //     redirect('pendaftaran/masterPasien');
    // }
}
