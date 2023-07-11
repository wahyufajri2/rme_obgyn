<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Bidan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function kebidanan()
    {
        $data['title'] = 'Asesment Kebidanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Kasus_model', 'kasus');

        $data['Kebidanan'] = $this->kasus->getKebidanan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bidan/kebidanan', $data);
        $this->load->view('templates/footer');
    }

    public function entriKebidanan()
    {
    }

    public function printKebidanan()
    {
        $data['title'] = 'Print Laporan Asesmen Kebidanan';

        $this->load->model('Kasus_model', 'print');

        $data['Kebidanan'] = $this->print->getKebidanan();
        $this->load->view('templates/header', $data);
        $this->load->view('bidan/print_kebidanan', $data);
    }

    public function pdfKebidanan()
    {
        $data['title'] = 'Export Laporan Asesmen Kebidanan';

        $this->load->library('dompdf_gen');
        $this->load->model('Kasus_model', 'pdf');

        $data['Kebidanan'] = $this->pdf->getKebidanan();

        $this->load->view('bidan/pdf_kebidanan', $data);

        $paper_size = 'A4';
        $orientation = 'portrait';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('Laporan Asesmen Kebidanan.pdf', array('Attachment' => 0));
    }

    public function excelKebidanan()
    {
        $data['title'] = 'Export Laporan Asesmen Kebidanan';

        $this->load->model('Kasus_model', 'excel');

        $Kebidanan = $this->excel->getKebidanan();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Asesmen Kebidanan.xlsx"');
        header('Cache-Control: max-age=0');

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'No');
        $activeWorksheet->setCellValue('B1', 'No Rg');
        $activeWorksheet->setCellValue('C1', 'No RM');
        $activeWorksheet->setCellValue('D1', 'Nama Pasien');
        $activeWorksheet->setCellValue('E1', 'Alamat');
        $activeWorksheet->setCellValue('F1', 'Status');

        $kolom = 2;
        $nomor = 1;

        foreach ($Kebidanan as $kbd) {
            $activeWorksheet->setCellValue('A' . $kolom, $nomor++);
            $activeWorksheet->setCellValue('B' . $kolom, $kbd['no_rg']);
            $activeWorksheet->setCellValue('C' . $kolom, $kbd['no_rm']);
            $activeWorksheet->setCellValue('D' . $kolom, $kbd['nama_pasien']);
            $activeWorksheet->setCellValue('E' . $kolom, $kbd['alamat']);
            $activeWorksheet->setCellValue('F' . $kolom, $kbd['status']);
            $kolom++;
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }








    //Controller untuk kasus persalinan

    public function persalinan()
    {
        $data['title'] = 'Catatan Persalinan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Kasus_model', 'kasus');


        $data['Persalinan'] = $this->kasus->getPersalinan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bidan/persalinan', $data);
        $this->load->view('templates/footer');
    }
}
