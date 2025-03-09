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
        <div class="bg-white shadow-md  p-6 w-full xl:w-1/3">
            <!-- Profile Header -->
            <div class="flex flex-col sm:flex-row items-center sm:space-x-4 border-b pb-4">
                <img class="w-20 h-20 rounded-full border border-gray-300"
                    src="<?= base_url($user['uploaded_profile_image'] ?? 'uploads/default_profiles/default_profile.avif'); ?>"
                    alt="Profile Image">
                <div class="text-center sm:text-left mt-2 sm:mt-0">
                    <h4 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($user['username']); ?></h4>
                    <p class="text-gray-600"><strong class="text-gray-800">Rank:</strong>
                        <?= htmlspecialchars($user['rank'] ?: 'Not Yet Assigned'); ?></p>
                    <p class="text-gray-600"><strong class="text-gray-800">Faculty:</strong>
                        <?= htmlspecialchars($user['faculty'] ?: 'Not Yet Assigned'); ?></p>
                </div>
            </div>

            <!-- Next Rank Requirements -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800">Next Rank Requirements:</h3>
                <p class="text-gray-700 mt-1"><strong class="text-gray-800">To be
                        <?= htmlspecialchars($next_rank_order); ?>, submit:</strong></p>
                <p class="text-gray-600"><?= htmlspecialchars($next_rank_label); ?></p>
            </div>

            <!-- File Upload Form -->
            <form method="POST" enctype="multipart/form-data" action="<?= base_url('controllerFaculty/submitFile') ?>"
                id="fileForm" class="mt-6">
                <label class="block text-gray-700 font-medium mb-2" for="file">Upload File:</label>
                <input type="file" name="file" id="file" required
                    class="block w-full border border-gray-300 rounded-md py-2 px-4 text-gray-700 focus:ring focus:ring-blue-300"
                    <?= $hasPending ? 'disabled' : '' ?>>
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-medium py-2 px-4 rounded-md mt-4 hover:bg-blue-700 transition-all duration-300"
                    <?= $hasPending ? 'disabled' : '' ?>>
                    Submit File
                </button>
                <?php if ($hasPending): ?>
                    <p class="text-red-500 text-sm mt-2">You cannot upload a new file while your previous submission is
                        still pending.</p>
                <?php endif; ?>
            </form>

            <!-- Faculty Members -->
            <h1 class="text-2xl py-2 uppercase mt-6">FACULTY MEMBERS</h1>
            <div class="faculty p-2 border rounded-lg shadow-md bg-gray-100 h-96 overflow-y-auto">
                <?php foreach ($fellow_faculty_members as $faculty_member): ?>
                    <?php if ($faculty_member['id'] != $user['id'] && $faculty_member['faculty'] === $user['faculty']): ?>
                        <div class="bg-white p-3 rounded-lg shadow mb-2">
                            <div class="flex items-center space-x-3">
                                <img class="w-12 h-12 rounded-full object-cover"
                                    src="<?= base_url($faculty_member['uploaded_profile_image'] ?? 'uploads/default_profiles/default_profile.avif'); ?>"
                                    alt="Profile Image">
                                <div>
                                    <h3 class="text-lg font-semibold"><?= htmlspecialchars($faculty_member['username']); ?></h3>
                                    <p class="text-sm text-gray-600"><strong>Rank:</strong>
                                        <?= htmlspecialchars($faculty_member['rank'] ?: 'Not Yet Assigned'); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
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