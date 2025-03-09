<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="<?= base_url('assets/css/frontpage.css?v=' . filemtime('assets/css/frontpage.css')) ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/png" href="<?= base_url('uploads/page_icon/authentication4.jpg') ?>">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: url('<?= base_url("assets/login_image/login_background3.jpg"); ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .error-message {
            color: red;
            font-size: 10px;
            margin-top: 2px;
        }

        .relative {
            display: flex;
            flex-direction: column;
        }

        .relative input {
            padding-right: 2.5rem;
            /* Ensure space for the icon */
        }

        .relative i {
            position: absolute;
            right: 10px;
            bottom: 50%;
            /* Center the icon vertically */
            transform: translateY(50%);
            transition: all 0.2s ease-in-out;
        }

        .relative .error-message {
            margin-top: 5px;
            min-height: 12px;
            /* Ensure consistent spacing */
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900 bg-opacity-60">

    <div class="w-full max-w-md p-6 bg-white bg-opacity-20 backdrop-blur-md rounded-lg shadow-lg absolute ml-[30px]">
        <div class="flex justify-center">
            <img src="<?= base_url('/design/images/SPClogo.png') ?>" alt="SPC Logo" class="w-20 h-20 rounded-lg">
        </div>
        <h2 class="text-2xl font-bold text-center text-green-900 uppercase text-sm font-bold mt-4">REGISTER</h2>

        <form method="post" action="<?= base_url('auth/register'); ?>" class="mt-6" id="registerForm">
            <div class="grid grid-cols-2 gap-4">

                <!-- Username -->
                <!-- Username -->
                <div class="relative">
                    <label class="block text-green-700 tracking-wider uppercase text-xs font-bold mb-1">Username</label>
                    <div class="relative flex items-center">
                        <input type="text" id="username" name="username"
                            class="w-full px-4 py-2 border text-sm rounded-lg focus:ring-2 focus:ring-green-500 pr-10"
                            placeholder="Username" required>
                        <i class="fa-solid fa-user absolute right-3 text-green-200"></i>
                    </div>
                    <p class="error-message" id="usernameError"></p>
                </div>


                <!-- Email -->
                <div class="relative">
                    <label class="block text-green-700 tracking-wider uppercase text-xs font-bold mb-1">Email</label>
                    <div class="relative flex items-center">

                        <input type="email" id="email" name="email"
                            class="w-full px-4 py-2 border text-sm rounded-lg focus:ring-2 focus:ring-green-500 pr-10"
                            placeholder="Email" required>
                        <i class="fa-solid fa-envelope absolute right-3 bottom-[13px] text-green-200"></i>
                    </div>
                    <p class="error-message" id="emailError"></p>
                </div>

                <!-- Password -->
                <div class="relative">
                    <label class="block text-green-700 tracking-wider uppercase text-xs font-bold mb-1">Password</label>
                    <div class="relative flex items-center">

                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2 border text-sm rounded-lg focus:ring-2 focus:ring-green-500 pr-10"
                            placeholder="Password" required>
                        <i class="fa-solid fa-lock absolute right-3 bottom-[13px] text-green-200"></i>
                    </div>
                    <p class="error-message" id="passwordError"></p>
                </div>

                <!-- Confirm Password -->
                <div class="relative">
                    <label class="block text-green-700 tracking-wider uppercase text-xs font-bold mb-1">Confirm
                        Password</label>
                    <div class="relative flex items-center">

                        <input type="password" id="confirm_password" name="confirm_password"
                            class="w-full px-4 py-2 border text-sm rounded-lg focus:ring-2 focus:ring-green-500 pr-10"
                            placeholder="Confirm Password" required>
                        <i class="fa-solid fa-lock absolute right-3 bottom-[13px] text-green-200"></i>
                    </div>
                    <p class="error-message" id="confirmPasswordError"></p>
                </div>

                <!-- Address -->
                <div class="relative">
                    <label class="block text-green-700 tracking-wider uppercase text-xs font-bold mb-1">Address</label>
                    <div class="relative flex items-center">

                        <input type="text" id="address" name="address"
                            class="w-full px-4 py-2 border text-sm rounded-lg focus:ring-2 focus:ring-green-500 pr-10"
                            placeholder="Address" required>
                        <i class="fa-solid fa-map-marker-alt absolute right-3 bottom-[13px] text-green-200"></i>
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="relative">
                    <label class="block text-green-700 tracking-wider uppercase text-xs font-bold mb-1">Phone
                        No.</label>
                    <div class="relative flex items-center">

                        <input type="tel" id="phoneNo" name="phoneNo"
                            class="w-full px-4 py-2 border text-sm rounded-lg focus:ring-2 focus:ring-green-500 pr-10"
                            placeholder="Phone Number" required>
                        <i class="fa-solid fa-phone absolute right-3 bottom-[13px] text-green-200"></i>
                    </div>
                    <p class="error-message" id="phoneError"></p>
                </div>

                <!-- Gender -->
                <div>
                    <label class="block text-green-700 tracking-wider uppercase text-xs font-bold mb-1">Gender</label>
                    <div class="relative flex items-center">

                        <select name="gender"
                            class="w-full px-4 py-2 border text-sm rounded-lg focus:ring-2 focus:ring-green-500"
                            required>
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-green-700 tracking-wider uppercase text-xs font-bold mb-1">Role</label>
                    <div class="relative flex items-center">

                        <select name="role"
                            class="w-full px-4 py-2 border text-sm rounded-lg focus:ring-2 focus:ring-green-500"
                            required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <!-- Birth Date -->
                <div class="col-span-2">
                    <label class="block text-green-700 tracking-wider uppercase text-xs font-bold mb-1">Birth
                        Date</label>
                    <input type="date" id="birth_date" name="birth_date"
                        class="w-full px-4 py-2 border text-sm rounded-lg focus:ring-2 focus:ring-green-500" required>
                    <p class="error-message" id="birthDateError"></p>
                </div>

                <!-- Flatpickr Initialization -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        flatpickr("#birth_date", {
                            dateFormat: "F j Y", // Format: August 16 2003
                            maxDate: "today",
                            altInput: true,
                            altFormat: "F j Y", // Display format
                            dateFormat: "Y-m-d" // Backend format (para sa database)
                        });

                        document.getElementById("birth_date").addEventListener("change", function () {
                            const birthDate = new Date(this.value);
                            const currentDate = new Date();
                            const age = currentDate.getFullYear() - birthDate.getFullYear();
                            const errorElement = document.getElementById("birthDateError");

                            if (isNaN(birthDate.getTime())) {
                                errorElement.innerText = "Please enter a valid birth date.";
                            } else if (age < 18) {
                                errorElement.innerText = "You must be at least 18 years old.";
                            } else {
                                errorElement.innerText = "";
                            }
                        });
                    });
                </script>

                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

            </div>

            <button type="submit"
                class="w-full py-2 mt-2 bg-green-100 hover:bg-green-200 text-green-700 font-semibold rounded-lg">
                Register
            </button>
        </form>
        <div class="text-center mt-4">
            <a href="<?= base_url('auth/viewlogin') ?>"
                class="text-green-700 font-bold text-xs uppercase hover:underline">login</a>
            <text class="text-green-900">|</text>
            <a href="<?= base_url('auth/viewadmin') ?>"
                class="text-green-700 font-bold text-xs uppercase hover:underline">login as admin</a> <text
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
            const form = document.getElementById("registerForm");

            function validateField(field, errorId, validationFn) {
                const errorElement = document.getElementById(errorId);
                field.addEventListener("input", function () {
                    const errorMessage = validationFn(field.value);
                    errorElement.innerText = errorMessage;
                });
            }

            validateField(document.getElementById("username"), "usernameError", value =>
                value.length < 4 ? "Username must be at least 4 characters." : "");

            validateField(document.getElementById("email"), "emailError", value =>
                !value.match(/^\S+@\S+\.\S+$/) ? "Invalid email format." : "");

            validateField(document.getElementById("password"), "passwordError", value =>
                value.length < 6 ? "Password must be at least 6 characters." : "");

            validateField(document.getElementById("confirm_password"), "confirmPasswordError", value => {
                const password = document.getElementById("password").value;
                return password !== value ? "Passwords do not match." : "";
            });

            validateField(document.getElementById("phoneNo"), "phoneError", value =>
                !value.match(/^\d{10,}$/) ? "Invalid phone number (must be at least 10 digits)." : "");

            validateField(document.getElementById("birth_date"), "birthDateError", value => {
                const birthYear = new Date(value).getFullYear();
                const currentYear = new Date().getFullYear();
                return (currentYear - birthYear) < 18 ? "You must be at least 18 years old." : "";
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("registerForm");

            form.addEventListener("submit", function (e) {
                e.preventDefault(); // Prevent default form submission

                const formData = new FormData(form);

                fetch("<?= base_url('auth/register'); ?>", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "error") {
                            showToast(data.message, "error");
                        } else {
                            showToast(data.message, "success");
                            setTimeout(() => {
                                window.location.href = "<?= base_url('auth/viewlogin') ?>";
                            }, 3000);
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        showToast("Something went wrong!", "error");
                    });
            });

            function showToast(message, type) {
                // Remove any <p> tags from the message
                message = message.replace(/<\/?p>/g, "");

                Toastify({
                    text: message,
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: type === "success"
                        ? "linear-gradient(to right, #00b09b,rgb(19, 182, 76))"
                        : "linear-gradient(to right,rgb(0, 13, 11),rgb(187, 26, 71))",
                    stopOnFocus: true
                }).showToast();
            }

        });


        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("registerForm");

            form.addEventListener("submit", function (e) {
                let isValid = true;

                // Get form values
                const username = document.getElementById("username").value.trim();
                const email = document.getElementById("email").value.trim();
                const password = document.getElementById("password").value;
                const confirmPassword = document.getElementById("confirm_password").value;
                const phoneNo = document.getElementById("phoneNo").value.trim();
                const birthDate = document.getElementById("birth_date").value;

                // Clear previous errors
                document.querySelectorAll(".error-message").forEach(el => el.innerText = "");

                // Username validation
                if (username.length < 4) {
                    document.getElementById("usernameError").innerText = "Username must be at least 4 characters.";
                    isValid = false;
                }

                // Email validation
                if (!email.match(/^\S+@\S+\.\S+$/)) {
                    document.getElementById("emailError").innerText = "Invalid email format.";
                    isValid = false;
                }

                // Password validation
                if (password.length < 6) {
                    document.getElementById("passwordError").innerText = "Password must be at least 6 characters.";
                    isValid = false;
                }

                // Confirm Password validation
                if (password !== confirmPassword) {
                    document.getElementById("confirmPasswordError").innerText = "Passwords do not match.";
                    isValid = false;
                }

                // Phone number validation (must be at least 10 digits)
                if (!phoneNo.match(/^\d{10,}$/)) {
                    document.getElementById("phoneError").innerText = "Invalid phone number (must be at least 10 digits).";
                    isValid = false;
                }

                // Birth date validation (must be at least 18 years old)
                const birthYear = new Date(birthDate).getFullYear();
                const currentYear = new Date().getFullYear();
                if ((currentYear - birthYear) < 18) {
                    document.getElementById("birthDateError").innerText = "You must be at least 18 years old.";
                    isValid = false;
                }


            });

            function showToast(message, type) {
                Toastify({
                    text: message,
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: type === "success" ? "linear-gradient(to right, #00b09b, #96c93d)" : "linear-gradient(to right,rgb(84, 12, 18),rgb(158, 18, 74))",
                    stopOnFocus: true
                }).showToast();
            }
        });

        function togglePassword(fieldId, icon) {
            const passwordField = document.getElementById(fieldId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

    </script>
</body>

</html>