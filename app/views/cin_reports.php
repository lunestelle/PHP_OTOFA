<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">CIN Reports</h6>
    </div>
    <div class="col-lg-12">
      <?php if (!empty($cinReports)): ?>
        <div class="mt-3 text-end">
          <form method="post" action="">
            <button type="submit" id="exportCsv" name="exportCsv" class="export-btn">Export as CSV</button>
          </form>
        </div>

        <?php foreach ($cinReports as $report): ?>
          <div class="mt-3 mb-2">
            <strong>Total of Available CIN Numbers:</strong> <?php echo $report['total_available_cin_numbers']; ?>
          </div>
          <div class="mt-3">
            <strong>Total of Used CIN Numbers:</strong> <?php echo $report['total_used_cin_numbers']; ?>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <div class="table-responsive pt-4">
        <table class="table table-hover" id="systemTable">
          <thead class="thead-custom">
            <tr class="text-uppercase">
              <th scope="col" class="text-center">#</th>
              <th scope="col" class="text-center">User Name</th>
              <th scope="col" class="text-center">CIN Numbers Owned</th>
            </tr>
          </thead>
          <tbody class="text-center text-capitalize">
            <?php foreach ($cinReports as $report): ?>
              <tr>
                <td><?php echo $report['index']; ?></td>
                <td><?php echo $report['user_name']; ?></td>
                <td><?php echo $report['cin_numbers_owned']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
