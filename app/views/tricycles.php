<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">tricycles</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <?php if (!empty($tricycles)): ?>
            <div class="mt-3 text-end">
              <form method="post" action="">
                <button type="submit" id="exportCsv" name="exportCsv" class="export-btn">Export as CSV</button>
              </form>
            </div>
          <?php endif; ?>
          <div class="row mt-3">
            <div class="col-6">
              <label for="statusFilter" class="fw-bold" style="font-size: 13px;">Filter By Status:</label>
              <select id="statusFilter" class="form-select" style="height: 35px; font-size: 14px;">
                <option value="all" <?php echo ($statusFilter === 'all') ? 'selected' : ''; ?>>All</option>
                <option value="Active" <?php echo ($statusFilter === 'Active') ? 'selected' : ''; ?>>Active</option>
                <option value="Change Motor Required" <?php echo ($statusFilter === 'Change Motor Required') ? 'selected' : ''; ?>>Change Motor Required</option>
                <option value="Renewal Required" <?php echo ($statusFilter === 'Renewal Required') ? 'selected' : ''; ?>>Renewal Required</option>
                <option value="Dropped" <?php echo ($statusFilter === 'Dropped') ? 'selected' : ''; ?>>Dropped</option>
                <option value="Expired Renewal (1st Notice)" <?php echo ($statusFilter === 'Expired Renewal (1st Notice)') ? 'selected' : ''; ?>>Expired Renewal (1st Notice)</option>
                <option value="Expired Renewal (2nd Notice)" <?php echo ($statusFilter === 'Expired Renewal (2nd Notice)') ? 'selected' : ''; ?>>Expired Renewal (2nd Notice)</option>
                <option value="Expired Renewal (3rd Notice)" <?php echo ($statusFilter === 'Expired Renewal (3rd Notice)') ? 'selected' : ''; ?>>Expired Renewal (3rd Notice)</option>
                <option value="Expired Motor (1st Notice)" <?php echo ($statusFilter === 'Expired Motor (1st Notice)') ? 'selected' : ''; ?>>Expired Motor (1st Notice)</option>
                <option value="Expired Motor (2nd Notice)" <?php echo ($statusFilter === 'Expired Motor (2nd Notice)') ? 'selected' : ''; ?>>Expired Motor (2nd Notice)</option>
                <option value="Expired Motor (3rd Notice)" <?php echo ($statusFilter === 'Expired Motor (3rd Notice)') ? 'selected' : ''; ?>>Expired Motor (3rd Notice)</option>
              </select>
            </div>
            <div class="col-6">
              <label for="routeAreaFilter" class="fw-bold"  style="font-size: 13px;">Filter By Route Area:</label>
              <select id="routeAreaFilter" class="form-select" style="height: 35px; font-size: 14px;">
                <option value="all" <?php echo ($routeAreaFilter === 'all') ? 'selected' : ''; ?>>All</option>
                <option value="Free Zone / Zone 1" <?php echo ($routeAreaFilter === 'Free Zone / Zone 1') ? 'selected' : ''; ?>>Free Zone / Zone 1</option>
                <option value="Free Zone & Zone 2" <?php echo ($routeAreaFilter === 'Free Zone & Zone 2') ? 'selected' : ''; ?>>Free Zone & Zone 2</option>
                <option value="Free Zone & Zone 3" <?php echo ($routeAreaFilter === 'Free Zone & Zone 3') ? 'selected' : ''; ?>>Free Zone & Zone 3</option>
                <option value="Free Zone & Zone 4" <?php echo ($routeAreaFilter === 'Free Zone & Zone 4') ? 'selected' : ''; ?>>Free Zone & Zone 4</option>
              </select>
            </div>
          </div>
          <div class="table-responsive pt-4">
            <table class="table table-hover" id="systemTable">
              <thead class="thead-custom">
                <tr class="text-uppercase">
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Tricycle CIN</th>
                  <th scope="col" class="text-center">Operator's Name</th>
                  <th scope="col" class="text-center">Make / Model</th>
                  <th scope="col" class="text-center">Motor Number</th>
                  <th scope="col" class="text-center">Color Code</th>
                  <th scope="col" class="text-center">Route Area</td>
                  <th scope="col" class="text-center">Status</th>
                  <th scope="col" class="text-center">Actions</th>
                  <?php if ($userRole === 'admin'): ?>
                    <th scope="col" class="text-center px-5">Update</th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody class="text-center text-capitalize">
                <?php foreach ($tricycles as $tricycle): ?>
                  <tr>
                  <td><?php echo $index++; ?></td>
                  <td><?php echo $tricycle['cin']; ?></td>
                  <td><?php echo $tricycle['operator_name']; ?></td>
                  <td><?php echo $tricycle['tricycle_application_data']->make_model; ?></td>
                  <td><?php echo $tricycle['tricycle_application_data']->motor_number; ?></td>
                  <td><?php echo $tricycle['tricycle_application_data']->color_code; ?></td>
                  <td><?php echo $tricycle['tricycle_application_data']->route_area; ?></td>
                  <td>  
                    <?php if (!empty($tricycle['statuses'])): ?>
                      <?php foreach ($tricycle['statuses'] as $status): ?>
                        <span class="badge status-badge text-uppercase text-center p-1 <?php echo $status['badgeColor']; ?>"><?php echo $status['status']; ?></span>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <span class="badge status-badge text-capitalize p-1 bg-secondary">No Status</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="./view_tricycle?tricycle_id=<?php echo $tricycle['tricycle_id']; ?>" class="view_data px-1 me-1" style="color: #0766AD;" title="View Tricycle Details"><i class="fa-solid fa-file-lines fa-xl"></i></a>
                  </td>
                  <?php if ($userRole === 'admin'): ?>
                    <td>
                      <?php if (hasStatusToUpdate($tricycle['statuses'])): ?>
                        <button type="button" class="update-status-btn" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $tricycle['tricycle_id']; ?>">
                          Update Status
                        </button>
                      <?php endif; ?>
                    </td>
                  <?php endif; ?>
                </tr>
                <!-- UPDATE STATUS MODAL -->
                <div class="modal fade" id="exampleModal-<?php echo $tricycle['tricycle_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header m-0 border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <h5 class="modal-title text-uppercase text-center mx-auto mb-3" id="statusModalLabel">Update Status</h5>
                        <form id="statusForm-<?php echo $tricycle['tricycle_id']; ?>" action="" method="post">
                          <div class="row">
                            <div class="col-12 d-flex py-3">
                              <div class="d-flex gap-5 text-center mx-1">
                                <div class="col-6">
                                  <div class="row-1">
                                    <?php if (!hasStatus($tricycle['statuses'], 'Active')): ?>
                                      <div class="tricycle-status-selection-modal rounded-3 mb-4">
                                        <input type="radio" id="Active-<?php echo $tricycle['tricycle_id']; ?>" name="status" value="Active">
                                        <label for="Active-<?php echo $tricycle['tricycle_id']; ?>">Active</label>
                                      </div>
                                    <?php else: ?>
                                      <div class="tricycle-status-disabled-modal rounded-3 mb-4">
                                        <input type="radio" id="Active" name="status" value="Active" disabled>
                                        <label for="Active" data-bs-toggle="tooltip" data-bs-placement="top" title="This option is disabled because the status is already Active">Active</label>
                                      </div>
                                    <?php endif; ?>
                                    <?php if (!hasStatus($tricycle['statuses'], 'Change Motor Required')): ?> 
                                      <div class="tricycle-status-selection-modal rounded-3 mb-4">
                                        <input type="radio" id="ChangeMotorRequired-<?php echo $tricycle['tricycle_id']; ?>" name="status" value="Change Motor Required">
                                        <label for="ChangeMotorRequired-<?php echo $tricycle['tricycle_id']; ?>">Change Motor Required</label>
                                      </div>
                                    <?php else: ?>
                                      <div class="tricycle-status-disabled-modal rounded-3 mb-4">
                                        <input type="radio" id="Change Motor Required" name="status" value="Change Motor Required" disabled>
                                        <label for="Change Motor Required" data-bs-toggle="tooltip" data-bs-placement="top" title="This option is disabled because the status is already Change Motor Required">Change Motor Required</label>
                                      </div>
                                    <?php endif; ?>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="row-2">
                                    <?php if (!hasStatus($tricycle['statuses'], 'Dropped')): ?>   
                                      <div class="tricycle-status-selection-modal rounded-3 mb-4">
                                        <input type="radio" id="Dropped-<?php echo $tricycle['tricycle_id']; ?>" name="status" value="Dropped">
                                        <label for="Dropped-<?php echo $tricycle['tricycle_id']; ?>">Dropped</label>
                                      </div>
                                    <?php else: ?>
                                      <div class="tricycle-status-disabled-modal rounded-3 mb-4">
                                        <input type="radio" id="Dropped" name="status" value="Dropped" disabled>
                                        <label for="Dropped" data-bs-toggle="tooltip" data-bs-placement="top" title="This option is disabled because the status is already Dropped">Dropped</label>
                                      </div>
                                    <?php endif; ?>
                                    <?php if (!hasStatus($tricycle['statuses'], 'Renewal Required')): ?>
                                      <div class="tricycle-status-selection-modal rounded-3 mb-4">
                                        <input type="radio" id="RenewalRequired-<?php echo $tricycle['tricycle_id']; ?>" name="status" value="Renewal Required">
                                        <label for="RenewalRequired-<?php echo $tricycle['tricycle_id']; ?>">Renewal Required</label>
                                      </div>
                                    <?php else: ?>
                                      <div class="tricycle-status-disabled-modal rounded-3 mb-4">
                                        <input type="radio" id="renewalRequired" name="status" value="Renewal Required" disabled>
                                        <label for="renewalRequired" data-bs-toggle="tooltip" data-bs-placement="top" title="This option is disabled because the status is already Renewal Required">Renewal Required</label>
                                      </div>
                                    <?php endif; ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="text-end my-3">
                            <input type="hidden" name="tricycle_id" value="<?php echo $tricycle['tricycle_id']; ?>">
                            <button type="submit" class="sidebar-btnContent" name="update_tricycle_status" id="update_tricycle_status">Update</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  // Initialize Bootstrap tooltips
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  $(document).ready(function () {
    $("#statusFilter, #routeAreaFilter").change(function () {
      const selectedStatus = $("#statusFilter").val();
      const selectedRouteArea = $("#routeAreaFilter").val();
      
      let queryParams = [];

      if (selectedStatus !== 'all') {
        queryParams.push('status=' + encodeURIComponent(selectedStatus));
      }
      if (selectedRouteArea !== 'all') {
        queryParams.push('route_area=' + encodeURIComponent(selectedRouteArea));
      }

      // Construct the URL based on selected filters
      let queryString = queryParams.length > 0 ? '?' + queryParams.join('&') : '';

      // Redirect to the page with selected filters
      window.location.href = "tricycles" + queryString;
    });
  });
</script>