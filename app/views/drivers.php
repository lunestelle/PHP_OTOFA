<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">drivers</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <?php if ($showNewButton): ?>
          <div class="col-12">
            <div class="mt-3">
              <a href="new_driver" class="text-uppercase sidebar-btnContent new-button">New</a>
            </div>

            <?php if (!empty($drivers)): ?>
              <div class="mt-3 text-end">
                <form method="post" action="">
                  <button type="submit" id="exportCsv" name="exportCsv" class="export-btn-operator">Export as CSV</button>
                </form>
              </div>
            <?php endif; ?>
          </div>
        <?php else: ?>
          <?php if (!empty($drivers)): ?>
            <div class="col-12">
              <div class="mt-3">
                <form method="post" action="">
                  <button type="submit" id="exportCsv" name="exportCsv" class="sidebar-btnContent new-button">Export as CSV</button>
                </form>
              </div>
            </div>
          <?php endif; ?>
        <?php endif; ?>
        <div class="col-12">
          <div class="table-responsive pt-4">
            <table class="table table-hover" id="systemTable">
              <thead class="thead-custom">
                <tr class="text-uppercase">
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Name</th>
                  <th scope="col" class="text-center">Birthdate</th>
                  <th scope="col" class="text-center">Address</th>
                  <th scope="col" class="text-center">Phone No.</th>
                  <th scope="col" class="text-center">License Number</th>
                  <th scope="col" class="text-center">License Expiry Date</th>
                  <th scope="col" class="text-center">Tricycle CIN</th>
                  <th scope="col" class="text-center">Status</th>
                  <th scope="col" class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody class="text-center text-capitalize">
                <?php foreach ($drivers as $driver): ?>
                  <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $driver['name']; ?></td>
                    <td><?php echo $driver['birthdate']; ?></td>
                    <td><?php echo $driver['address']; ?></td>
                    <td><?php echo $driver['phone_no']; ?></td>
                    <td><?php echo $driver['license_no']; ?></td>
                    <td><?php echo $driver['license_expiry_date']; ?></td>
                    <td><?php echo empty($driver['tricycle_plate_number']) ? '----------------' : $driver['tricycle_plate_number']; ?></td>
                    <td>
                      <?php foreach ($driver['statuses'] as $status): ?>
                        <?php
                          $statusClass = '';
                          switch ($status['status']) {
                            case 'Active':
                              $statusClass = 'bg-success';
                              break;
                            case 'Inactive':
                              $statusClass = 'bg-secondary';
                              break;
                            case 'Driver License Expired':
                              $statusClass = 'bg-danger';
                              break;
                            default:
                              $statusClass = 'bg-secondary';
                              break;
                          }
                        ?>
                        <span class="badge <?php echo $statusClass; ?>"><?php echo $status['status']; ?></span>
                      <?php endforeach; ?>
                    </td>
                    <td>
                      <a href="./view_driver?driver_id=<?php echo $driver['driver_id']; ?>" class="view_data px-1 me-1" style="color:#26CC00;" title="View Driver Details"><i class="fa-solid fa-file-lines fa-lg"></i></a>
                      <a href="./edit_driver?driver_id=<?php echo $driver['driver_id']; ?>" class="edit_data px-1 me-1" style="color: #ff6c36;" title="Edit Driver Details"><i class="fa-solid fa-file-pen fa-lg"></i></a>
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