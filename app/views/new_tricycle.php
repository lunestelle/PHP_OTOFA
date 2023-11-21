<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Add new tricycle</h6>
    </div>
    <div class="col-lg-12 mt-4">
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
                        <option value="Other" <?php echo isset($_POST['make_model']) && $_POST['make_model'] === 'Other' ? 'selected' : ''; ?>>Others</option>
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
                        <option value="Red" data-route-area="Free Zone / Zone 1">Red</option>
                        <option value="Green" data-route-area="Free Zone & Zone 2">Green</option>
                        <option value="Yellow" data-route-area="Free Zone & Zone 3">Yellow</option>
                        <option value="Blue" data-route-area="Free Zone & Zone 4">Blue</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-12 d-flex justify-content-between">
                    <div>
                      <label for="route_area" class="form-label">Route Area</label>
                      <input type="text" class="form-control" id="route_area" name="route_area" placeholder="Please select a color code" readonly required>
                    </div>
                    <div>
                      <label for="plate_no" class="form-label">Plate No.</label>
                      <input type="text" class="form-control" id="plate_no" name="plate_no" value="<?php echo isset($_POST['plate_no']) ? $_POST['plate_no'] : ''; ?>" required>
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
                  <div class="col-12 d-flex justify-content-between pt-3">
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
                      <select class="form-control" id="tricycle_status" name="tricycle_status" readonly>
                        <option value="Registration Pending" selected>Registration Pending</option>
                        <option value="Available">Available</option>
                        <option value="Renewal Required">Renewal Requi red</option>
                        <option value="Sold">Sold</option>
                        <option value="Under Maintenance">Under Maintenance</option>
                      </select>
                    </div>
                  </div>
                </div>

                <h6 class="pl-2 pt-3">DOCUMENTS</h6>
                <div class="row px-3">
                  <div class="col-8 d-flex justify-content-between">
                    <div>
                      <label for="tricycle_operator_permit" class="form-label">Tricycle Operator Permit</label>
                      <input type="file" class="form-control" id="tricycle_operator_permit" name="tricycle_operator_permit" required>
                    </div>

                    <div>
                      <label for="tricycle_images" class="form-label">Tricycle Images (Front, Back, & Sides)</label>
                      <input type="file" class="form-control" id="tricycle_images" name="tricycle_images" required multiple>
                    </div>
                  </div>
                </div>

                <div class="row px-3 pt-4">
                  <div class="col-8 d-flex justify-content-between">
                    <div>
                      <label for="certificate_of_registration" class="form-label">Certificate of Registration (CR)</label>
                      <input type="file" class="form-control" id="certificate_of_registration" name="certificate_of_registration" required>
                    </div> 

                    <div>
                      <label for="official_receipt" class="form-label">Official Receipt (OR)</label>
                      <input type="file" class="form-control" id="official_receipt" name="official_receipt" required>
                    </div>
                  </div>
                </div>
              </div>

              <div id="taripaTableContainer" >
                <!-- show here the taripa of the selected route area -->
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
        tableHtml += '<h6 class="text-center m-2">Tricycle Taripa for ' + routeArea + '</h6>';
        tableHtml += '<table class="table-bordered table-hover text-center" id="systemTable">';
        tableHtml += '<thead><tr><th class="text-white text-center" style="background-color:#090C1B !important;">Barangay</th><th class="text-white text-center" style="background-color:#090C1B !important;">Regular Rate</th><th class="text-white text-center" style="background-color:#090C1B !important;">Student Rate</th><th class="text-white text-center" style="background-color:#090C1B !important;">Senior Citizen & PWD Rate</th></tr></thead><tbody>';

        // Loop through the taripa data to generate table rows
        for (let i = 0; i < response.length; i++) {
          const regularRate = '₱' + parseFloat(response[i].regular_rate).toFixed(2);
          const studentRate = '₱' + parseFloat(response[i].student_rate).toFixed(2);
          const seniorPwdRate = '₱' + parseFloat(response[i].senior_and_pwd_rate).toFixed(2);
          
          tableHtml += '<tr><td>' + response[i].barangay + '</td><td>' + regularRate + '</td><td>' + studentRate + '</td><td>' + seniorPwdRate + '</td></tr>';
        }

        tableHtml += '</tbody></table>';
        tableHtml += '</div>';

        $("#taripaTableContainer").html(tableHtml);
        $('#systemTable').DataTable();
      },
      error: function () {
        alert("Failed to fetch taripa data. Please try again.");
      },
    });
  }

  $(document).ready(function () {
    $("#make_model").change(function () {
      const selectedModel = $(this).val();
      if (selectedModel === "Other") {
        const inputElement = '<input type="text" class="form-control" id="make_model" name="make_model" required>';
        $(this).replaceWith(inputElement);
      }
    });

    $("#color_code").change(function () {
      let selectedColorCode = $(this).val();
      let selectedRouteArea = $("#color_code").find(":selected").data("route-area");
      $("#route_area").val(selectedRouteArea);
      updateTaripaTable(selectedRouteArea);
    });
  });
</script>