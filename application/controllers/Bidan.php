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
    }

    public function catatRekamMedis()
    {
        $data['title'] = 'Data Rekam Medis';
        $data['user'] = $this->db->get_where('pengguna', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('peran_pengguna')->result_array();
        // $this->load->model('Bidan_model', 'bidan');

        // $data['Kebidanan'] = $this->bidan->getKebidanan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bidan/catatRekamMedis', $data);
        $this->load->view('templates/footer');
    }

    // public function entriKebidanan()
    // {
    //     // $this->load->model('Bidan_model', 'entri');

    //     $data['detail'] = $this->entri->getKunjunganDetail();
    //     // if ($this->form_validation->run() == false) {
    //     //     $data['title'] = 'Asesment Kebidanan';
    //     //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     //     $this->load->model('Bidan_model', 'detailKunjungan');

    //     //     $data['Kebidanan'] = $this->detailKunjungan->getKunjunganDetail();

    //     //     $this->load->view('templates/header', $data);
    //     //     $this->load->view('templates/sidebar', $data);
    //     //     $this->load->view('templates/topbar', $data);
    //     //     $this->load->view('bidan/kebidanan', $data);
    //     //     $this->load->view('templates/footer');
    //     // } else {
    //     //     $this->db->insert('tb_kunjungan_dtl', [
    //     //         'id_dtl_kunjungan' => htmlspecialchars($this->input->post('id_dtl_kunjungan', true)),
    //     //         'nama_pasien' => htmlspecialchars($this->input->post('nama_pasien', true)),
    //     //         'no_rm' => htmlspecialchars($this->input->post('no_rm', true)),
    //     //         'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
    //     //         'suami' => htmlspecialchars($this->input->post('suami', true)),
    //     //         'alamat' => htmlspecialchars($this->input->post('alamat', true)),
    //     //         'keluhan_pasien' => htmlspecialchars($this->input->post('keluhan_pasien', true)),
    //     //         'tdk_pernah_opname' => htmlspecialchars($this->input->post('tdk_pernah_opname', true)),
    //     //         'pernah_opname' => htmlspecialchars($this->input->post('pernah_opname', true)),
    //     //         'rs_opname' => htmlspecialchars($this->input->post('rs_opname', true)),
    //     //         'pernah_operasi' => htmlspecialchars($this->input->post('pernah_operasi', true)),
    //     //         'tdk_pernah_operasi' => htmlspecialchars($this->input->post('tdk_pernah_operasi', true)),
    //     //         'pasca_operasi' => htmlspecialchars($this->input->post('pasca_operasi', true)),
    //     //         'bawa_obat' => htmlspecialchars($this->input->post('bawa_obat', true)),
    //     //     ]);
    //     //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
    //     //     redirect('bidan/kebidanan');
    //     // }
    //     $data = array(
    //         'id_dtl_kunjungan' => htmlspecialchars($this->input->post('id_dtl_kunjungan', true)),
    //         'nama_pasien' => htmlspecialchars($this->input->post('nama_pasien', true)),
    //         'no_rm' => htmlspecialchars($this->input->post('no_rm', true)),
    //         'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
    //         'suami' => htmlspecialchars($this->input->post('suami', true)),
    //         'alamat' => htmlspecialchars($this->input->post('alamat', true)),
    //         'keluhan_pasien' => htmlspecialchars($this->input->post('keluhan_pasien', true)),
    //         'tdk_pernah_opname' => htmlspecialchars($this->input->post('tdk_pernah_opname', true)),
    //         'pernah_opname' => htmlspecialchars($this->input->post('pernah_opname', true)),
    //         'rs_opname' => htmlspecialchars($this->input->post('rs_opname', true)),
    //         'pernah_operasi' => htmlspecialchars($this->input->post('pernah_operasi', true)),
    //         'tdk_pernah_operasi' => htmlspecialchars($this->input->post('tdk_pernah_operasi', true)),
    //         'pasca_operasi' => htmlspecialchars($this->input->post('pasca_operasi', true)),
    //         'bawa_obat' => htmlspecialchars($this->input->post('bawa_obat', true)),
    //     );
    //     $this->entri->getEntriKebidanan($data, 'tb_kunjungan_dtl');

    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');

    //     redirect('bidan/kebidanan');
    // }


    // public function printKebidanan()
    // {
    //     $data['title'] = 'Print Laporan Asesmen Kebidanan';

    //     // $this->load->model('Bidan_model', 'print');

    //     // $data['Kebidanan'] = $this->print->getKebidanan();
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('bidan/print_kebidanan', $data);
    // }

    // public function pdfKebidanan()
    // {
    //     $data['title'] = 'Export Laporan Asesmen Kebidanan';

    //     $this->load->library('dompdf_gen');
    //     // $this->load->model('Bidan_model', 'pdf');

    //     $data['Kebidanan'] = $this->pdf->getKebidanan();
    //     // $data['Detail'] = $this->pdf->getKunjunganDetail();

    //     $this->load->view('bidan/pdf_kebidanan', $data);

    //     $paper_size = 'A4';
    //     $orientation = 'portrait';
    //     $html = $this->output->get_output();

    //     $this->dompdf->set_paper($paper_size, $orientation);
    //     $this->dompdf->load_html($html);
    //     $this->dompdf->render();
    //     $this->dompdf->stream('Laporan Asesmen Kebidanan.pdf', array('Attachment' => 0));
    // }

    // public function excelKebidanan()
    // {
    //     $data['title'] = 'Export Laporan Asesmen Kebidanan';

    //     $this->load->model('Bidan_model', 'excel');

    //     $Kebidanan = $this->excel->getKebidanan();

    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="Asesmen Kebidanan.xlsx"');
    //     header('Cache-Control: max-age=0');

    //     $spreadsheet = new Spreadsheet();
    //     $activeWorksheet = $spreadsheet->getActiveSheet();
    //     $activeWorksheet->setCellValue('A1', 'No');
    //     $activeWorksheet->setCellValue('B1', 'No Rg');
    //     $activeWorksheet->setCellValue('C1', 'No RM');
    //     $activeWorksheet->setCellValue('D1', 'Nama Pasien');
    //     $activeWorksheet->setCellValue('E1', 'Alamat');
    //     $activeWorksheet->setCellValue('F1', 'Status');

    //     $kolom = 2;
    //     $nomor = 1;

    //     foreach ($Kebidanan as $kbd) {
    //         $activeWorksheet->setCellValue('A' . $kolom, $nomor++);
    //         $activeWorksheet->setCellValue('B' . $kolom, $kbd['no_rg']);
    //         $activeWorksheet->setCellValue('C' . $kolom, $kbd['no_rm']);
    //         $activeWorksheet->setCellValue('D' . $kolom, $kbd['nama_pasien']);
    //         $activeWorksheet->setCellValue('E' . $kolom, $kbd['alamat']);
    //         $activeWorksheet->setCellValue('F' . $kolom, $kbd['status']);
    //         $kolom++;
    //     }

    //     $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    //     $writer->save('php://output');
    // }
}
