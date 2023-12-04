<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">tricycles</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <div class="mt-3">
            <?php if ($userRole === 'admin'): ?>
              <a href="new_tricycle" class="text-uppercase sidebar-btnContent new-button">New</a>
            <?php endif; ?>  
          </div>
        </div>
        <div class="col-12">
          <div class="table-responsive pt-4">
            <table class="table table-hover" id="systemTable">
              <thead class="thead-custom">
                <tr class="text-uppercase">
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">CIN</th>
                  <th scope="col" class="text-center">Operator's Name</th>
                  <th scope="col" class="text-center">Make / Model</th>
                  <th scope="col" class="text-center">Year Acquired</th>
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
                    <td><?php echo $tricycle['plate_no']; ?></td>
                    <td><?php echo $tricycle['operator_name']; ?></td>
                    <td><?php echo $tricycle['make_model']; ?></td>
                    <td><?php echo $tricycle['year_acquired']; ?></td>
                    <td><?php echo $tricycle['color_code']; ?></td>
                    <td><?php echo $tricycle['route_area']; ?></td>
                    <td>
                      <?php
                        $status = $tricycle['tricycle_status'];
                        $badgeColor = '';

                        switch ($status) {
                          case 'Active':
                            $badgeColor = 'bg-success';
                            break;
                          case 'Registration Pending':
                            $badgeColor = 'bg-warning';
                            break;
                          case 'Renewal Required':
                            $badgeColor = 'bg-danger';
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
                        <a href="./edit_tricycle?tricycle_id=<?php echo $tricycle['tricycle_id']?>" class="edit_data px-1 me-1" style="color: #ff6c36;" title="Edit Operator Details"><i class="fa-solid fa-pencil fa-lg"></i></a>
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