<?php
defined('BASEPATH') or exit('No direct script access allowed');

class conAdmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('auth_model');
        $this->load->model('home_model');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('download');
        $this->load->model('model_faculty');
        date_default_timezone_set('Asia/Manila');


    }

    public function index()
    {
        // ✅ Prevent browser from caching this page
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
        $this->output->set_header("Pragma: no-cache");

        // ✅ Fetch admin ID from session
        $admin_id = $this->session->userdata('admin_id');

        // ✅ Ensure the admin is logged in
        if (!$admin_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/admin_custom_access_denied', $data);
            return;
        }

        // ✅ Fetch admin details from the database
        $this->load->model('admin_model'); // Load model if not already loaded
        $admin = $this->admin_model->getAdminById($admin_id);

        // ✅ Pass admin details to the view
        $data['admin'] = $admin;

        // ✅ Fetch audit logs
        $data['logs'] = $this->admin_model->getAuditLogs();

        // ✅ Load the admin dashboard view
        $this->load->view('Authadmin/adminhome', $data);
    }



    public function AuditLogs()
    {
        $admin_id = $this->session->userdata('admin_id');

        if (!$admin_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/admin_custom_access_denied', $data);
            return;
        }
        $data['logs'] = $this->admin_model->getAuditLogs();

        // Ensure logging when audit logs are viewed
        // $this->insertAuditLog("Viewed Audit Logs");

        $this->load->view('adminHomepage/admin_auditlogs', $data);
    }

    // ✅ Ensure this method exists inside the controller
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

    // Method to fetch the count of unread notifications
    public function getNotificationsCount()
    {
        // Fetch the count of unread notifications
        $unreadCount = $this->admin_model->getUnreadNotificationCount();

        // Return the count as JSON
        echo json_encode(['count' => $unreadCount]);
    }

    // Add this method to update logs as "read"
    public function markNotificationsAsRead()
    {
        $this->admin_model->markAllNotificationsAsRead(); // Update the notifications in the database

        // Respond back to the AJAX request
        echo json_encode(['status' => 'success']);
    }

    public function userUploadedTasks()
    {
        $users = $this->auth_model->getUsers(); // Fetch all users
        $data['users'] = $users;

        $admin_id = $this->session->userdata('admin_id');

        if (!$admin_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/admin_custom_access_denied', $data);
            return;
        }
        // Fetch file submissions for all users (remove the logged-in user restriction)
        $file_submissions = $this->model_faculty->getAllFileSubmissions(); // Update this function to fetch for all users

        // Fetch uploaded tasks for all users
        $uploaded_tasks = $this->admin_model->getUploadedTasks(); // This should already return tasks for all users

        // Map uploaded tasks to their corresponding statuses
        foreach ($uploaded_tasks as &$file) {
            $task = $this->admin_model->getTaskById($file['task_id']); // Assuming this method exists
            $file['status'] = $task['status'] ?? 'Unknown';
        }

        // Pass the data to the view
        $data['uploaded_tasks'] = $uploaded_tasks;
        $data['file_submissions'] = $file_submissions; // Add all file submissions
        $data['rank_label'] = ''; // Adjust rank_label if necessary
        $data['next_rank_label'] = ''; // Adjust next rank if necessary
        $data['next_rank_order'] = ''; // Adjust rank order if necessary

        // Load the view
        $this->load->view('adminHomepage/userUploadedTask', $data);
    }

    public function getNextRankOrder($currentRank)
    {
        $rankOrder = [
            'Instructor I',
            'Instructor II',
            'Instructor III',
            'Assistant Professor I',
            'Assistant Professor II',
            'Associate Professor I',
            'Associate Professor II',
            'Associate Professor III',
            'Associate Professor IV',
            'Professor I',
            'Professor II'
        ];

        $currentRankIndex = array_search($currentRank, $rankOrder);
        if ($currentRankIndex !== false && $currentRankIndex + 1 < count($rankOrder)) {
            return $rankOrder[$currentRankIndex + 1];
        }

        return 'No next rank available';
    }

    public function getNextRankLabel($currentRank)
    {
        $rankRequirements = [
            'Instructor I' => 'BS/AB Graduate with Government Examination (CPA, Civil Service, Nursing Board Exam, etc)',
            'Instructor II' => 'BS/AB with Government Examination and MA/MBA Units',
            'Instructor III' => 'BS/AB with Government Examination with Complete Academic Requirements, no thesis',
            'Assistant Professor I' => 'BS/AB with Full MA',
            'Assistant Professor II' => 'Full MA with Government',
            'Associate Professor I' => 'Full MA with 3-15 Doctoral Units',
            'Associate Professor II' => 'Full MA with 18-30 Doctoral Units',
            'Associate Professor III' => 'Full MA with 33-45 Doctoral Units',
            'Associate Professor IV' => 'Full MA with over 45 Doctoral Units',
            'Professor I' => 'Full-fledged Doctor for 10 years',
            'Professor II' => 'Full-fledged Doctor for 11 years and above'
        ];

        $rankOrder = [
            'Instructor I',
            'Instructor II',
            'Instructor III',
            'Assistant Professor I',
            'Assistant Professor II',
            'Associate Professor I',
            'Associate Professor II',
            'Associate Professor III',
            'Associate Professor IV',
            'Professor I',
            'Professor II'
        ];

        $currentRankIndex = array_search($currentRank, $rankOrder);
        if ($currentRankIndex !== false && $currentRankIndex + 1 < count($rankOrder)) {
            return $rankRequirements[$rankOrder[$currentRankIndex + 1]];
        }

        return 'No next rank available';
    }


    public function getRankLabel($rank)
    {
        switch ($rank) {
            case 'Instructor I':
                return 'BS/AB Graduate with Government Examination (CPA, Civil Service, Nursing Board Exam, etc)';
            case 'Instructor II':
                return 'BS/AB with Government Examination and MA/MBA Units';
            case 'Instructor III':
                return 'BS/AB with Government Examination with Complete Academic Requirements, no thesis';
            case 'Assistant Professor I':
                return 'BS/AB with Full MA';
            case 'Assistant Professor II':
                return 'Full MA with Government';
            case 'Associate Professor I':
                return 'Full MA with 3-15 Doctoral Units';
            case 'Associate Professor II':
                return 'Full MA with 18-30 Doctoral Units';
            case 'Associate Professor III':
                return 'Full MA with 33-45 Doctoral Units';
            case 'Associate Professor IV':
                return 'Full MA with over 45 Doctoral Units';
            case 'Professor I':
                return 'Full-fledged Doctor for 10 years';
            case 'Professor II':
                return 'Full-fledged Doctor for 11 years and above';
            default:
                return 'Unspecified Label';
        }
    }



    private function resizeImage($image_path)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $image_path;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 800;
        $config['height'] = 600;

        $this->load->library('image_lib', $config);

        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }

        $this->image_lib->clear();
    }

    public function userinfo()
    {
        $admin_id = $this->session->userdata('admin_id');

        if (!$admin_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/admin_custom_access_denied', $data);
            return;
        }
        $data['users'] = $this->auth_model->getUsers();
        $this->load->view('adminHomepage/userinfo', $data);
    }
    public function viewuserinfo($user_id)
    {
        $user = $this->auth_model->getUserById($user_id);

        if ($user) {
            $this->load->view('adminHomepage/viewuserinfo', ['user' => $user]);
        } else {
            echo "User not found.";
        }
    }

    public function updateuserinfo($user_id)
    {
        // Fetch the current user information before update
        $old_user_data = $this->auth_model->getUserById($user_id);

        if (!$old_user_data) {
            echo "User not found.";
            return;
        }

        // Collect the new user data from input
        $user_data = [
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'phoneNo' => $this->input->post('phoneNo'),
            'gender' => $this->input->post('gender'),
            'birth_date' => $this->input->post('birth_date'),
        ];

        // Log changes between old and new data
        foreach ($user_data as $field => $new_value) {
            $old_value = $old_user_data[$field] ?? 'N/A'; // If the field doesn't exist, set it to N/A
            if ($old_value != $new_value) {
                $this->insertAuditLog("Updated {$field} for user (ID: {$user_id}) from '{$old_value}' to '{$new_value}'");
            }
        }

        // Log the full user data update
        log_message('info', 'User Data updated: ' . print_r($user_data, true));

        // Proceed with the update
        $result = $this->auth_model->updateUser($user_id, $user_data);

        if ($result) {
            // Log the successful update
            $this->insertAuditLog("Updated user information (ID: {$user_id}) successfully.");
            redirect(base_url('conAdmin'));
        } else {
            echo "Failed to update user.";
        }
    }

    public function FacultyMemberInformation()
    {
        $users = $this->auth_model->getUsers(); // Fetch all users
        $data['users'] = $users;
        $this->load->view('adminHomepage/admin_faculty_member_information', $data);
    }

    public function edituserinfo($user_id)
    {
        $user = $this->auth_model->getUserById($user_id);

        if ($user) {
            $this->load->view('adminHomepage/edituserinfo', ['user' => $user]);
        } else {
            echo "User not found.";
        }
    }

    public function tasks()
    {
        $data['tasks'] = $this->admin_model->getTasks(); // Get all active tasks
        // $data['completedTasks'] = $this->admin_model->getCompletedTasks(); // Get completed tasks
        $data['users'] = $this->auth_model->getUsers(); // Fetch users for dropdown
        $this->load->view('adminHomepage/createtask', $data); // Load task creation page
    }


    public function updateOwner()
    {
        $input = json_decode(file_get_contents('php://input'), true); // Get the JSON input
        $taskId = $input['taskId'];
        $newOwner = $input['newOwner'];

        // Validate the inputs (you might want to do more validation based on your requirements)
        if (!empty($taskId) && !empty($newOwner)) {
            // Update the owner in the database
            $result = $this->admin_model->updateTaskOwner($taskId, $newOwner);

            // Return a JSON response
            if ($result) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        }
    }

    public function updateTaskField()
    {
        $input = json_decode(file_get_contents('php://input'), true); // Get the JSON input
        $taskId = $input['taskId'];
        $columnType = $input['columnType'];
        $newValue = $input['newValue'];

        // Validate the inputs
        if (!empty($taskId) && !empty($columnType) && !empty($newValue)) {
            // Call the model method to update the field
            $result = $this->admin_model->updateTaskField($taskId, $columnType, $newValue);

            // Return a JSON response
            if ($result) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        }
    }
    public function deleteTask()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $taskId = $input['taskId'];

        if (!empty($taskId)) {
            // Start transaction
            $this->db->trans_start();

            // Delete the related records in the user_uploadedtask table
            $this->db->where('task_id', $taskId);
            $this->db->delete('user_uploadedtask');

            // Delete the task from the tasks table
            $this->db->where('id', $taskId);
            $this->db->delete('tasks');

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete task']);
            } else {
                echo json_encode(['status' => 'success']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Task ID is required']);
        }
    }
    public function bulkDeleteTasks()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $taskIds = $input['taskIds'];

        if (!empty($taskIds) && is_array($taskIds)) {
            // Start transaction
            $this->db->trans_start();

            // Delete related records in the user_uploadedtask table
            $this->db->where_in('task_id', $taskIds);
            $this->db->delete('user_uploadedtask');

            // Delete tasks from the tasks table
            $this->db->where_in('id', $taskIds);
            $this->db->delete('tasks');

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete tasks']);
            } else {
                echo json_encode(['status' => 'success']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid task IDs']);
        }
    }





    public function deleteuserinfo($user_id)
    {
        // Get user details before deletion for logging purposes
        $user = $this->auth_model->getUserById($user_id);

        if ($user) {
            // Log the deletion action
            $this->insertAuditLog("Deleted user (ID: {$user_id}) - Username: {$user['username']}, Email: {$user['email']}");
        }

        // Proceed with deleting the user
        $result = $this->auth_model->deleteUser($user_id);

        // Redirect to the admin page after deletion
        redirect(base_url('conAdmin'));
    }

    public function dashboard()
    {
        $user_id = $this->session->userdata('user_id'); // Assuming user ID is stored in session

        $admin_id = $this->session->userdata('admin_id');

        if (!$admin_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/admin_custom_access_denied', $data);
            return;
        }
        // Get recent tasks and total tasks
        $recentTasks = $this->admin_model->getRecentTasks();
        $totalTask = $this->admin_model->getTotalTaskCount(); // Total tasks count
        $users = $this->auth_model->getUsers(); // Fetch total users

        // Fetch all uploaded files from the 'userrequirements' table, including the user_id
        $uploaded_files = $this->db->select('userrequirements.*, users.username')
            ->join('users', 'users.id = userrequirements.user_id', 'left')
            ->get('userrequirements')->result_array();  // Fetch all uploaded files with uploader info

        // Calculate weekly approved and denied files
        // Calculate weekly approved and denied files
        $approved_files_by_day = [];
        $denied_files_by_day = [];
        $days_of_week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        foreach ($days_of_week as $index => $day) {
            // Calculate the start and end times for each day in the current week
            $start_of_week = strtotime('monday this week');
            $start_of_day = $start_of_week + ($index * 24 * 60 * 60); // Offset by the index (days)
            $end_of_day = $start_of_day + (24 * 60 * 60) - 1; // End of the day (23:59:59)

            $approved_files_by_day[] = $this->db->where('status', 'approved')
                ->where('updated_at >=', date('Y-m-d H:i:s', $start_of_day)) // Adjusted for current week's day
                ->where('updated_at <=', date('Y-m-d H:i:s', $end_of_day))
                ->count_all_results('userrequirements');

            $denied_files_by_day[] = $this->db->where('status', 'denied')
                ->where('updated_at >=', date('Y-m-d H:i:s', $start_of_day)) // Adjusted for current week's day
                ->where('updated_at <=', date('Y-m-d H:i:s', $end_of_day))
                ->count_all_results('userrequirements');
        }



        // Count totals for stats
        $totalUploaded = count($uploaded_files);
        $approvedFiles = $this->db->where('status', 'approved')->count_all_results('userrequirements');
        $deniedFiles = $this->db->where('status', 'denied')->count_all_results('userrequirements');

        // Calculate the progress for each user
        foreach ($users as &$user) {
            $userId = $user['id']; // Assuming you have an 'id' field for users
            $totalFiles = $this->db->where('user_id', $userId)->count_all_results('userrequirements');
            $approvedCount = $this->db->where(['user_id' => $userId, 'status' => 'approved'])->count_all_results('userrequirements');
            $user['progress'] = ($totalFiles > 0) ? ($approvedCount / $totalFiles) * 100 : 0; // Calculate progress
        }

        // Count the total number of uploaded, approved, and denied files
        $pendingTasks = $this->db->where('status', 'Not Started')->count_all_results('tasks');
        $completedTasks = $this->db->where('status', 'Completed')->count_all_results('tasks');

        // Fetch notifications for the user (unread notifications only)
        $notifications = $this->db->get_where('notifications', ['user_id' => $user_id])->result_array();
        // Count users by gender
        $maleUsers = $this->db->where('gender', 'Male')->count_all_results('users');
        $femaleUsers = $this->db->where('gender', 'Female')->count_all_results('users');
        $otherUsers = $this->db->where_not_in('gender', ['Male', 'Female'])->count_all_results('users');


        $approved_users = $this->auth_model->getUsersByStatus('approved');
        $rejected_users = $this->auth_model->getUsersByStatus('rejected');
        $pending_users = $this->auth_model->getUsersByStatus('pending');
        // Count total users
        $totalUsers = $this->db->count_all('users');
        $totalAdmins = $this->db->count_all('admin');


        // Count total admins
        // Pass data to the view
        $data['totalUsers'] = $totalUsers;
        $data['totalAdmins'] = $totalAdmins;

        // Pass the data to the view
        $data['recentTasks'] = $recentTasks;
        $data['totalTask'] = $totalTask;
        $data['completedTasks'] = $completedTasks;
        $data['pendingTasks'] = $pendingTasks;
        $data['users'] = $users;
        $data['maleUsers'] = $maleUsers;
        $data['femaleUsers'] = $femaleUsers;
        $data['otherUsers'] = $otherUsers;
        $data['uploaded_files'] = $uploaded_files;  // All uploaded files are passed here
        $data['totalUploaded'] = $totalUploaded;
        $data['approvedFiles'] = $approvedFiles;
        $data['deniedFiles'] = $deniedFiles;
        $data['notifications'] = $notifications;
        $data['approved_files_by_day'] = $approved_files_by_day;
        $data['denied_files_by_day'] = $denied_files_by_day;
        $data['auditLogs'] = $this->admin_model->getAuditLogs();
        $data['approved_count'] = count($approved_users);
        $data['rejected_count'] = count($rejected_users);
        $data['pending_count'] = count($pending_users);
        $data['feedbacks'] = $this->auth_model->getFeedbackMessages(); // Get feedback from the model

        // Load the dashboard view
        $this->load->view('Homepage/dashboard', $data);
    }


    //! CREATE TASK
    public function processCreateTask()
    {
        $task_name = $this->input->post('task_name');
        $due_date = $this->input->post('due_date');
        $owner = $this->input->post('owner');
        $task_for = $this->input->post('task_for'); // Array of user IDs

        if (empty($task_for)) {
            redirect(base_url('conAdmin/tasks'));
            return;
        }

        // Handle "Select All" logic
        if (in_array('all', $task_for)) {
            $users = $this->auth_model->getUsers(); // Fetch all user IDs
            $task_for = array_column($users, 'id');
        }

        // Insert task for each selected user
        foreach ($task_for as $user_id) {
            $task_data = [
                'task_name' => $task_name,
                'owner' => $owner,
                'task_for' => $user_id,
                'status' => 'Not Started',
                'due_date' => $due_date,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->admin_model->createTask($task_data);
        }

        // Redirect to the dashboard
        redirect(base_url('conAdmin'));
    }


    public function rankingtask()
    {
        $admin_id = $this->session->userdata('admin_id');

        if (!$admin_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/admin_custom_access_denied', $data);
            return;
        }
        $this->admin_model->checkResetPoints();  // Add this line to trigger the reset check
        $data['rankings'] = $this->admin_model->getUserRankings();
        $data['users'] = $this->auth_model->getUsers(); // Fetch all users
        $data['notifications'] = $this->admin_model->getNotifications(); // Fetch notifications
        $data['reset_date'] = $this->admin_model->getResetDate(); // Get the reset date

        $this->load->view('adminHomepage/adminRankbyTask', $data);
    }


    public function setResetDate()
    {
        $reset_year = $this->input->post('reset_year');
        $reset_month = $this->input->post('reset_month');
        $admin_id = $this->session->userdata('admin_id'); // Get the current admin's ID

        // Store the reset year and month in the database or configuration file
        $reset_date = $reset_year . '-' . str_pad($reset_month, 2, '0', STR_PAD_LEFT) . '-01'; // e.g., 2026-01-01

        // Save the reset date to the database or config file
        $this->admin_model->saveResetDate($reset_date);

        // Log the action
        $message = "Set the yearly reset date to: $reset_date";
        $this->admin_model->insertAuditLog($admin_id, $message);

        // Respond with JSON for Toastify
        echo json_encode(['status' => 'success', 'message' => 'Yearly reset date set successfully.']);
    }


    public function resetRankPoints()
    {
        $user_id = $this->input->post('user_id');
        if (!$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'Please select a user first.']);
            return;
        }
        $admin_id = $this->session->userdata('admin_id'); // Get the current admin's ID

        if ($user_id === 'all') {
            // Reset points for all users
            $this->db->set('points', 0);
            $result = $this->db->update('users');
            $message = "Rank points reset to 0 for all users.";
        } else {
            // Reset points for a specific user
            $this->db->set('points', 0);
            $this->db->where('id', $user_id);
            $result = $this->db->update('users');
            $user = $this->db->get_where('users', ['id' => $user_id])->row();
            $message = "Rank points reset to 0 for user: " . htmlspecialchars($user->username);
        }

        // Log the action
        $this->admin_model->insertAuditLog($admin_id, $message);

        // Respond with JSON for Toastify
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Rank points reset successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to reset rank points.']);
        }
    }
    public function resetSpecificPoints()
    {
        $user_id = $this->input->post('user_id');
        if (!$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'Please select a user first.']);
            return;
        }
        $user_id = $this->input->post('user_id');
        $points_to_reset = $this->input->post('points_to_reset');
        $admin_id = $this->session->userdata('admin_id'); // Get the current admin's ID

        if (empty($points_to_reset) || $points_to_reset <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Please specify a valid number of points to reset.']);
            return;
        }

        if ($user_id === 'all') {
            // Decrease points for all users
            $this->db->set('points', "GREATEST(points - $points_to_reset, 0)", FALSE);
            $result = $this->db->update('users');
            $message = "Reduced $points_to_reset points for all users.";
        } else {
            // Decrease points for a specific user
            $this->db->set('points', "GREATEST(points - $points_to_reset, 0)", FALSE);
            $this->db->where('id', $user_id);
            $result = $this->db->update('users');
            $user = $this->db->get_where('users', ['id' => $user_id])->row();
            $message = "Reduced $points_to_reset points for user: " . htmlspecialchars($user->username);
        }

        // Log the action
        $this->admin_model->insertAuditLog($admin_id, $message);

        // Respond with JSON for Toastify
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Points reset successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to reset points.']);
        }
    }
    public function addPointsToUser()
    {
        $user_id = $this->input->post('user_id');
        if (!$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'Please select a user first.']);
            return;
        }
        $user_id = $this->input->post('user_id');
        $points = $this->input->post('points');
        $admin_id = $this->session->userdata('admin_id'); // Get the current admin's ID

        if (!empty($points)) {
            if ($user_id === 'all') {
                // Apply points to all users
                $this->db->set('points', 'points + ' . (int) $points, FALSE);
                $result = $this->db->update('users');
                $message = "Added $points points for all users.";
            } else {
                // Apply points to a specific user
                $this->db->set('points', 'points + ' . (int) $points, FALSE);
                $this->db->where('id', $user_id);
                $result = $this->db->update('users');
                $user = $this->db->get_where('users', ['id' => $user_id])->row();
                $message = "Added $points points for user: " . htmlspecialchars($user->username);
            }

            // Log the action
            $this->admin_model->insertAuditLog($admin_id, $message);

            // Respond with JSON for Toastify
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Points added successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to add points.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Points are required.']);
        }
    }


    //conadmin
    public function userRequirements()
    {
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/custom_access_denied', $data);
            return;  // 🛑 Stop execution if not logged in
        }
        // Fetch uploaded files for the logged-in user
        $uploaded_files = $this->db->get_where('userrequirements', ['user_id' => $user_id])->result_array();

        // Separate files by type (General, Mandatory, Yearly)
        $generalFiles = array_filter($uploaded_files, function ($file) {
            return strpos($file['file_path'], 'requirements') !== false && strpos($file['file_path'], 'mandatory_requirements') === false;
        });

        $mandatoryFiles = array_filter($uploaded_files, function ($file) {
            return strpos($file['file_path'], 'mandatory_requirements') !== false;
        });

        $yearlyFiles = array_filter($uploaded_files, function ($file) {
            return strpos($file['file_path'], 'yearly_requirements') !== false;
        });

        // Count the total number of uploaded, approved, and pending files per category
        $totalGeneral = count($generalFiles);
        $approvedGeneral = count(array_filter($generalFiles, function ($file) {
            return $file['status'] == 'approved';
        }));

        $totalMandatory = count($mandatoryFiles);
        $approvedMandatory = count(array_filter($mandatoryFiles, function ($file) {
            return $file['status'] == 'approved';
        }));

        $totalYearly = count($yearlyFiles);
        $approvedYearly = count(array_filter($yearlyFiles, function ($file) {
            return $file['status'] == 'approved';
        }));

        // Calculate progress (based on the approved files count)
        $generalProgress = ($totalGeneral > 0) ? ($approvedGeneral / $totalGeneral) * 100 : 0;
        $mandatoryProgress = ($totalMandatory > 0) ? ($approvedMandatory / $totalMandatory) * 100 : 0;
        $yearlyProgress = ($totalYearly > 0) ? ($approvedYearly / $totalYearly) * 100 : 0;

        // Pass the data to the view
        $data['generalProgress'] = $generalProgress;
        $data['mandatoryProgress'] = $mandatoryProgress;
        $data['yearlyProgress'] = $yearlyProgress;

        $data['general_file_types'] = $this->db->get_where('file_types', ['category' => 'General', 'status' => 'approved'])->result_array();
        $data['mandatory_file_types'] = $this->db->get_where('file_types', ['category' => 'Mandatory', 'status' => 'approved'])->result_array();
        $data['yearly_file_types'] = $this->db->get_where('file_types', ['category' => 'Yearly', 'status' => 'approved'])->result_array();

        // Fetch total uploaded files (this includes all categories)
        $totalUploaded = count($uploaded_files);
        $pendingFiles = $this->db->where(['user_id' => $user_id, 'status' => 'pending'])->count_all_results('userrequirements');
        $approvedFiles = $this->db->where(['user_id' => $user_id, 'status' => 'approved'])->count_all_results('userrequirements');

        // Calculate overall progress (based on the approved files count)
        $progress = ($totalUploaded > 0) ? ($approvedFiles / $totalUploaded) * 100 : 0;

        // Fetch notifications for the user (unread notifications only)
        $notifications = $this->db->get_where('notifications', ['user_id' => $user_id, 'status' => 'unread'])->result_array();

        $uploaded_files = $this->db->get_where('userrequirements', ['user_id' => $user_id])->result_array();

        // Add points to each file based on its file_type
        foreach ($uploaded_files as &$file) {
            $file_type = $file['file_type'];
            // Get points from the file_types table
            $file_type_data = $this->db->get_where('file_types', ['type_name' => $file_type])->row_array();
            $file['points'] = $file_type_data ? $file_type_data['points'] : 0;  // Default points to 0 if not found
        }






        // Pass the data to the view
        $data['uploaded_files'] = $uploaded_files;
        $data['totalUploaded'] = $totalUploaded;
        $data['pendingFiles'] = $pendingFiles;
        $data['approvedFiles'] = $approvedFiles;
        $data['progress'] = $progress;
        $data['notifications'] = $notifications;

        // Load the view
        $this->load->view('Homepage/user_requirements', $data);
    }



    public function markNotificationsRead()
    {
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            return;
        }

        // Update all unread notifications to 'read'
        $this->db->where(['user_id' => $user_id, 'status' => 'unread']);
        $this->db->update('notifications_requirements', ['status' => 'read']);

        $this->db->where(['user_id' => $user_id, 'status' => 'unread']);
        $this->db->update('notifications_faculty_rankup', ['status' => 'read']);

        $this->db->where(['user_id' => $user_id, 'status' => 'unread']);
        $this->db->update('notification_message_the_user', ['status' => 'read']);

        // Get the number of remaining unread notifications
        $unread_notifications = $this->db
            ->where(['user_id' => $user_id, 'status' => 'unread'])
            ->count_all_results('notifications_requirements') +
            $this->db->where(['user_id' => $user_id, 'status' => 'unread'])
                ->count_all_results('notifications_faculty_rankup') +
            $this->db->where(['user_id' => $user_id, 'status' => 'unread'])
                ->count_all_results('notification_message_the_user');

        // Respond with success
        echo json_encode([
            'status' => 'success',
            'unread_notifications' => $unread_notifications
        ]);
    }

    public function getrequirementNotification()
    {
        $user_id = $this->session->userdata('user_id');

        // Ensure user is logged in
        if (!$user_id) {
            show_error("User not logged in or session expired.", 403, "Access Denied");
            return;
        }

        // Fetch unread notifications
        $notifications = $this->db->get_where('notifications_requirements', ['user_id' => $user_id, 'status' => 'unread'])->result_array();

        // Send notifications as a JSON response
        echo json_encode(['notifications' => $notifications]);
    }
    public function deleteAll_ViewHome_Notifications()
    {
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'User not logged in'
            ]);
            return;
        }

        // Delete all notifications from all related tables
        $this->db->where('user_id', $user_id)->delete('notifications_requirements');
        $this->db->where('user_id', $user_id)->delete('notifications_faculty_rankup');
        $this->db->where('user_id', $user_id)->delete('notification_message_the_user'); // Added this line

        echo json_encode([
            'status' => 'success',
            'message' => 'All notifications deleted.'
        ]);
    }



    public function delete_viewhome_notifications()
    {
        $user_id = $this->session->userdata('user_id');

        // Get the raw POST data
        $input = json_decode($this->input->raw_input_stream, true);
        $notification_id = $input['notification_id'] ?? null;
        $notification_type = $input['notification_type'] ?? 'requirements'; // Default to 'requirements'

        if (!$user_id || !$notification_id) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
            return;
        }

        // Determine the table based on the notification type
        $table = ($notification_type == 'rankup') ? 'notifications_rankup' : 'notifications_requirements';

        // Delete the notification from the appropriate table
        $this->db->where('id', $notification_id)->where('user_id', $user_id);
        $this->db->delete($table);

        // Fetch the updated list of unread notifications for the selected type
        $notifications = $this->db->get_where($table, ['user_id' => $user_id, 'status' => 'unread'])->result_array();

        // Prepare the updated HTML for the notification dropdown
        $updated_html = '';
        foreach ($notifications as $notification) {
            $updated_html .= '<li class="bg-gray-100 p-2 mb-2 rounded flex justify-between items-center">
                                <div>
                                    <p>' . htmlspecialchars($notification['message']) . '</p>
                                    <p class="text-sm text-gray-500">' . date('F j, Y, g:i a', strtotime($notification['created_at'])) . '</p>
                                </div>
                                <button onclick="deleteNotification(' . $notification['id'] . ', \'' . $notification_type . '\')" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </li>';
        }

        // Count remaining unread notifications
        $unread_notifications = count($notifications);

        // Send the updated HTML and notification count back to the frontend
        echo json_encode([
            'status' => 'success',
            'updated_html' => $updated_html,
            'unread_notifications' => $unread_notifications
        ]);
    }




    //! APPROVE DENY
    public function updateFileStatus()
    {
        $file_id = $this->input->post('file_id');
        $status = $this->input->post('status');

        if ($file_id && in_array($status, ['approved', 'denied'])) {
            // Get the current file details before update
            $file = $this->db->get_where('userrequirements', ['id' => $file_id])->row_array();
            if ($file) {
                $old_status = $file['status'];

                // Update the file status
                $this->db->where('id', $file_id);
                $this->db->update('userrequirements', ['status' => $status, 'updated_at' => date('Y-m-d H:i:s')]);

                // Log the status change action
                $this->insertAuditLog("Updated file (ID: {$file_id}) status from '{$old_status}' to '{$status}'");

                // Get the file details and user ID
                $user_id = $file['user_id'];
                $file_type = $file['file_type'];

                // Update user points if approved
                if ($status == 'approved') {
                    $file_type_data = $this->db->get_where('file_types', ['type_name' => $file_type])->row_array();
                    $points = $file_type_data['points'] ?? 0;

                    // Log the points update
                    $this->insertAuditLog("Granted {$points} points to user (ID: {$user_id}) for file type '{$file_type}'");

                    $this->db->set('points', 'points + ' . number_format((float) $points, 2, '.', ''), false);
                    $this->db->where('id', $user_id);
                    $this->db->update('users');
                }

                // Create a notification
                $message = "Your " . ucfirst($file_type) . " file has been " . $status . ".";
                $this->db->insert('notifications_requirements', [
                    'user_id' => $user_id,
                    'message' => $message,
                    'status' => 'unread',
                ]);

                echo json_encode(['status' => 'success', 'message' => "File has been $status and notification sent."]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'File not found.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input or action.']);
        }
    }

    public function adminUserRequirements()
    {
        $admin_id = $this->session->userdata('admin_id');

        if (!$admin_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/admin_custom_access_denied', $data);
            return;
        }
        // Fetch all approved file types
        $data['approved_file_types'] = $this->db->get_where('file_types', ['status' => 'approved'])->result_array();
        $data['pending_file_types'] = $this->db->get_where('file_types', ['status' => 'pending'])->result_array();

        // Fetch all users (without their uploaded files)
        $this->db->select('id as user_id, username');
        $data['users'] = $this->db->get('users')->result_array();

        // Fetch uploaded files for each user
        foreach ($data['users'] as &$user) {
            $user['uploaded_files'] = $this->db->get_where('userrequirements', ['user_id' => $user['user_id']])->result_array();
        }

        $this->load->view('adminHomepage/admin_user_requirements', $data);
    }


    public function getFileTypes()
    {
        $file_types = $this->db->get('file_types')->result_array();

        // Log the action of retrieving file types
        $this->insertAuditLog("Retrieved file types list.");

        echo json_encode($file_types);
    }

    public function bulkUpdateFileTypeStatus()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $ids = $data['ids'] ?? [];
        $status = $data['status'] ?? '';

        if (empty($ids) || !in_array($status, ['approved', 'rejected', 'pending'])) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
            return;
        }

        // Perform the bulk update
        $this->db->where_in('id', $ids)->update('file_types', ['status' => $status]);

        // Log the bulk update action
        $this->insertAuditLog("Bulk updated file types (IDs: " . implode(", ", $ids) . ") to status: {$status}");

        echo json_encode(['status' => 'success', 'message' => 'Selected file types updated successfully.']);
    }
    public function bulkDeleteFileType()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $ids = $data['ids'] ?? [];

        if (empty($ids)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
            return;
        }

        // Perform the bulk deletion
        $this->db->where_in('id', $ids)->delete('file_types');

        // Log the bulk deletion action
        $this->insertAuditLog("Bulk deleted file types (IDs: " . implode(", ", $ids) . ")");

        echo json_encode(['status' => 'success', 'message' => 'Selected file types deleted successfully.']);
    }

    public function addFileType()
    {
        $category = $this->input->post('category');
        $type_name = $this->input->post('type_name');
        $points = $this->input->post('points');

        if (!$category || !$type_name) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
            exit;
        }

        $data = [
            'category' => $category,
            'type_name' => $type_name,
            'points' => $points,
            'status' => 'pending' // Default status
        ];

        $this->db->insert('file_types', $data);

        // ✅ Log the action
        $this->insertAuditLog("Added new file type: {$type_name} (Category: {$category}, Points: {$points})");

        echo json_encode(['status' => 'success', 'message' => 'File type added successfully and is pending approval.']);
    }

    public function deleteFileType()
    {
        $id = $this->input->post('id');

        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
            return;
        }

        // Get the file type before deleting (for logging)
        $file_type = $this->db->get_where('file_types', ['id' => $id])->row();

        if (!$file_type) {
            echo json_encode(['status' => 'error', 'message' => 'File type not found.']);
            return;
        }

        // Delete the file type from the database
        $this->db->where('id', $id)->delete('file_types');

        // ✅ Log the action
        $this->insertAuditLog("Deleted file type: {$file_type->type_name} (ID: $id)");

        echo json_encode(['status' => 'success', 'message' => 'File type deleted successfully.']);
    }

    public function updateFileTypeStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status'); // 'approved', 'rejected', 'pending', or 'remove_from_approve'

        // Validate the id and status
        if (!$id || !in_array($status, ['approved', 'rejected', 'pending', 'remove_from_approve'])) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
            return;
        }

        // Get current file type information
        $file_type = $this->db->get_where('file_types', ['id' => $id])->row();

        if (!$file_type) {
            echo json_encode(['status' => 'error', 'message' => 'File type not found.']);
            return;
        }

        // Update the status in the database
        // If the status is 'remove_from_approve', update the status to 'pending'
        if ($status === 'remove_from_approve') {
            $this->db->where('id', $id)->update('file_types', ['status' => 'pending']);
        } else {
            $this->db->where('id', $id)->update('file_types', ['status' => $status]);
        }

        // ✅ Log the action
        $this->insertAuditLog("Updated file type status: {$file_type->type_name} (ID: $id) to {$status}");

        echo json_encode(['status' => 'success', 'message' => 'File type status updated successfully.']);
    }


    public function sendFileNotification()
    {
        $user_id = $this->input->post('user_id');
        $file_type = $this->input->post('file_type');

        if (!$user_id || !$file_type) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
            return;
        }

        // Get the user's information
        $user = $this->db->get_where('users', ['id' => $user_id])->row();

        if (!$user) {
            echo json_encode(['status' => 'error', 'message' => 'User not found.']);
            return;
        }

        $username = $user->username;

        // Save the notification in the database
        $data = [
            'user_id' => $user_id,
            'message' => "You need to upload your {$file_type} file.",
            'status' => 'unread',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('notifications_requirements', $data);

        // ✅ Log the action
        $this->insertAuditLog("Sent file upload notification to user: {$username} (User ID: $user_id) for {$file_type}");

        echo json_encode(['status' => 'success', 'message' => "{$username} has been notified to submit {$file_type}."]);
    }



    public function uploadFile($inputFileName, $directory)
    {
        $user_id = $this->session->userdata('user_id'); // Retrieve user ID from session

        if (!$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
            exit;
        }

        // Validate if file exists
        if (!isset($_FILES[$inputFileName]) || $_FILES[$inputFileName]['error'] != 0) {
            echo json_encode(['status' => 'error', 'message' => 'No file uploaded or upload error.']);
            exit;
        }

        // Get the original file name and sanitize
        $fileName = $_FILES[$inputFileName]['name'];
        $fileName = preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $fileName); // Only replace special characters, not spaces


        if (strlen($fileName) > 30) {
            echo json_encode(['status' => 'error', 'message' => 'File name exceeds the 30-character limit.']);
            exit;
        }

        // Get file type from the form
        $fileType = $this->input->post('file_type');

        // Set correct upload path based on requirement type
        $uploadPath = './uploads/' . $directory;
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
        $config['max_size'] = 2048; // 2MB limit
        $config['file_name'] = time() . '_' . $fileName;

        // Load upload library
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($inputFileName)) {
            echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
            exit;
        } else {
            // File upload successful, save to DB
            $fileData = $this->upload->data();
            $data = [
                'user_id' => $user_id,
                'file_name' => $fileData['file_name'],
                'file_path' => 'uploads/' . $directory . '/' . $fileData['file_name'],
                'file_type' => $fileType,
                'status' => 'pending',
                'uploaded_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('userrequirements', $data);
            echo json_encode(['status' => 'success', 'message' => 'File uploaded successfully!']);
            exit;
        }
    }

    // Upload paths
    public function uploadGeneralFile()
    {
        $this->uploadFile('requirements_file', 'requirements');
    }

    public function uploadMandatoryRequirementFile()
    {
        $this->uploadFile('requirements', 'mandatory_requirements'); // Fixed directory
    }

    public function uploadYearlyFile()
    {
        $this->uploadFile('requirements', 'yearly_requirements'); // Fixed directory
    }








    public function deleteFile()
    {
        $file_id = $this->input->post('file_id');

        if ($file_id) {
            // Get file details to delete the physical file
            $file = $this->db->get_where('userrequirements', ['id' => $file_id])->row_array();
            if ($file) {
                $file_path = './' . $file['file_path'];

                // Log the file deletion before actually deleting it
                $this->insertAuditLog("Deleted file (ID: {$file_id}, Path: {$file_path})");

                if (file_exists($file_path)) {
                    unlink($file_path); // Delete the file from the server
                }

                // Delete the record from the database
                $this->db->where('id', $file_id);
                $this->db->delete('userrequirements');

                echo json_encode(['status' => 'success', 'message' => 'File has been deleted.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'File not found.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid file ID.']);
        }
    }

    public function requirementstatus()
    {
        // Retrieve user ID from the session
        $user_id = $this->session->userdata('user_id'); // Assuming user ID is stored in session

        // Ensure the user is logged in
        if (!$user_id) {
            show_error("User not logged in.", 403, "Access Denied");
            return;
        }

        // Fetch only the uploaded tasks for the current user
        $uploaded_tasks = $this->admin_model->getUploadedTasksByUser($user_id); // Modify to fetch tasks specific to the logged-in user

        // Map uploaded tasks to their corresponding statuses
        foreach ($uploaded_tasks as &$file) {
            $task = $this->admin_model->getTaskById($file['task_id']); // Assuming this method exists
            $file['status'] = $task['status'] ?? 'Unknown';
        }

        // Fetch the user's progress
        $users = $this->auth_model->getUsers(); // Assuming this function gets all users
        foreach ($users as &$user) {
            $userId = $user['id']; // Assuming you have an 'id' field for users
            $totalFiles = $this->db->where('user_id', $userId)->count_all_results('userrequirements');
            $approvedCount = $this->db->where(['user_id' => $userId, 'status' => 'approved'])->count_all_results('userrequirements');
            $user['progress'] = ($totalFiles > 0) ? ($approvedCount / $totalFiles) * 100 : 0; // Calculate progress
        }

        // Fetch the uploaded files for the logged-in user
        $uploaded_files = $this->db->get_where('userrequirements', ['user_id' => $user_id])->result_array();

        // Fetch notifications for the user (unread notifications only)
        $notifications = $this->db->get_where('notifications', ['user_id' => $user_id])->result_array();

        // Pass the data to the view
        $data['uploaded_tasks'] = $uploaded_tasks;
        $data['uploaded_files'] = $uploaded_files;
        $data['notifications'] = $notifications;
        $data['users'] = $users;  // Ensure $users is passed to the view

        // Load the view
        $this->load->view('Homepage/requirement_status', $data);
    }

    // Delete a specific notification by ID
    public function deleteRequirement_statusNotification($id)
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
            return;
        }

        $this->db->where(['id' => $id, 'user_id' => $user_id]);
        $this->db->delete('notifications');

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Notification deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Notification not found or could not be deleted.']);
        }

    }
    public function deleteTaskbyUploadedTask($taskId)
    {
        // Ensure the user is logged in and has permission
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
            return;
        }

        // Verify that the task exists before attempting to delete it
        $this->db->where('id', $taskId);
        $query = $this->db->get('user_uploadedtask');

        if ($query->num_rows() == 0) {
            echo json_encode(['status' => 'error', 'message' => 'Task not found.']);
            return;
        }

        // Delete the task
        $this->db->where('id', $taskId);
        $this->db->delete('user_uploadedtask');

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Task deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete task.']);
        }
    }

    // Delete all notifications for the logged-in user
    public function deleteAllRequirement_statusNotifications()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
            return;
        }

        $this->db->where('user_id', $user_id);
        $this->db->delete('notifications');

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'All notifications deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No notifications to delete.']);
        }
    }




    public function userfiles()
    {
        $admin_id = $this->session->userdata('admin_id');

        if (!$admin_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/admin_custom_access_denied', $data);
            return;
        }
        $users = $this->auth_model->getUsers(); // Fetch total users
        $uploaded_files = $this->db->get('userrequirements')->result_array();
        $notifications = $this->admin_model->getNotifications(); // Fetch notifications

        foreach ($uploaded_files as &$file) {
            $file_type = $file['file_type'];
            // Get points from the file_types table
            $file_type_data = $this->db->get_where('file_types', ['type_name' => $file_type])->row_array();
            $file['points'] = $file_type_data ? $file_type_data['points'] : 0;  // Default points to 0 if not found
        }



        $data['uploaded_files'] = $uploaded_files;
        $data['users'] = $users;
        $data['notifications'] = $notifications; // Pass notifications
        $this->load->view('adminHomepage/UserUploadedFiles', $data);
    }
    public function sendMessage()
    {
        // Ensure admin is logged in
        $admin_id = $this->session->userdata('admin_id');
        if (!$admin_id) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
            return;
        }

        // Get input
        $user_id = $this->input->post('user_id');
        $message = $this->input->post('message');

        // Validate message
        if (empty(trim($message))) {
            echo json_encode(['status' => 'error', 'message' => 'Message cannot be empty.']);
            return;
        }

        // Insert message into the database
        $notification_data = [
            'user_id' => $user_id,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s'),
            'status' => 'unread'
        ];

        $this->db->insert('notification_message_the_user', $notification_data);

        // Count unread notifications
        $this->db->where(['user_id' => $user_id, 'status' => 'unread']);
        $unread_notifications = $this->db->count_all_results('notification_message_the_user');

        // ✅ Log the action
        $user = $this->db->select('username')->where('id', $user_id)->get('users')->row();
        $username = $user ? $user->username : "User ID: {$user_id}";

        $this->insertAuditLog("Sent message to {$username}: '{$message}'");

        // Return JSON response
        echo json_encode([
            'status' => 'success',
            'message' => 'Message sent successfully!',
            'unread_notifications' => $unread_notifications
        ]);
    }


    public function bulkUpdateFileStatus()
    {
        $file_ids = $this->input->post('file_ids');
        $status = $this->input->post('status');

        if ($file_ids && in_array($status, ['approved', 'denied'])) {
            $filesNotUpdated = [];
            $updatedFiles = [];

            foreach ($file_ids as $file_id) {
                // Check if the file exists
                $file = $this->db->get_where('userrequirements', ['id' => $file_id])->row_array();

                if (!$file) {
                    $filesNotUpdated[] = $file_id;
                    continue;
                }

                // Prevent invalid status changes
                if (($file['status'] == 'denied' && $status == 'approved') || ($file['status'] == 'approved' && $status == 'denied')) {
                    $filesNotUpdated[] = $file_id;
                    continue;
                }

                // Update file status and track updated files
                $this->db->where('id', $file_id)->update('userrequirements', [
                    'status' => $status,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                $updatedFiles[] = $file;

                // Increment user points if approving a pending file
                if ($status == 'approved' && $file['status'] == 'pending') {
                    $user_id = $file['user_id'];
                    $file_type = $file['file_type'];

                    $file_type_data = $this->db->get_where('file_types', ['type_name' => $file_type])->row_array();
                    $points = (float) ($file_type_data['points'] ?? 0.00);

                    $this->db->set('points', 'points + ' . number_format($points, 2, '.', ''), false)
                        ->where('id', $user_id)
                        ->update('users');
                }
            }

            // ✅ Log the action
            if (!empty($updatedFiles)) {
                $fileNames = implode(', ', array_map(function ($file) {
                    return "{$file['file_type']} (ID: {$file['id']})";
                }, $updatedFiles));
                $this->insertAuditLog("Bulk updated file statuses to '{$status}' for files: {$fileNames}");
            }

            // Provide feedback
            if (count($filesNotUpdated) > 0) {
                echo json_encode(['status' => 'success', 'message' => ucfirst($status) . ' all selected files. However, some files were already updated and were not modified.', 'files_not_updated' => $filesNotUpdated]);
            } else {
                echo json_encode(['status' => 'success', 'message' => ucfirst($status) . ' all selected files.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
        }
    }




    public function bulkDeleteFiles()
    {
        $file_ids = $this->input->post('file_ids');

        if ($file_ids) {
            // Get the file details for logging before deletion
            $files = $this->db->where_in('id', $file_ids)->get('userrequirements')->result_array();

            if (empty($files)) {
                echo json_encode(['status' => 'error', 'message' => 'Files not found.']);
                return;
            }

            // Delete the selected files
            $this->db->where_in('id', $file_ids)->delete('userrequirements');

            // ✅ Log the deleted files
            $fileDetails = implode(', ', array_map(function ($file) {
                return "{$file['file_type']} (ID: {$file['id']})";
            }, $files));
            $this->insertAuditLog("Bulk deleted files: {$fileDetails}");

            echo json_encode(['status' => 'success', 'message' => 'Deleted all selected files.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No files selected for deletion.']);
        }
    }





}