<div class="container-fluid">
  <div class="row">
    {{sidebar}} 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
      <div class="row">
        <div class="col-12 title-head text-uppercase">
        <h6 class="add">View Tricycle <?php  echo isset($_GET['plate_no'])  ?></h6>
        </div>
        <div class="col-lg-12">
          <div class="row">
            <div class="col-12 pt-2">
              <div id="newTricycleForm">
                <form class="default-form" method="POST" action="" enctype="multipart/form-data">
                  <div class="content-container mt-2 p-3">
                    <h6 class="pl-2">MOTOR UNIT</h6>
                    <div class="row px-3">
                      <div class="col-12 d-flex justify-content-between">
                        <div>
                          <label for="make_model" class="form-label">Model</label>
                          <input disabled type="text" class="form-control" id="make_model" name="make_model" value="<?php echo isset($_POST['make_model']) ? $_POST['make_model'] : ''; ?>" required>
                        </div>

                        <div>
                          <label for="year_acquired" class="form-label">Year Acquired</label>
                          <input disabled type="text" class="form-control view-field" id="year_acquired" name="year_acquired" value="<?php echo isset($_POST['year_acquired']) ? $_POST['year_acquired'] : ''; ?>" required>
                        </div>

                        <div>
                          <label for="color_code" class="form-label">Color Code</label>
                          <select disabled class="form-control" id="color_code" name="color_code" required>
                            <option selected disabled>Please Select Here</option>
                            <option value="Red" <?php echo isset($_POST['color_code']) && $_POST['color_code'] === 'Red' ? 'selected' : ''; ?>>Red</option>
                            <option value="Green" <?php echo isset($_POST['color_code']) && $_POST['color_code'] === 'Green' ? 'selected' : ''; ?>>Green</option>
                            <option value="Yellow" <?php echo isset($_POST['color_code']) && $_POST['color_code'] === 'Yellow' ? 'selected' : ''; ?>>Yellow</option>
                            <option value="Blue" <?php echo isset($_POST['color_code']) && $_POST['color_code'] === 'Blue' ? 'selected' : ''; ?>>Blue</option>
                          </select>
                        </div>

                        <div>
                          <label for="route_area" class="form-label">Route Area</label>
                          <select disabled class="form-control" id="route_area" name="route_area" required>
                            <option selected disabled>Please Select Here</option>
                            <option value="Freezone & Zone 1" <?php echo isset($_POST['route_area']) && $_POST['route_area'] === 'Freezone & Zone 1' ? 'selected' : ''; ?>>Freezone & Zone 1</option>
                            <option value="Freezone & Zone 2" <?php echo isset($_POST['route_area']) && $_POST['route_area'] === 'Freezone & Zone 2' ? 'selected' : ''; ?>>Freezone & Zone 2</option>
                            <option value="Freezone & Zone 3" <?php echo isset($_POST['route_area']) && $_POST['route_area'] === 'Freezone & Zone 3' ? 'selected' : ''; ?>>Freezone & Zone 3</option>
                            <option value="Freezone & Zone 4" <?php echo isset($_POST['route_area']) && $_POST['route_area'] === 'Freezone & Zone 4' ? 'selected' : ''; ?>>Freezone & Zone 4</option>
                            <option value="Freezone" <?php echo isset($_POST['route_area']) && $_POST['route_area'] === 'Freezone' ? 'selected' : ''; ?>>Freezone</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-12 d-flex justify-content-between pt-3">
                        <div>
                          <label for="plate_no" class="form-label">Plate No.</label>
                          <input disabled type="text" class="form-control" id="plate_no" name="plate_no" value="<?php echo isset($_POST['plate_no']) ? $_POST['plate_no'] : ''; ?>" required>
                        </div>

                        <div>
                          <label for="driver_id" class="form-label">Driver's Name</label>
                          <select disabled class="form-control" id="driver_id" name="driver_id" required>
                            <option <?php echo (!isset($_POST['driver_id'])) ? 'selected' : ''; ?> disabled>Please Select Here</option>
                            <?php foreach ($drivers as $driver): ?>
                            <option value="<?php echo $driver['driver_id']; ?>" <?php echo (isset($_POST['driver_id']) && $_POST['driver_id'] == $driver['driver_id']) ? 'selected' : ''; ?>>
                              <?php echo $driver['name']; ?>
                            </option>
                            <?php endforeach; ?>
                          </select>
                        </div>

                        <div>
                          <label for="or_no" class="form-label">OR No.</label>
                          <input disabled type="text" class="form-control" id="or_no" name="or_no" value="<?php echo isset($_POST['or_no']) ? $_POST['or_no'] : ''; ?>" required>
                        </div>

                        <div>
                          <label for="or_date" class="form-label">OR Date</label>
                          <input disabled type="date" class="form-control" id="or_date" name="or_date" value="<?php echo isset($_POST['or_date']) ? $_POST['or_date'] : ''; ?>" required>
                        </div>

                        <!-- <div>
                          <label for="tricycle_status" class="form-label">Tricycle Status</label>
                          <select disabled class="form-control" id="tricycle_status" name="tricycle_status" readonly>
                            <option value="Registration Pending" selected>Registration Pending</option>
                            <option value="Available">Available</option>
                            <option value="Renewal Required">Renewal Requi red</option>
                            <option value="Sold">Sold</option>
                            <option value="Under Maintenance">Under Maintenance</option>
                          </select>
                        </div> -->
                      </div>
                    </div>

                    <h6 class="pl-2 pt-3">DOCUMENTS</h6>
                    <div class="row px-3">
                      <div class="col-8 d-flex justify-content-between">
                        <div>
                          <label for="tricycle_operator_permit" class="form-label">Tricycle Operator Permit</label>
                          <input disabled type="file" class="form-control" id="tricycle_operator_permit" name="tricycle_operator_permit" required>
                        </div>

                        <div>
                          <label for="tricycle_images" class="form-label">Tricycle Images (Front, Back, & Sides)</label>
                          <input disabled type="file" class="form-control" id="tricycle_images" name="tricycle_images" required multiple>
                        </div>
                      </div>
                    </div>

                    <div class="row px-3 pt-4">
                      <div class="col-8 d-flex justify-content-between">
                        <div>
                          <label for="certificate_of_registration" class="form-label">Certificate of Registration (CR)</label>
                          <input disabled type="file" class="form-control" id="certificate_of_registration" name="certificate_of_registration" required>
                        </div> 

                        <div>
                          <label for="official_receipt" class="form-label">Official Receipt (OR)</label>
                          <input disabled type="file" class="form-control" id="official_receipt" name="official_receipt" required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="taripaTableContainer" >
                    <!-- show here the taripa of the selected route area -->
                  </div>

                  <div class="text-end my-3">
                    <a href="./tricycles.php"><button type="submit" class="sidebar-btnContent">Back</button></a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

<script>
  function updateTaripaTable(routeArea) {
    if (!routeArea) {
      $("#taripaTableContainer").empty();
      return;
    }

    $.ajax({
      url: "new_tricycle",
      method: "POST",
      data: { route_area: routeArea },
      dataType: "json",
      success: function (response) {
        let tableHtml = '<div id="taripaTableContainer" class="content-container mt-2 p-3">';
        tableHtml += '<h6>' + routeArea + ' Taripa</h6>';
        tableHtml += '<table class="table table-bordered table-hover text-center" id="systemTable">';
        tableHtml += '<thead><tr><th>Barangay</th><th>Regular Rate</th><th>Discounted Rate</th></tr></thead><tbody>';

        // Loop through the taripa data to generate table rows
        for (let i = 0; i < response.length; i++) {
          tableHtml += '<tr><td>' + response[i].barangay + '</td><td>' + response[i].regular_rate + '</td><td>' + response[i].discounted_rate + '</td></tr>';
        }

        tableHtml += '</tbody></table>';
        tableHtml += '</div>';

        $("#taripaTableContainer").html(tableHtml);
      },
      error: function () {
        alert("Failed to fetch taripa data. Please try again.");
      },
    });
  }

 $(document).ready(function () {
    $("#route_area").change(function () {
      let selectedRouteArea = $(this).val();
      updateTaripaTable(selectedRouteArea);
    });
  });
</script>