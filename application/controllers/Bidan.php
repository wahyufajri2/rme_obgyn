<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require FCPATH . 'vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Bidan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Bidan_model', 'bidan');
    }

    public function bidanRekamMedis()
    {
        //Menyimpan data judul, data pengguna, data peran, dan data kebidanan ke variabel data
        $data['title'] = 'Data Rekam Medis';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('peran_pengguna')->result_array();
        $data['Kebidanan'] = $this->bidan->getKebidanan();
        $data['Asesmen'] = $this->db->get('asesmen_pasien')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bidan/bidanRekamMedis', $data);
        $this->load->view('templates/footer');
    }

    public function catatRekamMedis()
    {
        $this->form_validation->set_rules('no_rm', 'No RM', 'required');
        $this->form_validation->set_rules('alasan_masuk', 'Alasan Masuk', 'trim');
        $this->form_validation->set_rules('deskripsi_opname', 'Deskripsi Opname', 'trim');
        $this->form_validation->set_rules('deskripsi_alergi', 'Deskripsi Alergi', 'trim');
        $this->form_validation->set_rules('deskripsi_nyeri', 'Deskripsi Nyeri', 'trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Rekam Medis';
            $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
            $data['role'] = $this->db->get('peran_pengguna')->result_array();
            $data['Kebidanan'] = $this->bidan->getKebidanan();
            $data['Asesmen'] = $this->db->get('asesmen_pasien')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('bidan/bidanRekamMedis', $data);
            $this->load->view('templates/footer');
        } else {
            // Ambil ID dari form (misalnya untuk mengupdate record berdasarkan primary key)
            $id_asesmen = $this->input->post('id_asesmen', true);

            // Ambil data dari form untuk asesmen_pasien
            $data_asesmen = [
                'no_rm' => $this->input->post('no_rm', true),
                'id_pengguna' => $this->session->userdata('id_pengguna'),
                'alasan_masuk' => $this->input->post('alasan_masuk', true),
                'deskripsi_opname' => $this->input->post('deskripsi_opname', true),
                'deskripsi_alergi' => $this->input->post('deskripsi_alergi', true),
                'deskripsi_nyeri' => $this->input->post('deskripsi_nyeri', true),
            ];

            // Update data pada tabel asesmen_pasien berdasarkan ID
            $this->db->where('id_asesmen', $id_asesmen);
            $this->db->update('asesmen_pasien', $data_asesmen);

            // Set flashdata untuk pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diperbarui!</div>');

            // Redirect setelah data berhasil diupdate
            redirect('bidan/bidanRekamMedis');
        }
    }

    public function pdfRekamMedis()
    {
        $this->data['title'] = 'Cetak Laporan Asesmen Kebidanan';

        // panggil model yang kita buat sebelumnya yang bernama Bidan_model
        $this->data['Kebidanan'] = $this->bidan->getKebidanan();

        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');
        // judul dari pdf
        $this->data['title_pdf'] = 'Laporan Asesmen Kebidanan';
        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_asesmen_kebidanan';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $html = $this->load->view('bidan/pdf_kebidanan', $this->data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
