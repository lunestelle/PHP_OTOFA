<main class="background-container col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Maintenance Tracker</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <?php if (!empty($maintenance_trackers) && is_array($maintenance_trackers)): ?>
            <div class="mt-3 text-end">
              <form method="post" action="">
                <button type="submit" id="exportCsv" name="exportCsv" class="export-btn">Export as CSV</button>
              </form>
            </div>
            <div class="row mt-2">
              <?php if ($userRole === 'admin'): ?>
                <div class="col-6">
                  <label for="operatorNameFilter" class="fw-bold" style="font-size: 13px;">Filter By Operators Name:</label>
                  <select id="operatorNameFilter" class="form-select" style="height: 35px; font-size: 14px;">
                    <option value="all" <?php echo ($selectedOperatorName == 'all') ? 'selected' : ''; ?>>All</option>
                    <?php foreach ($operators as $operator): ?>
                      <option value="<?php echo $operator->operator_name; ?>" <?php echo ($operator->operator_name == $selectedOperatorName) ? 'selected' : ''; ?>><?php echo $operator->operator_name; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              <?php endif; ?>

              <div class="col-6">
                <label for="yearFilter" class="fw-bold" style="font-size: 13px;">Filter By Year:</label>
                <select id="yearFilter" class="form-select" style="height: 35px; font-size: 14px;">
                  <option value="all" <?php echo ($selectedFilter == 'all') ? 'selected' : ''; ?>>All</option>
                  <?php foreach ($years as $year): ?>
                    <option value="<?php echo $year; ?>" <?php echo ($year == $selectedFilter) ? 'selected' : ''; ?>><?php echo $year; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          <?php endif; ?>
          <div class="table-responsive pt-4">
            <table class="table table-hover" id="systemTable">
              <thead>
                <tr class="text-uppercase">
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Tricyle CIN</th>
                  <?php if ($userRole === 'admin'): ?>  
                    <th scope="col" class="text-center">Operator's Name</th>
                  <?php endif; ?>
                  <th scope="col" class="text-center">Driver's Name</th>
                  <th scope="col" class="text-center"><?php echo ($selectedFilter == 'all') ? 'Total Expenses' : 'Yearly Total Expenses'; ?></th>
                  <th scope="col" class="text-center">View Calculations</th>
                </tr>
              </thead>
              <tbody class="text-center text-capitalize">
                <?php if (!empty($maintenance_trackers) && is_array($maintenance_trackers)): ?>
                  <?php foreach ($maintenance_trackers as $maintenance): ?>
                    <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $maintenance->cin_number; ?></td>
                    <?php if ($userRole === 'admin'): ?> 
                      <td><?php echo $maintenance->operator_name; ?></td>
                    <?php endif; ?>
                    <td><?php echo empty($maintenance->driver_name) ? '----------------' : $maintenance->driver_name; ?></td>
                    <td><?php echo '₱' . number_format($maintenance->yearly_total_expenses, 2); ?></td>
                    <td><a class="view-maintenance-tracker-btn" onclick="viewCalculations(<?php echo $maintenance->year; ?>, '<?php echo $maintenance->cin_number; ?>')">View</a></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  function viewCalculations(year, cin) {
    const selectedYear = $("#yearFilter").val();
    if (selectedYear === "all") {
      window.location.href = "view_calculations?cin=" + cin;
    } else {
      window.location.href = "view_calculations?year=" + selectedYear + "&cin=" + cin;
    }
  }

  $(document).ready(function () {
  $("#operatorNameFilter, #yearFilter").change(function () {
    const selectedOperator = $("#operatorNameFilter").val();
    const selectedYear = $("#yearFilter").val();
    
    let queryParams = [];

    // Check if the user is an admin before including operator name in the URL
    if ('<?php echo $userRole ?>' === 'admin' && selectedOperator !== 'all' && selectedOperator !== '' && selectedOperator !== null) {
      queryParams.push('operator_name=' + encodeURIComponent(selectedOperator));
    }
    if (selectedYear !== 'all') {
      queryParams.push('year=' + encodeURIComponent(selectedYear));
    }

    let queryString = queryParams.length > 0 ? '?' + queryParams.join('&') : '';

    // Construct the base URL based on the user's role
    let baseUrl = "<?php echo ($userRole === 'admin') ? 'maintenance_tracker' : 'maintenance_tracker'; ?>";

    window.location.href = baseUrl + queryString;
  });
});


</script>