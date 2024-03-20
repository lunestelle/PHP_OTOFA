<main class="background-container col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Users</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <div class="mt-3">
            <a href="new_user" class="text-uppercase sidebar-btnContent new-button">New</a>
          </div>
        </div>
        <div class="col-12">
          <?php if (!empty($users)): ?>
            <div class="mt-3 text-end">
              <form method="post" action="">
                <button type="submit" id="exportCsv" name="exportCsv" class="export-btn-operator">Export as CSV</button>
              </form>
            </div>
          <?php endif; ?>
          <div class="col-6 mt-3">
            <label for="userNameFilter" class="fw-bold" style="font-size: 13px;">Filter By Users Name:</label>
            <select id="userNameFilter" class="form-select" style="height: 35px; font-size: 14px;">
              <option value="all" <?php echo ($selectedFilter == 'all') ? 'selected' : ''; ?>>All</option>
              <?php foreach ($users as $user): ?>
                <option value="<?php echo $user['first_name'] . ' ' . $user['last_name']; ?>" <?php echo ($user['first_name'] . ' ' . $user['last_name'] == $selectedFilter) ? 'selected' : ''; ?>><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="table-responsive pt-4 pb-3">
            <table class="table table-hover" id="systemTable">
              <thead class="thead-custom">
                <tr class="text-center text-uppercase">
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">First Name</th>
                  <th scope="col" class="text-center">Last Name</th>
                  <th scope="col" class="text-center">Phone Number</th>
                  <th scope="col" class="text-center">Email</th>
                  <th scope="col" class="text-center">Address</th>
                  <th scope="col" class="text-center">Role</th>
                  <th scope="col" class="text-center">Permissions</th>
                  <th scope="col" class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody class="text-center text-capitalize">
              <?php foreach ($users as $index => $user): ?>
                  <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $user['first_name']; ?></td>
                    <td><?php echo $user['last_name']; ?></td>
                    <td><?php echo $user['phone_number']; ?></td>
                    <td class="text-lowercase"><?php echo $user['email']; ?></td>
                    <td><?php echo $user['address']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td><?php echo $user['permissions']; ?></td>
                    <td>
                      <a href="./view_user?user_id=<?php echo $user['user_id']; ?>" class="view_data px-1 me-1" style="color: #0766AD;" title="View User Details"><i class="fa-solid fa-file-lines fa-xl"></i></a>
                      <a href="./edit_user?user_id=<?php echo $user['user_id']?>" class="edit_data px-1 me-1" style="color: #ff6c36;" title="Edit User Details"><i class="fa-solid fa-file-pen fa-xl"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  $(document).ready(function () {
    $("#userNameFilter").change(function () {
      const selectedName = $("#userNameFilter").val();
      if (selectedName === 'all') {
        window.location.href = "users";
      } else {
        window.location.href = "users?user_name=" + selectedName;
      }
    });
  });
</script>