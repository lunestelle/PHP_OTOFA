<main class="background-container col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">maintenance logs</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <div class="mt-3">
            <a href="new_maintenance_log" class="text-uppercase sidebar-btnContent new-button">New</a>
          </div>
        </div>
        <div class="col-12">
          <?php if (!empty($maintenance_logs)): ?>
            <div class="mt-3 text-end">
              <form method="post" action="">
                <button type="submit" id="exportCsv" name="exportCsv" class="export-btn-operator">Export as CSV</button>
              </form>
            </div>
          <?php endif; ?>
          <div class="col-6 mt-3">
            <label for="driverNameFilter" class="fw-bold" style="font-size: 13px;">Filter By Drivers Name:</label>
            <select id="driverNameFilter" class="form-select" style="height: 35px; font-size: 14px;">
              <option value="all" <?php echo ($selectedFilter == 'all') ? 'selected' : ''; ?>>All</option>
              <?php foreach ($drivers as $driver_name): ?>
                <option value="<?php echo $driver_name; ?>" <?php echo ($driver_name == $selectedFilter) ? 'selected' : ''; ?>><?php echo $driver_name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="table-responsive pt-4 pb-3">
            <table class="table table-hover" id="systemTable">
              <thead class="thead-custom">
                <tr class="text-center text-uppercase">
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Tricyle CIN</th>
                  <th scope="col" class="text-center">Driver's Name</th>
                  <th scope="col" class="text-center">Date</th>
                  <th scope="col" class="text-center">Total Expenses</th>
                  <th scope="col" class="text-center">Description</th>
                  <th scope="col" class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody class="text-center text-capitalize">
              <?php foreach ($maintenance_logs as $maintenance_log): ?>
                  <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $maintenance_log['cin']; ?></td>
                    <td><?php echo $maintenance_log['driver_name']; ?></td>
                    <td><?php echo $maintenance_log['expense_date']; ?></td>
                    <td><?php echo '₱' . number_format($maintenance_log['total_expenses'], 2, '.', ''); ?></td>
                    <td><?php echo $maintenance_log['description']; ?></td>
                    <td>
                      <a href="./view_maintenance_log?maintenance_log_id=<?php echo $maintenance_log['maintenance_log_id']; ?>" class="view_data px-1 me-1" style="color: #0766AD;" title="View Maintenance Log Details"><i class="fa-solid fa-file-lines fa-xl"></i></a>
                      <a href="./edit_maintenance_log?maintenance_log_id=<?php echo $maintenance_log['maintenance_log_id']?>" class="edit_data px-1 me-1" style="color: #ff6c36;" title="Edit Maintenance Log Details"><i class="fa-solid fa-file-pen fa-xl"></i></a>
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
    $("#driverNameFilter").change(function () {
      const selectedName = $("#driverNameFilter").val();
      if (selectedName === 'all') {
        window.location.href = "maintenance_logs";
      } else {
        window.location.href = "maintenance_logs?driver_name=" + selectedName;
      }
    });
  });
</script>