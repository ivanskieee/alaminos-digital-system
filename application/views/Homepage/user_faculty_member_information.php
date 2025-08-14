<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACULTY MEMBER STATUS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen bg-gray-100 text-gray-800">
    <div class="flex flex-wrap gap-6 p-6 justify-center">
        <?php foreach ($users as $user): ?>
            <!-- User Card -->
            <div class="flex-1 user-card bg-white shadow-xl rounded-lg  min-w-[400px] h-[500px] cursor-pointer flex flex-col items-center transition-all duration-300"
                onclick="toggleDetails('user-<?= $user['id']; ?>')">

                <!-- Upper Section -->
                <div id="profile-section-<?= $user['id']; ?>"
                    class="flex flex-col items-center justify-center flex-grow transition-all duration-300 ">
                    <!-- Profile Image -->
                    <img id="image-<?= $user['id']; ?>"
                        class=" min-w-96 h-96  rounded-t-lg rounded-b-none  transition-all duration-300 mb-1.5"
                        src="<?= base_url($user['uploaded_profile_image'] ?? 'uploads/default_profiles/default_profile.avif'); ?>"
                        alt="Profile Image">

                    <h2 class="text-2xl font-semibold mt-4 text-center"><?= htmlspecialchars($user['username']); ?></h2>
                    <p class="text-teal-600 text-lg text-center"><?= htmlspecialchars($user['email']); ?></p>
                </div>

                <!-- Hidden Details -->
                <div id="user-<?= $user['id']; ?>"
                    class="mt-4 invisible opacity-0 h-0 overflow-hidden transition-all duration-300 w-full">
                    <div class="overflow-y-auto max-h-[280px] px-4">


                        <!-- Additional User Information -->
                        <div class="grid grid-cols-2 gap-2 mt-2">
                            <!-- Address -->
                            <div class="darkmode bg-teal-50 p-2 rounded-lg shadow-sm text-sm">
                                <p class="font-medium text-gray-600">Address</p>
                                <?php
                                $hidden_fields = json_decode($user['hidden_fields'], true) ?? [];
                                $address_hidden = in_array('address', $hidden_fields);
                                ?>
                                <p id="address-<?= $user['id']; ?>" class="my-1 text-gray-800">
                                    <?= $address_hidden ? 'Hidden info' : htmlspecialchars($user['address']); ?>
                                </p>
                            </div>

                            <!-- Phone -->
                            <div class="darkmode bg-teal-50 p-2 rounded-lg shadow-sm text-sm">
                                <p class="font-medium text-gray-600">Phone</p>
                                <?php
                                $phone_hidden = in_array('phone', $hidden_fields);
                                ?>
                                <p id="phone-<?= $user['id']; ?>" class="my-1 text-gray-800">
                                    <?= $phone_hidden ? 'Hidden info' : htmlspecialchars($user['phoneNo']); ?>
                                </p>
                            </div>

                            <!-- Gender -->
                            <div class="darkmode bg-teal-50 p-2 rounded-lg shadow-sm text-sm">
                                <p class="font-medium text-gray-600">Gender</p>
                                <?php
                                $gender_hidden = in_array('gender', $hidden_fields);
                                ?>
                                <p id="gender-<?= $user['id']; ?>" class="my-1 text-gray-800">
                                    <?= $gender_hidden ? 'Hidden info' : htmlspecialchars($user['gender']); ?>
                                </p>
                            </div>

                            <!-- Birth Date -->
                            <div class="darkmode bg-teal-50 p-2 rounded-lg shadow-sm text-sm">
                                <p class="font-medium text-gray-600">Birth Date</p>
                                <?php
                                $birthdate_hidden = in_array('birth_date', $hidden_fields);
                                ?>
                                <p id="birth_date-<?= $user['id']; ?>" class="my-1 text-gray-800">
                                    <?= $birthdate_hidden ? 'Hidden info' : date("F j, Y", strtotime($user['birth_date'])); ?>
                                </p>
                            </div>

                            <!-- Rank -->
                            <div class="darkmode bg-teal-50 p-2 rounded-lg shadow-sm text-sm col-span-2">
                                <p class="font-medium text-gray-600">Rank</p>
                                <?php
                                $rank_hidden = in_array('rank', $hidden_fields);
                                ?>
                                <p id="rank-<?= $user['id']; ?>" class="my-1 text-gray-800">
                                    <?= $rank_hidden ? 'Hidden info' : htmlspecialchars($user['rank'] ?: 'Not Yet Assigned'); ?>
                                </p>
                            </div>

                            <!-- Faculty -->
                            <div class="darkmode bg-teal-50 p-2 rounded-lg shadow-sm text-sm col-span-2">
                                <p class="font-medium text-gray-600">Faculty</p>
                                <?php
                                $faculty_hidden = in_array('faculty', $hidden_fields);
                                ?>
                                <p id="faculty-<?= $user['id']; ?>" class="my-1 text-gray-800">
                                    <?= $faculty_hidden ? 'Hidden info' : htmlspecialchars($user['faculty'] ?: 'Not Yet Assigned'); ?>
                                </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        function toggleDetails(id) {
            var details = document.getElementById(id);
            var profileSection = document.getElementById('profile-section-' + id.split('-')[1]);
            var image = document.getElementById('image-' + id.split('-')[1]);

            if (details.classList.contains('invisible')) {
                // Expand details
                details.classList.remove('invisible', 'opacity-0', 'h-0', 'overflow-hidden');
                details.classList.add('opacity-100', 'h-auto');

                // Shrink profile section
                profileSection.classList.add('h-[150px]');
                image.classList.remove('w-96', 'h-96');
                image.classList.add('w-24', 'h-24');
            } else {
                // Collapse details
                details.classList.add('invisible', 'opacity-0', 'h-0', 'overflow-hidden');
                details.classList.remove('opacity-100', 'h-auto');

                // Expand profile section
                profileSection.classList.remove('h-[150px]');
                image.classList.remove('w-24', 'h-24');
                image.classList.add('w-96', 'h-96');
            }
        }
    </script>
</body>

</html>