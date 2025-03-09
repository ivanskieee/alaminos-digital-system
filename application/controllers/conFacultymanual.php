<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ConFacultymanual extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('admin_model');
        $this->load->model('home_model');
        $this->load->model('model_faculty');
        $this->load->model('model_faculty_manual');

        date_default_timezone_set('Asia/Manila');
    }



    public function adminManualFaculty()
    {
        $admin_id = $this->session->userdata('admin_id');

        if (!$admin_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/admin_custom_access_denied', $data);
            return;
        }
        $this->load->view('adminHomepage/adminFacultyManual');
    }
    public function userManualFaculty()
    {
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/custom_access_denied', $data);
            return;  // 🛑 Stop execution if not logged in
        }
        $this->load->view('Homepage/userFacultyManual');
    }


}
