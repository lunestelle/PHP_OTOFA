<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">New tricycle</h6>
    </div>
    <div class="col-lg-12 mt-4">
      <div class="row">
        <div class="col-12 pt-2">
          <div id="newTricycleForm">
            <form class="default-form" method="POST" action="" enctype="multipart/form-data">
              <div class="content-container mt-2">
                <div class="bckgrnd pt-2">
                  <h6 class="pl-2 text-uppercase text-center text-light fs-6 bckgrnd">Motor Unit</h6>
                </div>
                <div class="row px-3 p-4">
                  <div class="col-12 d-flex justify-content-between">
                    <div>
                      <label for="make_model" class="form-label">Model</label>
                      <select class="form-control" id="make_model" name="make_model" required>
                        <option selected disabled>Please Select Here</option>
                        <option value="Kymco Kargador 150" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'Kymco Kargador 150' ? 'selected' : ''; ?>>Kymco Kargador 150</option>
                        <option value="Honda TMX 125 Alpha" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'Honda TMX 125 Alpha' ? 'selected' : ''; ?>>Honda TMX 125 Alpha</option>
                        <option value="Honda TMX Supremo" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'Honda TMX Supremo' ? 'selected' : ''; ?>>Honda TMX Supremo</option>
                        <option value="Honda XRM 125 Dual Sport" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'Honda XRM 125 Dual Sport' ? 'selected' : ''; ?>>Honda XRM 125 Dual Sport</option>
                        <option value="Bajaj CT 150 BA" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'Bajaj CT 150 BA' ? 'selected' : ''; ?>>Bajaj CT 150 BA</option>
                        <option value="Bajaj CT 125" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'Bajaj CT 125' ? 'selected' : ''; ?>>Bajaj CT 125</option>
                        <option value="Bajaj CT 150 BA" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'Bajaj CT 150 BA' ? 'selected' : ''; ?>>Bajaj CT 150 BA</option>
                        <option value="Kawasaki CT 100" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'Kawasaki CT 100' ? 'selected' : ''; ?>>Kawasaki CT 100</option>
                        <option value="Kawasaki Barako 175 (KICK)" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'Kawasaki Barako 175 (KICK)' ? 'selected' : ''; ?>>Kawasaki Barako 175 (KICK)</option>
                        <option value="Kawasaki Barako 175 (ELECTRIC)" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'Kawasaki Barako 175 (ELECTRIC)' ? 'selected' : ''; ?>>Kawasaki Barako 175 (ELECTRIC)</option>
                        <option value="Yamaha YTX 125" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'Yamaha YTX 125' ? 'selected' : ''; ?>>Yamaha YTX 125</option>
                        <option value="Yamaha Sight 115" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'Yamaha Sight 115' ? 'selected' : ''; ?>>Yamaha Sight 115</option>
                        <option value="TVS Max 4R" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'TVS Max 4R' ? 'selected' : ''; ?>>TVS Max 4R</option>
                        <option value="Others" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'Others' ? 'selected' : ''; ?>>Others</option>
                      </select>
                    </div>
                    <div>
                      <label for="year_acquired" class="form-label">Year Acquired</label>
                      <input type="text" class="form-control" id="year_acquired" name="year_acquired" value="<?php echo isset($_POST['year_acquired']) ? $_POST['year_acquired'] : ''; ?>" required>
                    </div>
                    <div>
                      <label for="color_code" class="form-label">Color Code</label>
                      <select class="form-control" id="color_code" name="color_code" required>
                        <option selected disabled>Please Select Here</option>
                        <option value="Red" data-route-area="Free Zone / Zone 1" <?php echo (isset($_POST['color_code']) && $_POST['color_code'] == 'Red' ? 'selected' : ''); ?>>Red</option>
                        <option value="Green" data-route-area="Free Zone & Zone 2" <?php echo (isset($_POST['color_code']) && $_POST['color_code'] == 'Green' ? 'selected' : ''); ?>>Green</option>
                        <option value="Yellow" data-route-area="Free Zone & Zone 3" <?php echo (isset($_POST['color_code']) && $_POST['color_code'] == 'Yellow' ? 'selected' : ''); ?>>Yellow</option>
                        <option value="Blue" data-route-area="Free Zone & Zone 4" <?php echo (isset($_POST['color_code']) && $_POST['color_code'] == 'Blue' ? 'selected' : ''); ?>>Blue</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-12 d-flex justify-content-between pt-2">
                    <div>
                      <label for="route_area" class="form-label">Route Area</label>
                      <input type="text" class="form-control" id="route_area" name="route_area" placeholder="Select Color Code First" readonly required data-toggle="tooltip" data-bs-placement="right" title="Please choose a Color Code to determine the Route Area for the tricycle." value="<?php echo isset($_POST['route_area']) ? $_POST['route_area'] : ''; ?>">
                    </div>
                    <div>
                      <label for="plate_no" class="form-label">Plate No.</label>
                      <select class="form-control" id="plate_no" name="plate_no" required>
                        <option selected disabled>Please Select Here</option>
                        <?php
                          if (isset($availablePlateNumbers)) {
                            foreach ($availablePlateNumbers as $plateNumber) {
                              echo '<option value="' . $plateNumber . '" ' . (isset($_POST['plate_no']) && $_POST['plate_no'] == $plateNumber ? 'selected' : '') . '>' . $plateNumber . '</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div>
                      <label for="driver_id" class="form-label">Driver's Name</label>
                      <select class="form-control" id="driver_id" name="driver_id" required>
                        <option <?php echo (!isset($_POST['driver_id'])) ? 'selected' : ''; ?> disabled>Please Select Here</option>
                        <?php foreach ($drivers as $driver): ?>
                        <option value="<?php echo $driver['driver_id']; ?>" <?php echo (isset($_POST['driver_id']) && $_POST['driver_id'] == $driver['driver_id']) ? 'selected' : ''; ?>>
                          <?php echo $driver['name']; ?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-12 d-flex justify-content-between pt-2">
                    <div>
                      <label for="or_no" class="form-label">OR No.</label>
                      <input type="text" class="form-control" id="or_no" name="or_no" value="<?php echo isset($_POST['or_no']) ? $_POST['or_no'] : ''; ?>" required>
                    </div>
                    <div>
                      <label for="or_date" class="form-label">OR Date</label>
                      <input type="date" class="form-control" id="or_date" name="or_date" value="<?php echo isset($_POST['or_date']) ? $_POST['or_date'] : ''; ?>" required>
                    </div>
                    <div>
                      <label for="tricycle_status" class="form-label">Tricycle Status</label>
                      <select class="form-control" id="tricycle_status" name="tricycle_status" required>
                        <option selected disabled>Please Select Here</option>
                        <option value="Registration Pending" <?php echo (isset($_POST['tricycle_status']) && $_POST['tricycle_status'] == 'Registration Pending' ? 'selected' : ''); ?>>Registration Pending</option>
                        <option value="Active" <?php echo (isset($_POST['tricycle_status']) && $_POST['tricycle_status'] == 'Active' ? 'selected' : ''); ?>>Active</option>
                        <option value="Renewal Required" <?php echo (isset($_POST['tricycle_status']) && $_POST['tricycle_status'] == 'Renewal Required' ? 'selected' : ''); ?>>Renewal Required</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="content-container mt-3">
                <div class="bckgrnd pt-2">
                  <h6 class="pl-2 text-uppercase text-center text-light fs-6 bckgrnd">Tricycle images</h6>
                </div>
                <div class="row px-3 p-3">
                  <div class="col-8 d-flex justify-content-between">
                    <div>
                      <label for="front_view_image" class="form-label">Tricycle Front View</label>
                      <input type="file" class="form-control" id="front_view_image" name="front_view_image" required accept="image/*" />
                    </div>
                    <div>
                      <label for="back_view_image" class="form-label">Tricycle Back View</label>
                      <input type="file" class="form-control" id="back_view_image" name="back_view_image" required accept="image/*" />
                    </div>
                    <div>
                      <label for="side_view_image" class="form-label">Tricycle Side View</label>
                      <input type="file" class="form-control" id="side_view_image" name="side_view_image" required accept="image/*" />
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="text-end my-3">
                <button type="submit" class="sidebar-btnContent" name="add_tricycle">Add Tricycle</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  $(document).ready(function () {
    $("#color_code").change(function () {
      let selectedColorCode = $(this).val();
      let selectedRouteArea = $("#color_code").find(":selected").data("route-area");
      $("#route_area").val(selectedRouteArea);
      updateTaripaTable(selectedRouteArea);
    });
  });
</script>