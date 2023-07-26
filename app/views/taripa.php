<div class="container-fluid">
  <div class="row">
    {{sidebar}} 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="row">
        <div class="col-12 title-head text-uppercase">
          <h6>Taripa</h6>
        </div>
        <div class="col-lg-12">
          <div class="row">
            <div class="col-12">
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
                <div class="col-6">
                  <div class="mt-3">
                  <?php if ($selectedFilter === 'All'): ?>
                      <a href="new_taripa" class="text-uppercase sidebar-btnContent">New</a>
                    <?php else: ?>
                      <a href="new_taripa?route_area=<?php echo urlencode($selectedFilter); ?>" class="text-uppercase sidebar-btnContent">New</a>
                    <?php endif; ?>
                  </div>
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
                      <th scope="col" class="text-center">Senior Citizen, PWD & Student Rate</th>
                      <th scope="col" class="text-center">Action</th>
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
                        <td><?php echo $taripa['regular_rate']; ?></td>
                        <td><?php echo $taripa['discounted_rate']; ?></td>
                        <td>
                        <a href="edit_taripa?id=<?php echo $taripa['taripa_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                          <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

<script>
  // Get the selected filter value from the URL query parameters
  const urlParams = new URLSearchParams(window.location.search);
  const selectedFilter = urlParams.get('route_area');

  // Set the selected filter value to the dropdown
  if (selectedFilter) {
    document.getElementById("routeAreaFilter").value = selectedFilter;
  }

  document.getElementById("routeAreaFilter").addEventListener("change", function() {
    const selectedValue = this.value;
    const url = 'taripa?route_area=' + encodeURIComponent(selectedValue);

    // Redirect to the URL
    window.location.href = url;
  });
</script>