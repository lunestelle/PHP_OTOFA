<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">taripa</h6>
    </div>
    <div class="col-lg-12">
      <div class="row mt-2">
        <div class="col-12 mt-3">
          <a href="new_taripa" class="text-uppercase sidebar-btnContent new-button">New</a>
        </div>
        <div class="col-5 mx-4 me-5">
          <label for="routeAreaFilter" class="fw-bold">Filter Route Area:</label>
          <select id="routeAreaFilter" class="form-select">
            <option value="All">All</option>
            <option value="Free Zone / Zone 1">Free Zone / Zone 1</option>
            <option value="Zone 2">Freezone & Zone 2</option>
            <option value="Zone 3">Freezone & Zone 3</option>
            <option value="Zone 4">Freezone & Zone 4</option>
          </select>
        </div>
        <div class="col-5 ms-5">
          <label for="yearFilter" class="fw-bold">Filter Year:</label>
          <select id="yearFilter" class="form-select">
            <?php foreach ($years as $year): ?>
              <option value="<?php echo $year; ?>" <?php echo ($year == $selectedFilter) ? 'selected' : ''; ?>><?php echo $year; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
    </div>
    
    <div class="col-12">
      <?php if (!empty($taripas)): ?>
        <div class="mt-3 text-end">
          <form method="post" action="">
            <button type="submit" id="exportCsv" name="exportCsv" class="btn btn-primary">Export as CSV</button>
          </form>
        </div>
      <?php endif; ?>
      <div class="table-responsive pt-4 mx-4">
        <table class="table table-hover" id="systemTable">
          <thead>
            <tr class="text-uppercase">
              <?php if ($selectedFilter === 'All'): ?>
                <th scope="col" class="text-center">Route Area</th>
              <?php endif; ?>
              <th scope="col" class="text-center">Barangay</th>
              <th scope="col" class="text-center">Regular Rate</th>
              <th scope="col" class="text-center">Student Rate</th>
              <th scope="col" class="text-center">Senior Citizen & PWD Rate</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <?php foreach ($taripas as $taripa): ?>
              <tr>
                <?php if ($selectedFilter === 'All'): ?>
                  <td><?php echo $taripa['route_area']; ?></td>
                <?php endif; ?>
                <td><?php echo $taripa['barangay']; ?></td>
                <td><?php echo '₱' . number_format($taripa['regular_rate'], 2, '.', ''); ?></td>
                <td><?php echo '₱' . number_format($taripa['student_rate'], 2, '.', ''); ?></td>
                <td><?php echo '₱' . number_format($taripa['senior_and_pwd_rate'], 2, '.', ''); ?></td>
              </tr>
            <?php endforeach; ?>   
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<script>
  const urlParams = new URLSearchParams(window.location.search);
  const selectedFilter = urlParams.get('route_area');
  const selectedYear = urlParams.get('year');

  // Set the selected filter values to the dropdowns
  if (selectedFilter) {
    document.getElementById("routeAreaFilter").value = selectedFilter;
  }

  if (selectedYear) {
    document.getElementById("yearFilter").value = selectedYear;
  }

  document.getElementById("routeAreaFilter").addEventListener("change", function() {
    const selectedValue = this.value;
    const yearFilter = document.getElementById("yearFilter").value;
    let url = 'taripa?route_area=' + encodeURIComponent(selectedValue);
    
    if (yearFilter !== 'All') {
      url += '&year=' + encodeURIComponent(yearFilter);
    }

    window.location.href = url;
  });

  document.getElementById("yearFilter").addEventListener("change", function() {
    const selectedValue = this.value;
    const routeAreaFilter = document.getElementById("routeAreaFilter").value;
    let url = 'taripa?year=' + encodeURIComponent(selectedValue);
    
    if (routeAreaFilter !== 'All') {
      url += '&route_area=' + encodeURIComponent(routeAreaFilter);
    }
    window.location.href = url;
  });
</script>