<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="module" src="https://unpkg.com/lucide@latest"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-teal: #0d9488;
      --primary-teal-light: #14b8a6;
      --primary-teal-dark: #0f766e;
      --primary-teal-ultra-light: #ccfbf1;
      --primary-teal-bg: #f0fdfa;
    }

    .table-container {
      scrollbar-width: thin;
      scrollbar-color: #cbd5e0 #f7fafc;
    }

    .table-container::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }

    .table-container::-webkit-scrollbar-track {
      background: #f7fafc;
      border-radius: 10px;
    }

    .table-container::-webkit-scrollbar-thumb {
      background-color: var(--primary-teal-light);
      border-radius: 10px;
    }

    .card-transition {
      transition: all 0.3s ease;
    }

    .card-transition:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(13, 148, 136, 0.1);
    }

    .action-btn {
      transition: all 0.2s ease;
    }

    .action-btn:hover {
      transform: scale(1.15);
    }

    .table-row {
      transition: background-color 0.2s ease;
    }

    .filter-input:focus {
      box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.3);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-in {
      animation: fadeIn 0.4s ease forwards;
    }

    .teal-gradient {
      background: linear-gradient(to right, #0d9488, #0891b2);
    }

    .edit-form-input {
      border: 1px solid #e2e8f0;
      border-radius: 0.5rem;
      transition: all 0.3s ease;
    }

    .edit-form-input:focus {
      border-color: var(--primary-teal);
      box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.2);
      outline: none;
    }

    .edit-form-label {
      color: var(--primary-teal-dark);
      font-size: 0.875rem;
      font-weight: 500;
      margin-bottom: 0.25rem;
      transition: color 0.2s;
    }

    .edit-section {
      transform: translateX(20px);
      opacity: 0;
      animation: slide-in 0.4s ease forwards;
    }

    @keyframes slide-in {
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    .glass-effect {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800">
  <div class="flex flex-col 2xl:flex-row gap-5 p-5 lg:p-6">
    <!-- Main Section -->
    <div class="w-full 2xl:w-3/4">
      <!-- Table Container with shadow effect -->
      <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-100">
        <!-- Table Header with teal gradient -->
        <div class="teal-gradient px-6 py-4 text-white">
          <h2 class="font-bold text-lg">User Information</h2>
        </div>

        <!-- Table for Large Screens -->
        <div class="hidden xl:block table-container overflow-x-auto">
          <table class="w-full border-collapse">
            <thead class="bg-teal-50 text-teal-800 border-b">
              <tr class="text-left">
                <th class="px-6 py-4 font-medium text-sm tracking-wider">User ID</th>
                <th class="px-6 py-4 font-medium text-sm tracking-wider">Username</th>
                <th class="px-6 py-4 font-medium text-sm tracking-wider">Email</th>
                <th class="px-6 py-4 font-medium text-sm tracking-wider">Address</th>
                <th class="px-6 py-4 font-medium text-sm tracking-wider">Phone No</th>
                <th class="px-6 py-4 font-medium text-sm tracking-wider">Gender</th>
                <th class="px-6 py-4 font-medium text-sm tracking-wider">Birth Date</th>
                <th class="px-6 py-4 text-center font-medium text-sm tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $index => $user): ?>
                <tr class="table-row border-b hover:bg-teal-50" data-gender="<?php echo $user['gender']; ?>">
                  <td class="px-6 py-4 whitespace-nowrap"><?php echo $user['id']; ?></td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div
                        class="h-9 w-9 rounded-full bg-teal-500 flex items-center justify-center text-white font-bold mr-3 shadow-sm">
                        <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                      </div>
                      <?php echo $user['username']; ?>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap"><?php echo $user['email']; ?></td>
                  <td class="px-6 py-4 whitespace-nowrap max-w-xs truncate" title="<?php echo $user['address']; ?>">
                    <?php echo $user['address']; ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap"><?php echo $user['phoneNo']; ?></td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="px-3 py-1 rounded-full text-xs font-medium 
                      <?php echo $user['gender'] === 'Male' ? 'bg-blue-100 text-blue-800' :
                        ($user['gender'] === 'Female' ? 'bg-pink-100 text-pink-800' : 'bg-purple-100 text-purple-800'); ?>">
                      <?php echo $user['gender']; ?>
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap"><?php echo date("F j, Y", strtotime($user['birth_date'])); ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex justify-center space-x-3">
                      <!-- Minimalist View Button -->
                      <button
                        onclick="openModal(<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8'); ?>)"
                        class="p-1.5 rounded hover:bg-gray-100 transition text-gray-600" title="View">
                        <i class="fas fa-eye"></i>
                      </button>

                      <!-- Minimalist Edit Button -->
                      <button onclick="editUserInfo('<?php echo $user['id']; ?>')"
                        class="p-1.5 rounded hover:bg-gray-100 transition text-gray-600" title="Edit">
                        <i class="fas fa-edit"></i>
                      </button>

                      <button onclick="confirmDelete('<?php echo base_url('conAdmin/deleteuserinfo/') . $user['id']; ?>')"
                        class="action-btn p-2 rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Card View for Mobile -->
        <div class="block xl:hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
          <?php foreach ($users as $index => $user): ?>
            <div class="bg-white rounded-xl p-5 shadow-md hover:shadow-lg card-transition border border-gray-100 fade-in"
              data-gender="<?php echo $user['gender']; ?>">
              <div class="flex items-center mb-4">
                <div
                  class="h-10 w-10 rounded-full bg-teal-500 flex items-center justify-center text-white font-bold mr-3 shadow-sm">
                  <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900"><?php echo $user['username']; ?></h3>
                  <span class="text-sm text-gray-500">ID: <?php echo $user['id']; ?></span>
                </div>
              </div>

              <div class="space-y-2 mb-4">
                <div class="flex items-center">
                  <i class="fas fa-envelope text-teal-400 w-5 mr-2"></i>
                  <span class="text-sm"><?php echo $user['email']; ?></span>
                </div>
                <div class="flex items-start">
                  <i class="fas fa-map-marker-alt text-teal-400 w-5 mr-2 mt-1"></i>
                  <span class="text-sm"><?php echo $user['address']; ?></span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-phone text-teal-400 w-5 mr-2"></i>
                  <span class="text-sm"><?php echo $user['phoneNo']; ?></span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-venus-mars text-teal-400 w-5 mr-2"></i>
                  <span class="text-sm">
                    <span
                      class="px-2 py-1 rounded-full text-xs font-medium
                      <?php echo $user['gender'] === 'Male' ? 'bg-blue-100 text-blue-800' :
                        ($user['gender'] === 'Female' ? 'bg-pink-100 text-pink-800' : 'bg-purple-100 text-purple-800'); ?>">
                      <?php echo $user['gender']; ?>
                    </span>
                  </span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-birthday-cake text-teal-400 w-5 mr-2"></i>
                  <span class="text-sm"><?php echo date("F j, Y", strtotime($user['birth_date'])); ?></span>
                </div>
              </div>

              <div class="flex justify-end space-x-2 pt-3 border-t border-gray-100">
                <button onclick="openModal(<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8'); ?>)"
                  class="action-btn p-2 rounded-full bg-teal-100 text-teal-600 hover:bg-teal-200 transition">
                  <i class="fas fa-eye"></i>
                </button>
                <button onclick="editUserInfo('<?php echo $user['id']; ?>')"
                  class="action-btn p-2 rounded-full bg-amber-100 text-amber-600 hover:bg-amber-200 transition">
                  <i class="fas fa-edit"></i>
                </button>
                <button onclick="confirmDelete('<?php echo base_url('conAdmin/deleteuserinfo/') . $user['id']; ?>')"
                  class="action-btn p-2 rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-teal-50 border-t border-gray-100">
          <div class="flex justify-between items-center">
            <span class="text-sm text-gray-600">Showing <span class="font-medium"><?php echo count($users); ?></span>
              users</span>
            <div class="flex space-x-1">
              <button disabled
                class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-400 cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
              </button>
              <button class="px-3 py-1 rounded border border-teal-500 bg-teal-500 text-white">1</button>
              <button
                class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-600 hover:bg-gray-50">2</button>
              <button
                class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-600 hover:bg-gray-50">3</button>
              <button class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-600 hover:bg-gray-50">
                <i class="fas fa-chevron-right"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Section (Edit Form) -->
    <div id="editUserSection" class="hidden 2xl:block w-1/4">
      <div class="bg-white shadow-xl rounded-xl border border-gray-100 overflow-hidden">
        <div class="teal-gradient px-6 py-4 text-white flex items-center justify-between">
          <h2 class="font-bold text-lg">Edit User</h2>
          <div class="h-8 w-8 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
            <i class="fas fa-user-edit text-white"></i>
          </div>
        </div>
        <div class="p-6">
          <div id="editUserForm" class="space-y-4">
            <div class="flex items-center justify-center h-64 text-gray-400">
              <div class="text-center">
                <i class="fas fa-user-edit text-5xl mb-3 text-teal-300"></i>
                <p>Select a user to edit</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for user view -->
  <script>
    function confirmDelete(deleteUrl) {
      Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#0d9488",
        cancelButtonColor: "#6B7280",
        confirmButtonText: "Yes, delete it!",
        customClass: {
          popup: 'rounded-xl',
          confirmButton: 'rounded-lg',
          cancelButton: 'rounded-lg'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = deleteUrl;
        }
      });
    }

    function openModal(user) {
      // Get a color for the avatar based on username
      const colorShades = ['teal-500', 'teal-600', 'teal-700', 'teal-800', 'cyan-600'];
      const colorIndex = user.username.charCodeAt(0) % colorShades.length;
      const color = colorShades[colorIndex];

      Swal.fire({
        title: false,
        html: `
          <div class="text-center mb-6">
            <div class="h-20 w-20 mx-auto rounded-full bg-${color} flex items-center justify-center text-white text-3xl font-bold">
              ${user.username.charAt(0).toUpperCase()}
            </div>
            <h2 class="text-xl font-bold mt-4">${user.username}</h2>
            <p class="text-gray-500">${user.email}</p>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
            <div class="bg-teal-50 rounded-lg p-3">
              <p class="text-sm text-teal-700">User ID</p>
              <p class="font-medium">${user.id}</p>
            </div>
            <div class="bg-teal-50 rounded-lg p-3">
              <p class="text-sm text-teal-700">Address</p>
              <p class="font-medium">${user.address}</p>
            </div>
            <div class="bg-teal-50 rounded-lg p-3">
              <p class="text-sm text-teal-700">Phone</p>
              <p class="font-medium">${user.phoneNo}</p>
            </div>
            <div class="bg-teal-50 rounded-lg p-3">
              <p class="text-sm text-teal-700">Gender</p>
              <p class="font-medium">${user.gender}</p>
            </div>
            <div class="bg-teal-50 rounded-lg p-3">
              <p class="text-sm text-teal-700">Birth Date</p>
              <p class="font-medium">${new Date(user.birth_date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</p>
            </div>
            <div class="bg-teal-50 rounded-lg p-3 md:col-span-2">
              <p class="text-sm text-teal-700">Address</p>
              <p class="font-medium">${user.address}</p>
            </div>
          </div>
        `,
        showConfirmButton: true,
        confirmButtonText: "Close",
        confirmButtonColor: "#0d9488",
        customClass: {
          popup: 'rounded-xl',
          confirmButton: 'rounded-lg'
        }
      });
    }

    function editUserInfo(userId) {
      fetch(`<?php echo base_url('conAdmin/edituserinfo/'); ?>${userId}`)
        .then(response => response.text())
        .then(data => {
          document.getElementById('editUserForm').innerHTML = data;

          // Add animation
          document.getElementById('editUserForm').classList.add('animate__animated', 'animate__fadeIn');

          // Make sure section is visible on mobile
          if (window.innerWidth < 1536) { // 2xl breakpoint
            const editSection = document.createElement('div');
            editSection.className = 'fixed inset-0 bg-black bg-opacity-30 z-50 flex justify-center items-center p-4 backdrop-blur-sm';
            editSection.id = 'mobileEditOverlay';

            const editContent = document.createElement('div');
            editContent.className = 'bg-white rounded-xl shadow-2xl w-full max-w-lg animate__animated animate__fadeInUp overflow-hidden';

            const header = document.createElement('div');
            header.className = 'teal-gradient px-6 py-4 text-white flex justify-between items-center';
            header.innerHTML = `
              <h3 class="font-bold flex items-center"><i class="fas fa-user-edit mr-2"></i> Edit User</h3>
              <button onclick="document.getElementById('mobileEditOverlay').remove()" class="text-white hover:text-teal-100 transition">
                <i class="fas fa-times"></i>
              </button>
            `;

            const body = document.createElement('div');
            body.className = 'p-6 max-h-[80vh] overflow-y-auto';
            body.innerHTML = data;

            editContent.appendChild(header);
            editContent.appendChild(body);
            editSection.appendChild(editContent);
            document.body.appendChild(editSection);
          }
        });
    }

    // Search and filter functionality
    document.addEventListener('DOMContentLoaded', function () {
      const searchInput = document.getElementById('searchUsers');
      const filterSelect = document.getElementById('filterUsers');

      if (searchInput) {
        searchInput.addEventListener('input', filterUsers);
      }

      if (filterSelect) {
        filterSelect.addEventListener('change', filterUsers);
      }

      function filterUsers() {
        const searchValue = searchInput.value.toLowerCase();
        const genderFilter = filterSelect.value;

        // Table rows
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
          const gender = row.getAttribute('data-gender');
          const text = row.textContent.toLowerCase();
          const matchesSearch = text.includes(searchValue);
          const matchesGender = !genderFilter || gender === genderFilter;

          if (matchesSearch && matchesGender) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });

        // Card view
        const cards = document.querySelectorAll('.card-transition');
        cards.forEach(card => {
          const gender = card.getAttribute('data-gender');
          const text = card.textContent.toLowerCase();
          const matchesSearch = text.includes(searchValue);
          const matchesGender = !genderFilter || gender === genderFilter;

          if (matchesSearch && matchesGender) {
            card.style.display = '';
          } else {
            card.style.display = 'none';
          }
        });
      }
    });
  </script>
</body>

</html>