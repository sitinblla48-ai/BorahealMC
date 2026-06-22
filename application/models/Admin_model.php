<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get admin by username
     * @param string $username
     * @return object|bool
     */
    public function get_by_username($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('admin');
        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return false;
    }

    /**
     * Authenticate Admin
     * @param string $username
     * @param string $password
     * @return object|bool
     */
    public function authenticate($username, $password) {
        $admin = $this->get_by_username($username);
        if ($admin) {
            if (password_verify($password, $admin->password)) {
                return $admin;
            }
        }
        return false;
    }
}
