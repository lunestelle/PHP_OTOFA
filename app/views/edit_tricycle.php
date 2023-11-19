<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 title-head text-uppercase">
      <h6 class="add newColor">Edit Tricycle</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12 pt-2">
          <form method="POST" action="update_tricycle.php">
            <div id="newTricycleForm">
              <div class="content-container mt-2 p-3">
                <h6 class="pl-2">MOTOR UNIT</h6>
                <div class="row px-3">
                  <div class="col-12 d-flex justify-content-between">
                    <div>
                      <p class="form-label">Model</p>
                      <input type="text" name="make_model" class="form-control" value="<?php echo $make_model; ?>">
                    </div>
                    <div>
                      <p for="year_acquired" class="form-label">Year Acquired</p>
                      <input type="text" name="year_acquired" class="form-control" value="<?php echo $year_acquired; ?>">
                    </div>
                    <div>
                      <p for="color_code" class="form-label">Color Code</p>
                      <input type="text" name="color_code" class="form-control" value="<?php echo $color_code; ?>">
                    </div>
                  </div>

                  <div class="col-12 d-flex justify-content-between">
                    <div>
                      <p class="form-label">Route Area</p>
                      <input type="text" name="route_area" class="form-control" value="<?php echo $route_area; ?>">
                    </div>
                    <div>
                      <p class="form-label">Plate No.</p>
                      <input type="text" name="plate_no" class="form-control" value="<?php echo $plate_no; ?>">
                    </div>
                    <div>
                      <p class="form-label">Driver's Name</p>
                      <input type="text" name="driver_name" class="form-control" value="<?php echo $driver_name; ?>">
                    </div>
                  </div>

                  <div class="col-12 d-flex justify-content-between pt-3">
                    <div>
                      <p class="form-label">OR No.</p>
                      <input type="text" name="or_no" class="form-control" value="<?php echo $or_no; ?>">
                    </div>
                    <div>
                      <p for="or_date" class="form-label">OR Date</p>
                      <input type="text" name="or_date" class="form-control" value="<?php echo $or_date; ?>">
                    </div>
                    <div>
                      <p for="tricycle_status" class="form-label">Tricycle Status</p>
                      <input type="text" name="tricycle_status" class="form-control" value="<?php echo $tricycle_status; ?>">
                    </div>
                  </div>
                </div>
              </div>

              <div class="content-container mt-2 p-3">
                <h6 class="pl-2 pt-3">TRICYCLE IMAGES</h6>
                <div class="row px-3">
                  <div class="col-8 d-flex justify-content-between">
                    <div>
                      <p class="form-label">Tricycle Front View</p>
                      <?php
                      if (isset($front_view_image) && $front_view_image) {
                        echo '<div class="image-container">';
                        echo '<img src="' . $front_view_image->file_path . '" id="front_view_image" alt="Tricycle Front View">';
                        echo '<button class="remove-image-btn" onclick="removeImage(\'front_view_image\')">X</button>';
                        echo '</div>';
                      } else {
                        echo '<p class="form-label">Front view image not available</p>';
                        echo '<input type="file" name="front_view_image" accept="image/*">';
                      }
                      ?>
                    </div>

                    <div>
                      <p class="form-label">Tricycle Back View</p>
                      <?php
                      if (isset($back_view_image) && $back_view_image) {
                        echo '<div class="image-container">';
                        echo '<img src="' . $back_view_image->file_path . '" id="back_view_image" alt="Tricycle Back View" class="tricycle_image">';
                        echo '<button class="remove-image-btn" onclick="removeImage(\'back_view_image\')">X</button>';
                        echo '</div>';
                      } else {
                        echo '<p class="form-label">Back view image not available</p>';
                      }
                      ?>
                    </div>

                    <div>
                      <p class="form-label">Tricycle Side View</p>
                      <?php
                      if (isset($side_view_image) && $side_view_image) {
                        echo '<div class="image-container">';
                        echo '<img src="' . $side_view_image->file_path . '" id="side_view_image" alt="Tricycle Side View">';
                        echo '<button class="remove-image-btn" onclick="removeImage(\'side_view_image\')">X</button>';
                        echo '</div>';
                      } else {
                        echo '<p class="form-label">Tricycle side view image not available</p>';
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <div id="taripaTableContainer">
                  <!-- show here the taripa of the selected route area -->
                </div>
              </div>

              <div class="text-end my-3">
                <button type="submit" class="sidebar-btnContent" name="update">Update</button>
                <a href="./tricycles" class="cancel-btn">Cancel</a>
              </div>
            </div>
          </form>
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

  function removeImage(imageId) {
    // You can add an AJAX call here to remove the image from the server if needed.
    // For simplicity, let's just remove the image from the DOM in this example.
    $("#" + imageId).parent(".image-container").remove();
  }
</script>