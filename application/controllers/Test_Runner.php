<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_Runner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Pasien_model');
        $this->load->model('Pendaftaran_model');
        $this->load->model('Dokter_model');
    }

    public function index() {
        echo "=== Boraheal MC Automated Test Suite (Indonesian Revision) ===\n";

        // 1. Test Database Connectivity
        $db_connected = $this->db->initialize();
        if ($this->db->conn_id) {
            echo "[PASS] Koneksi Database Berhasil.\n";
        } else {
            echo "[FAIL] Koneksi Database Gagal!\n";
            return;
        }

        // 2. Test Dokter count (10 specialties)
        $docs = $this->Dokter_model->get_all();
        $docs_count = count($docs);
        if ($docs_count == 10) {
            echo "[PASS] Tabel Dokter memiliki tepat 10 dokter spesialis.\n";
        } else {
            echo "[FAIL] Jumlah dokter adalah $docs_count (Seharusnya 10).\n";
        }

        // 3. Test Admin credentials
        $admin = $this->Admin_model->get_by_username('admin_bora');
        if ($admin) {
            echo "[PASS] Akun Administrator 'admin_bora' ditemukan.\n";
            if (password_verify('admin123', $admin->password)) {
                echo "[PASS] Autentikasi Admin 'admin_bora' dengan password 'admin123' Berhasil.\n";
            } else {
                echo "[FAIL] Autentikasi Admin gagal!\n";
            }
        } else {
            echo "[FAIL] Akun Admin 'admin_bora' tidak ditemukan!\n";
        }

        // 4. Test Pasien credentials
        $pasien = $this->Pasien_model->get_by_username('pasien_budi');
        if ($pasien) {
            echo "[PASS] Akun Pasien 'pasien_budi' ditemukan.\n";
            if (password_verify('budi123', $pasien->password)) {
                echo "[PASS] Autentikasi Pasien 'pasien_budi' dengan password 'budi123' Berhasil.\n";
            } else {
                echo "[FAIL] Autentikasi Pasien gagal!\n";
            }
        } else {
            echo "[FAIL] Akun Pasien 'pasien_budi' tidak ditemukan!\n";
        }

        // 5. Test Manual FPDF Loading
        $fpdf_file = APPPATH . 'third_party/fpdf/fpdf.php';
        if (file_exists($fpdf_file)) {
            echo "[PASS] File library FPDF ditemukan di folder third_party.\n";
            require_once $fpdf_file;
            $pdf = new FPDF();
            if (is_object($pdf)) {
                echo "[PASS] Instansiasi objek FPDF Berhasil.\n";
            } else {
                echo "[FAIL] Instansiasi FPDF gagal!\n";
            }
        } else {
            echo "[FAIL] File library FPDF tidak ditemukan!\n";
        }

        // 6. Test Pendaftaran CRUD Workflow
        echo "\nMenguji Alur Pendaftaran...\n";
        $test_reg_data = array(
            'id_pasien' => 1,
            'nama_lengkap' => 'Budi Santoso',
            'tanggal_lahir' => '2000-05-15',
            'alamat' => 'Jl. Sudirman No. 10',
            'no_telepon' => '081234567890',
            'keluhan' => 'Sakit kepala dan demam',
            'tanggal_kunjungan' => date('Y-m-d'),
            'jam_kunjungan' => '10:00:00',
            'id_dokter' => 1,
            'status_pendaftaran' => 'Pending'
        );

        $reg_id = $this->Pendaftaran_model->create($test_reg_data);
        if ($reg_id) {
            echo "[PASS] Pendaftaran berhasil dibuat dengan ID: $reg_id\n";
            
            // Read
            $reg_details = $this->Pendaftaran_model->get_by_id($reg_id);
            if ($reg_details && $reg_details->keluhan == 'Sakit kepala dan demam') {
                echo "[PASS] Data detail pendaftaran berhasil dibaca.\n";
            } else {
                echo "[FAIL] Gagal membaca data detail pendaftaran.\n";
            }

            // Update Status (Approve / Disetujui)
            $this->Pendaftaran_model->update_status($reg_id, 'Disetujui');
            $reg_details_updated = $this->Pendaftaran_model->get_by_id($reg_id);
            if ($reg_details_updated && $reg_details_updated->status_pendaftaran == 'Disetujui') {
                echo "[PASS] Status pendaftaran berhasil diperbarui menjadi: Disetujui.\n";
            } else {
                echo "[FAIL] Gagal memperbarui status pendaftaran.\n";
            }

            // Delete / Cleanup
            $this->db->where('id_pendaftaran', $reg_id);
            $this->db->delete('pendaftaran');
            $deleted = $this->Pendaftaran_model->get_by_id($reg_id);
            if (!$deleted) {
                echo "[PASS] Data pendaftaran uji berhasil dibersihkan dari database.\n";
            } else {
                echo "[FAIL] Gagal membersihkan data pendaftaran uji.\n";
            }
        } else {
            echo "[FAIL] Gagal membuat pendaftaran uji!\n";
        }

        echo "\n=== Seluruh Pengujian CodeIgniter & PHP 7.3 Berhasil Selesai ===\n";
    }
}
