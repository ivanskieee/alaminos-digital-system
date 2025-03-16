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
            <div class="bg-white shadow-md rounded-lg h-96 p-3 flex flex-col items-center cursor-pointer hover:shadow-lg transition duration-300 relative"
                onclick="confirmAction('userInfo')">

                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <button onclick="toggleEllipsisDashboard(this)"
                        class="absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <button onclick="goToPage('?view=userInfo')"
                            class="block w-full border-b text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </button>
                        <button onclick="downloadChart(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </button>
                        <button onclick="exportAsPDF(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </button>

                    </div>
                </div>

                <h2 class="text-sm font-bold text-green-500">Total Users</h2>
                <p class="text-xl font-semibold text-green-900"><?php echo count($users); ?></p>
                <canvas id="totalUsersChart"></canvas>
            </div>


            <!-- Weekly Tracker -->
            <div class="bg-white shadow-md rounded-lg p-3 h-96">
                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <button onclick="toggleEllipsisDashboard(this)"
                        class="absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <button onclick="goToPage('?view=userFiles')"
                            class="block w-full border-b text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </button>
                        <button onclick="downloadChart(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </button>
                        <button onclick="exportAsPDF(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </button>

                    </div>
                </div>
                <h2 class="text-sm font-semibold text-gray-700 mb-3">Weekly Tracker</h2>
                <canvas id="weeklyLineChart"></canvas>
            </div>

            <!-- User Gender Distribution -->
            <div class="bg-white shadow-md rounded-lg p-3 h-96 flex flex-col items-center">


                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <button onclick="toggleEllipsisDashboard(this)"
                        class="absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <button onclick="goToPage('?view=FacultyMemberInformation')"
                            class="block w-full border-b text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </button>
                        <button onclick="downloadChart(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </button>
                        <button onclick="exportAsPDF(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </button>
                    </div>
                </div>
                <h2 class="text-sm font-bold text-gray-500">User Gender Distribution</h2>
                <canvas id="genderChart"></canvas>
            </div>
            <div class="bg-white shadow-md rounded-lg p-3 flex h-96 flex-col items-center">


                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <button onclick="toggleEllipsisDashboard(this)"
                        class="absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <button onclick="goToPage('?view=manage_user')"
                            class="block w-full border-b text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </button>
                        <button onclick="downloadChart(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </button>
                        <button onclick="exportAsPDF(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </button>
                    </div>
                </div>

                <h2 class="text-sm font-bold text-gray-500">User Approval Breakdown</h2>
                <canvas id="sunburstChart"></canvas>
            </div>

        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
            <!-- Users Position -->
            <div class="bg-white shadow-md h-[450px] rounded-lg p-3 flex flex-col items-center">
                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <button onclick="toggleEllipsisDashboard(this)"
                        class="absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <button onclick="goToPage('?view=userUploadedTasks')"
                            class="block w-full border-b text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </button>
                        <button onclick="downloadChart(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </button>
                        <button onclick="exportAsPDF(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </button>
                    </div>
                </div>
                <h2 class="text-sm font-bold text-gray-500">Users Position</h2>
                <canvas id="userPositionChart"></canvas>
            </div>


            <!-- File Status Overview (Set Height to 450px) -->
            <div class="bg-white h-[450px] shadow-md rounded-lg p-3 flex flex-col items-center">
                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <button onclick="toggleEllipsisDashboard(this)"
                        class="absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <button onclick="goToPage('?view=userFiles')"
                            class="block w-full border-b text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </button>
                        <button onclick="downloadChart(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </button>
                        <button onclick="exportAsPDF(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </button>
                    </div>
                </div>
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

                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <button onclick="toggleEllipsisDashboard(this)"
                        class="absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">

                        <button onclick="downloadChart(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </button>
                        <button onclick="exportAsPDF(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </button>
                    </div>
                </div>
                <h2 class="text-sm font-bold text-gray-500">Users vs Admins</h2>
                <canvas id="usersAdminsChart"></canvas>
            </div>


            <!-- Daily File Uploads -->
            <div class="bg-white shadow-md h-[500px] rounded-lg p-3 flex flex-col items-center">

                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <button onclick="toggleEllipsisDashboard(this)"
                        class="absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <button onclick="goToPage('?view=userFiles')"
                            class="block w-full border-b text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </button>
                        <button onclick="downloadChart(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </button>
                        <button onclick="exportAsPDF(this)"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </button>
                    </div>
                </div>

                <h2 class="text-sm font-bold text-gray-500">Daily File Uploads</h2>
                <canvas id="dailyUploadsChart"></canvas>
            </div>
        </div>

    </div>
    <!-- User Progress Table -->
    <div class="bg-white shadow-md rounded-lg p-3 mb-4 mx-3">
        <div class="relative w-full">
            <!-- Vertical Ellipsis Button -->
            <button onclick="toggleEllipsisDashboard(this)"
                class="absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                &#8942;
            </button>

            <!-- Dropdown Menu -->
            <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">

                <button onclick="downloadChart(this)"
                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Download Chart as img
                </button>
                <button onclick="exportAsPDF(this)"
                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Export as PDF
                </button>
            </div>
        </div>

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

        // Toggle dropdown menu visibility
        function toggleEllipsisDashboard(button) {
            let menu = button.nextElementSibling;
            let allMenus = document.querySelectorAll('.hidden');

            // Close all other dropdowns
            allMenus.forEach(m => {
                if (m !== menu) m.classList.add('hidden');
            });

            // Toggle current menu
            menu.classList.toggle('hidden');
        }

        // Navigate to the user page
        function goToPage(page) {
            window.location.href = "<?php echo base_url('conAdmin/'); ?>" + page;
        }


        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            let menus = document.querySelectorAll('.hidden');
            menus.forEach(menu => {
                if (!menu.parentElement.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
        // Function to download the chart
        function downloadChart(button) {
            // Hanapin ang canvas na nasa parehong div
            let canvas = button.closest('.relative').parentElement.querySelector('canvas');

            if (!canvas) {
                alert("No chart found!");
                return;
            }

            // Convert canvas to data URL
            let image = canvas.toDataURL("image/png");

            // Create a download link
            let link = document.createElement('a');
            link.href = image;
            link.download = canvas.id + ".png"; // Gamitin ang ID ng canvas bilang filename
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }



        function exportAsPDF(button) {
            // Hanapin ang canvas o table na nasa parehong div
            let parentDiv = button.closest('.relative').parentElement;
            let canvas = parentDiv.querySelector('canvas');
            let table = parentDiv.querySelector('table');

            // Create a new window for the printable content
            let printWindow = window.open('', '', 'width=800,height=600');

            // Add basic styles
            printWindow.document.write('<html><head><title>Export PDF</title>');
            printWindow.document.write('<style>');
            printWindow.document.write('body { font-family: Arial, sans-serif; text-align: center; }');
            printWindow.document.write('canvas { max-width: 100%; height: auto; }');
            printWindow.document.write('table { border-collapse: collapse; width: 100%; margin-top: 20px; }');
            printWindow.document.write('th, td { border: 1px solid black; padding: 8px; text-align: left; }');
            printWindow.document.write('</style></head><body>');

            // Add content based on what is found
            if (canvas) {
                let image = canvas.toDataURL("image/png");
                printWindow.document.write('<h2>Chart Export</h2>');
                printWindow.document.write('<img src="' + image + '" style="max-width: 100%;">');
            } else if (table) {
                printWindow.document.write('<h2>Data Export</h2>');
                printWindow.document.write(table.outerHTML);
            } else {
                printWindow.document.write('<h2>No content available for export</h2>');
            }

            // Close document
            printWindow.document.write('</body></html>');
            printWindow.document.close();

            // Wait for the content to load before printing
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 500);
        }

    </script>

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