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
                <h6 class="pl-2 text-uppercase text-center text-light fs-6 bckgrnd">Motor Unit</h6>
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
                    <p class="form-label">Plate No.</p>
                    <div class="form-control">
                      <?php echo isset($plate_no) ? $plate_no : ''; ?>
                    </div>
                  </div>
                  <div>
                    <p class="form-label">Driver's Name</p>
                    <div class="form-control">
                      <?php echo isset($driver_name) ? $driver_name : ''; ?>
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
            <div class="content-container mt-3">
              <div class="bckgrnd pt-2">
                <h6 class="pl-2 text-uppercase text-center text-light fs-6 bckgrnd">Tricycle images</h6>
              </div>
              <div class="row px-3 p-3">
                <div class="col-8 d-flex justify-content-between">
                  <div>
                    <p class="form-label">Tricycle Front View</p>
                    <?php
                    if (isset($front_view_image) && $front_view_image) {
                      echo '<img src="' . $front_view_image->file_path . '" id="front_view_image" alt="Tricycle Front View">';
                    } else {
                      echo '<p class="form-label">Front view image not available</p>';
                    }
                    ?>
                  </div>
                  <div>
                    <p class="form-label">Tricycle Back View</p>
                    <?php
                      if (isset($back_view_image) && $back_view_image) {
                        echo '<img src="' . $back_view_image->file_path . '" id="back_view_image" alt="Tricycle Back View" class="tricycle_image">';
                      } else {
                        echo '<p class="form-label">Back view image not available</p>';
                      }
                    ?>
                  </div>
                  <div>
                    <p class="form-label">Tricycle Side View</p>
                    <?php
                      if (isset($side_view_image) && $side_view_image) {
                        echo '<img src="' . $side_view_image->file_path . '" id="side_view_image" alt="Tricycle Side View">';
                      } else {
                        echo '<p class="form-label">Tricycle side view image not available</p>';
                      }
                    ?>
                  </div>
                </div>
              </div>
              <div id="taripaTableContainer" >
                <!-- show here the taripa of the selected route area -->
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