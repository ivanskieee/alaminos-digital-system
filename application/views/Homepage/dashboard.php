<!DOCTYPE html>
<html lang="en">
<?php
// Kunin ang count ng bawat rank mula sa database
$rankCounts = [];
$ranks = [
    'Instructor I',
    'Instructor II',
    'Instructor III',
    'Assistant Professor I',
    'Assistant Professor II',
    'Associate Professor I',
    'Associate Professor II',
    'Associate Professor III',
    'Associate Professor IV',
    'Professor I',
    'Professor II'
];
foreach ($ranks as $rank) {
    $query = $this->db->where('rank', $rank)->count_all_results('users');
    $rankCounts[$rank] = $query;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet"
        href="<?php echo base_url('assets/css/dashboard.css?v=' . filemtime('assets/css/dashboard.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<style>
    #progress_table {
        height: 500px;
    }
</style>


<body class="bg-gray-100 p-6">

    <div class="m-3">
        <!-- Dashboard Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 mb-4">
            <!-- Total Users -->
            <div class="bg-white shadow-md rounded-lg h-96 p-3 flex flex-col items-center cursor-pointer hover:shadow-lg transition duration-300"
                onclick="confirmAction('userInfo')">
                <h2 class="text-sm font-bold text-green-500">Total Users</h2>
                <p class="text-xl font-semibold text-green-900"><?php echo count($users); ?></p>
                <canvas id="totalUsersChart"></canvas>
            </div>

            <!-- Weekly Tracker -->
            <div class="bg-white shadow-md rounded-lg p-3 h-96">
                <h2 class="text-sm font-semibold text-gray-700 mb-3">Weekly Tracker</h2>
                <canvas id="weeklyLineChart"></canvas>
            </div>

            <!-- User Gender Distribution -->
            <div class="bg-white shadow-md rounded-lg p-3 h-96 flex flex-col items-center">
                <h2 class="text-sm font-bold text-gray-500">User Gender Distribution</h2>
                <canvas id="genderChart"></canvas>
            </div>
            <div class="bg-white shadow-md rounded-lg p-3 flex h-96 flex-col items-center">
                <h2 class="text-sm font-bold text-gray-500">User Approval Breakdown</h2>
                <canvas id="sunburstChart"></canvas>
            </div>

        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
            <!-- Users Position -->
            <div class="bg-white shadow-md h-[450px] rounded-lg p-3 flex flex-col items-center">
                <h2 class="text-sm font-bold text-gray-500">Users Position</h2>
                <canvas id="userPositionChart"></canvas>
            </div>


            <!-- File Status Overview (Set Height to 450px) -->
            <div class="bg-white h-[450px] shadow-md rounded-lg p-3 flex flex-col items-center">

                <h2 class="text-sm font-bold text-gray-500">File Status Overview</h2>
                <canvas id="fileStatusChart"></canvas>
            </div>

        </div>


        <!-- Additional Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <!-- Uploaded Files -->
            <!-- <div class="bg-white shadow-md rounded-lg p-3 flex flex-col items-center cursor-pointer hover:shadow-lg transition duration-300"
                onclick="confirmAction('userfiles')">
                <h2 class="text-sm font-bold text-blue-500">Uploaded Files</h2>
                <p class="text-xl font-semibold text-blue-500"><?php echo $totalUploaded; ?></p>
                <canvas id="uploadedFilesChart"></canvas>
            </div> -->
            <div class="bg-white shadow-md h-[500px] rounded-lg p-3 flex flex-col items-center">
                <h2 class="text-sm font-bold text-gray-500">Users vs Admins</h2>
                <canvas id="usersAdminsChart"></canvas>
            </div>


            <!-- Daily File Uploads -->
            <div class="bg-white shadow-md h-[500px] rounded-lg p-3 flex flex-col items-center">
                <h2 class="text-sm font-bold text-gray-500">Daily File Uploads</h2>
                <canvas id="dailyUploadsChart"></canvas>
            </div>
        </div>

    </div>
    <!-- User Progress Table -->
    <div class="bg-white shadow-md rounded-lg p-3 mb-4 mx-3">
        <h2 class="text-sm font-semibold text-gray-700 mb-3">All Users Progress</h2>
        <div id="progress_table" class="overflow-y-auto">

            <?php
            $progress_sorting = array_column($users, 'progress');
            array_multisort($progress_sorting, SORT_DESC, $users);
            ?>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Username</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Progress</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($users as $user): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-800"><?= htmlspecialchars($user['username']); ?></td>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                <?php
                                $progress = !empty($user['progress']) ? round($user['progress'], 2) : 0;
                                $progress = min($progress, 100); // Ensure it doesn’t exceed 100%
                                ?>
                                <div class="w-full bg-gray-200 rounded-md h-2">
                                    <div class="bg-blue-500 h-full rounded-md transition-all duration-300"
                                        style="width: <?= $progress; ?>%;"></div>
                                </div>
                                <div class="text-gray-500 mt-1 text-xs"><?= $progress; ?>% Complete</div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>






    <script>
        new Chart(document.getElementById('usersAdminsChart'), {
            type: 'doughnut',
            data: {
                labels: ['Users', 'Admins'],
                datasets: [{
                    data: [<?= $totalUsers; ?>, <?= $totalAdmins; ?>],
                    backgroundColor: ['#14b8a6', '#f43f5e'], // Teal & Red
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
        new Chart(document.getElementById('sunburstChart'), {
            type: 'pie',
            data: {
                labels: ['Approved', 'Rejected', 'Pending'],
                datasets: [{
                    data: [<?= $approved_count; ?>, <?= $rejected_count; ?>, <?= $pending_count; ?>],
                    backgroundColor: ['#14b8a6', '#06b6d4', '#10b981'],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'right' },
                    tooltip: { callbacks: { label: (tooltipItem) => `${tooltipItem.label}: ${tooltipItem.raw} users` } }
                }
            }
        });
        // Users Position Bar Graph
        new Chart(document.getElementById('userPositionChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($rankCounts)); ?>,
                datasets: [{
                    label: 'Number of Users',
                    data: <?php echo json_encode(array_values($rankCounts)); ?>,
                    backgroundColor: '#14b8a6', // Teal
                    borderColor: '#0f766e', // Dark Teal
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } },
                plugins: { legend: { display: false } }
            }
        });

        // Gender Distribution Chart
        new Chart(document.getElementById('genderChart'), {
            type: 'doughnut',
            data: {
                labels: ['Male', 'Female', 'Other'],
                datasets: [{
                    data: [<?= $maleUsers; ?>, <?= $femaleUsers; ?>, <?= $otherUsers; ?>],
                    backgroundColor: ['#14b8a6', '#06b6d4', '#10b981'], // Teal, Cyan, Green
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // Chart for Total Users
        new Chart(document.getElementById('totalUsersChart'), {
            type: 'bar',
            data: {
                labels: ['Total Users'],
                datasets: [{
                    label: 'Users',
                    data: [<?= count($users); ?>],
                    backgroundColor: '#14b8a6', // Teal
                }]
            }
        });

        // Chart for Uploaded Files
        new Chart(document.getElementById('uploadedFilesChart'), {
            type: 'pie',
            data: {
                labels: ['Uploaded Files'],
                datasets: [{
                    data: [<?= $totalUploaded; ?>],
                    backgroundColor: '#14b8a6',
                }]
            }
        });

        // Weekly Line Chart
        new Chart(document.getElementById('weeklyLineChart'), {
            type: 'line',
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                datasets: [
                    {
                        label: 'Approved Files',
                        data: [<?php echo implode(',', $approved_files_by_day); ?>],
                        borderColor: '#14b8a6', // Teal
                        backgroundColor: 'rgba(20, 184, 166, 0.2)',
                        fill: false,
                        tension: 0.1,
                    },
                    {
                        label: 'Denied Files',
                        data: [<?php echo implode(',', $denied_files_by_day); ?>],
                        borderColor: '#f43f5e', // Soft Red
                        backgroundColor: 'rgba(244, 63, 94, 0.2)',
                        fill: false,
                        tension: 0.1,
                    }
                ]
            },
            options: {
                responsive: true,
                scales: { x: { beginAtZero: true }, y: { beginAtZero: true } },
                plugins: { legend: { position: 'top' } }
            }
        });

        // Stacked Bar Chart for Daily Uploads
        new Chart(document.getElementById('dailyUploadsChart'), {
            type: 'bar',
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                datasets: [
                    {
                        label: 'Approved Files',
                        data: <?php echo json_encode($approved_files_by_day); ?>,
                        backgroundColor: '#14b8a6',
                        stack: 'Stack 0',
                    },
                    {
                        label: 'Denied Files',
                        data: <?php echo json_encode($denied_files_by_day); ?>,
                        backgroundColor: '#f43f5e',
                        stack: 'Stack 0',
                    }
                ]
            },
            options: {
                responsive: true,
                scales: { x: { beginAtZero: true }, y: { stacked: true, beginAtZero: true } },
                plugins: { legend: { position: 'top' } }
            }
        });

        // Radar Chart - Consolidated File Status
        new Chart(document.getElementById('fileStatusChart'), {
            type: 'radar',
            data: {
                labels: ['Pending Approval', 'Approved Files', 'Denied Files', 'Total Uploaded'],
                datasets: [{
                    label: 'File Status Overview',
                    data: [
                        <?= $totalUploaded - $approvedFiles - $deniedFiles; ?>,
                        <?= $approvedFiles; ?>,
                        <?= $deniedFiles; ?>,
                        <?= $totalUploaded; ?>
                    ],
                    backgroundColor: 'rgba(20, 184, 166, 0.2)', // Teal Glow
                    borderColor: '#14b8a6', // Teal Border
                    pointBackgroundColor: ['#facc15', '#06b6d4', '#f43f5e', '#10b981'], // Yellow, Cyan, Red, Green
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: '#14b8a6'
                }]
            },
            options: {
                responsive: true,
                elements: { line: { borderWidth: 2 } },
                scales: {
                    r: {
                        suggestedMin: 0,
                        suggestedMax: <?= $totalUploaded; ?>,
                        grid: { color: 'rgba(20, 184, 166, 0.5)' },
                        angleLines: { color: 'rgba(20, 184, 166, 0.8)' },
                        ticks: { backdropColor: 'rgba(0, 0, 0, 0.8)', color: '#facc15' }
                    }
                },
                plugins: {
                    legend: { position: 'top', labels: { color: '#14b8a6' } }
                }
            }
        });
    </script>


</body>

</html>