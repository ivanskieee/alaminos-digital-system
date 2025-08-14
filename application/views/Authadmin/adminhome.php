<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="<?php echo base_url('assets/css/adminhome.css?v=' . filemtime('assets/css/adminhome.css')); ?>">
    <link rel="stylesheet"
        href="<?php echo base_url('assets/css/darkmode_landing.css?v=' . filemtime('assets/css/darkmode_landing.css')); ?>">
    <title>ADMIN PANEL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Flatpickr Initialization -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="icon" type="image/png" href="<?= base_url('uploads/page_icon/RANKINGsystemicon.jpg') ?>">

    <!-- BOXICONS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    #notificationDropdown {
        width: 48rem;
        height: 500px;
    }
</style>

<body>
    <!-- SIDE NAVBAR -->
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="<?= base_url('uploads/page_icon/RANKINGsystemicon.jpg'); ?>" alt="Menu Icon" ">
                </span>

             



            <div class=" text header-text">
                    <span class="name">
                        <?php echo isset($admin->username) ? htmlspecialchars($admin->username) : 'Admin'; ?></span>
                    <span class="profession">ADMIN HR</span>
            </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    <i class='bx bx-search-alt icon'></i>
                    <input class="text-left text-small font-semibold text-center tracking-wider" type="search"
                        id="search-bar" placeholder="SEARCH" oninput="filterData()">

                </li>

                <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('dashboard')">
                        <!-- Dashboard Icon: changed to a house -->
                        <i class='bx bx-home-circle icon'></i>
                        <span class="text nav-text">DASHBOARD</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('manage_user')">
                        <!-- Changed to User Management Icon -->
                        <i class='bx bx-user icon'></i>
                        <span class="text nav-text">MANAGE USER ACCOUNT</span>
                    </a>
                </li>



                <!-- <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('assignShift')">
                        <i class='bx bx-calendar icon'></i>
                        <span class="text nav-text">ASSIGN SHIFT</span>
                    </a>
                </li> -->
                <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('FacultyAdmin')">
                        <i class='bx bx-group icon'></i>
                        <span class="text nav-text">PROMOTE EMPLOYEE</span>
                    </a>
                </li>
                <!-- <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('FacultyManual')">
                        <i class='bx bx-book icon'></i>
                        <span class="text nav-text">FACULTY MANUAL</span>
                    </a>
                </li> -->
                <!-- <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('FacultyMemberInformation')">
                        <i class='bx bx-user-circle icon'></i>
                        <span class="text nav-text">FACULTY MEMBER STAT</span>
                    </a>
                </li> -->

                <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('rankingtask')">
                        <!-- Trophy Icon: changed to medal -->
                        <i class='bx bx-medal icon'></i>
                        <span class="text nav-text">USER RANK</span>
                    </a>
                </li>
                <li class="nav-link">
                    <!-- User Icon: changed to a calendar -->
                    <div class="darkmode_lines mt-12 w-full border-b border-gray-800">
                        <!-- Your content here -->
                    </div>
                </li>


                <!-- <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('createTask')">
                        <i class='bx bx-check-square icon'></i>
                        <span class="text nav-text">USER TASK</span>
                    </a>
                </li> -->
                <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('userUploadedTasks')">
                        <i class='bx bx-cloud-upload icon'></i>
                        <span class="text nav-text">RANK CONFIRMATION</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('adminUserRequirements')">
                        <!-- Changed to List Check Icon -->
                        <i class='bx bx-list-check icon'></i>
                        <span class="text nav-text">ASSIGN REQUIREMENTS</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('userFiles')">
                        <!-- File Icon: changed to folder-open -->
                        <i class='bx bx-folder-open icon'></i>
                        <span class="text nav-text">RELEASING</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('userInfo')">
                        <!-- User Information Icon: changed to user-circle -->
                        <i class='bx bx-user-circle icon'></i>
                        <span class="text nav-text">USER INFORMATION</span>
                    </a>
                </li>



            </div>

            <div class="bottom-content">

                <li class="mode">
                    <div class="moon-sun">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark Mode</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>

    <!-- Improved AdminHome Navbar -->
    <section class="home">
        <nav class="sticky top-0 z-10 bg-white shadow-md">
            <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                <div class="font-bold text-lg hidden sm:block">
                    Making Business Transactions in LGU Easier Through Online Services
                </div>

                <!-- Right-aligned items (Notification and Menu) -->
                <div class="flex items-center space-x-6 ml-auto">
                    <!-- Notification Icon -->
                    <div class="relative">
                        <a id="notificationButton" class="cursor-pointer relative focus:outline-none"
                            onclick="toggleDropdown()">
                            <i class="fas fa-bell text-green-600 text-2xl"></i>
                            <!-- Notification Counter -->
                            <span id="notificationCounter"
                                class="absolute -top-2 -right-2 bg-green-200 text-green-800 text-xs font-bold rounded-full px-2"></span>
                        </a>

                        <!-- Notification Dropdown -->
                        <div id="notificationDropdown"
                            class="hidden absolute right-0 mt-2 w-96 bg-white shadow-lg rounded-lg z-10 border overflow-y-auto max-h-96">
                            <div class="p-4">
                                <div class="sticky top-0 bg-white">
                                    <h3 class="font-bold text-lg flex justify-between px-1 py-2">
                                        Notifications
                                        <a class="text-green-500 rounded px-2 cursor-pointer hover:text-green-800"
                                            onclick="markNotificationsRead()">Mark all as read</a>
                                    </h3>
                                </div>
                                <div id="notificationList">
                                    <?php if (empty($logs)): ?>
                                        <p class="text-center text-gray-500 py-2">No notifications available.</p>
                                    <?php else: ?>
                                        <?php foreach ($logs as $log): ?>
                                            <div
                                                class="notification-item py-3 px-3 border-b border-gray-200 rounded-lg my-3 shadow-md bg-white">
                                                <h3 class="text-gray-700">
                                                    <strong
                                                        class="darkmode_green"><?= htmlspecialchars($log['username']) ?></strong>
                                                    <span class="darkmode_h1"><?= htmlspecialchars($log['action']) ?></span>
                                                </h3>
                                                <p class="text-sm text-gray-500">
                                                    <?= date('F j, Y, g:i a', strtotime($log['timestamp'])) ?>
                                                </p>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Dropdown -->
                    <div class="relative">
                        <a id="menuButton"
                            class="flex items-center space-x-2 text-gray-700 hover:text-green-700 focus:outline-none cursor-pointer"
                            onclick="toggleMenu()">
                            <img src="<?= base_url('uploads/page_icon/RANKINGsystemicon.jpg'); ?>" alt="Menu Icon"
                                class="w-8 h-8 rounded-full border border-gray-300 shadow-sm object-cover">
                        </a>

                        <div id="menuDropdown"
                            class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg z-10 border">
                            <ul class="py-2 text-gray-700">
                                <li>
                                    <a href="javascript:void(0);" onclick="loadView('Feedback')"
                                        class="hover_darkmode_gray block px-4 text-sm py-2 hover:bg-gray-100 flex items-center space-x-2">
                                        <i class='bx bx-message-square-detail text-lg'></i>
                                        <span>Schedules</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="loadView('AuditLogs')"
                                        class="hover_darkmode_gray block px-4 text-sm py-2 hover:bg-gray-100 flex items-center space-x-2">
                                        <i class='bx bx-calendar text-lg'></i>
                                        <span>Audit Logs</span>
                                    </a>
                                </li>
                                <li class="border-t">
                                    <a onclick="checker(event)" href="<?php echo base_url('Home/logout'); ?>"
                                        class="hover_darkmode_gray block px-4 text-sm py-2 text-red-600 hover:bg-gray-100 flex items-center space-x-2">
                                        <i class='bx bx-log-out text-lg'></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Add these style tags in the head section -->
        <style>
            /* Ensure Tailwind utilities are available even if CDN fails to load properly */
            .sticky {
                position: sticky;
            }

            .top-0 {
                top: 0;
            }

            .z-10 {
                z-index: 10;
            }

            .bg-white {
                background-color: white;
            }

            .shadow-md {
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }

            .container {
                width: 100%;
            }

            .mx-auto {
                margin-left: auto;
                margin-right: auto;
            }

            .px-4 {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .py-3 {
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
            }

            .flex {
                display: flex;
            }

            .justify-between {
                justify-content: space-between;
            }

            .items-center {
                align-items: center;
            }

            .font-bold {
                font-weight: 700;
            }

            .text-lg {
                font-size: 1.125rem;
                line-height: 1.75rem;
            }

            .hidden {
                display: none;
            }

            .sm\:block {
                @media (min-width: 640px) {
                    display: block;
                }
            }

            .space-x-6>*+* {
                margin-left: 1.5rem;
            }

            .ml-auto {
                margin-left: auto;
            }

            .relative {
                position: relative;
            }

            .cursor-pointer {
                cursor: pointer;
            }

            .focus\:outline-none:focus {
                outline: 2px solid transparent;
                outline-offset: 2px;
            }

            .text-green-600 {
                color: #059669;
            }

            .text-2xl {
                font-size: 1.5rem;
                line-height: 2rem;
            }

            .absolute {
                position: absolute;
            }

            .-top-2 {
                top: -0.5rem;
            }

            .-right-2 {
                right: -0.5rem;
            }

            .bg-green-200 {
                background-color: #a7f3d0;
            }

            .text-green-800 {
                color: #065f46;
            }

            .text-xs {
                font-size: 0.75rem;
                line-height: 1rem;
            }

            .rounded-full {
                border-radius: 9999px;
            }

            .px-2 {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            .mt-2 {
                margin-top: 0.5rem;
            }

            .w-96 {
                width: 24rem;
            }

            .w-48 {
                width: 12rem;
            }

            .rounded-lg {
                border-radius: 0.5rem;
            }

            .border {
                border-width: 1px;
            }

            .overflow-y-auto {
                overflow-y: auto;
            }

            .max-h-96 {
                max-height: 24rem;
            }

            .p-4 {
                padding: 1rem;
            }

            .py-2 {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }

            .text-green-500 {
                color: #10b981;
            }

            .hover\:text-green-800:hover {
                color: #065f46;
            }

            .text-gray-700 {
                color: #374151;
            }

            .hover\:bg-gray-100:hover {
                background-color: #f3f4f6;
            }

            .space-x-2>*+* {
                margin-left: 0.5rem;
            }

            .border-t {
                border-top-width: 1px;
            }

            .text-red-600 {
                color: #dc2626;
            }

            .w-8 {
                width: 2rem;
            }

            .h-8 {
                height: 2rem;
            }

            .border-gray-300 {
                border-color: #d1d5db;
            }

            .shadow-sm {
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            }

            .object-cover {
                object-fit: cover;
            }

            .hover\:text-green-700:hover {
                color: #047857;
            }

            .py-3 {
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
            }

            .px-3 {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }

            .my-3 {
                margin-top: 0.75rem;
                margin-bottom: 0.75rem;
            }

            .shadow-md {
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }

            /* Responsive dropdown adjustments */
            @media (max-width: 768px) {
                #notificationDropdown {
                    width: 90vw;
                    max-height: 80vh;
                    left: 50%;
                    transform: translateX(-50%);
                    right: auto;
                }

                #menuDropdown {
                    width: 80vw;
                    left: 50%;
                    transform: translateX(-50%);
                }
            }

            @media (max-width: 480px) {
                #notificationDropdown {
                    width: 95vw;
                }

                #menuDropdown {
                    width: 90vw;
                }
            }
        </style>

        <div id="content-container"></div>

        <script>
            // Toggle Notifications Dropdown
            function toggleDropdown() {
                document.getElementById("notificationDropdown").classList.toggle("hidden");
            }

            // Toggle Menu Dropdown
            function toggleMenu() {
                document.getElementById("menuDropdown").classList.toggle("hidden");
            }

            // Close dropdowns when clicking outside
            document.addEventListener("click", function (event) {
                const notificationDropdown = document.getElementById("notificationDropdown");
                const menuDropdown = document.getElementById("menuDropdown");
                const notificationButton = document.getElementById("notificationButton");
                const menuButton = document.getElementById("menuButton");

                if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event.target)) {
                    notificationDropdown.classList.add("hidden");
                }
                if (!menuButton.contains(event.target) && !menuDropdown.contains(event.target)) {
                    menuDropdown.classList.add("hidden");
                }
            });

            // Function to mark notifications as read
            function markNotificationsRead() {
                $.ajax({
                    url: "<?= site_url('conAdmin/markNotificationsAsRead') ?>",
                    method: "POST",
                    success: function () {
                        $('#notificationCounter').hide();
                        fetchNotificationCount();
                    }
                });
            }

            // Function to fetch unread notifications count and display it
            function fetchNotificationCount() {
                $.ajax({
                    url: "<?= site_url('conAdmin/getNotificationsCount') ?>",
                    method: "GET",
                    success: function (response) {
                        var data = JSON.parse(response);
                        var count = data.count;

                        // Update the notification counter
                        if (count > 0) {
                            $('#notificationCounter').text(count).show();
                        } else {
                            $('#notificationCounter').hide();
                        }
                    }
                });
            }

            // Periodically fetch new notifications
            setInterval(fetchNotificationCount, 5000);

            // Initial fetch of notification count on page load
            $(document).ready(function () {
                fetchNotificationCount();
            });
        </script>
    </section>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script>
        const body = document.querySelector("body"),
            sidebar = body.querySelector(".sidebar"),
            toggle = body.querySelector(".toggle"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");

        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
            // Save the state in localStorage
            const isClosed = sidebar.classList.contains("close");
            localStorage.setItem("sidebarState", isClosed ? "closed" : "open");
        });

        // On page load, restore the sidebar state
        document.addEventListener("DOMContentLoaded", function () {
            const savedSidebarState = localStorage.getItem("sidebarState");

            if (savedSidebarState === "closed") {
                sidebar.classList.add("close");
            } else {
                sidebar.classList.remove("close");
            }
        });

        // Toggle dark mode
        modeSwitch.addEventListener("click", () => {
            // Toggle the dark class on body
            body.classList.toggle("dark");

            // Update the mode text
            modeText.innerText = body.classList.contains("dark") ? "Light Mode" : "Dark Mode";

            // Store the dark mode preference in localStorage
            localStorage.setItem('darkMode', body.classList.contains("dark"));
        });

        // Check dark mode preference on page load
        document.addEventListener("DOMContentLoaded", function () {
            const darkModePreference = localStorage.getItem('darkMode') === 'true';

            // If dark mode was previously set, enable dark mode
            if (darkModePreference) {
                body.classList.add("dark");
                modeText.innerText = "Light Mode"; // Update the mode text
            } else {
                body.classList.remove("dark");
                modeText.innerText = "Dark Mode"; // Update the mode text
            }

            // Load the view if stored
            const storedView = localStorage.getItem('adminCurrentView');
            if (storedView) {
                loadView(storedView);
            } else {
                loadView('dashboard'); // Default to Dashboard if no view is stored
            }
        });

        // Function to load different views based on menu click
        function loadView(viewName) {
            let url = '';
            switch (viewName) {
                case 'dashboard':
                    url = '<?php echo base_url('conAdmin/dashboard'); ?>';
                    break;
                case 'rankingtask':
                    url = '<?php echo base_url('conAdmin/rankingtask'); ?>';
                    break;
                case 'manage_user':
                    url = '<?php echo base_url('auth/manage_users'); ?>';
                    break;
                case 'createTask':
                    url = '<?php echo base_url('conAdmin/tasks'); ?>';
                    break;
                case 'adminUserRequirements':
                    url = '<?php echo base_url('conAdmin/adminUserRequirements'); ?>';
                    break;
                case 'userUploadedTasks':
                    url = '<?php echo base_url('conAdmin/userUploadedTasks'); ?>';
                    break;
                case 'userFiles':
                    url = '<?php echo base_url('conAdmin/userfiles'); ?>';
                    break;
                case 'assignShift':
                    url = '<?php echo base_url('controllerAttendance/assignShift'); ?>';
                    break;
                case 'userInfo':
                    url = '<?php echo base_url('conAdmin/userinfo'); ?>';
                    break;
                case 'tasks':
                    url = '<?php echo base_url('conAdmin/tasks'); ?>';
                    break;
                case 'FacultyAdmin':
                    url = '<?php echo base_url('controllerFaculty/FacultyAdmin'); ?>';
                    break;
                case 'FacultyManual':
                    url = '<?php echo base_url('conFacultyManual/adminManualFaculty'); ?>';
                    break;
                case 'Feedback':
                    url = '<?php echo base_url('Auth/feedback_contact'); ?>';
                    break;
                case 'FacultyMemberInformation':
                    url = '<?php echo base_url('conAdmin/FacultyMemberInformation'); ?>';
                    break;
                case 'AuditLogs':
                    url = '<?php echo base_url('conAdmin/AuditLogs'); ?>';
                    break;
                default:
                    url = '<?php echo base_url('conAdmin'); ?>';
            }

            $("#content-container").load(url, function (response, status, xhr) {
                if (status === "error") {
                    console.error(`Error loading ${viewName}: `, xhr.status, xhr.statusText);
                } else {
                    console.log(`${viewName} loaded successfully`);
                    localStorage.setItem('adminCurrentView', viewName);

                    // Update URL without refreshing the page
                    window.history.pushState({ view: viewName }, '', `?view=${viewName}`);
                }
            });
        }

        // Restore view based on URL when reloading
        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            const viewName = urlParams.get('view');

            if (viewName) {
                loadView(viewName);
            } else {
                loadAdminHomeContent(); // Default view
            }
        });

        function loadAdminHomeContent() {
            loadView('dashboard');
        }

        function loadRankingTaskContent() {
            loadView('rankingtask');
        }

        function loadManageUserContent() {
            loadView('manage_user');
        }

        function loadCreateTaskContent() {
            loadView('createTask');
        }

        function loadAdminUserRequirementsContent() {
            loadView('adminUserRequirements');
        }

        function loadUserUploadedTasksContent() {
            loadView('userUploadedTasks');
        }

        function loadUserFilesContent() {
            loadView('userFiles');
        }

        function loadAssignShiftContent() {
            loadView('assignShift');
        }

        function loadUserInfoContent() {
            loadView('userInfo');
        }

        function loadTasksContent() {
            loadView('tasks');
        }

        function loadFacultyAdminContent() {
            loadView('FacultyAdmin');
        }

        function loadFacultyManualContent() {
            loadView('FacultyManual');
        }

        function loadFeedbackContent() {
            loadView('Feedback');
        }
        function loadAuditLogsContent() {
            loadView('AuditLogs');
        }
        function FacultyMemberInformation() {
            loadView('FacultyMemberInformation');
        }


        // Logout confirmation
        function checker(event) {
            event.preventDefault(); // Prevent the default action of the logout link

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to log out!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, log me out!',
                cancelButtonText: 'No, stay logged in!',
                confirmButtonColor: '#0d9488', // Teal-600 (Confirm Button)
                cancelButtonColor: '#5eead4',  // Teal-300 (Cancel Button)
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with logout if confirmed
                    window.location.href = '<?php echo base_url('Home/logout'); ?>';
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        // Improved search function with better UI/UX
        function filterData() {
            const searchQuery = document.getElementById('search-bar').value.toLowerCase().trim();
            const items = document.querySelectorAll('table tbody tr, .log-entry, .user-card, .user-info, .user-approval');
            let found = false;

            // If search box is empty, show all items and remove "no results" message
            if (searchQuery === '') {
                items.forEach(item => {
                    item.style.display = '';
                });

                // Remove no results message if it exists
                const noResultsMessage = document.getElementById('no-results');
                if (noResultsMessage) {
                    noResultsMessage.remove();
                }
                return;
            }

            // Filter items based on search query
            items.forEach(item => {
                const itemText = item.textContent.toLowerCase();
                if (itemText.includes(searchQuery)) {
                    item.style.display = '';
                    found = true;
                } else {
                    item.style.display = 'none';
                }
            });

            // Handle "no results" message
            let noResultsMessage = document.getElementById('no-results');

            if (!found) {
                if (!noResultsMessage) {
                    noResultsMessage = document.createElement('div');
                    noResultsMessage.id = 'no-results';
                    noResultsMessage.innerHTML = `
            <div class="flex flex-col items-center bg-white/90 dark:bg-gray-800/90 backdrop-blur 
                text-red-500 dark:text-red-400 px-8 py-6 rounded-2xl shadow-lg animate-fadeIn">
                <i class="fas fa-search text-red-500 dark:text-red-400 text-6xl mb-4"></i>
                <p class="text-lg font-semibold">No results found</p>
                <p class="text-sm mt-2">Try using different keywords</p>
            </div>`;
                    noResultsMessage.className = "fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 transition-all duration-300";
                    document.body.appendChild(noResultsMessage);
                }
            } else {
                if (noResultsMessage) {
                    noResultsMessage.remove();
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-in-out;
        }
    </style>


</body>

</html>