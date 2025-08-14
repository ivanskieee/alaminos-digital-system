<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/frontpage.css?v=' . filemtime('assets/css/frontpage.css')) ?>">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="icon" type="image/png" href="<?= base_url('uploads/page_icon/authentication4.jpg') ?>">

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-image: url('<?= base_url("assets/login_image/login_background3.jpg"); ?>');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    }

    .relative {
      display: flex;
      flex-direction: column;
    }

    .relative input {
      padding-right: 2.5rem;
    }

    .relative i {
      position: absolute;
      right: 10px;
      bottom: 50%;
      transform: translateY(50%);
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
    class="w-full max-w-md p-6 bg-white bg-opacity-20 backdrop-blur-md rounded-lg shadow-lg  absolute mt-[-30px] ml-[30px]">
    <!-- <div class="flex justify-center">
      <img src="<?= base_url('/design/images/SPClogo.png') ?>" alt="SPC Logo" class="w-20 h-20 rounded-lg">
    </div> -->
    <h2 class="text-2xl font-bold text-center text-green-900 uppercase text-sm mt-4">USER LOGIN</h2>

    <form id="login-form" method="post" action="<?= base_url('auth/viewlogin'); ?>">
      <!-- Email -->
      <div class="relative mb-4">
        <label class="block text-green-700 tracking-wider uppercase text-xs font-bold mb-1">Email</label>
        <div class="relative flex items-center">
          <input type="email" id="email" name="email"
            class="w-full px-4 py-2 border text-sm rounded-lg focus:ring-2 focus:ring-green-500 pr-10"
            placeholder="Enter email" required>
          <i class="fa-solid fa-envelope absolute right-3 text-green-200"></i>
        </div>
        <span id="email-error" class="error-text"></span>
      </div>

      <!-- Password -->
      <div class="relative mb-4">
        <label class="block text-green-700 tracking-wider uppercase text-xs font-bold mb-1">Password</label>
        <div class="relative flex items-center">
          <input type="password" id="password" name="password"
            class="w-full px-4 py-2 border text-sm rounded-lg focus:ring-2 focus:ring-green-500 pr-10"
            placeholder="Enter password" required>
          <i class="fa-solid fa-lock absolute right-3 text-green-200"></i>
        </div>
        <span id="password-error" class="error-text"></span>
      </div>

      <!-- Login Button -->
      <!-- Login Button -->
      <button type="submit"
        class="w-full py-2 mt-2 bg-green-100 hover:bg-green-200 text-green-700 font-semibold rounded-lg">
        Login
      </button>

      <!-- Forgot Password -->
      <div class="text-center mt-2">
        <a href="<?= base_url('auth/forgot_password_view') ?>"
          class="text-green-700 text-xs uppercase font-bold hover:underline">
          Forgot Password?
        </a>
      </div>
    </form>

    <div class="text-center mt-4">
      <a href="<?= base_url('auth/viewregister') ?>"
        class="text-green-700 font-bold text-xs uppercase hover:underline">Register</a> <text
        class="text-green-900">|</text>
      <a href="<?= base_url('auth/viewadmin') ?>"
        class="text-green-700 font-bold text-xs uppercase hover:underline">Login as Admin</a> <text
        class="text-green-900">|</text>
      <a href="<?= base_url('auth/contact') ?>"
        class="text-green-700 font-bold text-xs uppercase hover:underline">Contact</a>

      <text class="text-green-900">|</text>
      <a href="<?= base_url('auth') ?>" class="text-green-700 font-bold text-xs uppercase hover:underline">Entry
        Page</a>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Get flash message from PHP session
      const message = "<?= $this->session->flashdata('toast_message') ?>";
      const type = "<?= $this->session->flashdata('toast_type') ?>";

      if (message) {
        Toastify({
          text: message,
          duration: 3000,
          gravity: "top", // `top` or `bottom`
          position: "right", // `left`, `center` or `right`
          backgroundColor: type === "error" ? "linear-gradient(to right,rgb(14, 147, 127),rgb(16, 218, 157))" : "linear-gradient(to right,rgb(0, 13, 11),rgb(187, 26, 71))",
          stopOnFocus: true, // Prevents dismissing on hover
        }).showToast();
      }
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const emailInput = document.getElementById("email");
      const passwordInput = document.getElementById("password");
      const emailError = document.getElementById("email-error");
      const passwordError = document.getElementById("password-error");
      const form = document.getElementById("login-form");

      // Email Validation
      emailInput.addEventListener("input", function () {
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(emailInput.value.trim())) {
          emailError.textContent = "Please enter a valid email.";
        } else {
          emailError.textContent = "";
        }
      });

      // Password Validation
      passwordInput.addEventListener("input", function () {
        if (passwordInput.value.trim().length < 6) {
          passwordError.textContent = "Password must be at least 6 characters.";
        } else {
          passwordError.textContent = "";
        }
      });

      // Final Form Validation on Submit
      form.addEventListener("submit", function (event) {
        let valid = true;

        if (!emailInput.value.trim().match(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/)) {
          emailError.textContent = "Please enter a valid email.";
          valid = false;
        }

        if (passwordInput.value.trim().length < 6) {
          passwordError.textContent = "Password must be at least 6 characters.";
          valid = false;
        }

        if (!valid) {
          event.preventDefault(); // Stop form submission if validation fails
        }
      });
    });
  </script>

</body>

</html>