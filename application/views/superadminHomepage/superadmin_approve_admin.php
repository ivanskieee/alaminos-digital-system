<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Approve Admin Accounts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 p-6">
    <!-- Loading Overlay -->
    <div id="loadingScreen" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="flex flex-col items-center">
            <div class="w-16 h-16 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
            <p class="text-white mt-4 font-medium">Processing your request...</p>
        </div>
    </div>

    <div class="flex flex-wrap">
        <!-- Pending Admins -->
        <div class="flex-1 m-2 h-screen bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Pending Admins</h2>
            <!-- Table View (Hidden on 2xl and below) -->
            <div class="max-2xl:hidden">
                <div class="overflow-y-auto max-h-[calc(100vh-150px)]">
                    <table class="min-w-full border-collapse divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Username</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Email</th>
                                <th class="px-4 py-2 text-center text-sm font-semibold text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php foreach ($pending_admins as $admin): ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-4 py-3 text-gray-800"><?= htmlspecialchars($admin['username']) ?></td>
                                    <td class="px-4 py-3 text-gray-800"><?= htmlspecialchars($admin['email']) ?></td>
                                    <td class="px-4 py-3 text-center">
                                        <button onclick="approveAdmin(<?= $admin['admin_id'] ?>)"
                                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition">
                                            Approve
                                        </button>
                                        <button onclick="rejectAdmin(<?= $admin['admin_id'] ?>)"
                                            class="ml-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition">
                                            Reject
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Card View for 2xl and below -->
            <div class="2xl:hidden space-y-4">
                <?php foreach ($pending_admins as $admin): ?>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                        <p class="font-semibold text-lg text-gray-700"><?= htmlspecialchars($admin['username']) ?></p>
                        <p class="text-sm text-gray-500"><?= htmlspecialchars($admin['email']) ?></p>
                        <div class="mt-3 flex space-x-3">
                            <button onclick="approveAdmin(<?= $admin['admin_id'] ?>)"
                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md transition">
                                Approve
                            </button>
                            <button onclick="rejectAdmin(<?= $admin['admin_id'] ?>)"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md transition">
                                Reject
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Approved Admins -->
        <div class="flex-1 m-2 h-screen bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Approved Admins</h2>
            <!-- Table View (Hidden on 2xl and below) -->
            <div class="max-2xl:hidden">
                <div class="overflow-y-auto max-h-[calc(100vh-150px)]">
                    <table class="min-w-full border-collapse divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Username</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Email</th>
                                <th class="px-4 py-2 text-center text-sm font-semibold text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php foreach ($approved_admins as $admin): ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-4 py-3 text-gray-800"><?= htmlspecialchars($admin['username']) ?></td>
                                    <td class="px-4 py-3 text-gray-800"><?= htmlspecialchars($admin['email']) ?></td>
                                    <td class="px-4 py-3 text-center">
                                        <button onclick="AdminmoveToPending(<?= $admin['admin_id'] ?>)"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition">
                                            Move to Pending
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Card View for 2xl and below -->
            <div class="2xl:hidden space-y-4">
                <?php foreach ($approved_admins as $admin): ?>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                        <p class="font-semibold text-lg text-gray-700"><?= htmlspecialchars($admin['username']) ?></p>
                        <p class="text-sm text-gray-500"><?= htmlspecialchars($admin['email']) ?></p>
                        <div class="mt-3">
                            <button onclick="AdminmoveToPending(<?= $admin['admin_id'] ?>)"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md transition">
                                Move to Pending
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Rejected Admins -->
        <div class="flex-1 m-2 h-screen bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Rejected Admins</h2>
            <!-- Table View (Hidden on 2xl and below) -->
            <div class="max-2xl:hidden">
                <div class="overflow-y-auto max-h-[calc(100vh-150px)]">
                    <table class="min-w-full border-collapse divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Username</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Email</th>
                                <th class="px-4 py-2 text-center text-sm font-semibold text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php foreach ($rejected_admins as $admin): ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-4 py-3 text-gray-800"><?= htmlspecialchars($admin['username']) ?></td>
                                    <td class="px-4 py-3 text-gray-800"><?= htmlspecialchars($admin['email']) ?></td>
                                    <td class="px-4 py-3 text-center">
                                        <button onclick="AdminmoveToPending(<?= $admin['admin_id'] ?>)"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition">
                                            Move to Pending
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Card View for 2xl and below -->
            <div class="2xl:hidden space-y-4">
                <?php foreach ($rejected_admins as $admin): ?>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                        <p class="font-semibold text-lg text-gray-700"><?= htmlspecialchars($admin['username']) ?></p>
                        <p class="text-sm text-gray-500"><?= htmlspecialchars($admin['email']) ?></p>
                        <div class="mt-3">
                            <button onclick="AdminmoveToPending(<?= $admin['admin_id'] ?>)"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md transition">
                                Move to Pending
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        function AdminmoveToPending(adminId) {
            $.post("<?= base_url('Auth/Admin_move_to_pending') ?>", { admin_id: adminId }, function () {
                Swal.fire('Moved to Pending!', 'The admin has been moved to pending.', 'success').then(() => {
                    location.reload();
                });
            }).fail(function () {
                Swal.fire('Error!', 'There was an error moving the admin.', 'error');
            });
        }
        function showLoading() {
            document.getElementById("loadingScreen").classList.remove("hidden");
        }
        function hideLoading() {
            document.getElementById("loadingScreen").classList.add("hidden");
        }
        function approveAdmin(adminId) {
            Swal.fire({
                title: 'Approve Admin?',
                text: 'Are you sure you want to approve this admin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#0d9488',
                cancelButtonColor: '#5eead4'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    $.post("<?= base_url('Auth/approve_admin') ?>", { admin_id: adminId })
                        .done(function () {
                            Swal.fire('Approved!', 'The admin has been approved.', 'success').then(() => {
                                location.reload();
                            });
                        })
                        .fail(function () {
                            Swal.fire('Error!', 'There was an error approving the admin.', 'error');
                        })
                        .always(hideLoading);
                }
            });
        }
        function rejectAdmin(adminId) {
            Swal.fire({
                title: 'Reject Admin?',
                text: 'Are you sure you want to reject this admin?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Yes, reject!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d32f2f',
                cancelButtonColor: '#f87171'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    $.post("<?= base_url('Auth/reject_admin') ?>", { admin_id: adminId })
                        .done(function () {
                            Swal.fire('Rejected!', 'The admin has been rejected.', 'success').then(() => {
                                location.reload();
                            });
                        })
                        .fail(function () {
                            Swal.fire('Error!', 'There was an error rejecting the admin.', 'error');
                        })
                        .always(hideLoading);
                }
            });
        }
    </script>
</body>

</html>