<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

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
                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <a onclick="toggleEllipsisDashboard(this)"
                        class="hover_darkmode_gray cursor-pointer absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <a onclick="goToPage('?view=requirementstatus')"
                            class="hover_darkmode_gray cursor-pointer border-b block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </a>
                        <a onclick="downloadChart(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </a>
                        <a onclick="exportAsPDF(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </a>

                    </div>
                </div>
                <h2 class="text-sm text-gray-600">Uploaded Files</h2>
                <p class="text-3xl font-bold text-blue-500"><?= $totalUploaded ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-5 text-center">
                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <a onclick="toggleEllipsisDashboard(this)"
                        class="hover_darkmode_gray cursor-pointer absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <a onclick="goToPage('?view=requirementstatus')"
                            class="hover_darkmode_gray cursor-pointer border-b block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </a>
                        <a onclick="downloadChart(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </a>
                        <a onclick="exportAsPDF(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </a>

                    </div>
                </div>
                <h2 class="text-sm text-gray-600">Pending Approval</h2>
                <p class="text-3xl font-bold text-yellow-500"><?= $pendingFiles ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-5 text-center">
                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <a onclick="toggleEllipsisDashboard(this)"
                        class="hover_darkmode_gray cursor-pointer absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <a onclick="goToPage('?view=requirementstatus')"
                            class="hover_darkmode_gray cursor-pointer border-b block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </a>
                        <a onclick="downloadChart(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </a>
                        <a onclick="exportAsPDF(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </a>

                    </div>
                </div>
                <h2 class="text-sm text-gray-600">Approved Files</h2>
                <p class="text-3xl font-bold text-green-500"><?= $approvedFiles ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-5 text-center">
                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <a onclick="toggleEllipsisDashboard(this)"
                        class="hover_darkmode_gray cursor-pointer absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <a onclick="goToPage('?view=requirementstatus')"
                            class="hover_darkmode_gray cursor-pointer border-b block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </a>
                        <a onclick="downloadChart(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </a>
                        <a onclick="exportAsPDF(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </a>

                    </div>
                </div>
                <h2 class="text-sm text-gray-600">Denied Files</h2>
                <p class="text-3xl font-bold text-red-500"><?= $deniedFiles ?></p>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-5 rounded-lg shadow-md">
                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <a onclick="toggleEllipsisDashboard(this)"
                        class="hover_darkmode_gray cursor-pointer absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <a onclick="goToPage('?view=userrequirements')"
                            class="hover_darkmode_gray cursor-pointer bord block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </a>
                        <a onclick="downloadChart(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </a>
                        <a onclick="exportAsPDF(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </a>

                    </div>
                </div>
                <h3 class="text-sm font-semibold mb-3 text-center">Approval Status</h3>
                <canvas id="approvalPieChart"></canvas>
            </div>
            <div class="bg-white p-5 rounded-lg shadow-md">
                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <a onclick="toggleEllipsisDashboard(this)"
                        class="hover_darkmode_gray cursor-pointer absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <a onclick="goToPage('?view=userrequirements')"
                            class="hover_darkmode_gray cursor-pointer bord block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </a>
                        <a onclick="downloadChart(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </a>
                        <a onclick="exportAsPDF(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </a>

                    </div>
                </div>
                <h3 class="text-sm font-semibold mb-3 text-center">Files Over Time</h3>
                <canvas id="uploadBarChart"></canvas>
            </div>
            <div class="bg-white p-5 rounded-lg shadow-md">
                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <a onclick="toggleEllipsisDashboard(this)"
                        class="hover_darkmode_gray cursor-pointer absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <a onclick="goToPage('?view=userrequirements')"
                            class="hover_darkmode_gray cursor-pointer bord block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </a>
                        <a onclick="downloadChart(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </a>
                        <a onclick="exportAsPDF(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </a>

                    </div>
                </div>
                <h3 class="text-sm font-semibold mb-3 text-center">File Categories</h3>
                <canvas id="categoryDoughnutChart"></canvas>
            </div>
            <div class="bg-white p-5 rounded-lg shadow-md">
                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <a onclick="toggleEllipsisDashboard(this)"
                        class="hover_darkmode_gray cursor-pointer absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <a onclick="goToPage('?view=userrequirements')"
                            class="hover_darkmode_gray cursor-pointer bord block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Go to Page
                        </a>
                        <a onclick="downloadChart(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </a>
                        <a onclick="exportAsPDF(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </a>

                    </div>
                </div>

                <h3 class="text-sm font-semibold mb-3 text-center">Progress Trend</h3>
                <canvas id="progressLineChart"></canvas>
            </div>
        </div>
        <div class="flex flex-wrap gap-6">

            <!-- Hidden on mobile (visible on sm and up) -->
            <div class="hidden sm:block flex-1 h-[500px] bg-white p-5 rounded-lg shadow-md">
                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <a onclick="toggleEllipsisDashboard(this)"
                        class="hover_darkmode_gray cursor-pointer absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <a onclick="downloadChart(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </a>
                        <a onclick="exportAsPDF(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </a>
                    </div>
                </div>
                <h3 class="text-sm font-semibold mb-3 text-center">Rank Progression Comparison</h3>
                <canvas id="rankProgressRadarChart"></canvas>
            </div>

            <!-- Always visible (even on mobile) -->
            <div class="hidden sm:block flex-1 h-[500px] bg-white p-5 rounded-lg shadow-md">
                <div class="relative w-full">
                    <!-- Vertical Ellipsis Button -->
                    <a onclick="toggleEllipsisDashboard(this)"
                        class="hover_darkmode_gray cursor-pointer absolute top-2 right-2 p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                        &#8942;
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-2 top-10 bg-white shadow-md rounded-lg py-2 w-40 z-10">
                        <a onclick="downloadChart(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Download Chart as img
                        </a>
                        <a onclick="exportAsPDF(this)"
                            class="hover_darkmode_gray cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Export as PDF
                        </a>
                    </div>
                </div>
                <h3 class="text-sm font-semibold mb-3 text-center">User Points Distribution</h3>
                <canvas id="userPointsBarChart"></canvas>
            </div>

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
            window.location.href = "<?php echo base_url('Home/'); ?>" + page;
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


        // Rank Progression Radar Chart
        new Chart(document.getElementById('rankProgressRadarChart'), {
            type: 'radar',
            data: {
                labels: <?= $rankLabels ?>,
                datasets: [{
                    label: 'Progress %',
                    data: <?= $rankCounts ?>,
                    backgroundColor: 'rgba(26, 188, 156, 0.2)', // Teal with transparency
                    borderColor: '#1abc9c', // Light teal
                    pointBackgroundColor: '#16a085', // Darker teal
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: '#16a085' // Darker teal
                }]
            },
            options: {
                scale: {
                    ticks: { beginAtZero: true }
                }
            }
        });


        // User Points Bar Chart
        new Chart(document.getElementById('userPointsBarChart'), {
            type: 'bar',
            data: {
                labels: <?= $userNames ?>,
                datasets: [{
                    label: 'Points',
                    data: <?= $userPoints ?>,
                    backgroundColor: 'rgba(26, 188, 156, 0.59)',
                    borderColor: 'rgb(0, 255, 204)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Faculty Submissions Over Time Line Chart
        new Chart(document.getElementById('facultySubmissionsLineChart'), {
            type: 'line',
            data: {
                labels: <?= $submissionDates ?>,
                datasets: [{
                    label: 'Submissions',
                    data: <?= $submissionCounts ?>,
                    borderColor: '#27ae60',
                    backgroundColor: 'rgba(39, 174, 96, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>



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
                        '#76D7C4', '#B2DFDB', '#80CBC4', '#4DB6AC', '#26A69A',
                        '#009688', '#00897B', '#00796B', '#00695C', '#004D40',
                        '#D1F2EB', '#A3E4D7', '#0B5345', '#48C9B0', '#1ABC9C',
                        '#17A589', '#148F77', '#117A65', '#0E6251', '#E0F2F1'
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