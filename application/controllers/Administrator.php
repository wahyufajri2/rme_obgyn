<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dasbor';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('administrator/index', $data);
        $this->load->view('templates/footer');
    }

    public function dataPengguna()
    {
        $data['title'] = 'Data Pengguna';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('administrator/data_pengguna', $data);
        $this->load->view('templates/footer');
    }

    public function hotspotGenerator()
    {
        if ($this->input->post()) {
            // Ambil data inputan dari form
            $jumlah_user = $this->input->post('jumlah_user');
            $jumlah_device = $this->input->post('jumlah_device');
            $kode_enkripsi = $this->input->post('kode_enkripsi');
            $masa_berlaku = $this->input->post('masa_berlaku');
            $kode_panggil = $this->input->post('kode_panggil');
            $tgl_kadaluarsa = $this->input->post('tgl_kadaluarsa');

            // Lakukan proses penghasilan password WiFi
            $passwords = $this->_getgeneratePasswords($jumlah_user, $jumlah_device, $kode_enkripsi, $masa_berlaku, $kode_panggil, $tgl_kadaluarsa);

            // Simpan data password WiFi ke tabel 'tamu'
            $this->db->insert_batch('tamu', $passwords);

            // Simpan data password WiFi ke tabel 'generates'
            $generates = array();
            foreach ($passwords as $password) {
                $generates[] = array(
                    'jumlah_user' => $jumlah_user,
                    'jumlah_device' => $jumlah_device,
                    'kode_enkripsi' => $kode_enkripsi,
                    'masa_berlaku' => $masa_berlaku,
                    'kode_panggil' => $kode_panggil,
                    'tgl_kadaluarsa' => $tgl_kadaluarsa
                );
            }
            $this->db->insert_batch('generates', $generates);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Data berhasil ditambahkan!</div>');
            redirect('administrator/hotspotGenerator');
        } else {
            $data['title'] = 'Generator';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['role'] = $this->db->get('user_role')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('administrator/generator', $data);
            $this->load->view('templates/footer');
        }
    }

    private function _getgeneratePasswords($jumlah_user, $kode_enkripsi, $masa_berlaku, $kode_panggil, $tgl_kadaluarsa)
    {
        // Lakukan logika penghasilan password WiFi di sini
        $passwords = array();
        for ($i = 1; $i <= $jumlah_user; $i++) {
            $id_tamu = $kode_panggil . $i;
            $password = $this->_getencryptPassword($id_tamu, $kode_enkripsi);
            $tgl_mulai = date('Y-m-d');
            $tgl_akhir = date('Y-m-d', strtotime("+$masa_berlaku days", strtotime($tgl_mulai)));

            // Jika tgl_kadaluarsa diinputkan, gunakan nilainya
            if (!empty($tgl_kadaluarsa)) {
                $tgl_akhir = $tgl_kadaluarsa;
            }

            // Simpan data password WiFi ke tabel 'tamu'
            $passwords[] = array(
                'id_tamu' => $kode_panggil,
                'kode_panggil' => $kode_panggil,
                'password' => $password,
                'tgl_mulai' => $tgl_mulai,
                'tgl_akhir' => $tgl_akhir
            );
        }

        return $passwords;
    }

    private function _getencryptPassword($id_tamu, $kode_enkripsi)
    {
        // Lakukan enkripsi password di sini
        $password = substr(md5($id_tamu . $kode_enkripsi), 0, 8);

        return $password;
    }

    public function hotspotUserID()
    {
        $id_tamu = $this->input->post('id_tamu');
        $kode_enkripsi = $this->input->post('kode_enkripsi');

        $query = "SELECT t.id_tamu, g.kode_enkripsi, g.tgl_kadaluarsa
              FROM tamu t
              JOIN generates g ON t.id_tamu = g.id_tamu
              WHERE t.id_tamu = ? AND g.kode_enkripsi = ?";
        $getData = $this->db->query($query, array($id_tamu, $kode_enkripsi));

        // Debug: Cetak nilai variabel $id_tamu dan $kode_enkripsi
        echo "id_tamu: " . $id_tamu . "<br>";
        echo "kode_enkripsi: " . $kode_enkripsi . "<br>";

        if (!$getData) {
            // Debug: Cetak pesan kesalahan database
            echo $this->db->error();
            die;
        }

        $getData = $getData->row_array();
        var_dump($getData);
        die;

        if ($getData) {
            // ...
        } else {
            // ...
        }
    }

    // public function hotspotUserID()
    // {
    //     $id_tamu = $this->input->post('id_tamu');
    //     $kode_enkripsi = $this->input->post('kode_enkripsi');

    //     $query = "SELECT t.id_tamu, g.kode_enkripsi, g.tgl_kadaluarsa
    //     FROM tamu t
    //     JOIN generates g ON t.id_tamu = g.id_tamu
    //     WHERE t.id_tamu = ? AND g.kode_enkripsi = ?";
    //     $data = array($id_tamu, $kode_enkripsi);
    //     $getData = $this->db->query($query, $data);

    //     if (!$getData) {
    //         // Cetak kesalahan database
    //         echo $this->db->error();
    //         die;
    //     }

    //     $getData = $getData->row_array();
    //     var_dump($getData);
    //     die;

    //     if ($getData) {
    //         $data['title'] = 'Hotspot User ID';
    //         $data['view_data'] = $getData;
    //         $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //         $data['role'] = $this->db->get('user_role')->result_array();

    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('administrator/hotspot_user_id', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf! Data tidak ditemukan!</div>');
    //         redirect('administrator/dataPengguna');
    //     }
    // }

    public function hotspotUserPanggil()
    {
        $kodeEnkripsi = $this->input->post('kode_enkripsi');
        $kodePanggil = $this->input->post('kode_panggil');

        $this->db->select('id_tamu, hari, tgl_mulai, tgl_akhir');
        $this->db->select("CONVERT(AES_DECRYPT(FROM_BASE64(password), '$kodeEnkripsi'), CHAR) AS passwordasli", false);
        $this->db->select("IF(ISNULL(tgl_akhir), '.', CONCAT(' dan terakhir pada ', tgl_akhir)) AS exp", false);
        $this->db->from('tamu');
        $this->db->where('kode_panggil', $kodePanggil);
        $hotspotUserData = $this->db->get()->result();

        // Load view
        $data = array(
            'hotspotUserData' => $hotspotUserData,
            'kodeEnkripsi' => $kodeEnkripsi,
            'kodePanggil' => $kodePanggil
        );
        $data['title'] = 'Data Pengguna';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('administrator/datakodepanggil', $data);
        $this->load->view('templates/footer');
    }

    // public function hotspotUserPanggil()
    // {
    //     // Ambil data inputan dari form
    //     $kode_panggil = $this->input->post('kode_panggil');
    //     $kode_enkripsi = $this->input->post('kode_enkripsi');

    //     // Ambil data dari tabel tamu berdasarkan Kode Panggil dan Kode Enkripsi
    //     $data = $this->_gethotspotUserPanggil($kode_panggil, $kode_enkripsi);

    //     // Tampilkan data username, password, dan tenggang waktu berlaku
    //     foreach ($data as $row) {
    //         echo "Username: " . $row['id_tamu'] . "<br>";
    //         echo "Password: " . $row['password'] . "<br>";
    //         echo "Berlaku hingga: " . $row['tgl_akhir'] . "<br><br>";
    //     }
    // }

    // private function _gethotspotUserPanggil($kode_panggil, $kode_enkripsi)
    // {
    //     // Lakukan query untuk mendapatkan data dari tabel tamu berdasarkan Kode Panggil dan Kode Enkripsi
    //     $this->db->where('kodepanggil', $kode_panggil);
    //     $this->db->where('password', $kode_enkripsi);
    //     $query = $this->db->get('tamu');

    //     return $query->result_array();
    // }

    public function hotspotUserTgl()
    {
        // Ambil data inputan dari form
        $tgl_generate = $this->input->post('tgl_generate');
        $kode_enkripsi = $this->input->post('kode_enkripsi');

        // Ambil data dari tabel tamu berdasarkan Tanggal Generate dan Kode Enkripsi
        $data = $this->_gethotspotUserTgl($tgl_generate, $kode_enkripsi);

        // Tampilkan data username, password, dan tenggang waktu berlaku
        foreach ($data as $row) {
            echo "Username: " . $row['id_tamu'] . "<br>";
            echo "Password: " . $row['password'] . "<br>";
            echo "Berlaku hingga: " . $row['tgl_akhir'] . "<br><br>";
        }
    }

    private function _gethotspotUserTgl($tgl_generate, $kode_enkripsi)
    {
        // Lakukan query untuk mendapatkan data dari tabel tamu berdasarkan Tanggal Generate dan Kode Enkripsi
        $this->db->where('tgl_generate', $tgl_generate);
        $this->db->where('password', $kode_enkripsi);
        $query = $this->db->get('tamu');

        return $query->result_array();
    }

    public function printKodePanggil()
    {
        $data['title'] = 'Print Kode Panggil';
        $data['hotspotUserData'] = $this->db->get('tamu')->result_array();

        // Load view kebidanan yang akan dicetak
        $this->load->view('administrator/print_kode_panggil', $data);
    }
}
