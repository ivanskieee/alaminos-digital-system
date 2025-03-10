<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER REQUIREMENTS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.tailwindcss.com"></script>



    <style>
        div.approval,
        div.buttons,
        div.file-uploader,
        div.table,
        .grid {
            margin-left: 20px;
        }
    </style>
</head>




<body class="bg-gray-100 ">











    <div class="flex flex-wrap gap-6 mx-3">

        <!-- General File Progress -->
        <div class="flex-1 approval bg-white p-6 rounded-lg shadow-md mb-8 mt-8 ">
            <h3 class="px-6 py-3 text-left text-xl font-semibold text-gray-700 uppercase tracking-wider">General File
                Approval Progress</h3>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class="bg-teal-200 h-4 rounded-full text-teal-700 font-semibold text-center text-xs"
                    style="width: <?= $generalProgress ?>%;">
                    <?= round($generalProgress, 2) ?>%
                </div>
            </div>
        </div>

        <!-- Mandatory File Progress -->
        <div class="flex-1 approval bg-white p-6 rounded-lg shadow-md mb-8 mt-8">
            <h3 class="px-6 py-3 text-left text-xl font-semibold text-gray-700 uppercase tracking-wider">Mandatory File
                Approval Progress</h3>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class="bg-teal-200 h-4 rounded-full text-teal-700 font-semibold text-center text-xs"
                    style="width: <?= $mandatoryProgress ?>%;">
                    <?= round($mandatoryProgress, 2) ?>%
                </div>
            </div>
        </div>

        <!-- Yearly File Progress -->
        <div class="flex-1 approval bg-white p-6 rounded-lg shadow-md mb-8 mt-8">
            <h3 class="px-6 py-3 text-left text-xl font-semibold text-gray-700 uppercase tracking-wider">Yearly File
                Approval Progress</h3>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class="bg-teal-200 h-4 rounded-full text-teal-700 font-semibold text-center text-xs"
                    style="width: <?= $yearlyProgress ?>%;">
                    <?= round($yearlyProgress, 2) ?>%
                </div>
            </div>
        </div>
    </div>



    <!-- Upload Section -->
    <div class="file-uploader bg-white p-6 rounded-lg shadow-md mb-8 mx-3">
        <h2 class="px-6 py-3 text-left text-xl font-semibold text-gray-700 uppercase tracking-wider">Upload Files</h2>
        <div class="flex flex-wrap gap-6">
            <!-- General File Upload Form -->
            <form action="<?= base_url('conAdmin/uploadGeneralFile') ?>" method="post" enctype="multipart/form-data"
                class="flex-1 darkmode bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 ease-in-out"
                onsubmit="handleFileUpload(event, this)">

                <label for="file_type" class="darkmode_green block text-sm font-medium text-gray-700 mb-2">Select File
                    Type:</label>
                <div class="relative mb-4 ">
                    <select name="file_type"
                        class="w-full border text-center border-gray-300 rounded-lg py-3 text-gray-700">
                        <?php if (!empty($general_file_types)): ?>
                            <?php foreach ($general_file_types as $file): ?>
                                <option value="<?= strtolower($file['type_name']) ?>">

                                    <?= strtoupper($file['type_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled selected>File Type is Empty</option>
                        <?php endif; ?>
                    </select>

                </div>

                <label for="requirements_file"
                    class="darkmode_green block text-sm font-medium text-gray-700 mb-2">Select File:</label>
                <div class="relative">
                    <input type="file" name="requirements_file" id="requirements_file" accept=".pdf,.docx,.png,.jpg"
                        class="w-full opacity-0 absolute top-0 left-0 h-full cursor-pointer"
                        onchange="updateFileName(this, 'fileNameText')">

                    <button type="button"
                        class="w-full border border-gray-300 rounded-lg py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 transition flex items-center justify-center">
                        <span id="fileNameText" class="mr-2">Choose File</span>
                    </button>
                </div>

                <div class="flex justify-between items-center mt-4">
                    <button type="submit"
                        class="bg-teal-200 text-teal-800 font-semibold uppercase px-4 py-2 rounded-lg hover:bg-teal-300 transition">Upload</button>
                    <button type="button"
                        class="bg-red-200 text-red-800 font-semibold px-4 py-2 rounded-lg hover:bg-red-300 transition"
                        onclick="resetFileInput('requirements_file', 'fileNameText')">Clear</button>
                </div>
            </form>



            <!-- Mandatory Requirements Upload Form -->
            <form
                class="flex-1 darkmode bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 ease-in-out"
                action="<?= base_url('conAdmin/uploadMandatoryRequirementFile') ?>" method="post"
                enctype="multipart/form-data" onsubmit="handleFileUpload(event, this)">

                <label class="darkmode_green block text-sm font-medium text-gray-700 mb-2">Select Mandatory
                    Requirement:</label>
                <div class="relative mb-4 ">
                    <select name="file_type"
                        class="w-full border text-center border-gray-300 rounded-lg py-3 text-gray-700">
                        <?php if (!empty($mandatory_file_types)): ?>

                            <?php foreach ($mandatory_file_types as $file): ?>
                                <option value="<?= strtolower($file['type_name']) ?>">

                                    <?= strtoupper($file['type_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled selected>File Type is Empty</option>
                        <?php endif; ?>
                    </select>

                </div>

                <label class="darkmode_green block text-sm font-medium text-gray-700 mb-2">Upload File:</label>
                <div class="relative">
                    <input type="file" name="requirements" id="mandatory_requirements_file"
                        accept=".pdf,.docx,.png,.jpg"
                        class="w-full opacity-0 absolute top-0 left-0 h-full cursor-pointer"
                        onchange="updateFileName(this, 'mandatory_file_name')">
                    <button type="button"
                        class="w-full border border-gray-300 rounded-lg py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 transition flex items-center justify-center">
                        <span id="mandatory_file_name" class="mr-2">Choose File</span>
                    </button>

                </div>

                <div class="flex justify-between items-center mt-4">
                    <button type="submit"
                        class="bg-teal-200 text-teal-800 font-semibold uppercase px-4 py-2 rounded-lg hover:bg-teal-300 transition">Upload</button>
                    <button type="button"
                        class="bg-red-200 text-red-800 font-semibold px-4 py-2 rounded-lg hover:bg-red-300 transition"
                        onclick="resetFileInput('mandatory_requirements_file', 'mandatory_file_name')">Clear</button>
                </div>
            </form>

            <!-- Yearly Requirements Upload Form -->
            <form
                class="flex-1 darkmode bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 ease-in-out"
                action="<?= base_url('conAdmin/uploadYearlyFile') ?>" method="post" enctype="multipart/form-data"
                onsubmit="handleFileUpload(event, this)">

                <label class="darkmode_green block text-sm font-medium text-gray-700 mb-2">Select Yearly
                    Requirement:</label>
                <div class="relative mb-4">
                    <select name="file_type"
                        class="w-full border text-center border-gray-300 rounded-lg py-3 text-gray-700">
                        <?php if (!empty($yearly_file_types)): ?>

                            <?php foreach ($yearly_file_types as $file): ?>
                                <option value="<?= strtolower($file['type_name']) ?>">

                                    <?= strtoupper($file['type_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled selected>File Type is Empty</option>
                        <?php endif; ?>
                    </select>


                </div>

                <label class="darkmode_green block text-sm font-medium text-gray-700 mb-2">Upload File:</label>
                <div class="relative">
                    <input type="file" name="requirements" id="yearly_requirements_file" accept=".pdf,.docx,.png,.jpg"
                        class="w-full opacity-0 absolute top-0 left-0 h-full cursor-pointer"
                        onchange="updateFileName(this, 'yearly_file_name')">
                    <button type="button"
                        class="w-full border border-gray-300 rounded-lg py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 transition flex items-center justify-center">
                        <span id="yearly_file_name" class="mr-2">Choose File</span>
                    </button>

                </div>

                <div class="flex justify-between items-center mt-4">
                    <button type="submit"
                        class="bg-teal-200 text-teal-800 font-semibold uppercase px-4 py-2 rounded-lg hover:bg-teal-300 transition">Upload</button>
                    <button type="button"
                        class="bg-red-200 text-red-800 font-semibold px-4 py-2 rounded-lg hover:bg-red-300 transition"
                        onclick="resetFileInput('yearly_requirements_file', 'yearly_file_name')">Clear</button>
                </div>
            </form>


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        function handleFileUpload(event, form) {
            event.preventDefault(); // Prevent form submission

            const fileTypeSelect = form.querySelector("select[name='file_type']");
            const selectedFileType = fileTypeSelect ? fileTypeSelect.value.trim() : "";

            const fileInput = form.querySelector("input[type='file']");
            const selectedFile = fileInput ? fileInput.files.length > 0 : false;

            if (!selectedFileType) {
                // Show error toast if file type is empty
                Toastify({
                    text: "⚠️ select a file type/file type is empty",
                    duration: 5000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "linear-gradient(to right,rgb(84, 1, 37),rgb(217, 32, 152))",
                    stopOnFocus: true
                }).showToast();
                return; // Stop form submission
            }

            if (!selectedFile) {
                // Show error toast if no file is selected
                Toastify({
                    text: "⚠️ select a file before uploading",
                    duration: 5000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "linear-gradient(to right,rgb(97, 8, 8),rgb(190, 44, 93))",
                    stopOnFocus: true
                }).showToast();
                return; // Stop form submission
            }

            const formData = new FormData(form); // Create a FormData object

            // Perform AJAX request
            fetch(form.action, {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === "success") {
                        Toastify({
                            text: data.message,
                            duration: 5000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "linear-gradient(to right, rgb(0, 0, 0), rgb(31, 206, 150))",
                            stopOnFocus: true
                        }).showToast();

                        form.reset(); // Reset the form after successful upload
                    } else {
                        Toastify({
                            text: data.message || "An error occurred during upload.",
                            duration: 5000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "linear-gradient(to right,rgb(97, 8, 8),rgb(190, 44, 93))",
                            stopOnFocus: true
                        }).showToast();
                    }
                })
                .catch((error) => {
                    Toastify({
                        text: "An error occurred. Please try again.",
                        duration: 5000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(to right,rgb(97, 8, 8),rgb(190, 44, 93))",
                        stopOnFocus: true
                    }).showToast();
                });

            // Reload the page after Toastify finishes
            setTimeout(function () {
                location.reload(); // Reload the page
            }, 2000);
        }

    </script>



    <div class="bg-white p-6 rounded-lg shadow-md mx-3 h-full">


        <h2 class="text-xl font-semibold text-gray-600 uppercase tracking-wider mb-4">
            User Uploaded Files
        </h2>

        <!-- Filter Buttons -->
        <div class="flex justify-between gap-2 mb-6">
            <div class="tablebuttons">
                <button
                    class="bg-purple-200 px-3 py-2 rounded hover:bg-purple-100 text-purple-900 text-xs mb-2 uppercase transition font-semibold"
                    onclick="filterFiles('All')">All Files</button>
                <button
                    class="bg-green-200 px-3 py-2 rounded hover:bg-green-100 text-green-900 text-xs mb-2 uppercase transition font-semibold"
                    onclick="filterFiles('Approved')">Approved</button>
                <button
                    class="bg-yellow-200 px-3 py-2 rounded hover:bg-yellow-100 text-yellow-900 text-xs mb-2 uppercase transition font-semibold"
                    onclick="filterFiles('Pending')">Pending</button>
                <button
                    class="bg-red-200 px-3 py-2 rounded hover:bg-red-100 text-red-900 text-xs mb-2 uppercase transition font-semibold"
                    onclick="filterFiles('Denied')">Denied</button>
            </div>
            <div class="print_all_files">
                <button onclick="printUserFiles()" class="relative flex items-center justify-center gap-3 px-2 py-2 rounded-lg w-full sm:w-auto
    bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-semibold shadow-lg
    hover:scale-105 transition-transform duration-300 hover:shadow-2xl">

                    <div class="absolute inset-0 bg-white opacity-10 rounded-lg blur-md"></div>

                    <svg class="w-6 h-6 z-10" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 9V6a2 2 0 012-2h8a2 2 0 012 2v3M6 9h12M6 9v6m12-6v6m-4 4H10m4 0v-4H10v4m-4-4h12">
                        </path>
                    </svg>

                    <span class="z-10 hidden 2xl:block">Print All Uploaded Files</span>
                </button>

            </div>

        </div>

        <div class="hidden 2xl:block overflow-x-auto h-96">
            <table class="w-full text-left text-gray-700 border-collapse  overflow-y-auto">
                <thead class="sticky top-0 bg-gray-100 shadow-lg z-10">

                    <tr>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">File Name
                        </th>
                        <th
                            class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:table-cell">
                            Type</th>
                        <th
                            class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider hidden lg:table-cell">
                            Points</th>
                        <th
                            class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider hidden lg:table-cell">
                            Category</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th
                            class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:table-cell">
                            Date Uploaded</th>
                        <th
                            class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider hidden lg:table-cell">
                            Date Modified</th>
                    </tr>
                </thead>
                <tbody id="files-table-body">
                    <?php if (!empty($uploaded_files)): ?>
                        <?php foreach ($uploaded_files as $file): ?>
                            <tr class="border-b hover:bg-gray-50 transition file-row">

                                <td class="px-4 py-3">
                                    <a href="<?= htmlspecialchars($file['file_path']) ?>" target="_blank"
                                        class="text-blue-600 hover:underline">
                                        <?= htmlspecialchars($file['file_name']) ?>
                                    </a>
                                </td>
                                <td class="px-4 py-3 hidden md:table-cell"><?= ucfirst(htmlspecialchars($file['file_type'])) ?>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell"><?= htmlspecialchars($file['points']) ?></td>
                                <td class="px-4 py-3 hidden lg:table-cell">
                                    <?php
                                    if (strpos($file['file_path'], 'mandatory_requirements') !== false) {
                                        echo '<span class="text-red-500">Mandatory</span>';
                                    } elseif (strpos($file['file_path'], 'yearly_requirements') !== false) {
                                        echo '<span class="text-blue-500">Yearly Event</span>';
                                    } else {
                                        echo '<span class="text-green-500">Credential</span>';
                                    }
                                    ?>
                                </td>
                                <td class="px-4 py-3">
                                    <?php
                                    $statusClass = $file['status'] == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                        ($file['status'] == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800');
                                    ?>
                                    <span class="inline-block py-1 px-3 rounded-full text-xs font-semibold <?= $statusClass ?>">
                                        <?= ucfirst(htmlspecialchars($file['status'])) ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 hidden md:table-cell">
                                    <?= date('F j, Y - g:i A', strtotime($file['uploaded_at'])) ?>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell">
                                    <?php if (empty($file['updated_at'])): ?>
                                        <span class="text-gray-500 text-sm">Unread</span>
                                    <?php else: ?>
                                        <?= date('F j, Y - g:i A', strtotime($file['updated_at'])) ?>
                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-3 text-gray-500">No files uploaded yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Card Layout for Mobile (Below 2XL) -->
        <div id="files-card-container" class="2xl:hidden flex flex-wrap gap-4">
            <?php if (!empty($uploaded_files)): ?>
                <?php foreach ($uploaded_files as $file): ?>
                    <div class="flex-1 file-card bg-white p-4 rounded-lg shadow">
                        <div class="mb-2">
                            <a href="<?= htmlspecialchars($file['file_path']) ?>" target="_blank"
                                class="text-blue-600 font-semibold hover:underline text-sm block w-full truncate">
                                <?= htmlspecialchars($file['file_name']) ?>
                            </a>
                        </div>

                        <p class="text-gray-600 text-xs">
                            <span class="font-semibold">Type:</span> <?= ucfirst(htmlspecialchars($file['file_type'])) ?>
                        </p>
                        <p class="text-gray-600 text-xs">
                            <span class="font-semibold">Points:</span> <?= htmlspecialchars($file['points']) ?>
                        </p>
                        <p class="text-gray-600 text-xs">
                            <span class="font-semibold">Category:</span>
                            <?php
                            if (strpos($file['file_path'], 'mandatory_requirements') !== false) {
                                echo '<span class="text-red-500">Mandatory</span>';
                            } elseif (strpos($file['file_path'], 'yearly_requirements') !== false) {
                                echo '<span class="text-blue-500">Yearly Event</span>';
                            } else {
                                echo '<span class="text-green-500">Credential</span>';
                            }
                            ?>
                        </p>
                        <p class="text-gray-600 text-xs">
                            <span class="font-semibold">Status:</span>
                            <?php
                            $statusClass = $file['status'] == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                ($file['status'] == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800');
                            ?>
                            <span
                                class="status-text inline-block py-1 px-3 rounded-full text-xs font-semibold <?= $statusClass ?>">
                                <?= ucfirst(htmlspecialchars($file['status'])) ?>
                            </span>
                        </p>

                        <p class="text-gray-600 text-xs">
                            <span class="font-semibold">Uploaded:</span>
                            <?= date('F j, Y - g:i A', strtotime($file['uploaded_at'])) ?>
                        </p>
                        <p class="text-gray-600 text-xs">
                            <span class="font-semibold">Modified:</span>
                            <?php if (empty($file['updated_at'])): ?>
                                <span class="text-gray-500 text-sm">Unread</span>
                            <?php else: ?>
                                <?= date('F j, Y - g:i A', strtotime($file['updated_at'])) ?>
                            <?php endif; ?>
                        </p>


                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-gray-500">No files uploaded yet.</p>
            <?php endif; ?>
        </div>


    </div>





    <script>
        function updateFileName(input, fileNameId = 'fileNameText') {
            var fileName = input.files.length > 0 ? input.files[0].name : "Choose File";
            document.getElementById(fileNameId).textContent = fileName;
        }

        function resetFileInput(inputId, fileNameId = 'fileNameText') {
            document.getElementById(inputId).value = ""; // Clear the file input
            document.getElementById(fileNameId).textContent = "Choose File"; // Reset the displayed text
        }



        function resetFileInput(inputId) {
            document.getElementById(inputId).value = '';
        }

        function filterFiles(status) {
            const rows = document.querySelectorAll('.file-row'); // Table rows
            const cards = document.querySelectorAll('.file-card'); // Mobile cards
            let hasVisibleRow = false;
            let hasVisibleCard = false;

            // Filter for table view (Desktop)
            rows.forEach(row => {
                const statusCell = row.querySelector("td:nth-child(5) span");
                const fileStatus = statusCell ? statusCell.textContent.trim().toLowerCase() : '';

                if (status === 'All' || fileStatus === status.toLowerCase()) {
                    row.style.display = ''; // Show table row
                    hasVisibleRow = true;
                } else {
                    row.style.display = 'none'; // Hide table row
                }
            });

            // Filter for mobile view (Card layout)
            cards.forEach(card => {
                const statusSpan = card.querySelector('.status-text'); // Find the status span
                const fileStatus = statusSpan ? statusSpan.textContent.trim().toLowerCase() : '';

                if (status === 'All' || fileStatus === status.toLowerCase()) {
                    card.style.display = ''; // Show card
                    hasVisibleCard = true;
                } else {
                    card.style.display = 'none'; // Hide card
                }
            });

            // Handle "No files found" message for table
            let tableBody = document.getElementById('files-table-body');
            let noFilesRow = document.getElementById('no-files-message');

            if (!hasVisibleRow) {
                if (!noFilesRow) {
                    noFilesRow = document.createElement('tr');
                    noFilesRow.id = 'no-files-message';
                    noFilesRow.innerHTML = `<td colspan="8" class="text-center py-3 text-gray-500">No files found for this status.</td>`;
                    tableBody.appendChild(noFilesRow);
                }
            } else {
                if (noFilesRow) {
                    noFilesRow.remove();
                }
            }

            // Handle "No files found" message for mobile cards
            let cardContainer = document.getElementById('files-card-container');
            let noFilesCardMessage = document.getElementById('no-files-card-message');

            if (!hasVisibleCard) {
                if (!noFilesCardMessage) {
                    noFilesCardMessage = document.createElement('p');
                    noFilesCardMessage.id = 'no-files-card-message';
                    noFilesCardMessage.className = 'text-center text-gray-500';
                    noFilesCardMessage.textContent = 'No files found for this status.';
                    cardContainer.appendChild(noFilesCardMessage);
                }
            } else {
                if (noFilesCardMessage) {
                    noFilesCardMessage.remove();
                }
            }
        }



    </script>

    <script>
        // Function to show Toastify notification
        function showToast(message, isError = false) {
            Toastify({
                text: message,
                style: {
                    background: isError ? "linear-gradient(to right, #FF5C8D, #FF8364)" : "linear-gradient(to right, #00b09b, #96c93d)", // Error is red, success is green
                    color: "white",
                    fontSize: "14px",
                    fontWeight: "bold",
                    padding: "10px 20px",
                    borderRadius: "5px",
                },
                duration: 3000, // Duration in milliseconds
                gravity: "top", // Position
                position: "right", // Right side
                className: "custom-toastify",
            }).showToast();
        }


        // Attach the validation function to the form submit event
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function (event) {
                const inputId = form.querySelector('input[type="file"]').id;
                if (!validateFileNameLength(inputId)) {
                    event.preventDefault(); // Prevent form submission if file name is too long
                }
            });
        });
    </script>
    <script>
        function resetFileInput(inputId, fileNameId = 'fileNameText') {
            let fileInput = document.getElementById(inputId);
            let newFileInput = document.createElement("input");

            // Copy attributes from original input
            newFileInput.type = "file";
            newFileInput.name = fileInput.name;
            newFileInput.id = fileInput.id;
            newFileInput.accept = fileInput.accept;
            newFileInput.required = fileInput.required;
            newFileInput.className = fileInput.className;
            newFileInput.onchange = fileInput.onchange;

            // Replace the old input with the new one
            fileInput.parentNode.replaceChild(newFileInput, fileInput);

            // Reset displayed file name
            document.getElementById(fileNameId).textContent = "Choose File";

            // Show success message
            showToast("Cleared current file!", false);
        }


        // Function to show Toastify notification
        function showToast(message, isError = false) {
            Toastify({
                text: message,
                style: {
                    background: isError ? "linear-gradient(to right, #FF5C8D, #FF8364)" : "linear-gradient(to right,rgb(0, 0, 0),rgb(208, 8, 175))", // Error is red, success is green
                    color: "white",
                    fontSize: "14px",
                    fontWeight: "bold",
                    padding: "10px 20px",
                    borderRadius: "5px",
                },
                duration: 3000, // Duration in milliseconds
                gravity: "top", // Position
                position: "right", // Right side
                className: "custom-toastify",
            }).showToast();
        }

    </script>
    <script>
        function printUserFiles() {
            // Show Toastify notification immediately
            let table = document.getElementById('files-table-body');
            let rows = table.getElementsByTagName('tr');

            // Check if the table has any files
            let hasFiles = Array.from(rows).some(row => {
                let columns = row.getElementsByTagName('td');
                return columns.length > 0 && !row.innerText.includes("No files uploaded yet.");
            });

            if (!hasFiles) {
                Toastify({
                    text: "No files to print!",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "linear-gradient(to right, #FF5C8D, #FF8364)",
                    stopOnFocus: true
                }).showToast();
                return;
            }

            let printWindow = window.open('', '', 'width=900,height=600');
            printWindow.document.write('<html><head><title>Uploaded Files</title>');
            printWindow.document.write('<style>');
            printWindow.document.write(`
            body { font-family: Arial, sans-serif; text-align: center; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #f4f4f4; }
            h2 { margin-bottom: 10px; }
        `);
            printWindow.document.write('</style></head><body>');

            printWindow.document.write('<h2>User Uploaded Files</h2>');
            printWindow.document.write('<table>');
            printWindow.document.write('<tr><th>File Name</th><th>Type</th><th>Category</th><th>Status</th><th>Uploaded At</th></tr>');

            for (let row of rows) {
                let columns = row.getElementsByTagName('td');
                if (columns.length > 0) {
                    printWindow.document.write('<tr>');
                    printWindow.document.write(`<td>${columns[0].innerHTML}</td>`); // File Name
                    printWindow.document.write(`<td>${columns[1].innerHTML}</td>`); // Type
                    printWindow.document.write(`<td>${columns[3].innerHTML}</td>`); // Category
                    printWindow.document.write(`<td>${columns[4].innerHTML}</td>`); // Status
                    printWindow.document.write(`<td>${columns[5].innerHTML}</td>`); // Uploaded At
                    printWindow.document.write('</tr>');
                }
            }

            printWindow.document.write('</table></body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>

</body>

</html>