<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class buku extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('buku_model');
        $this->load->library('form_validation');
         if (!$this->session->userdata('login')){
                redirect('login');
            }
    }

    // =====================
    // INDEX (DATA TABLES)
    // =====================
    public function index()
    {
        $data['buku'] = $this->buku_model->get_all();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('buku/index', $data);
        $this->load->view('templates/footer');
    }

    // =====================
    // TAMBAH FORM
    // =====================
    public function tambah()
    {
        $data['kategori'] = $this->buku_model->get_kategori();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('buku/tambah', $data);
        $this->load->view('templates/footer');
    }

    // =====================
    // SIMPAN
    // =====================
    public function simpan()
    {
        $this->form_validation->set_rules('kode_buku', 'Kode Buku', 'required');
        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required');
        $this->form_validation->set_rules('penulis', 'Penulis', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {

            $data = [
                'kode_buku'   => $this->input->post('kode_buku'),
                'judul_buku'  => $this->input->post('judul_buku'),
                'penulis'     => $this->input->post('penulis'),
                'penerbit'    => $this->input->post('penerbit'),
                'tahun'       => $this->input->post('tahun'),
                'id_kategori' => $this->input->post('id_kategori'),
                'stok'        => $this->input->post('stok'),
                'lokasi_rak'  => $this->input->post('lokasi_rak')
            ];

            $this->buku_model->insert($data);

            $this->session->set_flashdata('success', "Data Buku Berhasil Ditambahkan");
            redirect('buku');
        }
    }

    // =====================
    // HAPUS
    // =====================
    public function hapus($id)
    {
        $this->buku_model->delete($id);

        $this->session->set_flashdata('success', "Data Berhasil Dihapus");
        redirect('buku');
    }

    // =====================
    // EDIT FORM
    // =====================
    public function edit($id)
    {
        $data['buku'] = $this->buku_model->get_by_id($id);
        $data['kategori'] = $this->buku_model->get_kategori();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('buku/edit', $data);
        $this->load->view('templates/footer');
    }

    // =====================
    // UPDATE
    // =====================
    public function update($id)
    {
        $this->form_validation->set_rules('kode_buku', 'Kode Buku', 'required');
        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {

            $data = [
                'kode_buku'   => $this->input->post('kode_buku'),
                'judul_buku'  => $this->input->post('judul_buku'),
                'penulis'     => $this->input->post('penulis'),
                'penerbit'    => $this->input->post('penerbit'),
                'tahun'       => $this->input->post('tahun'),
                'id_kategori' => $this->input->post('id_kategori'),
                'stok'        => $this->input->post('stok'),
                'lokasi_rak'  => $this->input->post('lokasi_rak')
            ];

            $this->buku_model->update($id, $data);

            $this->session->set_flashdata('success', "Data Buku Berhasil Di Update");
            redirect('buku');
        }
    }

    public function cetak_buku()
{
    $kategori = $this->input->get('kategori');

    $this->db->select('buku.*, kategori.nama_kategori');
    $this->db->from('buku');
    $this->db->join('kategori', 'kategori.id = buku.id_kategori');

    if($kategori){
        $this->db->where('buku.id_kategori', $kategori);
    }

    $data['buku'] = $this->db->get()->result();

    $this->load->view('laporan/cetak_buku', $data);
}
        
}