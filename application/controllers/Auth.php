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

                    // Handle cookie (jika diperlukan)
                    if ($this->input->post('save_id')) {
                        setcookie('email', $email, time() + 60 * 60 * 24 * 7);
                        setcookie('kata_sandi', $password, time() + 60 * 60 * 24 * 7);
                    } else {
                        setcookie('email', '');
                        setcookie('kata_sandi', '');
                    }
                    redirect('dashboard'); // Redirect setelah login berhasil
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
