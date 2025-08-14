<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password</title>
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
        <h2 class="text-2xl font-bold text-center text-green-900 uppercase text-sm">Forgot Password</h2>

        <p class="text-xs text-center text-green-800 mt-2 mb-4 px-2">
            Enter your Gmail address and we’ll send you a password reset link.
        </p>

        <form method="post" action="<?= base_url('auth/forgot_password') ?>" class="space-y-4">
            <div class="relative">
                <label class="block text-green-700 tracking-wider uppercase text-xs font-bold mb-1">Email</label>
                <div class="relative flex items-center">
                    <input type="email" name="email" required
                        class="w-full px-4 py-2 border text-sm rounded-lg focus:ring-2 focus:ring-green-500 pr-10"
                        placeholder="Enter your Gmail" />
                    <i class="fa-solid fa-envelope absolute right-3 text-green-200"></i>
                </div>
                <?php if ($this->session->flashdata('toast_success')): ?>
                    <script>
                        Toastify({
                            text: "<?= $this->session->flashdata('toast_success') ?>",
                            duration: 4000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "linear-gradient(to right,rgb(0, 0, 0),rgb(0, 255, 217))",
                            stopOnFocus: true,
                        }).showToast();
                    </script>
                <?php endif; ?>

                <?php if ($this->session->flashdata('toast_error')): ?>
                    <script>
                        Toastify({
                            text: "<?= $this->session->flashdata('toast_error') ?>",
                            duration: 4000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "linear-gradient(to right,rgb(84, 1, 37),rgb(217, 32, 152))",
                            stopOnFocus: true,
                        }).showToast();
                    </script>
                <?php endif; ?>

            </div>

            <button type="submit"
                class="w-full py-2 bg-green-100 hover:bg-green-200 text-green-700 font-semibold rounded-lg uppercase">
                Send Reset Link
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="<?= base_url('auth/login') ?>"
                class="text-green-700 font-bold text-xs uppercase hover:underline">Back to Login</a>
        </div>
    </div>
    <!-- Loading Screen Modal -->
    <div id="loadingModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg flex flex-col items-center space-y-4">
            <svg class="animate-spin h-10 w-10 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 11-8 8h4z"></path>
            </svg>
            <p class="text-green-700 font-semibold text-sm">Sending password reset link, please wait...</p>
        </div>
    </div>

    <script>
        const form = document.querySelector("form");
        const loadingModal = document.getElementById("loadingModal");

        form.addEventListener("submit", () => {
            loadingModal.classList.remove("hidden");
        });
    </script>

</body>

</html>