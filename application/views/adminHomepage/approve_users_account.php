<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 font-sans m1">
    <div class="flex flex-wrap">

        <!-- Pending Users Section -->
        <div class="w-full lg:w-1/3 p-2">
            <div class="h-screen overflow-y-auto bg-white shadow-lg rounded-lg p-6 mb-2">
                <h2 class="text-xl tracking-wider font-semibold text-gray-700 uppercase mb-4">Pending Users</h2>
                <div class="space-y-4">
                    <?php foreach ($pending_users as $user): ?>
                        <div
                            class="user-approval flex flex-col sm:flex-row sm:items-center sm:justify-between p-4 border rounded-lg hover:shadow-md transition-shadow space-y-2 sm:space-y-0 sm:space-x-4">
                            <!-- User Info -->
                            <div class="min-w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-800 truncate"><?= $user['username'] ?></h3>
                                <p class="text-sm text-gray-600 truncate"><?= $user['email'] ?></p>
                            </div>

                            <!-- Buttons -->
                            <div class="flex flex-wrap justify-end gap-2">
                                <!-- Example buttons for Pending users -->
                                <button onclick="approveUser(<?= $user['id'] ?>)"
                                    class="px-4 py-2 font-medium bg-green-100 text-green-800 text-sm rounded-lg hover:bg-green-200 transition">Approve</button>
                                <button onclick="rejectUser(<?= $user['id'] ?>)"
                                    class="px-4 py-2 font-medium bg-red-100 text-red-800 text-sm rounded-lg hover:bg-red-200 transition">Reject</button>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Approved Users Section -->
        <div class="w-full lg:w-1/3 p-2">
            <div class="h-screen overflow-y-auto bg-white shadow-lg rounded-lg">
                <div class="sticky top-0 bg-white z-10 p-5 flex justify-center">
                    <h2 class="text-xl tracking-wider font-semibold text-gray-700 uppercase mb-4">Active Accounts</h2>
                </div>
                <div class="space-y-4">
                    <?php foreach ($approved_users as $user): ?>
                        <div
                            class="user-approval flex flex-wrap items-center p-4 border rounded-lg hover:shadow-md transition-shadow">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-800 truncate"><?= $user['username'] ?></h3>
                                <p class="text-sm text-gray-600 truncate"><?= $user['email'] ?></p>
                            </div>
                            <button onclick="moveToPending(<?= $user['id'] ?>)"
                                class="flex-1 px-4 py-2 bg-yellow-100 text-yellow-800 text-sm rounded-lg hover:bg-yellow-200 font-medium transition">Deactivate
                                Account</button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Rejected Users Section -->
        <div class="w-full lg:w-1/3 p-2">
            <div class="h-screen overflow-y-auto bg-white shadow-lg rounded-lg p-6 mb-2">
                <h2 class="text-xl tracking-wider font-semibold text-gray-700 uppercase mb-4">Deactivated Accounts</h2>
                <div class="space-y-4">
                    <?php foreach ($rejected_users as $user): ?>
                        <div
                            class="user-approval flex flex-wrap items-center p-4 border rounded-lg hover:shadow-md transition-shadow">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-800 truncate"><?= $user['username'] ?></h3>
                                <p class="text-sm text-gray-600 truncate"><?= $user['email'] ?></p>
                            </div>
                            <button onclick="moveToPending(<?= $user['id'] ?>)"
                                class="px-4 py-2 bg-teal-100 text-teal-800 text-sm rounded-lg hover:bg-teal-200 font-medium transition">Move
                                to Pending</button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>



    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-25 flex items-center justify-center hidden">
        <div class="flex flex-col items-center">
            <div class="w-16 h-16 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
            <p class="text-white mt-4 font-medium">Processing your request...</p>
        </div>
    </div>

    <script>

        function showLoading() {
            document.getElementById('loading-overlay').classList.remove('hidden');
        }

        function hideLoading() {
            document.getElementById('loading-overlay').classList.add('hidden');
        }

        function approveUser(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to approve this user!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#0d9488',
                cancelButtonColor: '#5eead4'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();

                    $.ajax({
                        url: "<?= base_url('auth/approve_user') ?>",
                        method: "POST",
                        data: { user_id: userId },
                        success: function (response) {
                            hideLoading();
                            Swal.fire({
                                title: 'Approved!',
                                text: 'The user has been approved.',
                                icon: 'success',
                                confirmButtonColor: '#0d9488'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                            hideLoading();
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an error approving the user.',
                                icon: 'error',
                                confirmButtonColor: '#0d9488'
                            });
                        }
                    });
                }
            });
        }
        function rejectUser(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to reject this user!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Yes, reject it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d32f2f',
                cancelButtonColor: '#f87171'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();

                    $.ajax({
                        url: "<?= base_url('auth/reject_user') ?>",
                        method: "POST",
                        data: { user_id: userId },
                        success: function (response) {
                            hideLoading();
                            Swal.fire({
                                title: 'Rejected!',
                                text: 'The user has been rejected.',
                                icon: 'success',
                                confirmButtonColor: '#0d9488'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                            hideLoading();
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an error rejecting the user.',
                                icon: 'error',
                                confirmButtonColor: '#0d9488'
                            });
                        }
                    });
                }
            });
        }

        function moveToPending(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to move this user to pending!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Yes, move it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d32f2f',
                cancelButtonColor: '#f87171',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Please wait while we process your request.',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: "<?= base_url('auth/move_to_pending') ?>",
                        method: "POST",
                        data: { user_id: userId },
                        success: function (response) {
                            Swal.fire({
                                title: 'Moved!',
                                text: 'The user has been moved to pending.',
                                icon: 'success',
                                confirmButtonColor: '#0d9488' // Teal-600
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an error moving the user to pending.',
                                icon: 'error',
                                confirmButtonColor: '#0d9488' // Teal-600
                            });
                        }
                    });
                }
            });
        }

    </script>

    <!-- Include jQuery for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>