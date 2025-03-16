<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APPROVED ADMIN MESSAGE</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

    * {
        font-family: 'Poppins';
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
</style>

<body>
    <!-- File: application/views/approved_admin_message.php -->
    <div style="font-family: Arial, sans-serif; padding: 20px; background-color: #f9f9f9;">
        <div
            style="max-width: 700px; margin: auto; background: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);">
            <h2 style="color: #4CAF50; text-align: center;">🎉 Welcome Aboard, <?php echo $username; ?>!</h2>
            <p style="font-size: 16px; color: #333333;">
                We are absolutely thrilled to announce that your admin account has been <strong
                    style="color: #4CAF50;">approved</strong>!
                Your application was carefully reviewed and we found that your skills, experience, and passion are an
                exceptional match for our team.
            </p>
            <p style="font-size: 16px; color: #333333;">
                As part of our vibrant community of administrators, you will have access to advanced tools for managing
                registrations, maintaining system operations,
                and collaborating with our dedicated team. We are committed to supporting your journey every step of the
                way.
            </p>
            <h3 style="color: #4CAF50;">🚀 Your Next Steps:</h3>
            <ul style="font-size: 16px; color: #333333; line-height: 1.6;">
                <li>✔ <strong>Log In:</strong> Use your current credentials to access the admin dashboard.</li>
                <li>✔ <strong>Explore Features:</strong> Familiarize yourself with our powerful tools and resources
                    designed for efficient system management.</li>
                <li>✔ <strong>Join the Community:</strong> Engage with fellow administrators via our internal
                    communication channels.</li>
                <li>✔ <strong>Update Your Profile:</strong> Personalize your account by updating your profile
                    information and preferences.</li>
                <li>✔ <strong>Stay Informed:</strong> Keep an eye out for periodic updates, tips, and training materials
                    that will help you excel in your role.</li>
            </ul>
            <p style="text-align: center; margin: 20px 0;">
                <a href="<?php echo $dashboard_url; ?>"
                    style="background: #4CAF50; color: white; padding: 15px 25px; text-decoration: none; border-radius: 5px; font-size: 16px;">🔑
                    Access Admin Dashboard</a>
            </p>
            <p style="font-size: 14px; color: #666666; text-align: center;">
                If you encounter any issues or have any questions, please do not hesitate to contact our support team at
                <a href="mailto:<?php echo $support_email; ?>"><?php echo $support_email; ?></a>.
                We are here to ensure your transition is smooth and enjoyable.
            </p>
            <hr style="margin: 20px 0; border: none; border-top: 1px solid #e0e0e0;">
            <p style="font-size: 12px; color: #777777; text-align: center;">
                Best Regards,<br>
                <strong>Super Admin Team of San Pablo Colleges</strong><br>
                <small>
                    If you did not request this change, please contact our support team immediately at <a
                        href="mailto:<?php echo $support_email; ?>"><?php echo $support_email; ?></a>.
                </small>
            </p>
        </div>
    </div>

</body>

</html>



public function approve_admin()
    {
        // Retrieve the admin ID from the POST request
        $admin_id = $this->input->post('admin_id');

        // Validate the admin ID
        if (!$admin_id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Admin ID is missing. Please contact support if this issue persists.'
            ]);
            return;
        }

        // Fetch admin details from the database
        $admin = $this->model_superadmin->getAdminById($admin_id);
        if (!$admin) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Admin not found. The specified admin ID does not exist in our records.'
            ]);
            return;
        }

        // Check if the admin is already approved
        if (isset($admin['status']) && $admin['status'] === 'approved') {
            echo json_encode([
                'status' => 'error',
                'message' => 'This admin account has already been approved.'
            ]);
            return;
        }

        // Update the admin status to 'approved'
        $updateResult = $this->model_superadmin->updateAdminStatus($admin_id, 'approved');
        if (!$updateResult) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to update admin status. Please try again later or contact support.'
            ]);
            return;
        }

        // Build email subject
        $subject = "🎉 Congratulations! Your Admin Account Has Been Approved!";

        // Prepare data for the email template
        $data = [
            'username' => htmlspecialchars($admin['username']),
            'dashboard_url' => base_url('auth/viewadmin'),
            'support_email' => 'erankingsystem@gmail.com'
        ];

        // Load the email message design from the approved_admin_message.php view.
        // The third parameter TRUE returns the content as a string.
        $message = $this->load->view('GmailMessage/approved_admin_message', $data, TRUE);

        // Send the approval email
        $emailResult = $this->send_email($admin['email'], $subject, $message);
        if (!$emailResult) {
            // Log the failure of email sending
            $this->insertAuditLog("Admin approved (ID: $admin_id) but failed to send approval email.");
            echo json_encode([
                'status' => 'warning',
                'message' => 'Admin approved successfully, but we encountered an issue sending the email notification. Please check the email logs for more details.'
            ]);
            return;
        }

        // Log detailed action for auditing with IP and user agent details
        $ip_address = $this->input->ip_address();
        $user_agent = $this->input->user_agent();
        $log_message = "Approved admin account (Admin ID: $admin_id) from IP: $ip_address using $user_agent. Status updated to approved and notification email sent.";
        $this->insertAuditLog($log_message);

        // Trigger additional functionalities (e.g., update dashboard statistics, send push notifications, etc.)
        // Example: $this->model_superadmin->incrementAdminApprovalCount();
        // Example: $this->notifyExternalService('admin_approved', $admin_id);

        // Return a comprehensive success response with extra details
        echo json_encode([
            'status' => 'success',
            'message' => 'Admin account has been approved successfully. A detailed email with next steps and instructions has been sent to the admin. All system logs have been updated accordingly. Welcome to the team!',
            'admin_id' => $admin_id
        ]);
    }