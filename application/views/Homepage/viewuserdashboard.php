<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen p-6">
    <div class="m-10">
        <div class="bg-white p-5 rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-semibold mb-3">Overall Progress</h3>
            <div class="w-full bg-gray-200 rounded-full h-5">
                <div class="bg-teal-400 h-5 rounded-full text-white text-xs text-center leading-5"
                    style="width: <?= $progress ?>%;">
                    <?= round($progress, 2) ?>%
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
            <div class="bg-white shadow-md rounded-lg p-5 text-center">
                <h2 class="text-sm text-gray-600">Uploaded Files</h2>
                <p class="text-3xl font-bold text-blue-500"><?= $totalUploaded ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-5 text-center">
                <h2 class="text-sm text-gray-600">Pending Approval</h2>
                <p class="text-3xl font-bold text-yellow-500"><?= $pendingFiles ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-5 text-center">
                <h2 class="text-sm text-gray-600">Approved Files</h2>
                <p class="text-3xl font-bold text-green-500"><?= $approvedFiles ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-5 text-center">
                <h2 class="text-sm text-gray-600">Denied Files</h2>
                <p class="text-3xl font-bold text-red-500"><?= $deniedFiles ?></p>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6">
            <div class="bg-white p-5 rounded-lg shadow-md">
                <h3 class="text-sm font-semibold mb-3 text-center">Approval Status</h3>
                <canvas id="approvalPieChart"></canvas>
            </div>
            <div class="bg-white p-5 rounded-lg shadow-md">
                <h3 class="text-sm font-semibold mb-3 text-center">Files Over Time</h3>
                <canvas id="uploadBarChart"></canvas>
            </div>
            <div class="bg-white p-5 rounded-lg shadow-md">
                <h3 class="text-sm font-semibold mb-3 text-center">File Categories</h3>
                <canvas id="categoryDoughnutChart"></canvas>
            </div>
            <div class="bg-white p-5 rounded-lg shadow-md">
                <h3 class="text-sm font-semibold mb-3 text-center">Progress Trend</h3>
                <canvas id="progressLineChart"></canvas>
            </div>
        </div>
    </div>


    <script>
        new Chart(document.getElementById('approvalPieChart'), {
            type: 'pie',
            data: {
                labels: ['Approved', 'Pending', 'Denied'],
                datasets: [{
                    data: [<?= $approvedFiles ?>, <?= $pendingFiles ?>, <?= $deniedFiles ?>],
                    backgroundColor: ['#14b8a6', '#1ABC9C', '#10b981']
                }]
            }
        });

        new Chart(document.getElementById('uploadBarChart'), {
            type: 'bar',
            data: {
                labels: <?= $uploadDates ?>,
                datasets: [{
                    label: 'Uploads',
                    data: <?= $uploadCounts ?>,
                    backgroundColor: '#14b8a6'
                }]
            }
        });

        new Chart(document.getElementById('categoryDoughnutChart'), {
            type: 'doughnut',
            data: {
                labels: <?= $fileCategories ?>,
                datasets: [{
                    data: <?= $categoryCounts ?>,
                    backgroundColor: [
                        '#E0F2F1', '#B2DFDB', '#80CBC4', '#4DB6AC', '#26A69A',
                        '#009688', '#00897B', '#00796B', '#00695C', '#004D40',
                        '#D1F2EB', '#A3E4D7', '#76D7C4', '#48C9B0', '#1ABC9C',
                        '#17A589', '#148F77', '#117A65', '#0E6251', '#0B5345'
                    ]
                }]
            }
        });

        new Chart(document.getElementById('progressLineChart'), {
            type: 'line',
            data: {
                labels: <?= $uploadDates ?>,
                datasets: [{
                    label: 'Progress',
                    data: <?= $uploadCounts ?>,
                    borderColor: '#14b8a6',
                    fill: false
                }]
            }
        });
    </script>

</body>

</html>