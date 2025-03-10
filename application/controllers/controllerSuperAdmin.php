<?php
defined('BASEPATH') or exit('No direct script access allowed');

class controllerSuperAdmin extends CI_Controller
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
        $this->load->model('model_superadmin');
        date_default_timezone_set('Asia/Manila');


    }


    public function index()
    {
        $admin_id = $this->session->userdata('admin_id');
        $super_admin = $this->session->userdata('super_admin');

        // ✅ Allow Super Admin to access the dashboard
        if (!$admin_id && !$super_admin) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/admin_custom_access_denied', $data);
            return;
        }

        $data['pending_admins'] = $this->model_superadmin->getPendingAdmins();
        $data['approved_admins'] = $this->model_superadmin->getAdminsByStatus('approved');
        $data['rejected_admins'] = $this->model_superadmin->getAdminsByStatus('rejected');
        $this->load->view('superadminHomepage/view_superadmin_landing', $data);

    }

    public function approveAdmin()
    {
        $data['pending_admins'] = $this->model_superadmin->getPendingAdmins();
        $data['approved_admins'] = $this->model_superadmin->getAdminsByStatus('approved');
        $data['rejected_admins'] = $this->model_superadmin->getAdminsByStatus('rejected');
        $this->load->view('superadminHomepage/superadmin_approve_admin', $data);
    }





















}
