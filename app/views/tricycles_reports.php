<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Tricycles Reports</h6>
    </div>
    <div class="col-lg-12">
      <?php if (!empty($tricycleReports)): ?>
        <div class="mt-3 text-end">
          <form method="post" action="">
            <button type="submit" id="exportCsv" name="exportCsv" class="export-btn">Export as CSV</button>
          </form>
        </div>
      <?php endif; ?>
      <div class="table-responsive pt-4">
        <table class="table table-hover" id="systemTable">
          <thead>
            <tr class="text-uppercase">
              <th scope="col" class="text-center">#</th>
              <th scope="col" class="text-center">Operator's Name</th>
              <th scope="col" class="text-center">Total Tricycles</th>
              <th scope="col" class="text-center">Active Tricycles</th>
              <th scope="col" class="text-center">Dropped Tricycles</th>
              <th scope="col" class="text-center">Renewal Required Tricycles</th>
              <th scope="col" class="text-center">Change Motor Required Tricycles</th>
              <th scope="col" class="text-center">Expired Renewal Tricycles</th>
              <th scope="col" class="text-center">Expired Motor Tricycles</th>
            </tr>
          </thead>
          <tbody class="text-center text-capitalize">
          <?php foreach ($tricycleReports as $report): ?>
            <tr>
              <td><?php echo $data['index']++; ?></td>
              <td><?php echo $report['operator_name']; ?></td>
              <td><a href="tricycles?user_id=<?php echo $report['user_id']; ?>" style="color: blue; font-weight: bold; text-decoration: none;"><?php echo $report['total_tricycles']; ?></a></td>
              <td><a href="tricycles?status=Active&user_id=<?php echo $report['user_id']; ?>" style="color: black; font-weight: bold; text-decoration: none;"><?php echo $report['active_tricycles']; ?></a></td>
              <td><a href="tricycles?status=Dropped&user_id=<?php echo $report['user_id']; ?>" style="color: black; font-weight: bold; text-decoration: none;"><?php echo $report['dropped_tricycles']; ?></a></td>
              <td><a href="tricycles?status=Renewal Required&user_id=<?php echo $report['user_id']; ?>" style="color: black; font-weight: bold; text-decoration: none;"><?php echo $report['renewal_required_tricycles']; ?></a></td>
              <td><a href="tricycles?status=Change Motor Required&user_id=<?php echo $report['user_id']; ?>" style="color: black; font-weight: bold; text-decoration: none;"><?php echo $report['change_motor_required_tricycles']; ?></a></td>
              <td><a href="tricycles?status=Expired Renewal&user_id=<?php echo $report['user_id']; ?>" style="color: red; font-weight: bold; text-decoration: none;"><?php echo $report['expired_renewal_tricycles']; ?></a></td>
              <td><a href="tricycles?status=Expired Motor&user_id=<?php echo $report['user_id']; ?>" style="color: red; font-weight: bold; text-decoration: none;"><?php echo $report['expired_motor_tricycles']; ?></a></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>