<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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


        $this->email_config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'erankingsystem@gmail.com',
            'smtp_pass' => 'xcgs aayk sabg smwd',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];



    }
    public function forgot_password_view()
    {
        $this->load->view('adminHomepage/forgot_password');
    }

    public function forgot_password()
    {
        $this->load->helper('string');
        $this->load->model('auth_model');

        $email = $this->input->post('email');
        $user = $this->auth_model->get_user_by_email($email);

        if ($user) {
            $token = random_string('alnum', 40);
            $this->auth_model->save_reset_token($user->id, $token);

            $reset_link = base_url("auth/reset_password/" . $token);

            $this->load->library('email', $this->email_config);
            $this->email->initialize($this->email_config);

            $this->email->from('erankingsystem@gmail.com', 'eRanking System');
            $this->email->to($email);
            $this->email->subject('eRanking System Password Reset Request');

            $message = "
            <div style='font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4; color: #333;'>
                <div style='max-width: 600px; margin: auto; background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);'>
                    <h2 style='text-align: center; color: #00695c;'>eRanking System</h2>
                    <p>Dear <strong>{$user->username}</strong>,</p>
            
                    <p>We have received a request to reset the password associated with this email address. If you did not request to reset your password, please ignore this email and no further action will be taken.</p>
            
                    <p>If you did make this request, you may reset your password using the secure link provided below. This link is valid for a limited time and will expire shortly for your protection:</p>
            
                    <div style='text-align: center; margin: 30px 0;'>
                        <a href='{$reset_link}' style='background-color: #009688; color: white; padding: 12px 24px; text-decoration: none; font-weight: bold; border-radius: 5px;'>Reset Password</a>
                    </div>
            
                    <p>If the button above doesn't work, please copy and paste the following URL into your browser:</p>
                    <p style='word-break: break-all; background-color: #f1f1f1; padding: 10px; border-left: 4px solid #009688;'>{$reset_link}</p>
            
                    <p>For your account's security, please do not share this email or reset link with anyone.</p>
            
                    <p>Thank you for using the eRanking System. If you have any questions or concerns, please contact our support team.</p>
            
                    <p style='margin-top: 40px;'>Sincerely,<br><strong>eRanking System Team</strong></p>
                </div>
            </div>";


            $this->email->message($message);

            if ($this->email->send()) {
                $this->session->set_flashdata('toast_success', 'Reset link has been sent to your Gmail address. Please check your inbox.');
            } else {
                $this->session->set_flashdata('toast_error', 'Failed to send the password reset email. Please try again or contact support.');
            }
        } else {
            $this->session->set_flashdata('toast_error', 'The provided email address was not found in our system.');
        }

        redirect('auth/forgot_password_view');
    }


    private function init_email()
    {
        $this->load->library('email', $this->email_config);
        $this->email->initialize($this->email_config);
    }

    public function reset_password($token = null)
    {
        // Check if token is provided
        if (!$token) {
            $data = [
                'error_title' => 'Invalid Token',
                'error_message' => 'The token you provided is invalid. Please try again.'
            ];
            $this->load->view('message_design/invalid_token', $data);
            return;
        }

        // Get user by token, including reset token expiry
        $user = $this->auth_model->get_user_by_token($token);

        // Check if user exists and the expiry field is available
        if (!$user || !isset($user->reset_token_expiry)) {
            $data = [
                'error_title' => 'Invalid Token',
                'error_message' => 'The token has either expired or does not exist. Please request a new one.'
            ];
            $this->load->view('message_design/invalid_token', $data);
            return;
        }

        // Check if token has expired (e.g., 1 hour expiry)
        $expiry_time = strtotime($user->reset_token_expiry);
        if (time() > $expiry_time) {
            $data = [
                'error_title' => 'Token Expired',
                'error_message' => 'The reset token has expired. Please request a new one.'
            ];
            $this->load->view('message_design/invalid_token', $data);
            return;
        }

        // Handle password reset submission
        if ($this->input->post('password')) {
            $password = $this->input->post('password');

            // Check if the password is at least 6 characters
            if (strlen($password) < 6) {
                $data = [
                    'error_title' => 'Password Too Short',
                    'error_message' => 'Password must be at least 6 characters long.'
                ];
                $this->load->view('message_design/invalid_token', $data);
                return;
            }

            // Hash the password and update it
            $password = password_hash($password, PASSWORD_BCRYPT);
            $this->auth_model->update_password($user->id, $password);

            // Optionally, invalidate the token after use
            $this->auth_model->invalidate_reset_token($user->id);

            // Set Toastify success message for password change
            $this->session->set_flashdata('toast_success', 'Your password has been successfully updated!');

            // Pass a flag to display the toast in the view
            $this->load->view('adminHomepage/reset_password_form', [
                'token' => $token,
                'toast_success' => true
            ]);
        } else {
            $this->load->view('adminHomepage/reset_password_form', ['token' => $token]);
        }
    }

    public function index()
    {
        // ✅ If admin is already logged in, redirect to dashboard
        if ($this->session->userdata('admin_id')) {
            redirect(base_url('conAdmin'));
            return;
        }
        if ($this->session->userdata('user_id')) {
            redirect(base_url('Home'));
            return;
        }
        $data['pending_users'] = $this->auth_model->getPendingUsers();
        $data['approved_users'] = $this->auth_model->getUsersByStatus('approved');
        $data['rejected_users'] = $this->auth_model->getUsersByStatus('rejected');
        $data['feedbacks'] = $this->auth_model->getFeedbackMessages(); // Get feedback from the model

        $this->load->view('forlogin/frontpage', $data);
    }

    private function insertAuditLog($action)
    {
        $admin_id = $this->session->userdata('admin_id'); // Get the currently logged-in admin ID
        if (!$admin_id) {
            return; // Prevent logging if admin is not found
        }

        $data = [
            'admin_id' => $admin_id,
            'action' => $action,
            'timestamp' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('audit_logs', $data);
    }






    public function manage_users()
    {
        $admin_id = $this->session->userdata('admin_id');

        if (!$admin_id) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/admin_custom_access_denied', $data);
            return;
        }
        $data['pending_users'] = $this->auth_model->getPendingUsers();
        $data['approved_users'] = $this->auth_model->getUsersByStatus('approved');
        $data['rejected_users'] = $this->auth_model->getUsersByStatus('rejected');


        $this->load->view('adminHomepage/approve_users_account', $data);
    }


    // Approve user method
    public function approve_user()
    {
        $user_id = $this->input->post('user_id');
        $user = $this->auth_model->getUserById($user_id);

        if ($user) {
            $this->auth_model->updateUserStatus($user_id, 'approved');

            // Send approval email
            $subject = "🎉 Congratulations! Your Account Has Been Approved!";
            $message = "
            <div style='font-family: Arial, sans-serif; padding: 20px; background-color: #f9f9f9;'>
                <div style='max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);'>
                    <h2 style='color: #4CAF50;'>🎉 Welcome, " . $user['username'] . "!</h2>
                    <p>We are excited to inform you that your account has been <strong style='color: #4CAF50;'>approved</strong>! You now have full access to our system.</p>
                    <h3>🚀 What's Next?</h3>
                    <ul>
                        <li>✔ Log in to your account and personalize your profile.</li>
                        <li>✔ Explore the dashboard and features tailored for you.</li>
                        <li>✔ Connect and collaborate with other members.</li>
                    </ul>
                    <p>Click the button below to log in:</p>
                    <a href='" . base_url('auth/login') . "' style='display: inline-block; background: #4CAF50; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px;'>🔑 Login Now</a>
                    <p style='margin-top: 20px;'>If you have any questions, feel free to contact us at <a href='mailto:erankingsystem@gmail.com'>erankingsystem@gmail.com</a>.</p>
                    <hr>
                    <p style='font-size: 12px; color: #777;'>Best Regards, <br> <strong>Human Resources of San Pablo Colleges</strong></p>
                </div>
            </div>
        ";
            $this->send_email($user['email'], $subject, $message);

            // Log Action
            $this->insertAuditLog("Approved user account (User ID: $user_id)");

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }


    // Reject user method
    // Reject user method
    public function reject_user()
    {
        $user_id = $this->input->post('user_id');
        $user = $this->auth_model->getUserById($user_id);

        if ($user) {
            $this->auth_model->updateUserStatus($user_id, 'rejected');

            // Send rejection email
            $subject = "🚨 Important Update: Your Account Registration";
            $message = "
            <div style='font-family: Arial, sans-serif; padding: 20px; background-color: #f9f9f9;'>
                <div style='max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);'>
                    <h2 style='color: #D32F2F;'>🚨 Hello, " . $user['username'] . ".</h2>
                    <p>We appreciate your interest in joining our platform. However, after reviewing your application, we regret to inform you that your account registration has been <strong style='color: #D32F2F;'>not approved</strong> at this time.</p>
                    <h3>🔎 Possible Reasons:</h3>
                    <ul>
                        <li>❌ Missing or incorrect information.</li>
                        <li>⚠️ Does not meet our platform's eligibility criteria.</li>
                        <li>📌 Other specific reasons.</li>
                    </ul>
                    <p>If you believe this was a mistake or would like to reapply, please review your details and submit a new request.</p>
                    <a href='" . base_url('auth/viewregister') . "' style='display: inline-block; background: #D32F2F; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px;'>📌 Reapply Here</a>
                    <p style='margin-top: 20px;'>For further inquiries, feel free to contact us at <a href='mailto:erankingsystem@gmail.com'>erankingsystem@gmail.com</a>.</p>
                    <hr>
                    <p style='font-size: 12px; color: #777;'>Best Regards, <br> <strong>Human Resources of San Pablo Colleges</strong></p>
                </div>
            </div>
        ";
            $this->send_email($user['email'], $subject, $message);

            // Log Action
            $this->insertAuditLog("Rejected user account (User ID: $user_id)");

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }




    // Move to pending
    public function move_to_pending()
    {
        $user_id = $this->input->post('user_id');
        $user = $this->auth_model->getUserById($user_id);

        if ($user) {
            $this->auth_model->updateUserStatus($user_id, 'pending');

            // ✅ Add audit log for this action
            $this->insertAuditLog("Moved user to pending (User ID: $user_id)");

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }


    // Approve admin method
    public function approve_admin()
    {
        $admin_id = $this->input->post('admin_id');

        if (!$admin_id) {
            echo json_encode(['status' => 'error', 'message' => 'Admin ID is missing']);
            return;
        }

        $admin = $this->model_superadmin->getAdminById($admin_id);

        if ($admin) {
            $this->model_superadmin->updateAdminStatus($admin_id, 'approved');

            // Send approval email
            $subject = "🎉 Congratulations! Your Admin Account Has Been Approved!";
            $message = "
        <div style='font-family: Arial, sans-serif; padding: 20px; background-color: #f9f9f9;'>
            <div style='max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);'>
                <h2 style='color: #4CAF50;'>🎉 Welcome Aboard, " . $admin['username'] . "!</h2>
                <p>We are pleased to inform you that your <strong style='color: #4CAF50;'>admin account</strong> has been successfully approved! You now have full access to the admin dashboard.</p>
                <h3>🚀 Next Steps:</h3>
                <ul>
                    <li>✔ Log in to the system and manage user registrations.</li>
                    <li>✔ Oversee and maintain system operations efficiently.</li>
                    <li>✔ Collaborate with other administrators for a seamless experience.</li>
                </ul>
                <p>Click the button below to access your admin dashboard:</p>
                <a href='" . base_url('auth/viewadmin') . "' style='display: inline-block; background: #4CAF50; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px;'>🔑 Access Admin Dashboard</a>
                <p style='margin-top: 20px;'>For any assistance, feel free to contact us at <a href='mailto:erankingsystem@gmail.com'>erankingsystem@gmail.com</a>.</p>
                <hr>
                <p style='font-size: 12px; color: #777;'>Best Regards, <br> <strong>Super Admin Team of San Pablo Colleges</strong></p>
            </div>
        </div>
        ";

            $this->send_email($admin['email'], $subject, $message);

            // Log Action
            $this->insertAuditLog("Approved admin account (Admin ID: $admin_id)");

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Admin not found']);
        }
    }




    public function reject_admin()
    {
        $admin_id = $this->input->post('admin_id');
        $admin = $this->model_superadmin->getAdminById($admin_id);

        if ($admin) {
            $this->model_superadmin->updateAdminStatus($admin_id, 'rejected');

            // Send rejection email
            $subject = "⚠️ Important Notice: Admin Registration Status";
            $message = "
            <div style='font-family: Arial, sans-serif; padding: 20px; background-color: #f9f9f9;'>
                <div style='max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);'>
                    <h2 style='color: #D32F2F;'>⚠️ Hello, " . $admin['username'] . ".</h2>
                    <p>Thank you for applying for an <strong>admin role</strong> in our system. After careful review, we regret to inform you that your request has been <strong style='color: #D32F2F;'>not approved</strong> at this time.</p>
                    <h3>🔎 Possible Reasons:</h3>
                    <ul>
                        <li>❌ Insufficient or incorrect details in the application.</li>
                        <li>⚠️ Does not meet the necessary criteria for an admin role.</li>
                        <li>📌 Other specific reasons related to eligibility.</li>
                    </ul>
                    <p>If you believe this was a mistake or you would like to reapply, please review your information and submit a new request.</p>
                    <a href='" . base_url('auth/viewregister') . "' style='display: inline-block; background: #D32F2F; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px;'>📌 Reapply Here</a>
                    <p style='margin-top: 20px;'>For further inquiries or clarifications, feel free to contact us at <a href='mailto:erankingsystem@gmail.com'>erankingsystem@gmail.com</a>.</p>
                    <hr>
                    <p style='font-size: 12px; color: #777;'>Best Regards, <br> <strong>Super Admin Team of San Pablo Colleges</strong></p>
                </div>
            </div>
            ";

            $this->send_email($admin['email'], $subject, $message);

            // Log Action
            $this->insertAuditLog("Rejected admin account (Admin ID: $admin_id)");

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Admin not found']);
        }
    }

    public function Admin_move_to_pending()
    {
        $admin_id = $this->input->post('admin_id');
        $admin = $this->model_superadmin->getAdminById($admin_id);

        if ($admin) {
            $this->model_superadmin->updateAdminStatus($admin_id, 'pending');
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Admin not found']);
        }
    }




    private function send_email($to, $subject, $message)
    {
        $this->load->library('email');
        $this->email->initialize($this->email_config); // ✅ Use saved email config

        $this->email->from('erankingsystem@gmail.com', 'HR ADMIN'); // Change sender email
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);


        if ($this->email->send()) {
            return true;
        } else {
            log_message('error', $this->email->print_debugger());
            return false;
        }
    }








    public function contact()
    {
        $this->load->view('forlogin/frontpage_contact');
    }


    public function feedback_contact()
    {
        $admin_id = $this->session->userdata('admin_id');
        $super_admin = $this->session->userdata('super_admin');

        // ✅ Allow Super Admin to access the dashboard
        if (!$admin_id && !$super_admin) {
            $data['title'] = "Access Denied";
            $this->load->view('errors/admin_custom_access_denied', $data);
            return;
        }
        $data['feedbacks'] = $this->auth_model->getFeedbackMessages(); // Get feedback from the model
        $this->load->view('adminHomepage/Feedback', $data); // Pass data to the view
    }


    public function login()
    {
        // ✅ If admin is already logged in, redirect to dashboard
        if ($this->session->userdata('admin_id')) {
            redirect(base_url('conAdmin'));
            return;
        }
        // If the user is already logged in, redirect to home
        if ($this->session->userdata('user_id')) {
            redirect(base_url('Home'));
            return;
        }
        $this->load->view('forlogin/viewlogin');
    }
    public function viewregister()
    {
        $this->load->view('forlogin/viewregister');
    }

    public function REGISTERorLOGIN()
    {
        $this->load->view('forlogin/REGISTERorLOGIN');
    }

    public function viewlogin()
    {
        // If the user is already logged in, redirect to home
        if ($this->session->userdata('user_id')) {
            redirect(base_url('Home'));
            return;
        }

        $data['error'] = '';

        if ($this->input->post('email') && $this->input->post('password')) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->auth_model->setlogin($email, $password);

            if ($user) {
                if ($user['status'] === 'approved') {
                    $this->session->set_userdata('user_id', $user['id']);
                    $this->session->set_userdata('username', $user['username']);
                    redirect(base_url('Home'));
                } else {
                    if ($user['status'] === 'rejected') {
                        $this->session->set_flashdata('toast_message', 'Your account has been rejected by the admin.');
                        $this->session->set_flashdata('toast_type', 'error');
                    } else {
                        $this->session->set_flashdata('toast_message', 'Your account is pending approval.');
                        $this->session->set_flashdata('toast_type', 'info');
                    }
                }
            } else {
                $this->session->set_flashdata('toast_message', 'Invalid email or password.');
                $this->session->set_flashdata('toast_type', 'error');
            }

            redirect(base_url('auth/login')); // Redirect back to login page
        }

        $this->load->view('forlogin/viewlogin');
    }




    public function register()
    {
        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('phoneNo', 'Phone Number', 'required|regex_match[/^\d{10,}$/]');
        $this->form_validation->set_rules('gender', 'Gender', 'required|in_list[Male,Female,Other]');
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[user,admin]');
        $this->form_validation->set_rules('birth_date', 'Birth Date', 'required|callback_validate_age');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $role = $this->input->post('role'); // Get role from form
        $email = $this->input->post('email');
        $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $data = [
            'username' => $this->input->post('username'),
            'email' => $email,
            'password' => $password,
            'address' => $this->input->post('address'),
            'phoneNo' => $this->input->post('phoneNo'),
            'gender' => $this->input->post('gender'),
            'birth_date' => $this->input->post('birth_date'),
        ];

        if ($role == 'admin') {
            // Check if admin email already exists
            if ($this->auth_model->getAdminByEmail($email)) {
                echo json_encode(['status' => 'error', 'message' => 'Admin email is already in use.']);
                return;
            }

            if ($this->auth_model->register_admin($data)) {
                echo json_encode(['status' => 'success', 'message' => 'Admin registration successful!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Admin registration failed.']);
            }
        } else {
            // Check if user email already exists
            if ($this->auth_model->getUserByEmail($email)) {
                echo json_encode(['status' => 'error', 'message' => 'User email is already in use.']);
                return;
            }

            $data['status'] = 'pending'; // Default status for users
            if ($this->auth_model->register($data)) {
                echo json_encode(['status' => 'success', 'message' => 'User registration successful! Waiting for admin approval.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'User registration failed.']);
            }
        }
    }
    public function validate_age($birth_date)
    {
        $birth_date = strtotime($birth_date);
        $current_date = strtotime(date('Y-m-d'));
        $age = date('Y', $current_date) - date('Y', $birth_date);

        if ($age < 18) {
            $this->form_validation->set_message('validate_age', 'You must be at least 18 years old.');
            return false;
        }
        return true;
    }








    public function aboutranking()
    {
        $this->load->view('forlogin/aboutranking');
    }

    public function viewadmin()
    {
        // ✅ If admin is already logged in, redirect to dashboard
        if ($this->session->userdata('admin_id')) {
            redirect(base_url('conAdmin'));
            return;
        }
        $this->load->view('Homepage/viewadmin');
    }
    public function adminlogin()
    {
        // ✅ Prevent logged-in admin from accessing the login form
        if ($this->session->userdata('admin_id')) {
            redirect(base_url('conAdmin'));
            return;
        }
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Super Admin Login
        if ($email === 'erankingsystem@gmail.com' && $password === '123123') {
            $this->session->set_userdata('super_admin', true);

            // ✅ Log Super Admin Login
            $this->insertAuditLog("Super Admin logged in (Email: $email)");

            redirect(base_url('controllerSuperAdmin'));
            return;
        }

        // Attempt login for regular admin
        $admin = $this->home_model->setadminlogin($email, $password);

        if ($admin) {
            // Check if admin is pending or rejected
            if ($admin['status'] == 'pending') {
                $this->session->set_flashdata('login_error', 'Your account is pending approval.');

                // ✅ Log pending admin login attempt
                $this->insertAuditLog("Failed login attempt - Pending admin (Email: $email)");

                redirect(base_url('auth/viewadmin'));
                return;
            } elseif ($admin['status'] == 'rejected') {
                $this->session->set_flashdata('login_error', 'Your account has been rejected.');

                // ✅ Log rejected admin login attempt
                $this->insertAuditLog("Failed login attempt - Rejected admin (Email: $email)");

                redirect(base_url('auth/viewadmin'));
                return;
            }

            // Approved login
            $this->session->set_userdata('admin_id', $admin['admin_id']);
            $this->session->set_userdata('admin_name', $admin['username']);

            // ✅ Log successful admin login
            $this->insertAuditLog("Admin logged in (Admin ID: {$admin['admin_id']}, Email: $email)");

            redirect(base_url('conAdmin'));
        } else {
            // Invalid credentials
            $this->session->set_flashdata('login_error', 'Invalid email or password.');

            // ✅ Log failed admin login attempt
            $this->insertAuditLog("Failed login attempt (Email: $email)");

            redirect(base_url('auth/viewadmin'));
        }
    }

    public function contact_submit()
    {
        // Form validation
        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('message', 'Your Message', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'All fields are required and must be valid.');
        } else {
            // Get the form data
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $message = $this->input->post('message');

            // Check if the email is registered
            $user = $this->auth_model->getUserByEmail($email);

            if (!$user) {
                $this->session->set_flashdata('error', 'You are not yet registered.');
            } else {
                // Save the contact message to the database
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'message' => $message,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $insertSuccess = $this->auth_model->saveContactMessage($data);
                if ($insertSuccess) {
                    $this->session->set_flashdata('success', 'Your message has been successfully sent.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to send the message.');
                }
            }
        }

        redirect(base_url('auth/contact'));
    }



    public function deleteFeedback($id)
    {
        // Check if feedback is successfully deleted
        if ($this->auth_model->deleteFeedbackById($id)) {
            // Insert the audit log entry for deleting feedback
            $this->insertAuditLog("Deleted feedback (ID: {$id})");

            echo json_encode(['status' => 'success', 'message' => 'Feedback deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete feedback']);
        }
    }






}



?>