<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen bg-gray-100 text-gray-800">

    <!-- Main Container -->
    <div class="flex flex-grow p-6 gap-6 w-full">

        <!-- Profile Sidebar -->
        <div class="w-1/3 bg-white shadow-xl rounded-2xl p-6 flex flex-col items-center">
            <!-- Profile Image (Clickable) -->
            <img id="profilePreview" class="w-32 h-32 rounded-full border-4 border-teal-500 shadow-md cursor-pointer"
                src="<?= base_url($user['uploaded_profile_image'] ?? 'uploads/default_profiles/default_profile.avif'); ?>"
                alt="Profile Image" onclick="openModal()">
            <h2 class="text-xl font-semibold mt-4"><?= htmlspecialchars($user['username']); ?></h2>
            <p class="text-teal-600 text-sm"><?= htmlspecialchars($user['email']); ?></p>

            <!-- Approval Progress -->
            <div class="mt-6 w-full">
                <h3 class="text-sm font-semibold text-gray-600">Approval Progress</h3>
                <div class="relative w-full bg-gray-300 rounded-full h-4 mt-2">
                    <div class="bg-teal-500 h-4 rounded-full text-xs text-white text-center leading-4"
                        style="width: <?= $progress ?>%;">
                        <?= round($progress, 2) ?>%
                    </div>
                </div>
            </div>

            <!-- Upload Profile Image -->
            <div class="darkmode mt-6 w-full bg-teal-50 p-4 rounded-xl shadow">
                <form method="post" action="<?= base_url('Home/uploadProfileImage'); ?>" enctype="multipart/form-data">
                    <label class="block text-xs font-medium text-gray-700">Upload Profile Picture</label>

                    <div class="relative mt-2">
                        <input type="file" name="profile_image" id="fileInput" class="hidden" accept="image/*">
                        <label for="fileInput"
                            class="cursor-pointer flex items-center justify-center w-full p-3 bg-teal-600 text-white text-sm rounded-lg hover:bg-teal-700 transition-all">
                            Choose File
                        </label>
                    </div>

                    <p id="fileName" class="text-sm text-gray-500 mt-2 text-center">No file chosen</p>

                    <button type="submit"
                        class="w-full mt-3 py-2 text-sm bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-all">
                        Upload
                    </button>
                </form>
            </div>
        </div>

        <!-- User Information Panel -->
        <div class="w-2/3 bg-white shadow-xl rounded-2xl p-6 flex flex-col">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">User Information</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="darkmode bg-teal-50 p-4 rounded-lg shadow-sm text-sm">
                    <p class="font-medium text-gray-600">Address</p>
                    <p class="text-gray-800"><?= htmlspecialchars($user['address']); ?></p>
                </div>
                <div class="darkmode bg-teal-50 p-4 rounded-lg shadow-sm text-sm">
                    <p class="font-medium text-gray-600">Phone</p>
                    <p class="text-gray-800"><?= htmlspecialchars($user['phoneNo']); ?></p>
                </div>
                <div class="darkmode bg-teal-50 p-4 rounded-lg shadow-sm text-sm">
                    <p class="font-medium text-gray-600">Gender</p>
                    <p class="text-gray-800"><?= htmlspecialchars($user['gender']); ?></p>
                </div>
                <div class="darkmode bg-teal-50 p-4 rounded-lg shadow-sm text-sm">
                    <p class="font-medium text-gray-600">Birth Date</p>
                    <p class="text-gray-800"><?= date("F j, Y", strtotime($user['birth_date'])); ?></p>
                </div>
                <div class="darkmode bg-teal-50 p-4 rounded-lg shadow-sm text-sm col-span-2">
                    <p class="font-medium text-gray-600">Rank</p>
                    <p class="text-gray-800"><?= htmlspecialchars($user['rank'] ?: 'Not Yet Assigned'); ?></p>
                </div>
                <div class="darkmode bg-teal-50 p-4 rounded-lg shadow-sm text-sm col-span-2">
                    <p class="font-medium text-gray-600">Faculty</p>
                    <p class="text-gray-800"><?= htmlspecialchars($user['faculty'] ?: 'Not Yet Assigned'); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-25 flex justify-center items-center hidden">
        <div class="bg-white p-4 rounded-lg shadow-lg relative w-auto max-w-3xl">
            <button class="absolute top-2 right-2 text-gray-700 hover:text-red-500 text-2xl" onclick="closeModal()">
                &times;
            </button>
            <img id="modalImage" class="max-w-full max-h-[80vh] rounded-lg shadow-md" src="" alt="Full Image">
        </div>
    </div>

    <script>
        // File upload preview
        document.getElementById('fileInput').addEventListener('change', function (event) {
            const fileName = event.target.files.length > 0 ? event.target.files[0].name : "No file chosen";
            document.getElementById('fileName').textContent = fileName;

            // Preview selected image
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profilePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Open Modal
        function openModal() {
            const profileImageSrc = document.getElementById('profilePreview').src;
            document.getElementById('modalImage').src = profileImageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        // Close Modal
        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>

</body>

</html>