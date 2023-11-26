<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">new taripa</h6>
    </div>
    <form method="post" id="taripaForm">
      <div class="mx-5">
        <div class="col-lg-12 mt-5 pb-3 content-container mt-2">
          <div class="bckgrnd pt-2">
            <h6 class="pl-2 text-uppercase text-center text-light fs-6">Motor Unit</h6>
          </div>
          <div class="row mx-auto mt-4 px-3">
            <div class="col-12 d-flex justify-content-between gap-3">
              <div class="col-4">
                <label for="rateAction">Select Rate Action:</label>
                <select id="rateAction" name="rate_action" class="form-select">
                  <option value="increase" <?= isset($rate_action) && $rate_action === 'increase' ? 'selected' : '' ?>>Increase</option>
                  <option value="decrease" <?= isset($rate_action) && $rate_action === 'decrease' ? 'selected' : '' ?>>Decrease</option>
                </select>
              </div>
              <div class="col-4">
                <label for="year">Enter Year:</label>
                <input type="number" id="year" name="year" class="form-control" min="<?= $minYear ?>" max="<?= $currentYear ?>" value="<?= $year ?? '' ?>" required>
              </div>
              <div class="col-4">
                <label for="percentage">Enter Percentage:</label>
                <input type="number" id="percentage" name="percentage" class="form-control" min="1" max="100" step="1" value="<?= $percentage ?? '' ?>" required>
              </div>
            </div>
            <div class="col-12 mt-5">
              <button type="submit" class="sidebar-btnContent me-">Calculate</button>
              <a href="./taripa" class="cancel-btn me-1">Cancel</a>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- Display the calculated rates -->
  <?php if (isset($calculatedRates) && !empty($calculatedRates)): ?>
    <div class="col-12 mt-4">
      <h6 class="mb-4"><?php echo $year; ?> Calculated Rates: <?php echo $rate_action === 'increase' ? $percentage . '% Increase' : $percentage . '% Decrease'; ?> from the <?php echo $recentYear; ?> Taripa</h6>
      <table class="table-bordered table-hover text-center" id="systemTable">
        <thead class="thead-custom">
          <tr class="text-uppercase">
            <th scope="col" class="text-center">Route Area</th>
            <th scope="col" class="text-center">Barangay</th>
            <th scope="col" class="text-center">Previous Regular Rate</th>
            <th scope="col" class="text-center">Previous Student Rate</th>
            <th scope="col" class="text-center">Previous Senior & PWD Rate</th>
            <th scope="col" class="text-center">New Regular Rate</th>
            <th scope="col" class="text-center">New Student Rate</th>
            <th scope="col" class="text-center">New Senior & PWD Rate</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($calculatedRates as $rate): ?>
            <tr>
              <td><?php echo $rate['route_area']; ?></td>
              <td><?php echo $rate['barangay']; ?></td>
              <td><?php echo '₱' . number_format($rate['previous_regular_rate'], 2); ?></td>
              <td><?php echo '₱' . number_format($rate['previous_student_rate'], 2); ?></td>
              <td><?php echo '₱' . number_format($rate['previous_senior_and_pwd_rate'], 2); ?></td>
              <td><?php echo '₱' . number_format($rate['new_regular_rate'], 2); ?></td>
              <td><?php echo '₱' . number_format($rate['new_student_rate'], 2); ?></td>
              <td><?php echo '₱' . number_format($rate['new_senior_and_pwd_rate'], 2); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="col-12 mt-3">
      <form method="post" action="<?=ROOT?>/save_rate_adjustment" id="saveForm">
        <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
        <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
      </form>
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

  // Save the form data to session storage before form submission
  taripaForm.addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = {
      year: formYearInput.value,
      rate_action: formRateActionSelect.value,
      percentage: formPercentageInput.value,
    };
    sessionStorage.setItem('formInput', JSON.stringify(formData));
    this.submit();
  });

  saveForm.addEventListener('submit', function () {
    // Check if there is any form data in sessionStorage and populate the first form
    const formData = sessionStorage.getItem('formInput');
    if (formData) {
      const { year, rate_action, percentage } = JSON.parse(formData);
      formYearInput.value = year;
      formRateActionSelect.value = rate_action;
      formPercentageInput.value = percentage;

      const recentYear = <?php echo isset($_SESSION['recentYear']) ? json_encode($_SESSION['recentYear']) : 'null'; ?>;
    
      const rateActionInput = document.createElement('input');
      rateActionInput.type = 'hidden';
      rateActionInput.name = 'rate_action';
      rateActionInput.value = rate_action;
      saveForm.appendChild(rateActionInput);

      const percentageInput = document.createElement('input');
      percentageInput.type = 'hidden';
      percentageInput.name = 'percentage';
      percentageInput.value = percentage;
      saveForm.appendChild(percentageInput);

      const yearInput = document.createElement('input');
      yearInput.type = 'hidden';
      yearInput.name = 'year';
      yearInput.value = year;
      saveForm.appendChild(yearInput);

      const previousYearInput = document.createElement('input');
      previousYearInput.type = 'hidden';
      previousYearInput.name = 'previous_year';
      previousYearInput.value = recentYear;
      saveForm.appendChild(previousYearInput);
    }
  });
</script>