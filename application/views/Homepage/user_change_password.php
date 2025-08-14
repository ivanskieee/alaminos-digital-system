<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Passwords</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="icon" type="image/jpg" title="Atom">
</head>

<body class="">
    <!-- Container -->
    <div class=" m-16 border-none p-6 w-full max-w-sm mx-auto">
        <div class="flex flex-col items-center">
            <!-- Lock Icon -->
            <div class="bg-blue-100 p-3 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-blue-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v3m-6 0h12M4 10v1m16-1v1m-6 3V4a4 4 0 00-8 0v7m8 0a4 4 0 00-8 0m12 4H4">
                    </path>
                </svg>
            </div>

            <h2 class="text-lg font-semibold text-gray-700 mt-3">Change Password</h2>
            <p class="text-sm text-gray-500 mb-4 text-center">Update your password for security reasons.</p>
        </div>

        <!-- Success/Error Messages -->
        <div id="message" class="hidden p-2 rounded-md text-center text-sm font-semibold"></div>


        <!-- Password Form -->
        <form method="post" action="<?= base_url('Home/clientprofile'); ?>" onsubmit="return validatePassword()">
            <input type="hidden" name="change_password" value="1">

            <div class="space-y-3">
                <!-- Current Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-600">Current Password</label>
                    <div class="relative">
                        <input type="password" name="current_password" required id="current_password"
                            class="darkmode_text w-full border border-gray-300 rounded-md p-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <a type="button" onclick="togglePassword('current_password', 'eyeIcon1')"
                            class="absolute right-2 top-2 text-gray-500">
                            <svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- New Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-600">New Password</label>
                    <div class="relative">
                        <input type="password" name="new_password" required id="new_password"
                            class="darkmode_text w-full border border-gray-300 rounded-md p-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            onkeyup="checkPasswordStrength()">
                        <a type="button" onclick="togglePassword('new_password', 'eyeIcon2')"
                            class="absolute right-2 top-2 text-gray-500">
                            <svg id="eyeIcon2" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </a>
                    </div>
                    <!-- Password strength message -->
                    <p id="strengthMessage" class="mt-2 text-sm"></p>
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-600">Confirm New Password</label>
                    <div class="relative">
                        <input type="password" name="confirm_new_password" required id="confirm_password"
                            class="darkmode_text w-full border border-gray-300 rounded-md p-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        <a type="button" onclick="togglePassword('confirm_password', 'eyeIcon3')"
                            class="absolute right-2 top-2 text-gray-500">
                            <svg id="eyeIcon3" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full mt-4 py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all text-sm font-semibold">
                Update Password
            </button>
        </form>
    </div>

    <!-- JavaScript -->
    <script>
        function togglePassword(inputId, iconId) {
            let input = document.getElementById(inputId);
            let icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = `<path d="M17.94 17.94A10.05 10.05 0 0112 20c-7 0-11-8-11-8a17.3 17.3 0 015.15-5.88M9.9 4.25A9.77 9.77 0 0112 4c7 0 11 8 11 8a17.3 17.3 0 01-5.15 5.88M15 12a3 3 0 11-6 0 3 3 0 016 0zM3 3l18 18" />`;
            } else {
                input.type = "password";
                icon.innerHTML = `<path d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12z"></path><circle cx="12" cy="12" r="3"></circle>`;
            }
        }
    </script>
    <script>
        // Real-time password strength check
        function checkPasswordStrength() {
            const newPassword = document.getElementById('new_password').value;
            const strengthMessage = document.getElementById('strengthMessage');

            // Basic password strength check (length, digits, symbols)
            if (newPassword.length < 6) {
                strengthMessage.textContent = 'Password is too weak.';
                strengthMessage.classList.add('text-teal-500');
            } else {
                strengthMessage.textContent = 'Password is strong.';
                strengthMessage.classList.add('text-teal-500');
            }
        }

        // Form submission with AJAX
        function submitPasswordChange(event) {
            event.preventDefault();

            let formData = new FormData(document.querySelector('form'));

            fetch('<?= base_url('Home/UserChangePassword') ?>', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    const messageElement = document.getElementById('message');
                    if (data.success) {
                        messageElement.textContent = data.success;
                        messageElement.classList.remove('hidden', 'text-red-500');
                        messageElement.classList.add('text-green-500');
                    } else if (data.error) {
                        messageElement.textContent = data.error;
                        messageElement.classList.remove('hidden', 'text-green-500');
                        messageElement.classList.add('text-red-500');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }


        // Attach the submit handler
        document.querySelector('form').addEventListener('submit', submitPasswordChange);
    </script>

</body>

</html>