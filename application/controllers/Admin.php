<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Protect admin routes
        if (!$this->session->userdata('admin_logged_in')) {
            $this->session->set_flashdata('error', 'Silakan login sebagai Administrator terlebih dahulu.');
            redirect('admin/login');
        }
        $this->load->model('Admin_model');
        $this->load->model('Pasien_model');
        $this->load->model('Dokter_model');
        $this->load->model('Pendaftaran_model');
        $this->load->library('form_validation');
    }

    /**
     * Admin Dashboard: Summary Cards
     */
    public function dashboard() {
        $data['title'] = 'Dashboard Admin - Boraheal MC';
        $data['stats'] = $this->Pendaftaran_model->get_stats();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar');
        $this->load->view('dashboard/admin_dashboard', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Patient CRUD: List all patients
     */
    public function pasien() {
        $data['title'] = 'Data Pasien - Boraheal MC';
        $data['pasien'] = $this->Pasien_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar');
        $this->load->view('pendaftaran/pasien_list', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Patient CRUD: Create Patient
     */
    public function pasien_create() {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_telepon', 'Nomor Telepon', 'required|numeric|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[pasien.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Pasien - Boraheal MC';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/navbar');
            $this->load->view('pendaftaran/pasien_create');
            $this->load->view('templates/footer');
        } else {
            $pasien_data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'alamat' => $this->input->post('alamat', TRUE),
                'no_telepon' => $this->input->post('no_telepon', TRUE),
                'username' => $this->input->post('username', TRUE),
                'password' => $this->input->post('password')
            );

            $this->Pasien_model->create($pasien_data);
            $this->session->set_flashdata('success', 'Akun pasien berhasil ditambahkan!');
            redirect('admin/pasien');
        }
    }

    /**
     * Patient CRUD: Update Patient
     */
    public function pasien_edit($id) {
        $pasien = $this->Pasien_model->get_by_id($id);
        if (!$pasien) {
            $this->session->set_flashdata('error', 'Data pasien tidak ditemukan.');
            redirect('admin/pasien');
        }

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_telepon', 'Nomor Telepon', 'required|numeric|trim');
        
        if ($this->input->post('username') != $pasien->username) {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[pasien.username]');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required|trim');
        }

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Pasien - Boraheal MC';
            $data['pasien'] = $pasien;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/navbar');
            $this->load->view('pendaftaran/pasien_edit', $data);
            $this->load->view('templates/footer');
        } else {
            $update_data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'alamat' => $this->input->post('alamat', TRUE),
                'no_telepon' => $this->input->post('no_telepon', TRUE),
                'username' => $this->input->post('username', TRUE)
            );

            if ($this->input->post('password') != '') {
                $update_data['password'] = $this->input->post('password');
            }

            $this->Pasien_model->update($id, $update_data);
            $this->session->set_flashdata('success', 'Data pasien berhasil diperbarui!');
            redirect('admin/pasien');
        }
    }

    /**
     * Patient CRUD: Delete Patient
     */
    public function pasien_delete($id) {
        $pasien = $this->Pasien_model->get_by_id($id);
        if ($pasien) {
            $this->Pasien_model->delete($id);
            $this->session->set_flashdata('success', 'Data pasien berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Data pasien tidak ditemukan.');
        }
        redirect('admin/pasien');
    }

    /**
     * View all pendaftaran schedules
     */
    public function jadwal() {
        $data['title'] = 'Jadwal Pendaftaran - Boraheal MC';
        $data['schedules'] = $this->Pendaftaran_model->get_all_schedules();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar');
        $this->load->view('pendaftaran/jadwal_list', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Setujui Pendaftaran
     */
    public function setujui_pendaftaran($id) {
        $reg = $this->Pendaftaran_model->get_by_id($id);
        if ($reg) {
            $this->Pendaftaran_model->update_status($id, 'Disetujui');
            $this->session->set_flashdata('success', 'Permintaan pendaftaran telah disetujui.');
        } else {
            $this->session->set_flashdata('error', 'Data pendaftaran tidak ditemukan.');
        }
        redirect('admin/jadwal');
    }

    /**
     * Tolak Pendaftaran
     */
    public function tolak_pendaftaran($id) {
        $reg = $this->Pendaftaran_model->get_by_id($id);
        if ($reg) {
            $this->Pendaftaran_model->update_status($id, 'Ditolak');
            $this->session->set_flashdata('success', 'Permintaan pendaftaran telah ditolak.');
        } else {
            $this->session->set_flashdata('error', 'Data pendaftaran tidak ditemukan.');
        }
        redirect('admin/jadwal');
    }
}