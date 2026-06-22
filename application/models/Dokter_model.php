<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all doctors/specialists
     * @return array
     */
    public function get_all() {
        $query = $this->db->get('dokter');
        return $query->result_array();
    }

    /**
     * Get doctor by ID
     * @param int $id
     * @return object|bool
     */
    public function get_by_id($id) {
        $this->db->where('id_dokter', $id);
        $query = $this->db->get('dokter');
        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return false;
    }
}
