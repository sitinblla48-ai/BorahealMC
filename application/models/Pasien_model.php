<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get patient by username
     * @param string $username
     * @return object|bool
     */
    public function get_by_username($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('pasien');
        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return false;
    }

    /**
     * Authenticate Patient
     * @param string $username
     * @param string $password
     * @return object|bool
     */
    public function authenticate($username, $password) {
        $pasien = $this->get_by_username($username);
        if ($pasien) {
            if (password_verify($password, $pasien->password)) {
                return $pasien;
            }
        }
        return false;
    }

    /**
     * Get all patients
     * @return array
     */
    public function get_all() {
        $query = $this->db->get('pasien');
        return $query->result_array();
    }

    /**
     * Get patient by ID
     * @param int $id
     * @return object|bool
     */
    public function get_by_id($id) {
        $this->db->where('id_pasien', $id);
        $query = $this->db->get('pasien');
        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return false;
    }

    /**
     * Create a new patient
     * @param array $data
     * @return int Insert ID
     */
    public function create($data) {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        $this->db->insert('pasien', $data);
        return $this->db->insert_id();
    }

    /**
     * Update patient data
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }
        $this->db->where('id_pasien', $id);
        return $this->db->update('pasien', $data);
    }

    /**
     * Delete patient
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->where('id_pasien', $id);
        return $this->db->delete('pasien');
    }

    /**
     * Count total patients
     * @return int
     */
    public function count_all() {
        return $this->db->count_all('pasien');
    }
}
