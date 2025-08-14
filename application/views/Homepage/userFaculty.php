<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="<?php echo base_url('assets/css/userFaculty.css?v=' . filemtime('assets/css/userFaculty.css')); ?>">
    <title>User Faculty</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>



</head>

<body>

    <div class="flex flex-col xl:flex-row gap-6 m-2">
        <!-- Left Section (File Submissions) -->
        <div class="bg-white shadow-md rounded-lg p-4 w-full xl:w-2/3">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">File Submissions</h2>

            <!-- Table View for Large Screens -->
            <div class="hidden 2xl:block overflow-x-auto">
                <table class="w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-3 py-2 text-left text-gray-700">File</th>
                            <th class="px-3 py-2 text-left text-gray-700">Status</th>
                            <th class="px-3 py-2 text-left text-gray-700">Current Rank</th>
                            <th class="px-3 py-2 text-left text-gray-700">Next Rank</th>
                            <th class="px-3 py-2 text-left text-gray-700">Next Order</th>
                            <th class="px-3 py-2 text-left text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-300">
                        <?php foreach ($file_submissions as $submission): ?>
                            <tr class="text-gray-700 text-xs">
                                <td class="px-3 py-2">
                                    <a class="text-blue-500 hover:underline"
                                        href="<?= base_url($submission['file_path']); ?>">View</a>
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <span
                                        class="<?= $submission['approved'] ? 'text-green-600 bg-green-100 rounded-full px-3 py-1 font-semibold' : 'text-yellow-600 bg-yellow-100 rounded-full px-3 py-1 font-semibold'; ?>">
                                        <?= $submission['approved'] ? 'Approved' : 'Pending'; ?>
                                    </span>
                                </td>
                                <td class="px-3 py-2"><?= htmlspecialchars($submission['label']); ?></td>
                                <td class="px-3 py-2"><?= htmlspecialchars($submission['next_rank_label']); ?></td>
                                <td class="px-3 py-2"><?= htmlspecialchars($submission['next_rank_order']); ?></td>
                                <td class="px-3 py-2 flex justify-center">
                                    <a href="javascript:void(0);" class="text-red-400 hover:text-red-500 decline-link"
                                        data-id="<?= $submission['id']; ?>">
                                        <i class="fas fa-times-circle text-lg"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Card View for Mobile -->
            <div class="block 2xl:hidden space-y-4">
                <?php foreach ($file_submissions as $submission): ?>
                    <div class="border border-gray-300 rounded-lg p-4 shadow bg-white">
                        <p class="text-sm"><strong>File:</strong>
                            <a class="text-blue-500 hover:underline"
                                href="<?= base_url($submission['file_path']); ?>">View</a>
                        </p>
                        <p class="text-sm"><strong>Status:</strong>
                            <span
                                class="<?= $submission['approved'] ? 'text-green-600 bg-green-100 rounded-full px-3 py-1 font-semibold' : 'text-yellow-600 bg-yellow-100 rounded-full px-3 py-1 font-semibold'; ?>">
                                <?= $submission['approved'] ? 'Approved' : 'Pending'; ?>
                            </span>
                        </p>
                        <p class="text-sm"><strong>Current Rank:</strong> <?= htmlspecialchars($submission['label']); ?></p>
                        <p class="text-sm"><strong>Next Rank:</strong>
                            <?= htmlspecialchars($submission['next_rank_label']); ?></p>
                        <p class="text-sm"><strong>Next Order:</strong>
                            <?= htmlspecialchars($submission['next_rank_order']); ?></p>
                        <div class="flex justify-end mt-2">
                            <a href="javascript:void(0);" class="text-red-400 hover:text-red-500 decline-link"
                                data-id="<?= $submission['id']; ?>">
                                <i class="fas fa-times-circle text-lg"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Right Section (Profile & Faculty Members) -->
        <div class="bg-white shadow-lg rounded-lg p-6 w-full xl:w-1/3">
            <!-- Profile Header -->
            <div class="flex items-center space-x-4 border-b pb-4">
                <img class="w-24 h-24 rounded-full border-4 border-gray-300 shadow-md"
                    src="<?= base_url($user['uploaded_profile_image'] ?? 'uploads/default_profiles/default_profile.avif'); ?>"
                    alt="Profile Image">
                <div>
                    <h4 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($user['username']); ?></h4>
                    <p class="text-gray-600"><strong class="text-gray-800">Rank:</strong>
                        <?= htmlspecialchars($user['rank'] ?: 'Not Yet Assigned'); ?>
                    </p>
                    <p class="text-gray-600"><strong class="text-gray-800">Office:</strong>
                        <?= htmlspecialchars($user['faculty'] ?: 'Not Yet Assigned'); ?>
                    </p>
                </div>
            </div>

            <!-- Next Rank Requirements -->
            <div
                class="darkmode relative mt-6 p-6 rounded-xl shadow-xl  border-blue-500 dark:border-blue-400 overflow-hidden">

                <!-- Decorative Floating Elements -->
                <div
                    class="absolute top-0 left-0 w-16 h-16 bg-teal-100 dark:bg-teal-700 opacity-40 rounded-full transform -translate-x-6 -translate-y-6">
                </div>
                <div
                    class="absolute bottom-[-100px] right-[-40px] w-56 h-56 bg-teal-100 opacity-40 rounded-full -translate-x-6">
                </div>


                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 flex items-center uppercase">

                    Next Rank Requirements
                    <svg class="w-8 h-10 text-teal-600 dark:text-teal-400 mr-2 mt-2" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0l3-3m-3 3l-3-3"></path>
                    </svg>
                </h3>

                <p class="text-gray-700 dark:text-gray-300 text-lg">
                    <a class="text-gray-900 dark:text-white">To be <?= htmlspecialchars($next_rank_order); ?>,
                        submit:</a>
                </p>
                <p class="text-gray-600 dark:text-gray-400 italic text-md"><?= htmlspecialchars($next_rank_label); ?>
                </p>

                <!-- Animated Progress Indicator -->
                <div class="mt-4 w-full h-3 bg-gray-300 dark:bg-gray-700 rounded-full overflow-hidden relative">
                    <div class="h-full bg-teal-500 dark:bg-teal-400 transition-all duration-700 ease-in-out rounded-full"
                        style="width: <?= htmlspecialchars($progressPercentage); ?>%;">
                    </div>
                    <!-- Progress Label -->

                </div>
            </div>


            <!-- File Upload Form -->
            <form method="POST" enctype="multipart/form-data" action="<?= base_url('controllerFaculty/submitFile') ?>"
                id="fileForm" class="mt-6 bg-white p-6 rounded-lg shadow-md border border-gray-200">

                <h3 class="block text-gray-700 font-medium mb-2" for="file">Upload File:</h3>

                <!-- Custom File Input Wrapper -->
                <div class="relative w-full">
                    <input type="file" name="file" id="file" required class="hidden" <?= $hasPending ? 'disabled' : '' ?>
                        onchange="updateFileName(this)">

                    <label for="file"
                        class="flex items-center justify-center w-full bg-blue-600 text-white font-medium py-3 px-4 rounded-md cursor-pointer hover:bg-blue-700 transition-all duration-300 shadow-md <?= $hasPending ? 'opacity-50 cursor-not-allowed' : '' ?>">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2m-5-4l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        Choose File
                    </label>

                    <!-- File Name Display -->
                    <p id="file-name" class="text-gray-500 text-sm mt-2 text-center italic">No file chosen</p>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-green-600 text-white font-medium py-3 px-4 rounded-md mt-4 hover:bg-green-700 transition-all duration-300 shadow-md <?= $hasPending ? 'opacity-50 cursor-not-allowed' : '' ?>"
                    <?= $hasPending ? 'disabled' : '' ?>>
                    Submit File
                </button>

                <?php if ($hasPending): ?>
                    <p class="text-red-500 text-sm mt-2">You cannot upload a new file while your previous submission is
                        still pending.</p>
                <?php endif; ?>
            </form>

            <script>function updateFileName(input) {
                    const fileNameDisplay = document.getElementById('file-name');
                    if (input.files.length > 0) {
                        fileNameDisplay.textContent = `Selected: ${input.files[0].name}`;
                    } else {
                        fileNameDisplay.textContent = 'No file chosen';
                    }
                }
            </script>

        </div>
    </div>
    <script>
        document.getElementById('fileForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting

            const formData = new FormData(this);

            fetch('<?= base_url('controllerFaculty/submitFile') ?>', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        }).then(() => {
                            location.reload(); // Reload the page after clicking "Okay"
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while uploading the file.',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                });
        });
        // Decline file submission with SweetAlert2 confirmation
        document.querySelectorAll('.decline-link').forEach(function (element) {
            element.addEventListener('click', function (e) {
                e.preventDefault();
                const submissionId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('<?= base_url('controllerFaculty/declineFile/'); ?>' + submissionId)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Deleted!', data.message, 'success')
                                        .then(() => location.reload());
                                } else {
                                    Swal.fire('Error!', data.message, 'error');
                                }
                            })
                            .catch(() => Swal.fire('Error!', 'An error occurred.', 'error'));
                    }
                });
            });
        });


    </script>

    </div>
</body>

</html>