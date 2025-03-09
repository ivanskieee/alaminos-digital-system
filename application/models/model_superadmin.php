<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_superadmin extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

    public function getAdminById($admin_id)
    {
        $query = $this->db->get_where('admin', ['admin_id' => $admin_id]);
        return $query->row_array();
    }

    public function register_admin($data)
    {
        return $this->db->insert('admin', $data);
    }
    public function getPendingAdmins()
    {
        $query = $this->db->get_where('admin', ['status' => 'pending']);
        return $query->result_array();
    }

    public function getAdminsByStatus($status)
    {
        $query = $this->db->get_where('admin', ['status' => $status]);
        return $query->result_array();
    }

    public function updateAdminStatus($admin_id, $status)
    {
        $this->db->where('admin_id', $admin_id);
        return $this->db->update('admin', ['status' => $status]);
    }


}
