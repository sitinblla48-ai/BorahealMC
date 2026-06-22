<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class anggota extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('anggota_model');
         if (!$this->session->userdata('login')){
                redirect('login');
            }
    }

    public function index()
    {
        $data['anggota'] = $this->anggota_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('anggota/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('anggota/tambah');
        $this->load->view('templates/footer');
    }

    // =====================
    // SIMPAN
    // =====================
    public function simpan()
    {
        $data = [
            'no_anggota'   => $this->input->post('no_anggota'),
            'nama_anggota' => $this->input->post('nama_anggota'),
            'alamat'       => $this->input->post('alamat'),
            'telepon'      => $this->input->post('telepon'),
            'email'        => $this->input->post('email'),
            'tanggal'      => $this->input->post('tanggal'),
            'status'       => $this->input->post('status')
        ];

        $this->anggota_model->insert($data);
        redirect('anggota');
    }

    // =====================
    // HAPUS (PAKAI ID)
    // =====================
    public function hapus($id)
    {
        $this->anggota_model->delete($id);
        $this->session->set_flashdata('success', "Data Berhasil Dihapus");
        redirect('anggota');
    }

    // =====================
    // EDIT (PAKAI ID)
    // =====================
    public function edit($id)
    {
        $data['anggota'] = $this->anggota_model->get_by_id($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('anggota/edit', $data);
        $this->load->view('templates/footer');
    }

    // =====================
    // UPDATE (PAKAI ID)
    // =====================
    public function update($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_anggota', 'Nama anggota', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('anggota/edit/'.$id);
        } else {
            $data = [
                'no_anggota'   => $this->input->post('no_anggota'),
                'nama_anggota' => $this->input->post('nama_anggota'),
                'alamat'       => $this->input->post('alamat'),
                'telepon'      => $this->input->post('telepon'),
                'email'        => $this->input->post('email'),
                'tanggal'      => $this->input->post('tanggal'),
                'status'       => $this->input->post('status')
            ];

            $this->anggota_model->update($id, $data);

            $this->session->set_flashdata('success', "Data Berhasil Diupdate");
            redirect('anggota');
        }
    }
}