<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">View Tricycle</h6>
    </div>
    <div class="col-lg-12 mt-4">
      <div class="row">
        <div class="col-12 pt-2">
          <div id="newTricycleForm">
            <div class="content-container mt-2">
              <div class="bckgrnd pt-2">
                <h6 class="pl-2 text-uppercase text-center text-dark fs-6">Motor Unit</h6>
              </div>
              <div class="row px-3 p-4">
                <div class="col-12 d-flex justify-content-between">
                  <div>
                    <p class="form-label">Model</p>
                    <div class="form-control">
                      <?php echo isset($make_model) ? $make_model : ''; ?>
                    </div>
                  </div>
                  <div>
                    <p for="year_acquired" class="form-label">Year Acquired</p>
                    <div class="form-control">
                      <?php echo isset($year_acquired) ? $year_acquired : ''; ?>
                    </div>
                  </div>
                  <div>
                    <p for="color_code" class="form-label">Color Code</p>
                    <div class="form-control">
                      <?php echo isset($color_code) ? $color_code : ''; ?>
                    </div>
                  </div>
                </div>

                <div class="col-12 d-flex justify-content-between pt-2">
                  <div>
                    <p class="form-label">Route Area</p>
                    <div class="form-control">
                      <?php echo isset($route_area) ? $route_area : ''; ?>
                    </div>
                  </div>
                  <div>
                    <p class="form-label">CIN</p>
                    <div class="form-control">
                      <?php echo isset($plate_no) ? $plate_no : ''; ?>
                    </div>
                  </div>
                  <div>
                    <p class="form-label">Operator's Name</p>
                    <div class="form-control">
                      <?php echo isset($user_name) ? $user_name : ''; ?>
                    </div>
                  </div>
                </div>

                <div class="col-12 d-flex justify-content-between pt-2">
                  <div>
                    <p class="form-label">OR No.</p>
                    <div class="form-control">
                      <?php echo isset($or_no) ? $or_no : ''; ?>
                    </div>
                  </div>
                  <div>
                    <p for="or_date" class="form-label">OR Date</p>
                    <div class="form-control">
                      <?php echo isset($or_date) ? $or_date : ''; ?>
                    </div>
                  </div>
                  <div>
                    <p for="or_date" class="form-label">Tricycle Status</p>
                    <div class="form-control">
                      <?php echo isset($tricycle_status) ? $tricycle_status : ''; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="content-container mt-4">
              <div class="bckgrnd pt-2">
                <h6 class="pl-2 text-uppercase text-center text-dark fs-6">Tricycle images</h6>
              </div>
              <div class="row justify-content-evenly px-3 p-3">
                <div class="col-12 d-flex justify-content-evenly">
                  <div class="text-center">
                    <p class="form-label fw-semibold fs-6">Tricycle Front View</p>
                    <?php
                      if (isset($front_view_image_path) && $front_view_image_path) {
                        echo '<div class="image-container position-relative">';
                        echo '<img src="' . $front_view_image_path . '" class="img-fluid rounded fixed-height-image" id="front_view_image" alt="Tricycle Front View">';
                        echo '</div>';
                      } else {
                        echo '<p class="form-label">Front View Image not available</p>';
                      }
                    ?>
                  </div>
                  <div class="text-center">
                    <p class="form-label fw-semibold fs-6">Tricycle Side View</p>
                    <?php
                      if (isset($side_view_image_path) && $side_view_image_path) {
                        echo '<div class="image-container position-relative">';
                        echo '<img src="' . $side_view_image_path . '" class="img-fluid rounded fixed-height-image" id="side_view_image" alt="Tricycle Side View">';
                        echo '</div>';
                      } else {
                        echo '<p class="form-label">Side View Image not available</p>';
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>

            <div id="taripaTableContainer" class="content-container mt-4">
              <div class="bckgrnd pt-2">
                <?php
                  $taripaTitle = isset($route_area) ? $route_area : '';
                  $taripaTitle .= isset($recentYear) ? ' &mdash; ' . $recentYear . ' TARIPA' : '';
                ?>
                <h6 class="pl-2 text-uppercase text-center text-dark fs-6">
                  <?php echo $taripaTitle; ?>
                </h6>
              </div>
              <div class="row px-3 p-4">
                <table class="table-bordered table-hover text-center" id="systemTable">
                  <thead>
                    <tr>
                      <th class="text-white text-center" style="background-color:#090C1B !important;">Barangay</th>
                      <th class="text-white text-center" style="background-color:#090C1B !important;">Regular Rate</th>
                      <th class="text-white text-center" style="background-color:#090C1B !important;">Student Rate</th>
                      <th class="text-white text-center" style="background-color:#090C1B !important;">Senior Citizen & PWD Rate</th>
                    </tr>
                </thead>
                  <tbody>
                    <?php foreach ($recentTaripaData as $taripa): ?>
                      <tr>
                        <td><?php echo $taripa['barangay']; ?></td>
                        <td><?php echo '₱' . number_format($taripa['regular_rate'], 2); ?></td>
                        <td><?php echo '₱' . number_format($taripa['student_rate'], 2); ?></td>
                        <td><?php echo '₱' . number_format($taripa['senior_and_pwd_rate'], 2); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="text-end my-3">
              <a href="./tricycles"><button class="sidebar-btnContent">Back</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>