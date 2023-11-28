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
              <form class="default-form" method="POST" action="" id="appointmentForm">
                <div class="content-container mt-2 mb-3">
                  <div class="bckgrnd pt-2">
                    <h6 class="text-uppercase text-center text-light fs-6 bckgrnd">Appointment Information</h6>
                  </div>
                  <div class="row px-3 p-4">
                    <div class="col-12 d-flex justify-content-between px-4 mb-2">
                      <div>
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>
                      </div>
                      <div>
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <div class="input-group">
                          <span class="input-group-text">+63</span>
                          <input type="text" class="form-control phone-no" id="phone_number" name="phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['phone_number']) ? $_POST['phone_number'] : ''; ?>" required>
                        </div>
                      </div>
                      <div>
                        <label for="email" class="form-label">Email (Optional)</label>
                        <div class="input-group">
                          <input type="email" class="form-control phone-no" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-12 d-flex justify-content-between px-4">
                      <div>
                        <label for="appointment_type" class="form-label">Appointment Type</label>
                        <select class="form-control" id="appointment_type" name="appointment_type" required>
                          <option value="" selected disabled>Select Appointment Type</option>
                          <option value="Transfer of Ownership" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'Transfer of Ownership') ? 'selected' : ''; ?>>Transfer of Ownership</option>
                          <option value="New Applicant" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'New Applicant') ? 'selected' : ''; ?>>New Applicant</option>
                          <option value="New Franchise" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'New Franchise') ? 'selected' : ''; ?>>New Franchise</option>
                          <option value="Renewal of Franchise" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'Renewal of Franchise') ? 'selected' : ''; ?>>Renewal of Franchise</option>
                          <option value="Change of Motorcycle" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'Change of Motorcycle') ? 'selected' : ''; ?>>Change of Motorcycle</option>
                        </select>
                      </div>
                      <div>
                        <label for="appointment_date" class="form-label">Preferred Date</label>
                        <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="<?php echo isset($_POST['appointment_date']) ? $_POST['appointment_date'] : ''; ?>" required>
                      </div>
                      <div>
                        <label for="appointment_time" class="form-label">Preferred Time</label>
                        <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="<?php echo isset($_POST['appointment_time']) ? $_POST['appointment_time'] : ''; ?>" required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="content-container mt-2">
                  <div class="bckgrnd pt-2">
                    <h6 class="text-uppercase text-center text-light fs-6 bckgrnd">Tricycle Application Form</h6>
                  </div>
                  <div class="row px-3 p-4">
                    <div class="col-12 d-flex justify-content-between px-4 mb-2">
                      <div>
                        <label for="operator_name" class="form-label">Name of Operator</label>
                        <input type="text" class="form-control" id="operator_name" name="operator_name" value="<?php echo isset($_POST['operator_name']) ? $_POST['operator_name'] : ''; ?>" required>
                      </div>
                      <div>
                        <label for="tricycle_phone_number" class="form-label">Phone Number</label>
                        <div class="input-group">
                          <span class="input-group-text">+63</span>
                          <input type="text" class="form-control phone-no" id="tricycle_phone_number" name="tricycle_phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['tricycle_phone_number']) ? $_POST['tricycle_phone_number'] : ''; ?>" required>
                        </div>
                      </div>
                      <div>
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>" required>
                      </div>
                    </div>

                    <div class="col-12 d-flex justify-content-between px-4 mb-2">
                      <div>
                        <label for="mtop_no" class="form-label">MTOP Number</label>
                        <input type="text" class="form-control" id="mtop_no" name="mtop_no" value="<?php echo isset($_POST['mtop_no']) ? $_POST['mtop_no'] : ''; ?>" min="0" required>
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
                      <div>
                        <label for="route_area" class="form-label">Route Area</label>
                        <input type="text" class="form-control" id="route_area" name="route_area" placeholder="Select Color Code First" readonly required data-toggle="tooltip" data-bs-placement="right" title="Please choose a Color Code to determine the Route Area for the tricycle." value="<?php echo isset($_POST['route_area']) ? $_POST['route_area'] : ''; ?>">
                      </div>
                    </div>

                    <div class="col-12 d-flex justify-content-between px-4 mb-5">
                      <div>
                        <label for="make_model" class="form-label">Make Model</label>
                        <input type="text" class="form-control" id="make_model" name="make_model" value="<?php echo isset($_POST['make_model']) ? $_POST['make_model'] : ''; ?>" required>
                      </div>
                      <div>
                        <label for="make_model_expiry_date" class="form-label">Model Expiry Date</label>
                        <input type="date" class="form-control" id="make_model_expiry_date" name="make_model_expiry_date" value="<?php echo isset($_POST['make_model_expiry_date']) ? $_POST['make_model_expiry_date'] : ''; ?>" required>
                      </div>
                    </div>

                    <div class="col-12 d-flex justify-content-between px-4 mb-2">
                      <div>
                        <label for="motor_number" class="form-label">Motor Number</label>
                        <input type="text" class="form-control" id="motor_number" name="motor_number" value="<?php echo isset($_POST['motor_number']) ? $_POST['motor_number'] : ''; ?>" min="0" required>
                      </div>
                      <div>
                        <label for="insurer" class="form-label">Insurer</label>
                        <input type="text" class="form-control" id="insurer" name="insurer" value="<?php echo isset($_POST['insurer']) ? $_POST['insurer'] : ''; ?>" required>
                      </div>
                      <div>
                        <label for="chasis_number" class="form-label">Chasis Number</label>
                        <input type="text" class="form-control" id="chasis_number" name="chasis_number" value="<?php echo isset($_POST['chasis_number']) ? $_POST['chasis_number'] : ''; ?>" min="0" required>
                      </div>
                    </div>

                    <div class="col-12 d-flex justify-content-between px-4 mb-5">
                      <div>
                        <label for="coc_no" class="form-label">C.O.C Number</label>
                        <input type="text" class="form-control" id="coc_no" name="coc_no" value="<?php echo isset($_POST['coc_no']) ? $_POST['coc_no'] : ''; ?>" min="0" required>
                      </div>
                      <div>
                        <label for="coc_no_expiry_date" class="form-label">C.O.C Expiry Date</label>
                        <input type="date" class="form-control" id="coc_no_expiry_date" name="coc_no_expiry_date" value="<?php echo isset($_POST['coc_no_expiry_date']) ? $_POST['coc_no_expiry_date'] : ''; ?>" required>
                      </div>
                    </div>

                    <div class="col-12 d-flex justify-content-between px-4 mb-2">
                      <div>
                        <label for="plate_number" class="form-label">Plate Number</label>
                        <input type="text" class="form-control" id="plate_number" name="plate_number" value="<?php echo isset($_POST['plate_number']) ? $_POST['plate_number'] : ''; ?>" min="0" required>
                      </div>
                      <div>
                        <label for="lto_cr_no" class="form-label">LTO CR Number</label>
                        <input type="text" class="form-control" id="lto_cr_no" name="lto_cr_no" value="<?php echo isset($_POST['lto_cr_no']) ? $_POST['lto_cr_no'] : ''; ?>" required>
                      </div>
                      <div>
                        <label for="lto_or_no" class="form-label">LTO OR Number</label>
                        <input type="text" class="form-control" id="lto_or_no" name="lto_or_no" value="<?php echo isset($_POST['lto_or_no']) ? $_POST['lto_or_no'] : ''; ?>" required>
                      </div>
                    </div>

                    <div class="col-12 d-flex justify-content-between px-4 mb-2">
                      <div>
                        <label for="driver_id" class="form-label">Name of Driver</label>
                        <select class="form-control" id="driver_id" name="driver_id">
                          <option value="" disabled <?php echo (!isset($_POST['driver_id'])) ? 'selected' : ''; ?>>Please Select Here</option>
                          <?php foreach ($data['drivers'] as $driver): ?>
                            <option value="<?php echo $driver['driver_id']; ?>" <?php echo (isset($_POST['driver_id']) && $_POST['driver_id'] == $driver['driver_id']) ? 'selected' : ''; ?>>
                              <?php echo $driver['name']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div>
                        <label for="driver_license_no" class="form-label">Driver License Number</label>
                        <input type="text" class="form-control" id="driver_license_no" name="driver_license_no" value="<?php echo isset($_POST['driver_license_no']) ? $_POST['driver_license_no'] : ''; ?>">
                      </div>
                      <div>
                        <label for="driver_license_expiry_date" class="form-label">License Expiry Date</label>
                        <input type="date" class="form-control" id="driver_license_expiry_date" name="driver_license_expiry_date" value="<?php echo isset($_POST['driver_license_expiry_date']) ? $_POST['driver_license_expiry_date'] : ''; ?>">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="text-end my-3">
                  <button type="submit" class="sidebar-btnContent" name="schedule_appointment" id="scheduleAppointmentBtn">Schedule Appointment</button>
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