<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Personal Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.13.0/toastify.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.13.0/toastify.min.css">
</head>

<body>
    <div class="m-5 border-none p-6 w-full max-w-sm mx-auto">
        <div class="text-center">
            <div class="bg-blue-100 p-4 rounded-full inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-blue-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm0 2c-4.418 0-8 3.582-8 8h16c0-4.418-3.582-8-8-8z" />
                </svg>
            </div>

            <h2 class="text-2xl font-semibold text-gray-800 mt-3">Update Personal Information</h2>
            <p class="text-sm text-gray-500 mb-4 text-center">Keep your details up-to-date for a better experience.</p>
        </div>

        <form id="updateForm" method="post" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
                <input type="text" id="username" name="username" required
                    value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 outline-none">
                <small id="username-error" class="text-red-500 hidden">Username must be at least 3 characters
                    long.</small>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" id="email" name="email" required
                    value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>"
                    class="darkmode_text w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 outline-none">
                <small id="email-error" class="text-red-500 hidden">Please enter a valid email.</small>
            </div>

            <div>
                <label for="phoneNo" class="block text-sm font-medium text-gray-600">Phone Number</label>
                <input type="text" id="phoneNo" name="phoneNo" required
                    value="<?php echo isset($user['phoneNo']) ? $user['phoneNo'] : ''; ?>"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 outline-none">
                <small id="phoneNo-error" class="text-red-500 hidden">Phone number must be at least 10 digits.</small>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-600">Address</label>
                <input type="text" id="address" name="address"
                    value="<?php echo isset($user['address']) ? $user['address'] : ''; ?>"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600">Gender</label>
                <div class="flex space-x-6 mt-1">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="gender" value="Male" <?php echo (isset($user['gender']) && $user['gender'] == 'Male') ? 'checked' : ''; ?> class="form-radio text-blue-500">
                        <span class="text-sm text-gray-700">Male</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="gender" value="Female" <?php echo (isset($user['gender']) && $user['gender'] == 'Female') ? 'checked' : ''; ?> class="form-radio text-pink-500">
                        <span class="text-sm text-gray-700">Female</span>
                    </label>
                </div>
            </div>

            <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-600">Birth Date</label>
                <input type="date" id="birth_date" name="birth_date"
                    value="<?php echo isset($user['birth_date']) ? $user['birth_date'] : ''; ?>"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 outline-none">
                <small id="birth_date-error" class="text-red-500 hidden">You must be at least 18 years old.</small>

            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg shadow-md transition duration-300">
                Update Information
            </button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            // Real-time validation for username
            $('#username').on('input', function () {
                let username = $(this).val();
                if (username.length < 3) {
                    $('#username').addClass('border-red-500');
                    $('#username-error').removeClass('hidden');
                } else {
                    $('#username').removeClass('border-red-500');
                    $('#username-error').addClass('hidden');
                }
            });

            // Real-time validation for email
            $('#email').on('input', function () {
                let email = $(this).val();
                let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if (!emailPattern.test(email)) {
                    $('#email').addClass('border-red-500');
                    $('#email-error').removeClass('hidden');
                } else {
                    $('#email').removeClass('border-red-500');
                    $('#email-error').addClass('hidden');
                }
            });

            // Real-time validation for birth date
            $('#birth_date').on('change', function () {
                let birthDate = new Date($(this).val());
                let age = calculateAge(birthDate);
                if (age < 18) {
                    $('#birth_date').addClass('border-red-500');
                    $('#birth_date-error').removeClass('hidden');
                } else {
                    $('#birth_date').removeClass('border-red-500');
                    $('#birth_date-error').addClass('hidden');
                }
            });

            // Function to calculate age
            function calculateAge(birthDate) {
                let today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                let m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            }

            // Real-time validation for phone number
            $('#phoneNo').on('input', function () {
                let phoneNo = $(this).val();
                if (phoneNo.length < 10 || !/^\d+$/.test(phoneNo)) {
                    $('#phoneNo').addClass('border-red-500');
                    $('#phoneNo-error').removeClass('hidden');
                } else {
                    $('#phoneNo').removeClass('border-red-500');
                    $('#phoneNo-error').addClass('hidden');
                }
            });

            // Form submit with AJAX
            $('#updateForm').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: '<?php echo base_url('Home/updateUserInfo'); ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            Toastify({
                                text: response.success,
                                backgroundColor: "linear-gradient(to right, rgb(0, 0, 0), rgb(31, 206, 150))",
                                gravity: "bottom",
                                position: "right",
                                className: "info",
                                duration: 3000
                            }).showToast();
                        } else {
                            Toastify({
                                text: response.error,
                                backgroundColor: "linear-gradient(to right,rgb(0, 0, 0),rgb(119, 3, 3))",
                                className: "info",
                                duration: 3000
                            }).showToast();
                        }
                    },
                    error: function () {
                        Toastify({
                            text: 'An error occurred. Please try again.',
                            backgroundColor: "linear-gradient(to right,rgb(0, 0, 0),rgb(119, 3, 3))",
                            className: "info",
                            duration: 3000
                        }).showToast();
                    }
                });
            });
        });
    </script>
</body>

</html>