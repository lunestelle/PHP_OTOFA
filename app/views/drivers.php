<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">drivers</h6>
    </div>
    <div class="col-lg-12 mt-4">
      <div class="row">
        <div class="col-12">
          <div class="mt-3">
            <a href="new_driver" class="text-uppercase sidebar-btnContent new-button">New</a>
          </div>
        </div>
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
                  <th scope="col" class="text-center">License No.</th>
                  <th scope="col" class="text-center">License Validity</th>
                  <th scope="col" class="text-center">Tricycle Plate Number</th>
                  <th scope="col" class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php foreach ($drivers as $driver): ?>
                  <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $driver['name']; ?></td>
                    <td><?php echo $driver['birthdate']; ?></td>
                    <td><?php echo $driver['address']; ?></td>
                    <td><?php echo $driver['phone_no']; ?></td>
                    <td><?php echo $driver['license_no']; ?></td>
                    <td><?php echo $driver['license_validity']; ?></td>
                    <td><?php echo empty($driver['tricycle_plate_number']) ? '----------------' : $driver['tricycle_plate_number']; ?></td>
                    <td>
                      <a href="./view_driver?driver_id=<?php echo $driver['driver_id']; ?>" class="view_data px-1 me-1" style="color:#26CC00;" title="View Product Details"><i class="fa-solid fa-file-lines fa-lg"></i></a>
                      <a href="./edit_driver?driver_id=<?php echo $driver['driver_id']; ?>" class="edit_data px-1 me-1" style="color: #ff6c36;" title="Edit Product Details"><i class="fa-solid fa-file-pen fa-lg"></i></a>
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