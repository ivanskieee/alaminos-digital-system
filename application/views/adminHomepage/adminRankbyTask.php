<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Admin Rank By Task</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-container {
            display: flex;
            height: calc(100vh - 4rem);
            /* Adjust for header height */
        }

        .left-section,
        .right-section {
            overflow-y: auto;
            padding: 1rem;
        }

        .left-section {
            flex: 3;
        }

        .right-section {
            background-color: white;
            border-left: 1px solid #e5e7eb;
            width: 350px;
        }

        .pagination {
            display: flex;
            justify-content: flex-end;
        }

        .ranking_table {
            height: 800px;
        }
    </style>
</head>

<body class="bg-gray-50">


    <!-- Main Content -->
    <div class="main-container">
        <!-- Left Section -->
        <div class="left-section space-y-6">

            <div class="bg-white shadow-lg rounded-lg p-6 md:p-8 space-y-8">
                <!-- Current Reset Date Display -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b pb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Yearly Reset Date</h2>
                        <p class="text-gray-600 mt-2">
                            The current yearly reset date is:
                            <strong class="text-green-400"><?= date('F j, Y', strtotime($reset_date)); ?></strong>
                        </p>
                    </div>
                    <div class="flex items-center gap-2 md:gap-4 mt-4 md:mt-0">
                        <span class="text-sm text-gray-500">Modify Below</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6 md:w-8 md:h-8 text-green-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5l6 6m0 0l-6 6m6-6H5" />
                        </svg>
                    </div>
                </div>

                <!-- Set Yearly Reset Form -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Set Yearly Reset</h2>
                    <form method="POST" action="<?= base_url('conAdmin/setResetDate') ?>" class="space-y-6">
                        <!-- Year Input (Responsive Layout) -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="reset_year" class="block text-sm font-medium text-gray-600 mb-2">Select
                                    Year:</label>
                                <input type="date" name="reset_year" id="reset_year"
                                    class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    onfocus="this.type='month'" onblur="this.type='text'" placeholder="Select Year">
                            </div>



                            <!-- Hidden Month Picker -->
                            <div class="hidden">
                                <label for="reset_month" class="block text-sm font-medium text-gray-600 mb-2">Select
                                    Month:</label>
                                <select name="reset_month" id="reset_month"
                                    class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <?php foreach (range(1, 12) as $month): ?>
                                        <option value="<?= $month; ?>">
                                            <?= date('F', mktime(0, 0, 0, $month, 1)); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center md:justify-end mt-4">
                            <button type="submit" id="resetButton" disabled
                                class="bg-gray-400 text-white w-full md:w-auto px-6 py-3 rounded-lg cursor-not-allowed">
                                Set Reset Date
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                document.getElementById('reset_year').addEventListener('change', function () {
                    let resetDate = this.value;
                    let resetButton = document.getElementById('resetButton');

                    if (resetDate) {
                        resetButton.removeAttribute('disabled');
                        resetButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                        resetButton.classList.add('bg-green-600', 'hover:bg-green-700');
                    } else {
                        resetButton.setAttribute('disabled', 'true');
                        resetButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                        resetButton.classList.remove('bg-green-600', 'hover:bg-green-700');
                    }
                });
            </script>

            <!-- Manually Add Points and Reset Rank Points Section -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <!-- Manually Add Points -->
                    <div class="darkmode bg-white p-4 rounded-md shadow-lg flex-1">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Manually Add Points</h2>
                        <form method="POST" action="<?= base_url('conAdmin/addPointsToUser') ?>" class="space-y-4">
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-600">Select
                                    User:</label>
                                <select name="user_id" id="user_id"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">-- Select User --</option>
                                    <option value="all">All Users</option>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['username']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="points" class="block text-sm font-medium text-gray-600">Points to
                                    Add:</label>
                                <input type="number" name="points" id="points"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <button type="submit"
                                    class="flex items-center justify-center gap-2 w-full bg-gray-100 font-semibold text-green-400 font-medium px-4 py-2 rounded-md shadow-md hover:bg-gray-200 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add Points
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Reset Specific Points -->
                    <div class="darkmode bg-white p-4 rounded-md shadow-lg flex-1">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Reset Specific Points</h2>
                        <form method="POST" action="<?= base_url('conAdmin/resetSpecificPoints') ?>" class="space-y-4">
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-600">Select
                                    User:</label>
                                <select name="user_id" id="user_id"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">-- Select User --</option>
                                    <option value="all">All Users</option>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['username']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="points_to_reset" class="block text-sm font-medium text-gray-600">Points to
                                    Reset:</label>
                                <input type="number" name="points_to_reset" id="points_to_reset"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <button type="submit"
                                    class="flex items-center justify-center gap-2 w-full bg-gray-100 font-semibold text-yellow-400 font-medium px-4 py-2 rounded-md shadow-md hover:bg-gray-200 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Reset Specific Points
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Reset Rank Points -->
                    <div class="darkmode bg-white p-4 rounded-md shadow-lg flex-1">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Reset Rank Points</h2>
                        <form method="POST" action="<?= base_url('conAdmin/resetRankPoints') ?>" class="space-y-4"
                            id="resetRankPointsForm">
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-600">Select
                                    User:</label>
                                <select name="user_id" id="user_id"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">-- Select User --</option>
                                    <option value="all">All Users</option>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['username']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <button type="submit"
                                    class="flex items-center justify-center gap-2 w-full bg-gray-100 font-semibold text-red-400 font-medium px-4 py-2 rounded-md shadow-md hover:bg-gray-200 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Reset Rank Points
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>







            <!-- User Rankings Table -->
            <div class="bg-white shadow-lg rounded-lg p-6 overflow-x-auto">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">User Rankings</h2>

                <!-- Table for XL and larger -->
                <div class="hidden lg:block">
                    <div class="ranking_table overflow-y-auto">

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="sticky top-0 bg-gray-100 shadow">
                                <tr>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Rank</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Username</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Completed Tasks</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Points</th>
                                </tr>
                            </thead>
                            <tbody id="userTable" class="bg-white divide-y divide-gray-200">
                                <?php if (!empty($rankings)): ?>
                                    <?php
                                    $rank = 1;
                                    foreach ($rankings as $user):
                                        // Combine completed tasks and total points
                                        $total_score = $user['completed_tasks'] + $user['total_points'];
                                        $progress_percentage = ($total_score / 50000) * 100;
                                        ?>
                                        <tr id="userRow<?= $user['id'] ?>">
                                            <td class="px-4 py-2 text-sm text-gray-500"><?= $rank++; ?></td>
                                            <td class="px-4 py-2 text-sm text-gray-800">
                                                <?= htmlspecialchars($user['username']); ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div class="flex items-center">
                                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                        <div class="bg-blue-600 h-2.5 rounded-full"
                                                            style="width: <?= min($progress_percentage, 100); ?>%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-2 text-sm text-gray-500 user-points">
                                                <?= $user['total_points']; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 text-sm text-gray-500 text-center">No users found.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- Card Layout for LG and Smaller Screens -->
                <div class="lg:hidden space-y-4">
                    <?php if (!empty($rankings)): ?>
                        <?php
                        $rank = 1;
                        foreach ($rankings as $user):
                            $total_score = $user['completed_tasks'] + $user['total_points'];
                            $progress_percentage = ($total_score / 50000) * 100;
                            ?>
                            <div class="user-card bg-white p-4 rounded-lg shadow-md border border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-700">#<?= $rank++; ?>
                                    <?= htmlspecialchars($user['username']); ?>
                                </h3>
                                <p class="text-gray-600 text-sm"><span class="font-semibold">Points:</span>
                                    <?= $user['total_points']; ?></p>
                                <p class="text-gray-600 text-sm"><span class="font-semibold">Completed Tasks:</span></p>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                    <div class="bg-blue-600 h-2.5 rounded-full"
                                        style="width: <?= min($progress_percentage, 100); ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center text-gray-500 text-sm">No users found.</div>
                    <?php endif; ?>
                </div>
            </div>

        </div>


        <!-- Right Section - Notifications -->
        <div class="right-section hidden 2xl:block">
            <!-- Right Section Content -->
        </div>

    </div>

    <script>
        // Handle the reset date form submission
        document.querySelector('form[action="<?= base_url('conAdmin/setResetDate') ?>"]').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);
            fetch('<?= base_url('conAdmin/setResetDate') ?>', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    showToast(data);
                    if (data.status === "success") {
                        setTimeout(() => location.reload(), 2000); // Delay reload by 2 seconds
                    }
                })
                .catch(error => console.error('Error:', error));
        });
        function showToast(response) {
            Toastify({
                text: response.message,
                backgroundColor: response.status === 'success' ?
                    "linear-gradient(to right,rgb(0, 0, 0),rgb(18, 208, 186))" :
                    "linear-gradient(to right,rgb(0, 0, 0),rgb(217, 32, 152))",
                duration: 3000,
                position: "right"
            }).showToast();
        }

        function updateUserPoints(userId, newPoints) {
            const row = document.querySelector(`#userRow${userId}`);
            if (row) {
                const pointsCell = row.querySelector('.user-points');
                const progressBar = row.querySelector('.bg-blue-600');

                pointsCell.innerText = parseFloat(newPoints).toFixed(2);
                progressBar.style.width = Math.min((newPoints / 50000) * 100, 100) + '%';
            }
        }

        function handleFormSubmit(formSelector, url, onSuccess) {
            const form = document.querySelector(formSelector);
            if (!form) return;

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                const formData = new FormData(this);
                fetch(url, { method: 'POST', body: formData })
                    .then(response => response.json())
                    .then(data => {
                        showToast(data);
                        if (data.status === "success" && onSuccess) onSuccess(formData);
                    })
                    .catch(error => console.error('Error:', error));
            });
        }

        // Handle Add Points
        handleFormSubmit('form[action="<?= base_url('conAdmin/addPointsToUser') ?>"]',
            '<?= base_url('conAdmin/addPointsToUser') ?>',
            formData => {
                const userId = formData.get('user_id');
                const pointsToAdd = parseInt(formData.get('points')) || 0;

                if (userId !== 'all') {
                    const row = document.querySelector(`#userRow${userId}`);
                    if (row) {
                        const currentPoints = parseInt(row.querySelector('.user-points').innerText) || 0;
                        updateUserPoints(userId, currentPoints + pointsToAdd);
                    }
                } else {
                    document.querySelectorAll('#userTable tr').forEach(row => {
                        const pointsCell = row.querySelector('.user-points');
                        if (pointsCell) {
                            const currentPoints = parseInt(pointsCell.innerText) || 0;
                            updateUserPoints(row.id.replace('userRow', ''), currentPoints + pointsToAdd);
                        }
                    });
                }
            }
        );

        // Handle Reset Rank Points (Full Reset)
        handleFormSubmit('form[action="<?= base_url('conAdmin/resetRankPoints') ?>"]',
            '<?= base_url('conAdmin/resetRankPoints') ?>',
            formData => {
                const userId = formData.get('user_id');

                if (userId !== 'all') {
                    updateUserPoints(userId, 0);
                } else {
                    document.querySelectorAll('#userTable tr').forEach(row => {
                        const pointsCell = row.querySelector('.user-points');
                        if (pointsCell) updateUserPoints(row.id.replace('userRow', ''), 0);
                    });
                }
            }
        );

        // Handle Reset Specific Points
        handleFormSubmit('form[action="<?= base_url('conAdmin/resetSpecificPoints') ?>"]',
            '<?= base_url('conAdmin/resetSpecificPoints') ?>',
            formData => {
                const userId = formData.get('user_id');
                const pointsToReset = parseInt(formData.get('points_to_reset')) || 0;

                if (userId !== 'all') {
                    const row = document.querySelector(`#userRow${userId}`);
                    if (row) {
                        const currentPoints = parseInt(row.querySelector('.user-points').innerText) || 0;
                        updateUserPoints(userId, Math.max(0, currentPoints - pointsToReset));
                    }
                } else {
                    document.querySelectorAll('#userTable tr').forEach(row => {
                        const pointsCell = row.querySelector('.user-points');
                        if (pointsCell) {
                            const currentPoints = parseInt(pointsCell.innerText) || 0;
                            updateUserPoints(row.id.replace('userRow', ''), Math.max(0, currentPoints - pointsToReset));
                        }
                    });
                }
            }
        );

    </script>




</body>

</html>