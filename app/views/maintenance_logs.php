<main class="background-container col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">maintenance logs</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <div class="mt-3">
            <a href="new_maintenance_log" class="text-uppercase sidebar-btnContent new-button">New</a>
          </div>
        </div>
        <div class="col-12">
          <div class="table-responsive pt-4 pb-3">
            <table class="table table-hover" id="systemTable">
              <thead class="thead-custom">
                <tr class="text-center text-uppercase">
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Tricyle CIN</th>
                  <th scope="col" class="text-center">Driver's Name</th>
                  <th scope="col" class="text-center">Date</th>
                  <th scope="col" class="text-center">Total Expenses</th>
                  <th scope="col" class="text-center">Description</th>
                  <th scope="col" class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody class="text-center text-capitalize">
              <?php foreach ($maintenance_logs as $maintenance_log): ?>
                  <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $maintenance_log['cin']; ?></td>
                    <td><?php echo $maintenance_log['driver_name']; ?></td>
                    <td><?php echo $maintenance_log['expense_date']; ?></td>
                    <td><?php echo $maintenance_log['total_expenses']; ?></td>
                    <td><?php echo $maintenance_log['description']; ?></td>
                    <td>
                      <a href="./view_maintenance_log?maintenance_log_id=<?php echo $maintenance_log['maintenance_log_id']; ?>" class="view_data px-1 me-1" style="color:#26CC00;" title="View Maintenance Log Details"><i class="fa-solid fa-file-lines fa-lg"></i></a>
                      <a href="./edit_maintenance_log?maintenance_log_id=<?php echo $maintenance_log['maintenance_log_id']?>" class="edit_data px-1 me-1" style="color: #ff6c36;" title="Edit Maintenance Log Details"><i class="fa-solid fa-pencil fa-lg"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>