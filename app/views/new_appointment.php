<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top" id="mainAppointmentForm">
      <h6 class="title-head">Schedule New Appointment</h6>
    </div>
    <div class="col-lg-12 mt-2">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-3">
            <div id="newAppointmentForm">
              <form class="default-form" method="POST" action="" enctype="multipart/form-data" id="appointmentForm">
                <div class="content-container mt-2 mb-3">
                  <div class="bckgrnd pt-2">
                    <h6 class="text-uppercase text-center text-light fs-6">Select Appointment Type</h6>
                  </div>
                  <div class="row px-3 p-4">
                    <div class="col-12 d-flex mb-1 px-5 py-3">
                      <div class="col-12 px-5">
                        <label for="appointment_type" class="form-label">Appointment Type</label>
                        <select class="form-control" id="appointment_type" name="appointment_type" required>
                          <option value="" selected disabled>Select Appointment Type</option>
                          <option value="New Franchise" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'New Franchise') ? 'selected' : ''; ?>>New Franchise</option>
                          <option value="Renewal of Franchise" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'Renewal of Franchise') ? 'selected' : ''; ?>>Renewal of Franchise</option>
                          <option value="Transfer of Ownership" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'Transfer of Ownership') ? 'selected' : ''; ?>>Transfer of Ownership</option>
                          <option value="Change of Motorcycle" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'Change of Motorcycle') ? 'selected' : ''; ?>>Change of Motorcycle</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="content-container mt-2 mb-3">
                  <div class="bckgrnd pt-2">
                    <h6 class="text-uppercase text-center text-light fs-6">Select Appointment Type</h6>
                  </div>
                  <div class="row px-3 p-4">
                    <div class="col-12 d-flex mb- py-3">
                      <div class="col-12 px-5">
                        <div class="d-flex gap-5 text-center">
                          <div class="row-1">
                            <div class="new-appointment-selection rounded-3 mb-4">
                              New Franchise
                            </div>
                            <div class="new-appointment-selection rounded-3">
                              Renewal of Franchise
                            </div>
                          </div>
                          <div class="row-2">
                            <div class="new-appointment-selection rounded-3 mb-4">
                              Change of Motorcycle
                            </div>
                            <div class="new-appointment-selection rounded-3">
                              Transfer of Ownership
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="text-end my-3">
                  <button type="submit" class="sidebar-btnContent" name="schedule_appointment" id="scheduleAppointmentBtn">Save</button>
                </div>
              </form>
            </div>
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
    });

    let errorMessage = $(".flash-message.error");
    if (errorMessage.length > 0) {
      document.getElementById("mainAppointmentForm").scrollIntoView({
        behavior: "smooth",
        block: "start"
      });
    }
  });
</script>