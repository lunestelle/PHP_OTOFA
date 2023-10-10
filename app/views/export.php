<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 title-head text-uppercase">
      <h6>Export Data</h6>
    </div>
    <div class="col-lg-12">
      <div class="row mt-2">
        <div class="col-6">
          <form method="post" action="">
            <label for="export_data" class="form-label fw-bold">Select Data to Export:</label>
            <select class="form-select" name="export_data" id="export_data">
              <option value="operators">Operators</option>
              <option value="drivers">Drivers</option>
              <option value="taripa">Taripa</option>
            </select>
            <button type="submit" class="btn btn-primary mt-2">Export</button>
          </form>
        </div>
        <div class="col-6">
  <form method="post" action="">
    <div class="form-group">
      <label for="date_range">Date Range:</label>
      <input type="text" class="form-control" id="date_range" name="date_range" placeholder="Select date range">
    </div>

    <?php if ($selectedData !== 'operators' && isset($showOperatorFilter) && $showOperatorFilter): ?>
      <div class="form-group">
        <label for="operator_filter">Operator:</label>
        <select class="form-select" name="operator_filter" id="operator_filter">
          <?php foreach ($filterOperators as $operator): ?>
            <option value="<?php echo $operator['id']; ?>"><?php echo $operator['name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    <?php endif; ?>

    <?php if ($selectedData !== 'drivers' && isset($showDriverFilter) && $showDriverFilter): ?>
      <div class="form-group">
        <label for="driver_filter">Driver:</label>
        <select class="form-select" name="driver_filter" id="driver_filter">
          <?php foreach ($filterDrivers as $driver): ?>
            <option value="<?php echo $driver['id']; ?>"><?php echo $driver['name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    <?php endif; ?>

    <?php if ($selectedData !== 'taripa' && isset($showTaripaFilter) && $showTaripaFilter): ?>
      <div class="form-group">
        <label for="taripa_filter">Taripa:</label>
        <select class="form-select" name="taripa_filter" id="taripa_filter">
          <?php foreach ($filterTaripa as $taripa): ?>
            <option value="<?php echo $taripa['id']; ?>"><?php echo $taripa['name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    <?php endif; ?>

    <div class="form-group">
      <label for="status_filter">Status:</label>
      <select class="form-select" name="status_filter" id="status_filter">
        <?php foreach ($filterStatus as $status): ?>
          <option value="<?php echo $status['id']; ?>"><?php echo $status['name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="export_format">Export Format:</label>
      <select class="form-select" name="export_format" id="export_format">
        <?php foreach ($filterFormats as $format): ?>
          <option value="<?php echo $format; ?>"><?php echo $format; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="export_selection">Export All vs. Export Selection:</label>
      <input type="radio" id="export_all" name="export_selection" value="all" checked>
      <label for="export_all">Export All</label>
      <input type="radio" id="export_selection" name="export_selection" value="selection">
      <label for="export_selection">Export Selection</label>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Apply Filters</button>
  </form>
</div>
      </div>
    </div>

    <div class="col-12">
  <div class="table-responsive pt-4">
    <?php if ($exportData): ?>
      <table class="table table-hover" id="systemTable">
        <thead>
          <tr>
            <?php if ($selectedData === 'operators'): ?>
              <th>Full Name</th>
              <th>Phone Number</th>
              <th>Email</th>
              <th>Address</th>
            <?php elseif ($selectedData === 'drivers'): ?>
              <th>Name</th>
              <th>Birthdate</th>
              <th>Address</th>
              <th>Phone Number</th>
              <th>License Number</th>
            <?php elseif ($selectedData === 'taripa'): ?>
              <th>Route Area</th>
              <th>Barangay</th>
              <th>Regular Rate</th>
              <th>Student Rate</th>
              <th>Senior & PWD Rate</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($exportData as $row): ?>
            <tr>
              <?php if ($selectedData === 'operators'): ?>
                <td><?php echo empty($row['full_name']) ? '--------------' : $row['full_name']; ?></td>
                <td><?php echo empty($row['phone_number']) ? '--------------' : $row['phone_number']; ?></td>
                <td><?php echo empty($row['email']) ? '--------------' : $row['email']; ?></td>
                <td><?php echo empty($row['address']) ? '--------------' : $row['address']; ?></td>
              <?php elseif ($selectedData === 'drivers'): ?>
                <td><?php echo empty($row['name']) ? '--------------' : $row['name']; ?></td>
                <td><?php echo empty($row['birthdate']) ? '--------------' : $row['birthdate']; ?></td>
                <td><?php echo empty($row['address']) ? '--------------' : $row['address']; ?></td>
                <td><?php echo empty($row['phone_no']) ? '--------------' : $row['phone_no']; ?></td>
                <td><?php echo empty($row['license_no']) ? '--------------' : $row['license_no']; ?></td>
              <?php elseif ($selectedData === 'taripa'): ?>
                <td><?php echo empty($row['route_area']) ? '--------------' : $row['route_area']; ?></td>
                <td><?php echo empty($row['barangay']) ? '--------------' : $row['barangay']; ?></td>
                <td><?php echo empty($row['regular_rate']) ? '--------------' : $row['regular_rate']; ?></td>
                <td><?php echo empty($row['student_rate']) ? '--------------' : $row['student_rate']; ?></td>
                <td><?php echo empty($row['senior_and_pwd_rate']) ? '--------------' : $row['senior_and_pwd_rate']; ?></td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No data available.</p>
    <?php endif; ?>
  </div>
</div>

  </div>
</main>