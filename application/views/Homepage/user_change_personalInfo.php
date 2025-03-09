<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Personal Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-2xl rounded-xl p-6 w-full max-w-md">
        <div class="flex flex-col items-center">
            <!-- Profile Icon -->
            <div class="bg-blue-100 p-4 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-blue-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm0 2c-4.418 0-8 3.582-8 8h16c0-4.418-3.582-8-8-8z" />
                </svg>
            </div>

            <h2 class="text-2xl font-semibold text-gray-800 mt-3">Update Personal Information</h2>
            <p class="text-sm text-gray-500 mb-4 text-center">Keep your details up-to-date for a better experience.</p>
        </div>

        <!-- Success Message -->
        <?php if ($this->session->flashdata('success')): ?>
            <p class="bg-green-100 text-green-700 px-4 py-2 rounded-md mb-4 text-sm text-center">
                <?php echo $this->session->flashdata('success'); ?>
            </p>
        <?php endif; ?>

        <!-- Error Message -->
        <?php if ($this->session->flashdata('error')): ?>
            <p class="bg-red-100 text-red-700 px-4 py-2 rounded-md mb-4 text-sm text-center">
                <?php echo $this->session->flashdata('error'); ?>
            </p>
        <?php endif; ?>

        <form action="<?php echo base_url('Home/updateUserInfo'); ?>" method="post" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
                <div class="relative">
                    <input type="text" id="username" name="username" required
                        value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 outline-none">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" id="email" name="email" required
                    value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 outline-none">
            </div>

            <div>
                <label for="phoneNo" class="block text-sm font-medium text-gray-600">Phone Number</label>
                <input type="text" id="phoneNo" name="phoneNo" required
                    value="<?php echo isset($user['phoneNo']) ? $user['phoneNo'] : ''; ?>"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 outline-none">
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-600">Address</label>
                <input type="text" id="address" name="address"
                    value="<?php echo isset($user['address']) ? $user['address'] : ''; ?>"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 outline-none">
            </div>

            <!-- Gender Selection -->
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

            <!-- Birth Date Input -->
            <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-600">Birth Date</label>
                <input type="date" id="birth_date" name="birth_date"
                    value="<?php echo isset($user['birth_date']) ? $user['birth_date'] : ''; ?>"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 outline-none">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg shadow-md transition duration-300">
                Update Information
            </button>
        </form>
    </div>
</body>

</html>