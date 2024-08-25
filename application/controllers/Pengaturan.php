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

    // Awal dari fungsi-fungsi di menu tambah akun
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
            'id_peran',
            'Role',
            'required',
            [
                'required' => 'Peran harus dipilih!'
            ]
        );
        $this->form_validation->set_rules(
            'kata_sandi1',
            'Kata Sandi',
            'required|trim|min_length[12]|callback_password_check', // Callback function di urutan terakhir
            [
                'required' => 'Kata sandi diperlukan!',
                'min_length' => 'Kata sandi terlalu pendek!, min-12 karakter',
            ]
        );
        $this->form_validation->set_rules(
            'kata_sandi2',
            'Ulangi Kata Sandi',
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
                'id_peran' => htmlspecialchars($this->input->post('id_peran')),
                'apakah_aktif' => 1,
                'tgl_dibuat' => time()
            ];

            if ($this->db->insert('pengguna', $data)) {
                // Redirect ke halaman kelola akun setelah berhasil
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun telah ditambahkan, harap beri tahu pengguna!</div>');
                redirect('pengaturan/tambahAkun');
            } else {
                // Penanganan Error Database
                $error = $this->db->error();
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan akun. Error: ' . $error['message'] . '</div>');
                redirect('pengaturan/tambahAkun');
            }
        }
    }

    public function password_check($password)
    {
        $password = trim($password); // Hilangkan spasi di awal dan akhir kata
        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&\#\^\(\)~\-])[\w@$!%*?&\#\^\(\)~\-]{12,}$/i'; // Memastikan setidaknya ada huruf kecil, huruf besar, angka, simbol, dan panjang minimal 12 karakter  

        if (!preg_match($regex, $password)) {
            $this->form_validation->set_message('password_check', 'Kata sandi harus mengandung huruf besar, huruf kecil, angka, dan simbol.');
            return FALSE; // Kata sandi tidak lolos validasi
        }
        return TRUE; // Kata sandi lolos validasi
    }
    // Akhir dari fungsi-fungsi di menu tambah akun


    // Awal dari fungsi-fungsi di menu kelola akun
    public function kelolaAkun()
    {
        $data['title'] = 'Kelola Akun';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('peran_pengguna')->result_array();

        $this->load->model('Akun_model', 'akun');
        $data['akun'] = $this->akun->getAkun();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pengaturan/kelolaAkun', $data);
        $this->load->view('templates/footer',);
    }

    public function ubahDataAkun($id)
    {
        // Ambil data akun berdasarkan ID
        $data['role'] = $this->db->get_where('peran_pengguna', ['id' => $id])->row_array();

        // Validasi formulir ubah data akun
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Nama akun diperlukan!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'required' => 'Email diperlukan!',
            'valid_email' => 'Email tidak valid!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form ubah peran dengan data yang sudah ada
            $data['title'] = 'Kelola Akun';
            $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->model('Akun_model', 'akun');
            $data['akun'] = $this->akun->getAkun();
            $data['role'] = $this->db->get('peran_pengguna')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/kelolaAkun', $data);
            $this->load->view('templates/footer',);
        } else {
            // Jika validasi berhasil, update data akun di database (tabel 'pengguna')
            $nama = $this->input->post('nama');
            $email =  $this->input->post('email');
            $id_peran = $this->input->post('id_peran');
            $apakah_aktif = $this->input->post('apakah_aktif');

            // Handle upload gambar jika ada
            $upload_image = $_FILES['gambar']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 1024; // KB
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $old_image = $data['user']['gambar'];
                    if ($old_image != 'default.jpg') {
                        if (!unlink(FCPATH . '/assets/img/profile/' . $old_image)) {
                            echo "Error deleting $old_image"; // Atau log error ini
                        }
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar', $new_image);
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error . '</div>');
                    redirect('pengaturan/kelolaAkun');
                }
            }

            $this->db->set('nama', $nama);
            $this->db->set('email', $email);
            $this->db->set('id_peran', $id_peran);
            $this->db->set('apakah_aktif', $apakah_aktif);
            $this->db->where('id', $id);
            $this->db->update('pengguna');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data akun berhasil diubah!</div>');
            redirect('pengaturan/kelolaAkun');
        }
    }

    public function email_check($email, $id) // Callback untuk validasi email, memastikan email unik kecuali untuk ID yang sedang diedit
    {
        $this->db->where('email', $email);
        $this->db->where('id !=', $id);
        $user = $this->db->get('pengguna')->row_array();

        if ($user) {
            $this->form_validation->set_message('email_check', 'Email ini sudah terdaftar!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    private function _kirimEmail($token, $type)
    {
        $name = $this->input->post('nama', true);
        $email = $this->input->post('email', true);
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'whybaik2@gmail.com',
            'smtp_pass' => 'vwrt meio qatm vrsn',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('whybaik2@gmail.com', 'Admin RS PKU Muhammadiyah Gamping');
        $this->email->to('whybaik2@gmail.com');
        if ($type == 'lupa') {
            $this->email->subject('Atur Ulang Kata Sandi');
            $this->email->message('<h2>Atur Ulang Kata Sandi Anda</h2>
            <p>Baru saja ada akun baru atas nama <strong>' . $name . '</strong> dengan alamat email ' . $email . '.</p>
            <p>Jika Anda ingin mengatur ulang kata sandi akun tersebut, harap klik tautan di bawah ini:</p>
            <a href="' . base_url() . 'pengaturan/resetKataSandi?email=' . $this->input->post('email') . '& token=' . urlencode($token) . '">Atur Ulang Kata Sandi</a>
            <p>Terima kasih atas tanggapan yang Anda berikan!</p>
            <p>Salam,<br>Tim Website Kami</p>');
        }

        if ($this->email->send()) {
            return TRUE;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function lupaKataSandi()
    {
        $data['title'] = 'Kelola Akun';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Akun_model', 'akun');
        $data['akun'] = $this->akun->getAkun();
        $data['role'] = $this->db->get('peran_pengguna')->result_array();

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email diperlukan!',
            'valid_email' => 'Email tidak valid!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/kelolaAkun', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('pengguna', ['email' => $email])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'tgl_dibuat' => time()
                ];

                $this->db->insert('token_pengguna', $user_token);
                $this->_kirimEmail($token, 'lupa');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Silakan cek email Anda untuk mengatur ulang kata sandi!</div>');
                redirect('pengaturan/lupaKataSandi');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
                redirect('pengaturan/kelolaAkun');
            }
        }
    }

    public function resetKataSandi()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('pengguna', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('token_pengguna', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->ubahKataSandi();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengatur ulang kata sandi! Token tidak valid.</div>');
                redirect('pengaturan/lupaKataSandi');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengatur ulang kata sandi! Email tidak valid.</div>');
            redirect('pengaturan/lupaKataSandi');
        }
    }

    public function ubahKataSandi()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth/blocked');
        }

        $this->form_validation->set_rules(
            'kata_sandi1',
            'Kata Sandi',
            'required|trim|min_length[12]|callback_password_check',
            [
                'required' => 'Kata sandi diperlukan!',
                'min_length' => 'Kata sandi terlalu pendek!, min-12 karakter',
            ]
        );
        $this->form_validation->set_rules(
            'kata_sandi2',
            'Ulangi Kata Sandi',
            'required|trim|matches[kata_sandi1]',
            [
                'matches' => 'Kata sandi tidak cocok!',
                'required' => 'Ulangi kata sandi wajib diisi!',
            ]
        );

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Kelola Akun';
            $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->model('Akun_model', 'akun');
            $data['akun'] = $this->akun->getAkun();
            $data['role'] = $this->db->get('peran_pengguna')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/ubahKataSandi', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $this->session->userdata('reset_email');
            $kata_sandi = password_hash($this->input->post('kata_sandi1'), PASSWORD_DEFAULT);

            $this->db->set('kata_sandi', $kata_sandi);
            $this->db->where('email', $email);
            $this->db->update('pengguna');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kata sandi telah diubah! Silakan beritahu pengguna.</div>');
            redirect('pengaturan/kelolaAkun');
        }
    }
    // Akhir dari fungsi-fungsi di menu kelola akun


    // Awal dari fungsi-fungsi di menu kelola peran akun
    public function kelolaPeranAkun()
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
            $this->load->view('pengaturan/kelolaPeranAkun', $data);
            $this->load->view('templates/footer');
        } else {
            // Jika validasi berhasil dan ada data POST, simpan peran baru ke database
            $data = [
                'peran' => $this->input->post('peran')
            ];
            $this->db->insert('peran_pengguna', $data);

            // Set flashdata dan redirect
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Peran baru berhasil ditambahkan!</div>');
            redirect('pengaturan/kelolaPeranAkun'); // Atau redirect ke halaman yang sama
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
            $this->load->view('pengaturan/kelolaPeranAkun', $data); // View untuk form ubah peran
            $this->load->view('templates/footer');
        } else {
            // Jika validasi berhasil, update data menu di database
            $this->db->where('id', $role_id);
            $this->db->update('peran_pengguna', ['peran' => $this->input->post('peran')]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Peran berhasil diubah!</div>');
            redirect('pengaturan/kelolaPeranAkun');
        }
    }

    public function hapusPeran($role_id)
    {
        // Hapus peran dari database berdasarkan ID
        $this->db->where('id', $role_id);
        $this->db->delete('peran_pengguna');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Nama peran berhasil dihapus!</div>');
        redirect('pengaturan/kelolaPeranAkun');
    }
    // Akhir dari fungsi-fungsi di menu kelola peran akun



    // Awal dari fungsi-fungsi di menu kelola menu
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
            $data['role'] = $this->db->get('peran_pengguna')->result_array();
            $data['menu'] = $this->db->get('menu_pengguna')->result_array();

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
    // Akhir dari fungsi-fungsi di menu kelola menu


    // Awal dari fungsi-fungsi di menu kelola submenu
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

    public function ubahSubmenu($id)
    {
        // Ambil data dari permintaan POST
        $newJudul = $this->input->post('judul');
        $newMenuId = $this->input->post('id_menu');
        $newUrl = $this->input->post('url');
        $newIkon = $this->input->post('ikon');
        $newApakahAktif = $this->input->post('apakah_aktif') ? 1 : 0;

        // Validasi form
        $this->form_validation->set_rules('judul', 'Judul', 'required', [
            'required' => 'Judul submenu diperlukan!'
        ]);
        $this->form_validation->set_rules('id_menu', 'Menu', 'required', [
            'required' => 'Menu diperlukan!'
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required', [
            'required' => 'URL diperlukan!'
        ]);
        $this->form_validation->set_rules('ikon', 'Ikon', 'required', [
            'required' => 'Ikon diperlukan!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kirim respons error (Anda bisa menggunakan AJAX di sini jika diperlukan)
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>');
            redirect('pengaturan/kelolaSubmenu');
        } else {
            // Jika validasi berhasil, update data submenu di database
            $data_to_update = [
                'judul'       => $newJudul,
                'id_menu'     => $newMenuId,
                'url'         => $newUrl,
                'ikon'        => $newIkon,
                'apakah_aktif' => $newApakahAktif
            ];

            $this->db->where('id', $id); // Pastikan Anda menggunakan $submenuId di sini, bukan $id
            $updateResult = $this->db->update('submenu_pengguna', $data_to_update);

            // Berikan respons (redirect)
            if ($updateResult) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu berhasil diubah!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengubah submenu.</div>');
            }
            redirect('pengaturan/kelolaSubmenu');
        }
    }

    public function hapusSubmenu($id)
    {
        // Hapus submenu dari database berdasarkan ID
        $this->db->where('id', $id);
        $this->db->delete('submenu_pengguna');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu berhasil dihapus!</div>');
        redirect('pengaturan/kelolaSubmenu');
    }
    // Akhir dari fungsi-fungsi di menu kelola submenu
}
