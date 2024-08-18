<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('anggota/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules(
            'name',
            'Nama lengkap',
            'required|trim',
            [
                'required' => 'Nama lengkap wajib diisi!'
            ]
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('anggota/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // Cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048'; // 2MB
                $config['upload_path'] = './assets/assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // Cek gambar lama
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/assets/img/profile/' . $old_image);
                    }

                    // Jika berhasil upload gambar
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    // Jika gagal upload gambar
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            // Tampilkan pesan berhasil
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil berhasil diubah!</div>');
            redirect('anggota');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();


        $this->form_validation->set_rules(
            'current_password',
            'Kata sandi saat ini',
            'required|trim',
            [
                'required' => 'Kata sandi saat ini wajib diisi!'
            ]
        );
        $this->form_validation->set_rules(
            'new_password1',
            'Password',
            'required|trim|min_length[4]|matches[new_password2]',
            [
                'required' => 'Kata sandi wajib diisi!',
                'matches' => 'Kata sandi tidak sama!',
                'min_length' => 'Kata sandi terlalu pendek!'
            ]
        );
        $this->form_validation->set_rules(
            'new_password2',
            'Password',
            'required|trim|matches[new_password1]',
            [
                'required' => 'Ulangi kata sandi wajib diisi!',
                'matches' => 'Kata sandi tidak sama!',
            ]
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('anggota/change_password', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            // Cek kata sandi saat ini
            if (!password_verify($current_password, $data['user']['password'])) {
                // Tampilkan pesan gagal
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata sandi saat ini salah!</div>');
                redirect('anggota/changePassword');
            } else {
                // Cek kata sandi baru
                if ($current_password == $new_password) {
                    // Tampilkan pesan gagal
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata sandi baru tidak boleh sama dengan kata sandi saat ini!</div>');
                    redirect('anggota/changePassword');
                } else {
                    // Kata sandi sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    // Tampilkan pesan berhasil
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kata sandi berhasil diubah!</div>');
                    redirect('anggota/changePassword');
                }
            }
        }
    }
}
