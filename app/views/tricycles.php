<div class="container-fluid">
  <div class="row">
    {{sidebar}} 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
      <div class="row">
        <div class="col-12 title-head text-uppercase">
          <h6>tricycles</h6>
        </div>
        <div class="col-lg-12">
          <div class="row">
            <div class="col-12">
              <div class="mt-3">
                <a href="new_tricycle" class="text-uppercase sidebar-btnContent">New</a>
              </div>
            </div>
            <div class="col-12">
              <div class="table-responsive pt-4">
                <table class="table-bordered table-hover" id="systemTable">
                  <thead class="thead-custom">
                    <tr class="text-uppercase">
                      <th scope="col" class="text-center">#</th>
                      <th scope="col" class="text-center">Plate No.</th>
                      <th scope="col" class="text-center">Driver's Name</th>
                      <th scope="col" class="text-center">Make / Model</th>
                      <th scope="col" class="text-center">Year Acquired</th>
                      <th scope="col" class="text-center">Color Code</th>
                      <th scope="col" class="text-center">Route Area</td>
                      <th scope="col" class="text-center">Status</th>
                      <th scope="col" class="text-center">Actions</th>
                      <!-- <th scope="col" class="text-center">Actions</th> -->
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php foreach ($tricycles as $tricycle): ?>
                      <tr>
                        <td><?php echo $index++; ?></td>
                        <td><?php echo $tricycle['plate_no']; ?></td>
                        <td><?php echo $tricycle['driver_name']; ?></td>
                        <td><?php echo $tricycle['make_model']; ?></td>
                        <td><?php echo $tricycle['year_acquired']; ?></td>
                        <td><?php echo $tricycle['color_code']; ?></td>
                        <td><?php echo $tricycle['route_area']; ?></td>
                        <td>
                          <span class="badge status-badge"><?php echo $tricycle['tricycle_status']; ?></span>
                        </td>
                        <td>
                          <a class="view-tricycle" href="./view_tricycle">View</a>
                          <a class="text-decoration-none" href="./edit_tricycle.php" >Edit</a>
                        </td>

                        <!-- <td>
                          Actions
                        </td> -->
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
  </div>
</div>