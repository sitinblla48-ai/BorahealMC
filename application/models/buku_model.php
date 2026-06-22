<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class buku_model extends CI_Model {

    private $table = 'buku';

    // Ambil semua data buku (untuk DataTables nanti)
    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    // Ambil data buku berdasarkan id
    public function get_by_id($id)
    {
        $this->db->where('id_buku', $id);
        return $this->db->get($this->table)->row();
    }

    // Insert data buku
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Update data buku
    public function update($id, $data)
    {
        $this->db->where('id_buku', $id);
        return $this->db->update($this->table, $data);
    }

    // Delete data buku
    public function delete($id)
    {
        return $this->db->delete($this->table, ['id_buku' => $id]);
    }

    // Ambil kategori (untuk dropdown form)
    public function get_kategori()
    {
        return $this->db->get('kategori')->result();
    }
}