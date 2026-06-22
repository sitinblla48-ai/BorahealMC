<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Protect patient routes
        if (!$this->session->userdata('patient_logged_in')) {
            $this->session->set_flashdata('error', 'Please log in to access the patient portal.');
            redirect('patient/login');
        }
        $this->load->model('Patient_model');
        $this->load->model('Registration_model');
        $this->load->model('Specialist_model');
        $this->load->library('form_validation');
    }

    /**
     * Patient Dashboard: Personal Info and History
     */
    public function dashboard() {
        $patient_id = $this->session->userdata('patient_id');
        $data['title'] = 'My Profile & History - Boraheal MC';
        $data['patient'] = $this->Patient_model->get_by_id($patient_id);
        $data['registrations'] = $this->Registration_model->get_by_patient_id($patient_id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar');
        $this->load->view('patient/patient_dashboard', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Online Registration Form Submission
     */
    public function register() {
        $patient_id = $this->session->userdata('patient_id');
        
        // Form Validation Rules
        $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('birth_date', 'Birth Date', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|numeric|trim');
        $this->form_validation->set_rules('complaint', 'Complaint', 'required|trim');
        $this->form_validation->set_rules('visit_date', 'Visit Date', 'required|callback_check_future_date');
        $this->form_validation->set_rules('visit_time', 'Visit Time', 'required');
        $this->form_validation->set_rules('id_specialist', 'Medical Specialist', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Online Registration - Boraheal MC';
            $data['patient'] = $this->Patient_model->get_by_id($patient_id);
            $data['specialists'] = $this->Specialist_model->get_all();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/navbar');
            $this->load->view('patient/patient_register', $data);
            $this->load->view('templates/footer');
        } else {
            $insert_data = array(
                'id_patient' => $patient_id,
                'full_name' => $this->input->post('full_name', TRUE),
                'birth_date' => $this->input->post('birth_date'),
                'address' => $this->input->post('address', TRUE),
                'phone_number' => $this->input->post('phone_number', TRUE),
                'complaint' => $this->input->post('complaint', TRUE),
                'visit_date' => $this->input->post('visit_date'),
                'visit_time' => $this->input->post('visit_time'),
                'id_specialist' => $this->input->post('id_specialist', TRUE),
                'registration_status' => 'Pending'
            );

            $reg_id = $this->Registration_model->create($insert_data);
            if ($reg_id) {
                $this->session->set_flashdata('success', 'Online registration submitted successfully!');
                redirect('patient/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Failed to submit registration. Please try again.');
                redirect('patient/register');
            }
        }
    }

    /**
     * Callback rule: Visit Date cannot be earlier than today
     */
    public function check_future_date($date) {
        $today = date('Y-m-d');
        if ($date < $today) {
            $this->form_validation->set_message('check_future_date', 'The {field} cannot be earlier than today.');
            return FALSE;
        }
        return TRUE;
    }
}
