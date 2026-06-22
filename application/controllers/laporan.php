<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Protect admin routes
        if (!$this->session->userdata('admin_logged_in')) {
            $this->session->set_flashdata('error', 'Silakan login sebagai Administrator.');
            redirect('admin/login');
        }
        $this->load->model('Pasien_model');
        $this->load->model('Pendaftaran_model');
        $this->load->model('Dokter_model');
    }

    /**
     * View Reports Summary
     */
    public function index() {
        $data['title'] = 'Laporan Sistem - Boraheal MC';
        $data['stats'] = $this->Pendaftaran_model->get_stats();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar');
        $this->load->view('laporan/laporan_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Export Reports to PDF using manual FPDF
     */
    public function ekspor_pdf() {
        require_once APPPATH . 'third_party/fpdf/fpdf.php';

        $stats = $this->Pendaftaran_model->get_stats();
        $schedules = $this->Pendaftaran_model->get_all_schedules();

        // Create PDF instance
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        
        // Logo & Title (Indonesian University Project style)
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->SetTextColor(111, 66, 193); // Soft Purple Theme Color
        $pdf->Cell(0, 10, 'Boraheal Medical Center', 0, 1, 'C');
        
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->SetTextColor(107, 114, 128); // Muted color
        $pdf->Cell(0, 5, 'Laporan Pendaftaran Pasien Rumah Sakit', 0, 1, 'C');
        $pdf->Cell(0, 5, 'Tanggal Cetak: ' . date('d M Y H:i'), 0, 1, 'C');
        
        $pdf->Ln(10); // Spacer
        
        // Summary Stats section header
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(45, 32, 74);
        $pdf->Cell(0, 8, 'RINGKASAN STATISTIK SISTEM', 0, 1, 'L');
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->Ln(4);
        
        // Stats grid (Indonesian)
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 8, 'Total Pasien Terdaftar:', 0, 0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 8, $stats['total_pasien'], 0, 1);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 8, 'Total Pendaftaran Konsultasi:', 0, 0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 8, $stats['total_pendaftaran'], 0, 1);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 8, 'Pendaftaran Disetujui:', 0, 0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(21, 128, 61); // Accent Green
        $pdf->Cell(50, 8, $stats['pendaftaran_disetujui'], 0, 1);
        $pdf->SetTextColor(45, 32, 74);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 8, 'Pendaftaran Ditolak:', 0, 0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(185, 28, 28); // Danger Red
        $pdf->Cell(50, 8, $stats['pendaftaran_ditolak'], 0, 1);
        $pdf->SetTextColor(45, 32, 74);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 8, 'Pendaftaran Menunggu:', 0, 0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(180, 83, 9); // Warning Orange/Brown
        $pdf->Cell(50, 8, $stats['pendaftaran_pending'], 0, 1);
        $pdf->SetTextColor(45, 32, 74);
        
        $pdf->Ln(10);
        
        // Schedule list section header
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'DAFTAR JADWAL PENDAFTARAN PASIEN', 0, 1, 'L');
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->Ln(4);
        
        // Table Headers (Indonesian)
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(245, 243, 255);
        $pdf->Cell(45, 8, 'Nama Pasien', 1, 0, 'C', true);
        $pdf->Cell(45, 8, 'Dokter / Spesialis', 1, 0, 'C', true);
        $pdf->Cell(30, 8, 'Tgl Kunjungan', 1, 0, 'C', true);
        $pdf->Cell(30, 8, 'Jam Kunjungan', 1, 0, 'C', true);
        $pdf->Cell(40, 8, 'Status', 1, 1, 'C', true);
        
        // Table Rows
        $pdf->SetFont('Arial', '', 9);
        if (!empty($schedules)) {
            foreach ($schedules as $sched) {
                $v_date = date('d-m-Y', strtotime($sched['tanggal_kunjungan']));
                $v_time = date('H:i', strtotime($sched['jam_kunjungan']));
                $status_label = 'Menunggu';
                if ($sched['status_pendaftaran'] == 'Disetujui') {
                    $status_label = 'Disetujui';
                } elseif ($sched['status_pendaftaran'] == 'Ditolak') {
                    $status_label = 'Ditolak';
                }
                
                $pdf->Cell(45, 8, $sched['nama_pasien'], 1, 0, 'C');
                $pdf->Cell(45, 8, $sched['nama_dokter'], 1, 0, 'C');
                $pdf->Cell(30, 8, $v_date, 1, 0, 'C');
                $pdf->Cell(30, 8, $v_time, 1, 0, 'C');
                $pdf->Cell(40, 8, $status_label, 1, 1, 'C');
            }
        } else {
            $pdf->Cell(190, 8, 'Tidak ada data pendaftaran.', 1, 1, 'C');
        }
        
        // Output PDF to browser download
        $pdf->Output('D', 'Laporan_Pendaftaran_' . date('Ymd_His') . '.pdf');
    }

    /**
     * Export Reports to CSV
     */
    public function ekspor_csv() {
        $schedules = $this->Pendaftaran_model->get_all_schedules();

        $filename = 'Laporan_Pendaftaran_' . date('Ymd_His') . '.csv';

        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv;");

        $file = fopen('php://output', 'w');

        // Header Rows (Indonesian)
        fputcsv($file, array('ID Pendaftaran', 'Nama Pasien', 'Tanggal Lahir', 'Nomor Telepon', 'Keluhan', 'Dokter/Spesialis', 'Tanggal Kunjungan', 'Jam Kunjungan', 'Status', 'Dibuat Pada'));

        foreach ($schedules as $sched) {
            $reg_id_formatted = sprintf('REG-%s-%04d', str_replace('-', '', $sched['tanggal_kunjungan']), $sched['id_pendaftaran']);
            $status_label = 'Menunggu';
            if ($sched['status_pendaftaran'] == 'Disetujui') {
                $status_label = 'Disetujui';
            } elseif ($sched['status_pendaftaran'] == 'Ditolak') {
                $status_label = 'Ditolak';
            }
            fputcsv($file, array(
                $reg_id_formatted,
                $sched['nama_pasien'],
                $sched['tanggal_lahir'],
                $sched['no_telepon'],
                $sched['keluhan'],
                $sched['nama_dokter'],
                $sched['tanggal_kunjungan'],
                $sched['jam_kunjungan'],
                $status_label,
                $sched['created_at']
            ));
        }

        fclose($file);
        exit;
    }
}
