<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Appointments Reports</h6>
    </div>
    <div class="col-lg-12">
      <?php if (!empty($appointmentsReports) && is_array($appointmentsReports)): ?>
        <div class="mt-3 text-end">
          <form method="post" action="">
            <button type="submit" id="exportCsv" name="exportCsv" class="export-btn">Export as CSV</button>
          </form>
        </div>

        <div class="col-6 mt-3">
          <label for="yearFilter" class="fw-bold" style="font-size: 13px;">Filter By Year:</label>
          <select id="yearFilter" class="form-select" style="height: 35px; font-size: 14px;">
            <option value="all" <?php echo ($selectedFilter == 'all') ? 'selected' : ''; ?>>All</option>
            <?php foreach ($years as $year): ?>
              <option value="<?php echo $year; ?>" <?php echo ($year == $selectedFilter) ? 'selected' : ''; ?>><?php echo $year; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      <?php endif; ?>
      <div class="table-responsive pt-4">
        <table class="table table-hover" id="systemTable">
          <thead class="thead-custom">
            <tr class="text-uppercase">
              <th scope="col" class="text-center">#</th>
              <th scope="col" class="text-center">Operator Name</th>
              <th scope="col" class="text-center">Phone Number</th>
              <th scope="col" class="text-center">Total Appointments</th>
              <th scope="col" class="text-center">Pending Appointments</th>
              <th scope="col" class="text-center">Completed Appointments</th>
              <?php if ($selectedFilter == 'all'): ?>
                <th scope="col" class="text-center">Appointment Year</th>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody class="text-center text-capitalize">
            <?php if (!empty($appointmentsReports) && is_array($appointmentsReports)): ?>
              <?php foreach ($appointmentsReports as $report): ?>
                <tr>
                  <td><?php echo $index++; ?></td>
                  <td><?php echo $report['operator_name']; ?></td>
                  <td><?php echo $report['phone_number']; ?></td>
                  <td><?php echo $report['total_appointments']; ?></td>
                  <td><?php echo $report['pending_appointments']; ?></td>
                  <td><?php echo $report['completed_appointments']; ?></td>
                  <?php if ($selectedFilter == 'all'): ?>
                    <td><?php echo $report['year']; ?></td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
<script>
  $(document).ready(function () {
    $("#yearFilter").change(function () {
      const selectedYear = $("#yearFilter").val();
      if (selectedYear === 'all') {
        window.location.href = "appointments_reports";
      } else {
        window.location.href = "appointments_reports?year=" + selectedYear;
      }
    });
  });
</script>