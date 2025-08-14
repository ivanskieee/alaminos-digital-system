<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER PANEL</title>
    <link rel="stylesheet"
        href="<?php echo base_url('assets/css/adminhome.css?v=' . filemtime('assets/css/adminhome.css')); ?>">
    <link rel="stylesheet"
        href="<?php echo base_url('assets/css/darkmode_landing.css?v=' . filemtime('assets/css/darkmode_landing.css')); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="<?= base_url('uploads/page_icon/RANKINGsystemicon.jpg') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- BOXICONS-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        #notificationDropdown {
            width: 48rem;
            /* Doubled the width */
        }
    </style>
</head>

<body>







    <!-- SIDE NAVBAR -->
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="<?= base_url($user['uploaded_profile_image'] ?? 'uploads/default_profiles/default_profile.avif'); ?>"
                        alt="Profile Image">
                </span>

                <div class="text header-text">
                    <span class="name">
                        <?php echo $username; ?>
                    </span>

                    <span class="profession">
                        <?= isset($user['rank']) ? htmlspecialchars($user['rank']) : 'Unranked'; ?>
                    </span>


                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>


        <script>
            // Disable back button functionality
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };
        </script>




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

        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    <i class='bx bx-search-alt icon'></i>
                    <input class="text-left text-small font-semibold text-center tracking-wider" type="search"
                        id="search-bar" placeholder="SEARCH" oninput="filterData()">
                </li>
                <li class="nav-link">
                    <a class="darkmode_sidebar_links" href="javascript:void(0);" onclick="loaduserDashboard()">
                        <i class="darkmode_sidebar_links bx bx-home-circle icon"></i> <!-- userrequirements icon -->
                        <span class="text nav-text">DASHBOARD</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a class="darkmode_sidebar_links" href="javascript:void(0);" onclick="loadUseruserrequirements()">
                        <i class="darkmode_sidebar_links bx bx-folder icon"></i>
                        <!-- Changed icon for User Requirements -->
                        <span class="text nav-text">USER REQUIREMENTS</span>
                    </a>
                </li>

                <!-- <li class="nav-link">
                    <a class="darkmode_sidebar_links" href="javascript:void(0);" onclick="loadAttendanceContent()">
                        <i class="darkmode_sidebar_links bx bx-calendar-check icon"></i> 
                        <span class="text nav-text">ATTENDANCE</span>
                    </a>
                </li> -->
                <!-- <li class="nav-link">
                    <a class="darkmode_sidebar_links" href="javascript:void(0);" onclick="loadManualFacultyContent()">
                        <i class="darkmode_sidebar_links bx bx-list-check icon"></i> 
                        <span class="text nav-text">FACULTY MANUAL</span>
                    </a>
                </li> -->
                <!-- <li class="nav-link">
                    <a class="darkmode_sidebar_links" href="javascript:void(0);" onclick="loadUserTasksContent()">
                        <i class="darkmode_sidebar_links bx bx-list-check icon"></i> 
                        <span class="text nav-text">TASKS</span>
                    </a>
                </li> -->

                <li class="nav-link">
                    <a class="darkmode_sidebar_links" href="javascript:void(0);" onclick="loadRequirementStatus()">
                        <i class="darkmode_sidebar_links bx bx-clipboard icon"></i> <!-- Requirement status icon -->
                        <span class="text nav-text">FILE STATUS</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a class="darkmode_sidebar_links" href="javascript:void(0);" onclick="loadFacultyContent()">
                        <i class="darkmode_sidebar_links bx bx-book icon"></i> <!-- Book icon -->
                        <span class="text nav-text">RANKING</span>
                    </a>
                </li>




                <li class="nav-link">
                    <a class="darkmode_sidebar_links" href="javascript:void(0);" onclick="loadProfileContent()">
                        <i class="darkmode_sidebar_links bx bx-user-circle icon"></i> <!-- Profile icon -->
                        <span class="text nav-text">PROFILE</span>
                    </a>
                </li>

            </div>

            <div class="bottom-content">


                <li class="mode">
                    <div class="moon-sun">
                        <i class='darkmode_sidebar_links bx bx-moon icon moon'></i>
                        <i class='darkmode_sidebar_links bx bx-sun icon sun'></i>
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
        <nav class="sticky top-0 z-10 bg-white shadow-md">
            <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                <div class="font-bold text-lg hidden sm:block">
                    Making Business Transactions in LGU Easier Through Online Services
                </div>

                <!-- Right-aligned items (Notification and Profile) -->
                <div class="flex items-center space-x-6 ml-auto">
                    <!-- Notification Icon -->
                    <div class="relative">
                        <a id="notificationButton" class="cursor-pointer relative focus:outline-none"
                            onclick="toggleDropdown()">
                            <i class="fas fa-bell text-green-600 text-2xl"></i>
                            <!-- Notification Counter -->
                            <span id="notificationCounter"
                                class="absolute -top-2 -right-2 bg-green-200 text-green-800 text-xs font-bold rounded-full px-2">
                                <?= $unread_notifications ?>
                            </span>
                        </a>

                        <!-- Notification Dropdown -->
                        <div id="notificationDropdown"
                            class="hidden absolute right-0 mt-2 w-96 bg-white shadow-lg rounded-lg z-10 border overflow-y-auto max-h-96">
                            <div class="p-4">
                                <h3 class="font-bold text-lg flex justify-between px-1 py-2">
                                    Notifications
                                    <a class="text-green-500 rounded px-2 cursor-pointer hover:text-green-800"
                                        onclick="markNotificationsRead()">Mark all as read</a>
                                    <a class="text-red-500 rounded px-2 cursor-pointer hover:text-red-700"
                                        onclick="deleteAll_ViewHome_Notifications()">Delete all</a>
                                </h3>
                                <ul class="mt-2">
                                    <?php if (empty($notifications)): ?>
                                        <li class="bg-gray-50 p-3 rounded text-center text-gray-500">
                                            No notifications yet
                                        </li>
                                    <?php else: ?>
                                        <?php foreach ($notifications as $notification): ?>
                                            <li
                                                class="bg-white border-b border-gray-200 p-2 my-3 rounded flex justify-between items-center">
                                                <div>
                                                    <p><?= htmlspecialchars($notification['message']) ?></p>
                                                    <p class="text-sm text-gray-500">
                                                        <?= date('F j, Y, g:i a', strtotime($notification['created_at'])) ?>
                                                    </p>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Picture Icon -->
                    <div class="relative">
                        <div class="relative">
                            <a id="userMenuButton" class="flex items-center focus:outline-none cursor-pointer"
                                onclick="toggleUserMenu()">
                                <img src="<?= base_url($user['uploaded_profile_image'] ?? 'uploads/default_profiles/default_profile.avif'); ?>"
                                    alt="Profile Image"
                                    class="w-8 h-8 rounded-full border border-gray-300 shadow-sm object-cover">
                            </a>
                            <div id="userMenuDropdown"
                                class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg z-10 border">
                                <ul class="py-2 text-gray-700">
                                    <li>
                                        <a href="javascript:void(0);" onclick="UserChangePassword()"
                                            class="hover_darkmode_gray block px-4 text-sm py-2 hover:bg-gray-100 flex items-center space-x-2">
                                            <i class="bx bx-key text-lg"></i>
                                            <span>Change Password</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript:void(0);" onclick="userChangeUserInformation()"
                                            class="hover_darkmode_gray block px-4 text-sm py-2 hover:bg-gray-100 flex items-center space-x-2">
                                            <i class="bx bx-user text-lg"></i>
                                            <span>Change Personal Info</span>
                                        </a>
                                    </li>

                                    <li class="border-t">
                                        <a onclick="checker(event)" href="<?php echo base_url('Home/logout'); ?>"
                                            class="hover_darkmode_gray block px-4 text-sm py-2 text-red-600 hover:bg-gray-100 flex items-center space-x-2">
                                            <i class="bx bx-log-out text-lg"></i>
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
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

            .text-red-500 {
                color: #ef4444;
            }

            .hover\:text-red-700:hover {
                color: #b91c1c;
            }

            .bg-gray-50 {
                background-color: #f9fafb;
            }

            .p-3 {
                padding: 0.75rem;
            }

            .text-center {
                text-align: center;
            }

            .text-gray-500 {
                color: #6b7280;
            }

            .bg-white {
                background-color: white;
            }

            .border-b {
                border-bottom-width: 1px;
            }

            .border-gray-200 {
                border-color: #e5e7eb;
            }

            .p-2 {
                padding: 0.5rem;
            }

            .my-3 {
                margin-top: 0.75rem;
                margin-bottom: 0.75rem;
            }

            .text-sm {
                font-size: 0.875rem;
                line-height: 1.25rem;
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

            /* Responsive dropdown adjustments */
            @media (max-width: 768px) {
                #notificationDropdown {
                    width: 90vw;
                    max-height: 80vh;
                    left: 50%;
                    transform: translateX(-50%);
                    right: auto;
                }
            }

            @media (max-width: 480px) {
                #notificationDropdown {
                    width: 95vw;
                }
            }
        </style>

        <div id="content-container"></div> <!-- This will load the usertask.php view dynamically -->

        <script>
            // Toggle Notifications Dropdown
            function toggleDropdown() {
                document.getElementById("notificationDropdown").classList.toggle("hidden");
            }

            // Toggle User Menu Dropdown
            function toggleUserMenu() {
                document.getElementById("userMenuDropdown").classList.toggle("hidden");
            }

            // Close dropdowns when clicking outside
            document.addEventListener("click", function (event) {
                const notificationDropdown = document.getElementById("notificationDropdown");
                const userMenuDropdown = document.getElementById("userMenuDropdown");
                const notificationButton = document.getElementById("notificationButton");
                const userMenuButton = document.getElementById("userMenuButton");

                if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event.target)) {
                    notificationDropdown.classList.add("hidden");
                }
                if (!userMenuButton.contains(event.target) && !userMenuDropdown.contains(event.target)) {
                    userMenuDropdown.classList.add("hidden");
                }
            });
        </script>

        <script>
            // Toggle Notification Dropdown
            function toggleDropdown() {
                document.getElementById('notificationDropdown').classList.toggle('hidden');
            }

            // Mark all notifications as read with validation
            function markNotificationsRead() {
                let notificationCounter = document.getElementById('notificationCounter');
                let unreadCount = parseInt(notificationCounter.innerText);

                if (unreadCount === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Unread Notifications',
                        text: 'There are no unread notifications to mark as read.',
                    });
                    return;
                }

                fetch('<?= base_url('conAdmin/markNotificationsRead') ?>', {
                    method: 'POST',
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            toggleDropdown();
                            notificationCounter.innerText = '0';
                            notificationCounter.style.display = 'none';

                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'All notifications marked as read!',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to mark notifications as read!',
                            });
                        }
                    });
            }

            // Delete all notifications with validation
            function deleteAll_ViewHome_Notifications() {
                let notificationList = document.querySelector('#notificationDropdown ul');

                if (!notificationList || notificationList.children.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Notifications',
                        text: 'There are no notifications to delete.',
                    });
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will delete all notifications permanently.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#b71c1c', // Dark Red
                    cancelButtonColor: '#e53935',  // Lighter Red

                    confirmButtonText: 'Yes, delete all!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('<?= base_url('conAdmin/deleteAll_ViewHome_Notifications') ?>', {
                            method: 'POST',
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    toggleDropdown();
                                    document.getElementById('notificationCounter').innerText = '0';
                                    document.getElementById('notificationCounter').style.display = 'none';
                                    notificationList.innerHTML = '';

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: 'All notifications have been deleted.',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Failed to delete notifications!',
                                    });
                                }
                            });
                    }
                });
            }

            // Delete a single notification with validation
            function deleteNotification(notificationId, notificationType = 'requirements') {
                let notificationElement = document.getElementById('notification-' + notificationId);

                if (!notificationElement) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Notification Not Found',
                        text: 'This notification has already been deleted or does not exist.',
                    });
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This notification will be permanently deleted.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('<?= base_url('conAdmin/delete_viewhome_notifications') ?>', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                notification_id: notificationId,
                                notification_type: notificationType
                            }),
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    notificationElement.remove();
                                    document.getElementById('notificationCounter').innerText = data.unread_notifications;

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: 'Notification has been removed.',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Failed to delete notification!',
                                    });
                                }
                            });
                    }
                });
            }





        </script>


    </section>

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
        modeSwitch.addEventListener("click", () => {
            body.classList.toggle("dark");

            // Save dark mode state in localStorage
            if (body.classList.contains("dark")) {
                modeText.innerText = "Light Mode";
                localStorage.setItem('darkMode', 'true'); // Store dark mode preference
            } else {
                modeText.innerText = "Dark Mode";
                localStorage.setItem('darkMode', 'false'); // Store light mode preference
            }
        });

        // On page load, check for dark mode preference in localStorage
        document.addEventListener("DOMContentLoaded", function () {
            const darkModePreference = localStorage.getItem('darkMode') === 'true';
            if (darkModePreference) {
                body.classList.add('dark');
                modeText.innerText = "Light Mode"; // Update the text to indicate Light Mode
            } else {
                modeText.innerText = "Dark Mode"; // Update the text to indicate Dark Mode
            }

            // Load the stored view on page refresh
            const storedView = localStorage.getItem('currentView');
            if (storedView) {
                loadView(storedView);
            } else {
                loadHomeContent(); // Default to Home if no view is stored
            }
        });

        function loadView(viewName) {
            let url = '';
            switch (viewName) {
                case 'userrequirements':
                    url = '<?php echo base_url('conAdmin/userrequirements'); ?>';
                    break;
                case 'userDashboard':
                    url = '<?php echo base_url('Home/userDashboard'); ?>';
                    break;
                case 'userAttendance':
                    url = '<?php echo base_url('controllerAttendance/userAttendance'); ?>';
                    break;
                case 'tasks':
                    url = '<?php echo base_url('Home/userTasks'); ?>';
                    break;
                case 'userFaculty':
                    url = '<?php echo base_url('controllerFaculty/UserFaculty'); ?>';
                    break;
                case 'profile':
                    url = '<?php echo base_url('Home/clientprofile'); ?>';
                    break;
                case 'requirementstatus':
                    url = '<?php echo base_url('conAdmin/requirementstatus'); ?>';
                    break;
                case 'UserChangePassword':
                    url = '<?php echo base_url('Home/UserChangePassword'); ?>';
                    break;
                case 'userManualFaculty':
                    url = '<?php echo base_url('conFacultyManual/userManualFaculty'); ?>';
                    break;
                case 'userChangeUserInformation':
                    url = '<?php echo base_url('Home/userChangeUserInformation'); ?>';
                    break;
                case 'UserFacultyMemberInformation':
                    url = '<?php echo base_url('Home/UserFacultyMemberInformation'); ?>';
                    break;
                default:
                    url = '<?php echo base_url('Home/DefaultHome'); ?>';
            }

            $("#content-container").load(url, function (response, status, xhr) {
                if (status === "error") {
                    console.error(`Error loading ${viewName}: `, xhr.status, xhr.statusText);
                } else {
                    console.log(`${viewName} loaded successfully`);
                    localStorage.setItem('currentView', viewName);

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
                loadHomeContent(); // Default view
            }
        });


        function loadHomeContent() {
            loadView('home');
        }
        function loadAttendanceContent() {
            loadView('userAttendance');
        }

        function loadUserTasksContent() {
            loadView('tasks');
        }

        function loadRequirementStatus() {
            loadView('requirementstatus');
        }

        function loadUseruserrequirements() {
            loadView('userrequirements');
        }
        function loadFacultyContent() {
            loadView('userFaculty');
        }

        function loadProfileContent() {
            loadView('profile');
        }
        function loadManualFacultyContent() {
            loadView('userManualFaculty');
        }
        function loaduserDashboard() {
            loadView('userDashboard');
        }
        function UserChangePassword() {
            loadView('UserChangePassword');
        }
        function userChangeUserInformation() {
            loadView('userChangeUserInformation');
        }
        function UserFacultyMemberInformation() {
            loadView('UserFacultyMemberInformation');
        }

        function checker(event) {
            event.preventDefault(); // Prevent the default action of the logout link

            // SweetAlert2 confirmation dialog
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Show loading alert
        Swal.fire({
            title: 'Loading...',
            text: 'Please wait while the page loads.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Hide loading alert once the content has fully loaded
        window.onload = function () {
            Swal.close();
        };
    });
</script>

</html>