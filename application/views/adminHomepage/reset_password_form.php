<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/png" href="<?= base_url('uploads/page_icon/authentication4.jpg') ?>">
    <!-- Toastify CSS & JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: url('<?= base_url("assets/login_image/login_background3.jpg"); ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .error-text {
            color: red;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900 bg-opacity-60">
    <div
        class="w-full max-w-md p-6 bg-white bg-opacity-20 backdrop-blur-md rounded-lg shadow-lg absolute mt-[-30px] ml-[30px]">
        <div class="flex justify-center mb-4">
            <img src="<?= base_url('/design/images/SPClogo.png') ?>" alt="SPC Logo" class="w-20 h-20 rounded-lg" />
        </div>
        <h2 class="text-2xl font-bold text-center text-green-900 uppercase text-sm">Reset Password</h2>

        <form method="post" action="<?= base_url('auth/reset_password/' . $token) ?>" class="space-y-4">
            <div class="relative">
                <label class="block text-green-700 tracking-wider uppercase text-xs font-bold mb-1">New Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border text-sm rounded-lg focus:ring-2 focus:ring-green-500"
                    placeholder="Enter new password" />
                <?php if (isset($toast_success) && $toast_success): ?>
                    <script>
                        // Display Toastify message
                        Toastify({
                            text: "<?= $this->session->flashdata('toast_success') ?>",
                            duration: 4000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "linear-gradient(to right, rgb(0, 0, 0), rgb(0, 255, 217))",
                            stopOnFocus: true,
                        }).showToast();

                        // Redirect after the toast is shown
                        setTimeout(function () {
                            window.location.href = "<?= base_url('auth/login') ?>"; // Redirect to the login page
                        }, 4000); // Time should match Toastify duration (4000ms)
                    </script>
                <?php endif; ?>

            </div>

            <button type="submit"
                class="w-full py-2 bg-green-100 hover:bg-green-200 text-green-700 font-semibold rounded-lg uppercase">Update
                Password</button>
        </form>

        <div class="text-center mt-4">
            <a href="<?= base_url('auth/login') ?>"
                class="text-green-700 font-bold text-xs uppercase hover:underline">Back to Login</a>
        </div>
    </div>
</body>

</html>