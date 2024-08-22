<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
    }

    public function tambahAkun()
    {
        $this->form_validation->set_rules(
            'nama',
            'Name',
            'required|trim',
            [
                'required' => 'Nama diperlukan!',
            ]
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[pengguna.email]',
            [
                'is_unique' => 'Email ini sudah terdaftar!',
                'valid_email' => 'Email tidak valid!',
                'required' => 'Email diperlukan!',
            ]
        );
        $this->form_validation->set_rules(
            'kata_sandi1',
            'Password',
            'required|trim|min_length[8]|matches[kata_sandi2]',
            [
                'matches' => 'Kata sandi tidak cocok!',
                'min_length' => 'Kata sandi terlalu pendek!',
                'required' => 'Kata sandi diperlukan!',
            ]
        );
        $this->form_validation->set_rules(
            'kata_sandi2',
            'Password',
            'required|trim|matches[kata_sandi1]',
            [
                'matches' => 'Kata sandi tidak cocok!',
                'required' => 'Ulangi kata sandi wajib diisi!',
            ]
        );

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Akun';
            $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
            $data['role'] = $this->db->get('peran_pengguna')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/tambahAkun', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'gambar' => 'default.jpg',
                'kata_sandi' => password_hash($this->input->post('kata_sandi1'), PASSWORD_DEFAULT),
                'id_peran' => 2,
                'apakah_aktif' => 1,
                'tgl_dibuat' => time()
            ];

            if ($this->db->insert('pengguna', $data)) {
                // Redirect ke halaman kelola akun setelah berhasil
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun telah ditambahkan, harap beri tahu pengguna!</div>');
                redirect('pengaturan/kelolaAkun');
            } else {
                // Penanganan Error Database
                $error = $this->db->error();
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan akun. Error: ' . $error['message'] . '</div>');
                redirect('pengaturan/tambahAkun');
            }
        }
    }

    public function kelolaAkun()
    {
        $data['title'] = 'Kelola Peran Akun';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('peran_pengguna')->result_array();

        // Tambahkan validasi untuk input 'peran' (nama peran baru)
        $this->form_validation->set_rules(
            'peran',
            'Peran',
            'required|trim',
            [
                'required' => 'Nama peran diperlukan!'
            ]
        );

        if ($this->form_validation->run() == false) {
            // Jika validasi gagal atau tidak ada data POST, tampilkan view seperti biasa
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/kelolaAkun', $data);
            $this->load->view('templates/footer');
        } else {
            // Jika validasi berhasil dan ada data POST, simpan peran baru ke database
            $data = [
                'peran' => $this->input->post('peran')
            ];
            $this->db->insert('peran_pengguna', $data);

            // Set flashdata dan redirect
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Peran baru berhasil ditambahkan!</div>');
            redirect('pengaturan/kelolaAkun'); // Atau redirect ke halaman yang sama
        }
    }

    public function aksesAkun($role_id)
    {
        $data['title'] = 'Kelola Peran Akun';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('peran_pengguna')->result_array();
        $data['satuRole'] = $this->db->get_where('peran_pengguna', ['id' => $role_id])->row_array();

        //Tampilkan semua menu kecuali menu pengaturan
        $this->db->where('id !=', 5);
        $data['menu'] = $this->db->get('menu_pengguna')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pengaturan/aksesAkun', $data);
        $this->load->view('templates/footer');
    }

    public function ubahAkses()
    {
        $menuId = $this->input->post('menuId');
        $roleId = $this->input->post('roleId');

        $data = [
            'id_peran' => $roleId,
            'id_menu' => $menuId
        ];

        $result = $this->db->get_where('menu_akses_pengguna', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('menu_akses_pengguna', $data);
        } else {
            $this->db->delete('menu_akses_pengguna', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses telah diubah!</div>');
    }

    public function ubahPeran($role_id)
    {
        // Ambil data peran berdasarkan ID
        $data['role'] = $this->db->get_where('peran_pengguna', ['id' => $role_id])->row_array();

        // Validasi form
        $this->form_validation->set_rules('peran', 'Peran', 'required', [
            'required' => 'Nama peran diperlukan!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form ubah peran dengan data yang sudah ada
            $data['title'] = 'Kelola Peran Akun';
            $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/kelolaAkun', $data); // View untuk form ubah peran
            $this->load->view('templates/footer');
        } else {
            // Jika validasi berhasil, update data menu di database
            $this->db->where('id', $role_id);
            $this->db->update('peran_pengguna', ['peran' => $this->input->post('peran')]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Peran berhasil diubah!</div>');
            redirect('pengaturan/kelolaAkun');
        }
    }

    public function hapusPeran($role_id)
    {
        // Hapus peran dari database berdasarkan ID
        $this->db->where('id', $role_id);
        $this->db->delete('peran_pengguna');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Nama peran berhasil dihapus!</div>');
        redirect('pengaturan/kelolaAkun');
    }



    // Fungsi untuk mengelola menu

    public function kelolaMenu()
    {
        $data['title'] = 'Kelola Menu';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('peran_pengguna')->result_array();
        $data['menu'] = $this->db->get('menu_pengguna')->result_array();

        $this->form_validation->set_rules(
            'menu',
            'Menu',
            'required',
            [
                'required' => 'Nama menu diperlukan!'
            ]
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/kelolaMenu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('menu_pengguna', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu baru berhasil ditambahkan!</div>');
            redirect('pengaturan/kelolaMenu');
        }
    }

    public function ubahMenu($id)
    {
        // Ambil data menu berdasarkan ID
        $data['menu'] = $this->db->get_where('menu_pengguna', ['id' => $id])->row_array();

        // Validasi form
        $this->form_validation->set_rules('menu', 'Menu', 'required', [
            'required' => 'Nama menu diperlukan!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form ubah menu dengan data yang sudah ada
            $data['title'] = 'Kelola Menu';
            $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/kelolaMenu', $data); // View untuk form ubah menu
            $this->load->view('templates/footer');
        } else {
            // Jika validasi berhasil, update data menu di database
            $this->db->where('id', $id);
            $this->db->update('menu_pengguna', ['menu' => $this->input->post('menu')]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu berhasil diubah!</div>');
            redirect('pengaturan/kelolaMenu');
        }
    }

    public function hapusMenu($id)
    {
        // Hapus menu dari database berdasarkan ID
        $this->db->where('id', $id);
        $this->db->delete('menu_pengguna');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu berhasil dihapus!</div>');
        redirect('pengaturan/kelolaMenu');
    }


    // Fungsi untuk mengelola submenu

    public function kelolaSubmenu()
    {
        $data['title'] = 'Kelola Submenu';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('peran_pengguna')->result_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        usort($data['subMenu'], function ($a, $b) {
            return strcmp($a['menu'], $b['menu']);
        });
        $data['menu'] = $this->db->get('menu_pengguna')->result_array();

        $this->form_validation->set_rules(
            'judul',
            'Judul',
            'required',
            [
                'required' => 'Judul submenu diperlukan!'
            ]
        );
        $this->form_validation->set_rules(
            'id_menu',
            'Menu',
            'required',
            [
                'required' => 'Menu diperlukan!'
            ]
        );
        $this->form_validation->set_rules(
            'url',
            'URL',
            'required',
            [
                'required' => 'URL diperlukan!'
            ]
        );
        $this->form_validation->set_rules(
            'ikon',
            'Ikon',
            'required',
            [
                'required' => 'Ikon diperlukan!'
            ]
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/kelolaSubmenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'judul'     => $this->input->post('judul'),
                'id_menu'   => $this->input->post('id_menu'),
                'url'       => $this->input->post('url'),
                'ikon'      => $this->input->post('ikon'),
                'apakah_aktif' => $this->input->post('apakah_aktif')
            ];
            $this->db->insert('submenu_pengguna', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu baru berhasil ditambahkan!</div>');
            redirect('pengaturan/kelolaSubmenu');
        }
    }
}
