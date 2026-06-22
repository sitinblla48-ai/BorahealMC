<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Pasien_model');
        $this->load->library('form_validation');
    }

    public function index() {
        redirect('pasien/login');
    }

    /**
     * Login Admin
     */
    public function admin_login() {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/dashboard');
        }

        // Form Validation Rules
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/admin_login');
        } else {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password');

            $admin = $this->Admin_model->authenticate($username, $password);

            if ($admin) {
                $session_data = array(
                    'admin_id' => $admin->id_admin,
                    'admin_username' => $admin->username,
                    'admin_logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                $this->session->set_flashdata('success', 'Selamat datang kembali, Admin!');
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah.');
                redirect('admin/login');
            }
        }
    }

    /**
     * Login Pasien
     */
    public function pasien_login() {
        if ($this->session->userdata('pasien_logged_in')) {
            redirect('pasien/dashboard');
        }

        // Form Validation Rules
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/pasien_login');
        } else {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password');

            $pasien = $this->Pasien_model->authenticate($username, $password);

            if ($pasien) {
                $session_data = array(
                    'pasien_id' => $pasien->id_pasien,
                    'pasien_username' => $pasien->username,
                    'pasien_name' => $pasien->nama_lengkap,
                    'pasien_logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                $this->session->set_flashdata('success', 'Berhasil login ke Portal Pasien!');
                redirect('pasien/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah.');
                redirect('pasien/login');
            }
        }
    }

    /**
     * Registrasi Pasien Baru
     */
    public function register() {
        if ($this->session->userdata('pasien_logged_in')) {
            redirect('pasien/dashboard');
        }

        // Validation Rules
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_telepon', 'Nomor Telepon', 'required|numeric|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[pasien.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'alamat' => $this->input->post('alamat', TRUE),
                'no_telepon' => $this->input->post('no_telepon', TRUE),
                'username' => $this->input->post('username', TRUE),
                'password' => $this->input->post('password')
            );

            $insert_id = $this->Pasien_model->create($data);
            if ($insert_id) {
                $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
                redirect('pasien/login');
            } else {
                $this->session->set_flashdata('error', 'Registrasi gagal. Silakan coba lagi.');
                redirect('auth/register');
            }
        }
    }

    /**
     * Logout Admin
     */
    public function admin_logout() {
        $this->session->unset_userdata(array('admin_id', 'admin_username', 'admin_logged_in'));
        $this->session->set_flashdata('success', 'Admin berhasil keluar.');
        redirect('admin/login');
    }

    /**
     * Logout Pasien
     */
    public function pasien_logout() {
        $this->session->unset_userdata(array('pasien_id', 'pasien_username', 'pasien_name', 'pasien_logged_in'));
        $this->session->set_flashdata('success', 'Anda telah keluar dari portal pasien.');
        redirect('pasien/login');
    }
}