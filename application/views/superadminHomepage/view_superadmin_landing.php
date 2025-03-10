<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="<?php echo base_url('assets/css/adminhome.css?v=' . filemtime('assets/css/adminhome.css')); ?>">
    <link rel="stylesheet"
        href="<?php echo base_url('assets/css/darkmode_landing.css?v=' . filemtime('assets/css/darkmode_landing.css')); ?>">
    <title>SUPER ADMIN PANEL</title>
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
    .grid div:hover {
        cursor: pointer;
        transform: scale(1.05);
        transition: transform 0.2s ease-in-out;
    }

    #notificationDropdown {
        width: 48rem;
        height: 500px;
        /* Doubled the width */
    }
</style>

<body>

    <!-- SIDE NAVBAR -->
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="https://up.yimg.com/ib/th?id=OIP.LyQMxucs0UiwtrvJeT44MQHaFg&pid=Api&rs=1&c=1&qlt=95&w=145&h=108"
                        alt="logo">
                </span>

                <script>
                    function filterData() {
                        const searchQuery = document.getElementById('search-bar').value.toLowerCase();
                        const items = document.querySelectorAll('table tbody tr, .log-entry, .user-card, .user-info, .user-approval');
                        let found = false;

                        items.forEach(item => {
                            const itemText = item.textContent.toLowerCase();
                            if (itemText.includes(searchQuery)) {
                                item.style.display = '';
                                found = true;
                            } else {
                                item.style.display = 'none';
                            }
                        });

                        let noResultsMessage = document.getElementById('no-results');

                        if (!found) {
                            if (!noResultsMessage) {
                                noResultsMessage = document.createElement('div');
                                noResultsMessage.id = 'no-results';
                                noResultsMessage.innerHTML = `
                    <div class="flex flex-col items-center bg-white/20 backdrop-blur-md text-red-500 px-8 py-6 rounded-2xl shadow-lg animate-fadeIn scale-95">
                        <i class="fas fa-search text-red-500 text-6xl animate-bounce mb-2"></i>
                        <p class="text-lg text-red-500 font-semibold">No results found</p>
                    </div>
                `;
                                noResultsMessage.className = "fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 transition-all duration-300";
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
                <div class="text header-text">
                    <span class="name">SUPER ADMIN</span>
                    <span class="profession"></span>
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
                    <a href="javascript:void(0);" onclick="loadView('approveAdmin')">
                        <!--  Icon: changed to a house -->
                        <i class='bx bx-home-circle icon'></i>
                        <span class="text nav-text truncate">MANAGE ACCOUNTS</span>
                    </a>
                </li>




                <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('FacultyManual')">
                        <!-- Trophy Icon: changed to medal -->
                        <i class='bx bx-medal icon'></i>
                        <span class="text nav-text">FACULTY MANUAL</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('Feedback')">
                        <!-- User Information Icon: changed to user-circle -->
                        <i class='bx bx-user-circle icon'></i>
                        <span class="text nav-text">FEEDBACK</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="javascript:void(0);" onclick="loadView('AuditLogs')">
                        <i class='bx bx-calendar icon'></i>
                        <span class="text nav-text">AUDIT LOGS</span>
                    </a>
                </li>


            </div>

            <div class="bottom-content">

                <li>
                    <a onclick="checker(event)" href="<?php echo base_url('Home/logout'); ?>">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
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
    <section class="home">


        <div id="content-container"></div>
    </section>

    <style>
        /* Style for notification dropdown */
        .notifications_design {
            width: 400px;
            /* Set width to 400px */
            max-height: 300px;
            /* Limit the max height of the dropdown */
            overflow-y: auto;
            /* Make it scrollable if content exceeds max-height */
        }

        /* Add some padding to the notification items */
        .notification-item {
            padding: 10px;
        }

        /* Add some border between items to separate them visually */
        .notification-item:not(:last-child) {
            border-bottom: 1px solid #ddd;
        }
    </style>

    <script>
        function toggleDropdown() {
            document.getElementById("notificationDropdown").classList.toggle("hidden");
        }

        // Function to mark notifications as read
        function markNotificationsRead() {
            $.ajax({
                url: "<?= site_url('conAdmin/markNotificationsAsRead') ?>", // Adjust this URL based on your route
                method: "POST",
                success: function () {
                    // Hide the counter once notifications are marked as read
                    $('#notificationCounter').hide();
                    fetchNotificationCount(); // Re-fetch the notification count after marking as read
                }
            });
        }

        // Function to fetch unread notifications count and display it
        function fetchNotificationCount() {
            $.ajax({
                url: "<?= site_url('conAdmin/getNotificationsCount') ?>", // Adjust this URL based on your route
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

        // Periodically fetch new notifications every 5 seconds
        setInterval(fetchNotificationCount, 5000); // Check every 5 seconds

        // Initial fetch of notification count on page load
        $(document).ready(function () {
            fetchNotificationCount();
        });
    </script>


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
                case 'approveAdmin':
                    url = '<?php echo base_url('controllerSuperAdmin/approveAdmin'); ?>';
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
            loadView('approveAdmin');
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


</body>

</html>