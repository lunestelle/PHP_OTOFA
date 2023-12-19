<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">tricycles</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
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
                </tr>
              </thead>
              <tbody class="text-center text-capitalize">
                <?php foreach ($tricycles as $tricycle): ?>
                  <tr>
                  <td><?php echo $index++; ?></td>
                  <td><?php echo $tricycle['cin']; ?></td>
                  <td><?php echo $tricycle['tricycle_application_data']->operator_name; ?></td>
                  <td><?php echo $tricycle['tricycle_application_data']->make_model; ?></td>
                  <td><?php echo $tricycle['tricycle_application_data']->motor_number; ?></td>
                  <td><?php echo $tricycle['tricycle_application_data']->color_code; ?></td>
                  <td><?php echo $tricycle['tricycle_application_data']->route_area; ?></td>
                    <td>
                      <?php
                        $status = $tricycle['status'];
                        $badgeColor = '';

                        switch ($status) {
                          case 'Active':
                            $badgeColor = 'bg-success';
                            break;
                          case 'Dropped':
                            $badgeColor = 'bg-danger';
                            break;
                          case 'Renewal Required':
                            $badgeColor = 'bg-warning';
                            break;
                          default:
                            break;
                        }
                      ?>
                      <span class="badge status-badge text-uppercase p-2 <?php echo $badgeColor; ?>"><?php echo $status; ?></span>
                    </td>
                    <td>
                      <?php if ($userRole === 'admin'): ?>  
                        <a href="./view_tricycle?tricycle_id=<?php echo $tricycle['tricycle_id']; ?>" class="view_data px-1 me-1" style="color:#26CC00;" title="View Operator Details"><i class="fa-solid fa-file-lines fa-lg"></i></a>
                        <?php if ($tricycle['status'] != 'Dropped'): ?>  
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#statusModal-<?php echo $tricycle['tricycle_id']; ?>">
                            Update Status
                          </button>
                        <?php endif; ?> 
                      <?php elseif ($userRole === 'operator'): ?>
                        <a href="./view_tricycle?tricycle_id=<?php echo $tricycle['tricycle_id']; ?>" class="view_data px-1 me-1" style="color:#26CC00;" title="View Operator Details"><i class="fa-solid fa-file-lines fa-lg"></i></a>
                      <?php endif; ?>  
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
<!-- UPDATE STATUS MODAL -->
<div class="modal fade" id="statusModal-<?php echo $tricycle['tricycle_id']; ?>" tabindex="-1" aria-labelledby="statusModalLabel-<?php echo $tricycle['tricycle_id']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="statusModalLabel-<?php echo $tricycle['tricycle_id']; ?>">Update Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="statusForm-<?php echo $tricycle['tricycle_id']; ?>" action="" method="post">
          <div class="row px-3 p-4">
            <div class="col-12 d-flex mb- py-3">
              <div class="col-12 px-5">
                <div class="d-flex gap-5 text-center">
                  <div class="row-1">
                    <div class="tricycle-status-selection-modal rounded-3 mb-4">
                      <input type="radio" id="active" name="status" value="Active">
                      <label for="active">Active</label>
                    </div>
                    <div class="tricycle-status-selection-modal rounded-3">
                      <input type="radio" id="dropped" name="status" value="Dropped">
                      <label for="dropped">Dropped</label>
                    </div>
                  </div>
                  <div class="row-2">
                    <div class="tricycle-status-selection-modal rounded-3 mb-4">
                      <input type="radio" id="renewalRequired" name="status" value="Renewal Required">
                      <label for="renewalRequired">Renewal Required</label>
                    </div>
                    <div class="tricycle-status-selection-modal rounded-3">
                      <input type="radio" id="changeMotorRequired" name="status" value="Change Motor Required">
                      <label for="changeMotorRequired">Change Motor Required</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-end my-3">
            <input type="hidden" name="tricycle_id" value="<?php echo $tricycle['tricycle_id']; ?>">
            <button type="submit" class="btn btn-primary" name="update_tricycle_status" id="update_tricycle_status">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>