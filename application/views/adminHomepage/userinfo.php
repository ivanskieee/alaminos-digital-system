<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User's Info</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 text-gray-800">

  <div class="flex flex-col 2xl:flex-row gap-4 p-4">

    <!-- Left Section -->
    <div class="w-full 2xl:w-3/4">
      <div class="bg-white shadow-lg rounded-lg p-6 overflow-x-auto">

        <!-- Table for Large Screens -->
        <div class="hidden xl:block">
          <table class="w-full border-collapse">
            <thead class="bg-gray-200 text-gray-700 border-b">
              <tr class="text-left">
                <th class="p-3">User ID</th>
                <th class="p-3">Username</th>
                <th class="p-3">Email</th>
                <th class="p-3">Address</th>
                <th class="p-3">Phone No</th>
                <th class="p-3">Gender</th>
                <th class="p-3">Birth Date</th>
                <th class="p-3 text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
                <tr class="border-b hover:bg-gray-50">
                  <td class="p-3"><?php echo $user['id']; ?></td>
                  <td class="p-3"><?php echo $user['username']; ?></td>
                  <td class="p-3"><?php echo $user['email']; ?></td>
                  <td class="p-3"><?php echo $user['address']; ?></td>
                  <td class="p-3"><?php echo $user['phoneNo']; ?></td>
                  <td class="p-3"><?php echo $user['gender']; ?></td>
                  <td class="p-3"><?php echo date("F j, Y", strtotime($user['birth_date'])); ?></td>
                  <td class="p-3 flex justify-center space-x-2">
                    <button onclick="openModal(<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8'); ?>)"
                      class="p-2 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
                      <i class="fas fa-eye"></i>
                    </button>
                    <button onclick="editUserInfo('<?php echo $user['id']; ?>')"
                      class="p-2 rounded-full bg-yellow-100 text-yellow-500 hover:bg-yellow-200 transition">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="confirmDelete('<?php echo base_url('conAdmin/deleteuserinfo/') . $user['id']; ?>')"
                      class="p-2 rounded-full bg-red-100 text-red-500 hover:bg-red-200 transition">
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Card View for Mobile -->
        <div class="block xl:hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
          <?php foreach ($users as $user): ?>
            <div class="bg-white rounded-lg p-4 shadow">
              <p><strong>User ID:</strong> <?php echo $user['id']; ?></p>
              <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
              <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
              <p><strong>Address:</strong> <?php echo $user['address']; ?></p>
              <p><strong>Phone No:</strong> <?php echo $user['phoneNo']; ?></p>
              <p><strong>Gender:</strong> <?php echo $user['gender']; ?></p>
              <p><strong>Birth Date:</strong> <?php echo date("F j, Y", strtotime($user['birth_date'])); ?></p>
              <div class="flex justify-end space-x-3 mt-3">
                <button onclick="openModal(<?php echo json_encode($user); ?>)" class="text-blue-500 hover:text-blue-600">
                  <i class="fas fa-eye"></i>
                </button>
                <button onclick="editUserInfo('<?php echo $user['id']; ?>')"
                  class="text-yellow-500 hover:text-yellow-600">
                  <i class="fas fa-edit"></i>
                </button>
                <button onclick="confirmDelete('<?php echo base_url('conAdmin/deleteuserinfo/') . $user['id']; ?>')"
                  class="text-red-500 hover:text-red-600">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>

    <!-- Right Section (Edit Form) -->
    <div id="editUserSection" class="hidden 2xl:block w-1/4 p-6 bg-white shadow-lg rounded-lg">
      <div id="editUserForm"></div>
    </div>

  </div>

  <!-- SweetAlert2 Delete Confirmation -->
  <script>
    function confirmDelete(deleteUrl) {
      Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = deleteUrl;
        }
      });
    }

    function openModal(user) {
      Swal.fire({
        title: `<h2 class='text-xl font-bold'>User Details</h2>`,
        html: `
          <p><strong>User ID:</strong> ${user.id}</p>
          <p><strong>Username:</strong> ${user.username}</p>
          <p><strong>Email:</strong> ${user.email}</p>
          <p><strong>Address:</strong> ${user.address}</p>
          <p><strong>Phone:</strong> ${user.phoneNo}</p>
          <p><strong>Gender:</strong> ${user.gender}</p>
          <p><strong>Birth Date:</strong> ${user.birth_date}</p>
        `,
        confirmButtonText: "Close",
        confirmButtonColor: "#3085d6",
      });
    }

    function editUserInfo(userId) {
      fetch(`<?php echo base_url('conAdmin/edituserinfo/'); ?>${userId}`)
        .then(response => response.text())
        .then(data => {
          document.getElementById('editUserForm').innerHTML = data;
        });
    }
  </script>

</body>

</html>