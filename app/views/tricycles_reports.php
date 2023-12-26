<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Tricycles Reports</h6>
    </div>
    <div class="col-lg-12">
      <?php if (!empty($tricycleReports)): ?>
        <div class="mt-3 text-end">
          <form method="post" action="">
            <button type="submit" id="exportCsv" name="exportCsv" class="btn btn-primary">Export as CSV</button>
          </form>
        </div>
      <?php endif; ?>
      <div class="table-responsive pt-4">
        <table class="table table-hover" id="systemTable">
          <thead class="thead-custom">
            <tr class="text-uppercase">
              <th scope="col" class="text-center">#</th>
              <th scope="col" class="text-center">Operator's Name</th>
              <th scope="col" class="text-center">Total Tricycles</th>
              <th scope="col" class="text-center">Active Tricycles</th>
              <th scope="col" class="text-center">Dropped Tricycles</th>
              <th scope="col" class="text-center">Renewal Required Tricycles</th>
              <th scope="col" class="text-center">Change Motor Required Tricycles</th>
            </tr>
          </thead>
          <tbody class="text-center text-capitalize">
            <?php foreach ($tricycleReports as $report): ?>
              <tr>
                <td><?php echo $index++; ?></td>
                <td><?php echo $report['operator_name']; ?></td>
                <td><?php echo $report['total_tricycles']; ?></td>
                <td><?php echo $report['active_tricycles']; ?></td>
                <td><?php echo $report['dropped_tricycles']; ?></td>
                <td><?php echo $report['renewal_required_tricycles']; ?></td>
                <td><?php echo $report['change_motor_required_tricycles']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>