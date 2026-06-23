<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Create a new registration
     * @param array $data
     * @return int
     */
    public function create($data) {
        $this->db->insert('pendaftaran', $data);
        return $this->db->insert_id();
    }

    /**
     * Get registration details by ID
     * @param int $id
     * @return object|bool
     */
    public function get_by_id($id) {
        $this->db->select('pendaftaran.*, dokter.nama_dokter, dokter.spesialis');
        $this->db->from('pendaftaran');
        $this->db->join('dokter', 'pendaftaran.id_dokter = dokter.id_dokter');
        $this->db->where('pendaftaran.id_pendaftaran', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return false;
    }

    /**
     * Get registration history for a specific patient
     * @param int $id_pasien
     * @return array
     */
    public function get_by_pasien_id($id_pasien) {
        $this->db->select('pendaftaran.*, dokter.nama_dokter, dokter.spesialis');
        $this->db->from('pendaftaran');
        $this->db->join('dokter', 'pendaftaran.id_dokter = dokter.id_dokter');
        $this->db->where('pendaftaran.id_pasien', $id_pasien);
        $this->db->order_by('pendaftaran.tanggal_kunjungan', 'DESC');
        $this->db->order_by('pendaftaran.jam_kunjungan', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get all schedules for Admin (Sorted by visit date)
     * @return array
     */
    public function get_all_schedules() {
        $this->db->select('pendaftaran.*, dokter.nama_dokter, dokter.spesialis, pasien.nama_lengkap AS nama_pasien');
        $this->db->from('pendaftaran');
        $this->db->join('pasien', 'pendaftaran.id_pasien = pasien.id_pasien');
        $this->db->join('dokter', 'pendaftaran.id_dokter = dokter.id_dokter');
        $this->db->order_by('pendaftaran.tanggal_kunjungan', 'ASC');
        $this->db->order_by('pendaftaran.jam_kunjungan', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Update status of a registration
     * @param int $id
     * @param string $status ('Pending', 'Disetujui', 'Ditolak')
     * @return bool
     */
    public function update_status($id, $status) {
        $this->db->where('id_pendaftaran', $id);
        return $this->db->update('pendaftaran', array('status_pendaftaran' => $status));
    }

    /**
     * Count registrations
     * @param string $status (optional)
     * @return int
     */
    public function count_pendaftaran($status = null) {
        if ($status !== null) {
            $this->db->where('status_pendaftaran', $status);
        }
        $this->db->from('pendaftaran');
        return $this->db->count_all_results();
    }

    /**
     * Get statistics for dashboard and reports
     * @return array
     */
    public function get_stats() {
        return array(
            'total_pasien' => $this->db->count_all('pasien'),
            'total_pendaftaran' => $this->count_pendaftaran(),
            'pendaftaran_disetujui' => $this->count_pendaftaran('Disetujui'),
            'pendaftaran_ditolak' => $this->count_pendaftaran('Ditolak'),
            'pendaftaran_pending' => $this->count_pendaftaran('Pending')
        );
    }

    /**
     * Get statistics filtered by Month and Year
     */
    public function get_filtered_stats($month = null, $year = null) {
        $total_pasien = $this->count_unique_pasien($month, $year);
        $total_pendaftaran = $this->count_pendaftaran_filtered(null, $month, $year);
        $pendaftaran_disetujui = $this->count_pendaftaran_filtered('Disetujui', $month, $year);
        $pendaftaran_ditolak = $this->count_pendaftaran_filtered('Ditolak', $month, $year);
        $pendaftaran_pending = $this->count_pendaftaran_filtered('Pending', $month, $year);

        return array(
            'total_pasien' => $total_pasien,
            'total_pendaftaran' => $total_pendaftaran,
            'pendaftaran_disetujui' => $pendaftaran_disetujui,
            'pendaftaran_ditolak' => $pendaftaran_ditolak,
            'pendaftaran_pending' => $pendaftaran_pending
        );
    }

    /**
     * Count unique patients who registered in a month/year
     */
    public function count_unique_pasien($month = null, $year = null) {
        if ((empty($month) || $month === 'all') && (empty($year) || $year === 'all')) {
            return $this->db->count_all('pasien');
        }
        $this->db->distinct();
        $this->db->select('id_pasien');
        $this->db->from('pendaftaran');
        if (!empty($month) && $month !== 'all') {
            $this->db->where('MONTH(tanggal_kunjungan)', $month);
        }
        if (!empty($year) && $year !== 'all') {
            $this->db->where('YEAR(tanggal_kunjungan)', $year);
        }
        return $this->db->count_all_results();
    }

    /**
     * Count pendaftaran with month and year filter
     */
    public function count_pendaftaran_filtered($status = null, $month = null, $year = null) {
        if ($status !== null) {
            $this->db->where('status_pendaftaran', $status);
        }
        if (!empty($month) && $month !== 'all') {
            $this->db->where('MONTH(tanggal_kunjungan)', $month);
        }
        if (!empty($year) && $year !== 'all') {
            $this->db->where('YEAR(tanggal_kunjungan)', $year);
        }
        $this->db->from('pendaftaran');
        return $this->db->count_all_results();
    }

    /**
     * Get schedules with month, year, and status filter
     */
    public function get_filtered_schedules($month = null, $year = null, $status = null) {
        $this->db->select('pendaftaran.*, dokter.nama_dokter, dokter.spesialis, pasien.nama_lengkap AS nama_pasien');
        $this->db->from('pendaftaran');
        $this->db->join('pasien', 'pendaftaran.id_pasien = pasien.id_pasien');
        $this->db->join('dokter', 'pendaftaran.id_dokter = dokter.id_dokter');
        
        if (!empty($month) && $month !== 'all') {
            $this->db->where('MONTH(pendaftaran.tanggal_kunjungan)', $month);
        }
        if (!empty($year) && $year !== 'all') {
            $this->db->where('YEAR(pendaftaran.tanggal_kunjungan)', $year);
        }
        if (!empty($status) && $status !== 'all') {
            $this->db->where('pendaftaran.status_pendaftaran', $status);
        }
        
        $this->db->order_by('pendaftaran.tanggal_kunjungan', 'ASC');
        $this->db->order_by('pendaftaran.jam_kunjungan', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
