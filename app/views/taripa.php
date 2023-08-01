<div class="container-fluid">
  <div class="row">
    {{sidebar}} 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
      <div class="row">
        <div class="col-12 title-head text-uppercase">
          <h6>Taripa</h6>
        </div>
        <div class="col-lg-12">
          <div class="row mt-2">
            <div class="col-6">
              <label for="routeAreaFilter">Select Route Area:</label>
              <select id="routeAreaFilter" class="form-select">
                <option value="All">All</option>
                <option value="Freezone & Zone 1">Freezone & Zone 1</option>
                <option value="Freezone & Zone 2">Freezone & Zone 2</option>
                <option value="Freezone & Zone 3">Freezone & Zone 3</option>
                <option value="Freezone & Zone 4">Freezone & Zone 4</option>
                <option value="Freezone">Freezone</option>
              </select>
            </div>
            <div class="col-6 mt-3">
              <a href="new_taripa" class="text-uppercase sidebar-btnContent">New</a>
            </div>
            <div class="col-6 mt-3">
              <label for="yearFilter">Select Year:</label>
              <select id="yearFilter" class="form-select">
                <?php foreach ($years as $year): ?>
                  <option value="<?php echo $year; ?>" <?php echo ($year == $selectedFilter) ? 'selected' : ''; ?>><?php echo $year; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        
        <div class="col-12">
          <div class="table-responsive pt-4">
            <table class="table-bordered table-hover" id="systemTable">
              <thead class="thead-custom">
                <tr class="text-uppercase">
                  <th scope="col" class="text-center">#</th>
                  <?php if ($selectedFilter === 'All'): ?>
                    <th scope="col" class="text-center">Route Area</th>
                  <?php endif; ?>
                  <th scope="col" class="text-center">Barangay</th>
                  <th scope="col" class="text-center">Regular Rate</th>
                  <th scope="col" class="text-center">Senior Citizen, PWD, & Student Rate</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php foreach ($taripas as $taripa): ?>
                  <tr>
                    <td><?php echo $index++; ?></td>
                    <?php if ($selectedFilter === 'All'): ?>
                      <td><?php echo $taripa['route_area']; ?></td>
                    <?php endif; ?>
                    <td><?php echo $taripa['barangay']; ?></td>
                    <td><?php echo '₱' . number_format($taripa['regular_rate'], 2, '.', ''); ?></td>
                    <td><?php echo '₱' . number_format($taripa['discounted_rate'], 2, '.', ''); ?></td>
                  </tr>
                <?php endforeach; ?>   
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

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