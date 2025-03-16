<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('auth_model');
        $this->load->library('session');
        $this->load->model('admin_model');
        $this->load->database();
        $this->load->library('upload');
        $this->load->model('model_faculty');
        date_default_timezone_set('Asia/Manila');


    }
    public function index()
    {
        $username = '';

        // Check if the user is logged in
        if ($this->session->has_userdata('user_id')) {
            // Retrieve the username from the session
            $username = $this->session->userdata('username');
        }


        $user_id = $this->session->userdata('user_id');

        // Ensure user ID is available
        if (!$user_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/custom_access_denied', $data);
            return;  // 🛑 Stop execution if not logged in
        }
        // Fetch notifications for rank up
        $notifications_rankup = $this->model_faculty->getNotificationsByUser($user_id);


        // Fetch notifications from both 'notifications_requirements' and 'notification_message_the_user'
        $notifications_requirements = $this->db->order_by('id', 'DESC')->get_where('notifications_requirements', ['user_id' => $user_id])->result_array();
        $notifications_messages = $this->db->order_by('created_at', 'DESC')->get_where('notification_message_the_user', ['user_id' => $user_id])->result_array();

        // Merge both notification types
        $notifications = array_merge($notifications_requirements, $notifications_messages);

        // Pass to the view
        $data['notifications'] = $notifications;

        // Fetch notifications for requirements
        $notifications_requirements = $this->db->order_by('id', 'DESC')->get_where('notifications_requirements', ['user_id' => $user_id])->result_array();

        // Fetch unread notifications count for requirements
        $unread_notifications_requirements = $this->db->where(['user_id' => $user_id, 'status' => 'unread'])->count_all_results('notifications_requirements');

        // Pass the notifications data to the view
        $data['notifications_rankup'] = $notifications_rankup;
        $data['notifications_requirements'] = $notifications_requirements;
        $data['unread_notifications_requirements'] = $unread_notifications_requirements;

        // Fetch unread notifications count for rankup
        $unread_notifications_rankup = $this->db->where(['user_id' => $user_id, 'status' => 'unread'])->count_all_results('notifications_faculty_rankup');

        // Include the unread notifications for both
        // Fetch unread notifications count for messages
        $unread_notifications_messages = $this->db
            ->where(['user_id' => $user_id, 'status' => 'unread'])
            ->count_all_results('notification_message_the_user');

        // Total unread notifications count
        $data['unread_notifications'] = $unread_notifications_rankup + $unread_notifications_requirements + $unread_notifications_messages;

        // Load the view and pass the data
        $data['username'] = $username;
        $data['user'] = $this->auth_model->getUserById($this->session->userdata('user_id'));
        $this->load->view('Homepage/viewhome', $data);
    }


    public function userDashboard()
    {
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/custom_access_denied', $data);
            return;  // 🛑 Stop execution if not logged in
        }
        // Fetch uploaded files
        $uploaded_files = $this->db->get_where('userrequirements', ['user_id' => $user_id])->result_array();
        $totalUploaded = count($uploaded_files);
        $pendingFiles = $this->db->where(['user_id' => $user_id, 'status' => 'pending'])->count_all_results('userrequirements');
        $approvedFiles = $this->db->where(['user_id' => $user_id, 'status' => 'approved'])->count_all_results('userrequirements');
        $deniedFiles = $this->db->where(['user_id' => $user_id, 'status' => 'denied'])->count_all_results('userrequirements');

        // Progress calculation
        $progress = ($totalUploaded > 0) ? ($approvedFiles / $totalUploaded) * 100 : 0;

        // Fetch file uploads over time
        $uploadsOverTime = $this->db->query("
            SELECT DATE(created_at) as upload_date, COUNT(id) as count
            FROM userrequirements
            WHERE user_id = ?
            GROUP BY DATE(created_at)
            ORDER BY DATE(created_at) ASC
        ", [$user_id])->result_array();

        $dates = [];
        $uploads = [];
        foreach ($uploadsOverTime as $entry) {
            $dates[] = $entry['upload_date'];
            $uploads[] = $entry['count'];
        }

        // Fetch file category distribution
        $fileCategories = $this->db->query("
            SELECT file_type, COUNT(id) as count
            FROM userrequirements
            WHERE user_id = ?
            GROUP BY file_type
        ", [$user_id])->result_array();

        $categories = [];
        $categoryCounts = [];
        foreach ($fileCategories as $category) {
            $categories[] = $category['file_type'];
            $categoryCounts[] = $category['count'];
        }
        // Fetch rank distribution
        $rankDistribution = $this->db->query("
    SELECT rank, COUNT(id) as count 
    FROM users 
    GROUP BY rank
")->result_array();

        $rankLabels = [];
        $rankCounts = [];
        foreach ($rankDistribution as $rank) {
            $rankLabels[] = $rank['rank'];
            $rankCounts[] = $rank['count'];
        }

        // Fetch user points data
        $userPointsData = $this->db->query("
    SELECT username, points 
    FROM users 
    ORDER BY points DESC
")->result_array();

        $userNames = [];
        $userPoints = [];
        foreach ($userPointsData as $user) {
            $userNames[] = $user['username'];
            $userPoints[] = $user['points'];
        }

        // Fetch file submissions over time for all users
        $facultySubmissions = $this->db->query("
    SELECT DATE(created_at) as submission_date, COUNT(id) as count
    FROM userrequirements
    GROUP BY DATE(created_at)
    ORDER BY DATE(created_at) ASC
")->result_array();

        $submissionDates = [];
        $submissionCounts = [];
        foreach ($facultySubmissions as $entry) {
            $submissionDates[] = $entry['submission_date'];
            $submissionCounts[] = $entry['count'];
        }

        $data = [
            'uploaded_files' => $uploaded_files,
            'totalUploaded' => $totalUploaded,
            'pendingFiles' => $pendingFiles,
            'approvedFiles' => $approvedFiles,
            'deniedFiles' => $deniedFiles,
            'progress' => $progress,
            'uploadDates' => json_encode($dates),
            'uploadCounts' => json_encode($uploads),
            'fileCategories' => json_encode($categories),
            'categoryCounts' => json_encode($categoryCounts),
            'rankLabels' => json_encode($rankLabels),
            'rankCounts' => json_encode($rankCounts),
            'userNames' => json_encode($userNames),
            'userPoints' => json_encode($userPoints),
            'submissionDates' => json_encode($submissionDates),
            'submissionCounts' => json_encode($submissionCounts),
        ];

        $this->load->view('Homepage/viewuserdashboard', $data);
    }


    private function insertAuditLog($action)
    {
        $admin_id = $this->session->userdata('admin_id'); // Ensure admin_id is in the session
        if (!$admin_id) {
            return; // Avoid logging if no admin is logged in
        }

        $data = [
            'admin_id' => $admin_id,
            'action' => $action,
            'timestamp' => date('Y-m-d H:i:s'),
        ];

        $this->db->insert('audit_logs', $data);
    }

    public function logout()
    {
        // Log the logout action
        $this->insertAuditLog('Logged out');

        // Destroy session
        $this->session->sess_destroy();

        // Prevent back button from revisiting the page
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        // Redirect to login
        redirect('auth');
    }


    public function updateUserInfo()
    {
        if (!$this->session->has_userdata('user_id')) {
            echo json_encode(['error' => 'Access Denied']);
            return;
        }

        $user_id = $this->session->userdata('user_id'); // Get the current user's ID

        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|callback_unique_email[' . $user_id . ']');
        $this->form_validation->set_rules('phoneNo', 'Phone Number', 'required|numeric|trim');
        $this->form_validation->set_rules('address', 'Address', 'trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required'); // Add gender validation
        $this->form_validation->set_rules('birth_date', 'Birthdate', 'required|callback_check_age'); // Add age validation

        if ($this->form_validation->run()) {
            // Data to be updated
            $update_data = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'phoneNo' => $this->input->post('phoneNo'),
                'address' => $this->input->post('address'),
                'gender' => $this->input->post('gender'), // Add gender
                'birth_date' => $this->input->post('birth_date') // Add birthdate
            ];

            // Update user information
            if ($this->auth_model->updateUser($user_id, $update_data)) {
                echo json_encode(['success' => 'Profile updated successfully.']);
            } else {
                echo json_encode(['error' => 'Failed to update profile.']);
            }
        } else {
            // Return validation errors
            echo json_encode(['error' => validation_errors()]);
        }
    }

    // Age validation callback function
    public function check_age($birth_date)
    {
        $birth_date = new DateTime($birth_date);
        $today = new DateTime();
        $age = $today->diff($birth_date)->y;

        if ($age < 18) {
            $this->form_validation->set_message('check_age', 'You must be at least 18 years old.');
            return false;
        }
        return true;
    }



    public function userChangeUserInformation()
    {
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/custom_access_denied', $data);
            return;  // 🛑 Stop execution if not logged in
        }
        if (!$this->session->has_userdata('user_id')) {
            redirect(base_url('auth'));
        }

        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->auth_model->getUserById($user_id); // Fetch user data

        $this->load->view('Homepage/user_change_personalInfo', $data);
    }
    public function toggleHideField()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $field = $input['field'];
        $user_id = $input['user_id'];

        // Kunin ang kasalukuyang hidden fields ng user
        $user = $this->db->get_where('users', ['id' => $user_id])->row_array();
        $hidden_fields = json_decode($user['hidden_fields'], true) ?? [];

        // I-toggle ang field
        if (in_array($field, $hidden_fields)) {
            $hidden_fields = array_diff($hidden_fields, [$field]); // Remove from hidden
        } else {
            $hidden_fields[] = $field; // Add to hidden
        }

        // I-update ang database
        $this->db->where('id', $user_id);
        $this->db->update('users', ['hidden_fields' => json_encode($hidden_fields)]);

        echo json_encode([
            'status' => 'success',
            'is_hidden' => in_array($field, $hidden_fields),
        ]);
    }


    public function UserFacultyMemberInformation()
    {
        $users = $this->auth_model->getUsers(); // Fetch all users
        $data['users'] = $users;
        $this->load->view('Homepage/user_faculty_member_information', $data);
    }
    public function clientprofile()
    {
        // Check if the user is logged in
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/custom_access_denied', $data);
            return;  // 🛑 Stop execution if not logged in
        }

        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->auth_model->getUserById($user_id);

        // Fetch uploaded files for the logged-in user
        $uploaded_files = $this->db->get_where('userrequirements', ['user_id' => $user_id])->result_array();

        // Count the total number of uploaded, approved, and pending files
        $totalUploaded = count($uploaded_files);
        $pendingFiles = $this->db->where(['user_id' => $user_id, 'status' => 'pending'])->count_all_results('userrequirements');
        $approvedFiles = $this->db->where(['user_id' => $user_id, 'status' => 'approved'])->count_all_results('userrequirements');

        // Calculate progress (based on the approved files count)
        $progress = ($totalUploaded > 0) ? ($approvedFiles / $totalUploaded) * 100 : 0;

        // Handle profile update form submission
        if ($this->input->post('update_profile')) {
            $this->updateProfile($user_id);
        }

        // Handle password change
        if ($this->input->post('change_password')) {
            $this->changePassword($user_id);
        }

        // Handle profile image upload
        if (!empty($_FILES['profile_image']['name'])) {
            $this->uploadProfileImage();
            $data['user'] = $this->auth_model->getUserById($user_id); // Refresh user data
        }

        $data['uploaded_files'] = $uploaded_files;
        $data['totalUploaded'] = $totalUploaded;
        $data['pendingFiles'] = $pendingFiles;
        $data['approvedFiles'] = $approvedFiles;
        $data['progress'] = $progress;

        $this->load->view('Homepage/clientprofile', $data);
    }

    public function UserChangePassword()
    {
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            echo json_encode(['error' => 'Access Denied']);
            return;
        }

        if ($this->input->post('change_password')) {
            $response = $this->changePassword($user_id);
            echo json_encode($response);  // Send response back as JSON
            return;
        }

        $data['user'] = $this->auth_model->getUserById($user_id);
        $this->load->view('Homepage/user_change_password', $data);
    }

    public function changePassword($user_id)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            return ['error' => strip_tags(validation_errors())]; // Strip tags to remove <p> tags
        } else {
            $user = $this->auth_model->getUserById($user_id);

            if (!password_verify($this->input->post('current_password'), $user['password'])) {
                return ['error' => 'Incorrect current password.'];
            }

            $new_password_hashed = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT);
            $this->auth_model->updateUser($user_id, ['password' => $new_password_hashed]);

            return ['success' => 'Password updated successfully.'];
        }
    }




    public function updateProfile($user_id)
    {
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|callback_unique_email[' . $user_id . ']');
        $this->form_validation->set_rules('phoneNo', 'Phone Number', 'required|numeric|trim');
        $this->form_validation->set_rules('address', 'Address', 'trim');

        if ($this->form_validation->run()) {
            // Update user profile
            $update_data = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'phoneNo' => $this->input->post('phoneNo'),
                'address' => $this->input->post('address'),
            ];

            $this->auth_model->updateUser($user_id, $update_data);
            $this->session->set_flashdata('success', 'Profile updated successfully.');
        } else {
            $this->session->set_flashdata('error', validation_errors());
        }

        redirect(base_url('Home/clientprofile'));
    }

    // Custom validation function to check for unique email
    public function unique_email($email, $user_id)
    {
        $existingUser = $this->db->where('email', $email)->where('id !=', $user_id)->get('users')->row();
        if ($existingUser) {
            $this->form_validation->set_message('unique_email', 'This email is already taken.');
            return false;
        }
        return true;
    }


    public function uploadProfileImage()
    {
        $user_id = $this->session->userdata('user_id');

        // Upload configuration
        $config['upload_path'] = './uploads/profile_images';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 10240;
        $config['file_name'] = uniqid();

        $this->upload->initialize($config);


        if ($this->upload->do_upload('profile_image')) {
            $upload_data = $this->upload->data();
            $image_path = 'uploads/profile_images/' . $upload_data['file_name'];

            // Save image path in the database
            $this->auth_model->updateUser($user_id, ['uploaded_profile_image' => $image_path]);

            // Return JSON response
            echo json_encode(['status' => 'success', 'message' => 'Profile image updated successfully.', 'image' => base_url($image_path)]);
        } else {
            echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
        }
    }

    //! USER TASK
    //! CREATE TASK

    public function userTasks()
    {
        if (!$this->session->has_userdata('user_id')) {
            redirect(base_url('auth'));
        }

        $user_id = $this->session->userdata('user_id');
        $tasks = $this->admin_model->getTasksByUserId($user_id);

        // Ensure tasks have proper statuses (e.g., overdue logic)
        $current_date = date('Y-m-d');
        foreach ($tasks as &$task) {
            if ($task['due_date'] < $current_date && $task['status'] != 'Completed') {
                $task['status'] = 'Overdue';
            }
        }

        $uploaded_tasks = $this->admin_model->getUploadedTasks();

        // Map uploaded tasks to their corresponding statuses
        foreach ($uploaded_tasks as &$file) {
            $task = $this->admin_model->getTaskById($file['task_id']); // Assuming this method exists
            $file['status'] = $task['status'] ?? 'Unknown';
        }

        $data['tasks'] = $tasks;
        $data['uploaded_tasks'] = $uploaded_tasks;

        $data['total_tasks'] = count($tasks);
        $data['completed_tasks'] = count(array_filter($tasks, function ($task) {
            return $task['status'] == 'Completed';
        }));
        $data['pending_tasks'] = count(array_filter($tasks, function ($task) {
            return $task['status'] == 'Not Started' || $task['status'] == 'Overdue';
        }));

        $this->load->view('Homepage/usertask', $data);
    }




    public function saveTask()
    {
        if (!$this->session->has_userdata('user_id')) {
            redirect(base_url('auth'));
        }

        $user_id = $this->session->userdata('user_id');
        $username = $this->session->userdata('username');

        // Configure upload
        $config['upload_path'] = './uploads/tasks';
        $config['allowed_types'] = '*';
        $config['max_size'] = 10240;
        $config['file_name'] = uniqid();

        $this->upload->initialize($config);

        if ($this->upload->do_upload('task_file')) {
            $upload_data = $this->upload->data();
            $data = [
                'file_name' => $upload_data['file_name'],
                'username' => $username,
                'task_id' => $this->input->post('task_id'),
                'uploaded_at' => date('Y-m-d H:i:s'),
            ];

            // Save file details to the database
            $this->admin_model->saveUploadedTask($data);

            // Send JSON response back to the client
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $this->upload->display_errors()]);
        }
    }









}