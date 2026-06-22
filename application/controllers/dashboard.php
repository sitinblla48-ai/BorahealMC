<?php 
defined('BASEPATH') OR Exit('No direct script access allowed');

class dashboard extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        {
            if (!$this->session->userdata('login')){
                redirect('login');
            }
        }

    }

    public function index ()
    {
        $data['total_kategori']=$this->db->count_all('kategori');
        $data['total_buku']=$this->db->count_all('buku');
        $data['total_anggota']=$this->db->count_all('anggota');

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('dashboard/index',$data);
        $this->load->view('templates/footer');
    }
}