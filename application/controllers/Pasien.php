<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Protect patient routes
        if (!$this->session->userdata('pasien_logged_in')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu untuk mengakses portal pasien.');
            redirect('pasien/login');
        }
        $this->load->model('Pasien_model');
        $this->load->model('Pendaftaran_model');
        $this->load->model('Dokter_model');
        $this->load->library('form_validation');
    }

    /**
     * Dashboard Pasien: Profil & Riwayat Pendaftaran
     */
    public function dashboard() {
        $pasien_id = $this->session->userdata('pasien_id');
        $data['title'] = 'Portal Pasien - Boraheal MC';
        $data['pasien'] = $this->Pasien_model->get_by_id($pasien_id);
        $data['registrations'] = $this->Pendaftaran_model->get_by_pasien_id($pasien_id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar');
        $this->load->view('pasien/pasien_dashboard', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Pendaftaran Online Form
     */
    public function daftar() {
        $pasien_id = $this->session->userdata('pasien_id');

        // Validation Rules
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_telepon', 'Nomor Telepon', 'required|numeric|trim');
        $this->form_validation->set_rules('keluhan', 'Keluhan Penyakit', 'required|trim');
        $this->form_validation->set_rules('tanggal_kunjungan', 'Tanggal Kunjungan', 'required|callback_check_future_date');
        $this->form_validation->set_rules('jam_kunjungan', 'Jam Kunjungan', 'required');
        $this->form_validation->set_rules('id_dokter', 'Spesialis / Dokter', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Pendaftaran Online - Boraheal MC';
            $data['pasien'] = $this->Pasien_model->get_by_id($pasien_id);
            $data['doctors'] = $this->Dokter_model->get_all();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/navbar');
            $this->load->view('pasien/pasien_daftar', $data);
            $this->load->view('templates/footer');
        } else {
            $insert_data = array(
                'id_pasien' => $pasien_id,
                'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'alamat' => $this->input->post('alamat', TRUE),
                'no_telepon' => $this->input->post('no_telepon', TRUE),
                'keluhan' => $this->input->post('keluhan', TRUE),
                'tanggal_kunjungan' => $this->input->post('tanggal_kunjungan'),
                'jam_kunjungan' => $this->input->post('jam_kunjungan'),
                'id_dokter' => $this->input->post('id_dokter', TRUE),
                'status_pendaftaran' => 'Pending'
            );

            $reg_id = $this->Pendaftaran_model->create($insert_data);
            if ($reg_id) {
                $this->session->set_flashdata('success', 'Pendaftaran online berhasil dikirim!');
                redirect('pasien/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengirim pendaftaran. Silakan coba lagi.');
                redirect('pasien/daftar');
            }
        }
    }

    /**
     * Callback rule: Visit Date cannot be earlier than today
     */
    public function check_future_date($date) {
        $today = date('Y-m-d');
        if ($date < $today) {
            $this->form_validation->set_message('check_future_date', 'Kolom {field} tidak boleh sebelum tanggal hari ini.');
            return FALSE;
        }
        return TRUE;
    }
}
