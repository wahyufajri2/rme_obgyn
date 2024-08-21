<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email diperlukan!',
            'valid_email' => 'Email tidak valid!'
        ]);
        $this->form_validation->set_rules(
            'kata_sandi',
            'Password',
            'required|trim',
            [
                'required' => 'Kata sandi diperlukan!'
            ]
        );
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman masuk';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('kata_sandi');

        $user = $this->db->get_where('pengguna', ['email' => $email])->row_array();

        //periksa jika ada pengguna
        if ($user) {
            //periksa jika pengguna aktif
            if ($user['apakah_aktif'] == 1) {
                //periksa kata sandi
                if (password_verify($password, $user['kata_sandi'])) {
                    $data = [
                        'email' => $user['email'],
                        'id_peran' => $user['id_peran']
                    ];

                    //mengatur sesi
                    $this->session->set_userdata($data);
                    //periksa peran pengguna
                    if ($user['id_peran'] == 1) {
                        if ($this->input->post('save_id')) {
                            setcookie('email', $email, time() + 60 * 60 * 24 * 30);
                            setcookie('kata_sandi', $password, time() + 60 * 60 * 24 * 30);
                        } else {
                            setcookie('email', '');
                            setcookie('kata_sandi', '');
                        }
                        redirect('dashboard');
                    } elseif ($user['id_peran'] == 2) {
                        if ($this->input->post('save_id')) {
                            setcookie('email', $email, time() + 60 * 60 * 24 * 30);
                            setcookie('kata_sandi', $password, time() + 60 * 60 * 24 * 30);
                        } else {
                            setcookie('email', '');
                            setcookie('kata_sandi', '');
                        }
                        redirect('dashboard');
                    } elseif ($user['id_peran'] == 3) {
                        if ($this->input->post('save_id')) {
                            setcookie('email', $email, time() + 60 * 60 * 24 * 30);
                            setcookie('kata_sandi', $password, time() + 60 * 60 * 24 * 30);
                        } else {
                            setcookie('email', '');
                            setcookie('kata_sandi', '');
                        }
                        redirect('bidan');
                    } else {
                        if ($this->input->post('save_id')) {
                            setcookie('email', $email, time() + 60 * 60 * 24 * 30);
                            setcookie('kata_sandi', $password, time() + 60 * 60 * 24 * 30);
                        } else {
                            setcookie('email', '');
                            setcookie('kata_sandi', '');
                        }
                        redirect('bidan/kebidanan');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata sandi salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email ini belum diaktifkan!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('nama', 'Name', 'required|trim');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'is_unique' => 'Email ini sudah terdaftar!'
            ]
        );
        $this->form_validation->set_rules('kata_sandi1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => 'Kata sandi tidak cocok!',
            'min_length' => 'Kata sandi terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'matches' => 'Kata sandi tidak cocok!',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Registrasi Pengguna';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'gambar' => 'default.jpg',
                'kata_sandi' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'id_peran' => 2,
                'apakah_aktif' => 1,
                'tgl_dibuat' => time()
            ];

            $this->db->insert('pengguna', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Akun Anda telah dibuat. Silakan Login</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id_peran');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah keluar!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $data['title'] = 'Halaman terblokir';

        $this->load->view('templates/header', $data);
        $this->load->view('auth/blocked');
        $this->load->view('templates/footer');
    }
}
