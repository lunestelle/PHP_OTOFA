<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">new taripa</h6>
    </div>
    <?php if (!isset($calculatedRates) || empty($calculatedRates) || !empty($errors)): ?>
      <form method="post" id="taripaForm">
        <div class="col-lg-12 mt-5 pb-3 content-container mt-2">
          <div class="bckgrnd pt-2">
            <h6 class="pl-2 text-uppercase text-center text-light fs-6">Motor Unit</h6>
          </div>
          <div class="row mt-4 mx-2">
            <div class="col-12 d-flex">
              <div class="col-4 px-3">
                <label for="rateAction">Select Rate Action:</label>
                <select id="rateAction" name="rate_action" class="form-control">
                  <option value="increase" <?= isset($rate_action) && $rate_action === 'increase' ? 'selected' : '' ?>>Increase</option>
                  <option value="decrease" <?= isset($rate_action) && $rate_action === 'decrease' ? 'selected' : '' ?>>Decrease</option>
                </select>
              </div>
              <div class="col-4 px-3">
                <label for="year">Enter Effective Date:</label>
                <input type="date" id="year" name="year" class="form-control" min="<?= $minYear ?>-01-01" max="<?= $currentYear ?>-12-31" value="<?= $year ?? date('Y-m-d') ?>" required>
              </div>

              <div class="col-4 px-3">
                <label for="percentage">Enter Percentage:</label>
                <input type="number" id="percentage" name="percentage" class="form-control" min="1" max="100" step="1" value="<?= $percentage ?? '' ?>" required>
              </div>
            </div>
            <div class="col-12 mt-5">
              <button type="submit" class="sidebar-btnContent ms-2">Calculate</button>
              <a href="./taripa" class="cancel-btn ms-5">Cancel</a>
            </div>
          </div>
        </div>
      </form>
    <?php endif; ?>
  </div>

  <!-- Display the calculated rates -->
  <?php if (isset($calculatedRates) && !empty($calculatedRates)): ?>
    <div class="col-12 mt-4">
      <h6 class="mb-4"><?php echo $year; ?> Calculated Rates: <?php echo $rate_action === 'increase' ? $percentage . '% Increase' : $percentage . '% Decrease'; ?> from the <?php echo $recentYear; ?> Taripa</h6>
      <table class="table-bordered table-hover text-center" id="systemTable">
        <thead class="thead-custom">
          <tr class="text-uppercase">
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Route Area</th>
            <th scope="col" class="text-center">Barangay</th>
            <th scope="col" class="text-center">Previous Regular Fare</th>
            <th scope="col" class="text-center">Previous Discounted Fare</th>
            <th scope="col" class="text-center">New Regular Fare</th>
            <th scope="col" class="text-center">New Discounted Fare</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($calculatedRates as $rate): ?>
            <tr>
              <td><?php echo $index++; ?></td>
              <td><?php echo $rate['route_area']; ?></td>
              <td><?php echo $rate['barangay']; ?></td>
              <td><?php echo '₱' . number_format($rate['previous_regular_fare'], 2); ?></td>
              <td><?php echo '₱' . number_format($rate['previous_discounted_fare'], 2); ?></td>
              <td><?php echo '₱' . number_format($rate['new_regular_fare'], 2); ?></td>
              <td><?php echo '₱' . number_format($rate['new_discounted_fare'], 2); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="col-12 mt-3">
        <form method="post" action="<?=ROOT?>/save_rate_adjustment" id="saveForm">
          <input type="hidden" name="rate_action" value="<?= $rate_action; ?>">
          <input type="hidden" name="previous_year" value="<?= $recentYear; ?>">
          <input type="hidden" name="percentage" value="<?= $percentage; ?>">
          <input type="hidden" name="effective_date" value="<?= $effective_date; ?>">
          <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
          <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
        </form>
      </div>
    </div>

  <?php endif; ?>
</main>

<script>
  const formYearInput = document.getElementById('year');
  const formRateActionSelect = document.getElementById('rateAction');
  const formPercentageInput = document.getElementById('percentage');
  const taripaForm = document.getElementById('taripaForm');

  // On page load, check if there are calculated rates in the session and hide the form if needed
  const calculatedRates = <?php echo isset($calculatedRates) ? json_encode($calculatedRates) : 'null'; ?>;

  if (calculatedRates) {
    taripaForm.style.display = 'none';
  }
  
  // Clear the session data when the page is clicked (refreshed)
  window.addEventListener('beforeunload', function () {
    <?php unset($_SESSION['calculatedRates']); ?>
    <?php unset($_SESSION['formInput']); ?>
  });
</script>