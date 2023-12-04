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
                    <h6 class="text-uppercase text-center text-light fs-6">Appointment Information</h6>
                  </div>
                  <div class="row px-3 p-4">
                    <div class="col-12 d-flex mb-1">
                      <div class="col-4 px-5">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <div class="input-group">
                          <span class="input-group-text">+63</span>
                          <input type="text" class="form-control phone-no" id="phone_number" name="phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['phone_number']) ? $_POST['phone_number'] : ''; ?>" required>
                        </div>
                      </div>
                      <div class="col-4 px-5">
                        <label for="email" class="form-label">Email (Optional)</label>
                        <div class="input-group">
                          <input type="email" class="form-control phone-no text-lowercase" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-12 d-flex mb-1">
                      <div class="col-4 px-5">
                        <label for="appointment_type" class="form-label">Appointment Type</label>
                        <select class="form-control" id="appointment_type" name="appointment_type" required>
                          <option value="" selected disabled>Select Appointment Type</option>
                          <option value="New Franchise" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'New Franchise') ? 'selected' : ''; ?>>New Franchise</option>
                          <option value="Renewal of Franchise" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'Renewal of Franchise') ? 'selected' : ''; ?>>Renewal of Franchise</option>
                          <option value="Transfer of Ownership" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'Transfer of Ownership') ? 'selected' : ''; ?>>Transfer of Ownership</option>
                          <option value="Change of Motorcycle" <?php echo (isset($_POST['appointment_type']) && $_POST['appointment_type'] === 'Change of Motorcycle') ? 'selected' : ''; ?>>Change of Motorcycle</option>
                        </select>
                      </div>
                      <div class="col-4 px-5">
                        <label for="appointment_date" class="form-label">Preferred Date</label>
                        <input type="date" class="form-control text-uppercase" id="appointment_date" name="appointment_date" value="<?php echo isset($_POST['appointment_date']) ? $_POST['appointment_date'] : ''; ?>" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="appointment_time" class="form-label">Preferred Time</label>
                        <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="<?php echo isset($_POST['appointment_time']) ? $_POST['appointment_time'] : ''; ?>" required>
                      </div>
                    </div>
                    <div class="col-12 d-flex">
                      <div class="col-4 px-5" id="transferTypeSection" style="display: none;">
                        <label for="transferType" class="form-label">Transfer Type (if applicable):</label>
                        <select id="transferType" name="transferType" class="form-control">
                          <option value="normal">Normal Transfer</option>
                          <option value="deceased_owner">Transfer from Deceased Owner</option>
                          <option value="intent_of_transfer">Intent of Transfer</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="content-container mt-2 mb-3">
                  <div class="bckgrnd pt-2">
                    <h6 class="text-uppercase text-center text-light fs-6">Tricycle Application Form</h6>
                  </div>
                  <div class="row px-3 p-4">
                    <div class="col-12 d-flex mb-2">
                      <div class="col-4 px-5">
                        <label for="operator_name" class="form-label">Name of Operator</label>
                        <input type="text" class="form-control" id="operator_name" name="operator_name" value="<?php echo isset($_POST['operator_name']) ? $_POST['operator_name'] : ''; ?>" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="tricycle_phone_number" class="form-label">Phone Number</label>
                        <div class="input-group">
                          <span class="input-group-text">+63</span>
                          <input type="text" class="form-control phone-no" id="tricycle_phone_number" name="tricycle_phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['tricycle_phone_number']) ? $_POST['tricycle_phone_number'] : ''; ?>" required>
                        </div>
                      </div>
                      <div class="col-4 px-5">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>" required>
                      </div>
                    </div>

                    <div class="col-12 d-flex mb-2">
                      <div class="col-4 px-5">
                        <label for="mtop_no" class="form-label">MTOP Number</label>
                        <input type="text" class="form-control" id="mtop_no" name="mtop_no" value="<?php echo isset($_POST['mtop_no']) ? $_POST['mtop_no'] : ''; ?>" min="0" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="color_code" class="form-label">Color Code</label>
                        <select class="form-control" id="color_code" name="color_code" required>
                          <option selected disabled>Please Select Here</option>
                          <option value="Red" data-route-area="Free Zone / Zone 1" <?php echo (isset($_POST['color_code']) && $_POST['color_code'] == 'Red' ? 'selected' : ''); ?>>Red</option>
                          <option value="Blue" data-route-area="Free Zone & Zone 2" <?php echo (isset($_POST['color_code']) && $_POST['color_code'] == 'Blue' ? 'selected' : ''); ?>>Blue</option>
                          <option value="Yellow" data-route-area="Free Zone & Zone 3" <?php echo (isset($_POST['color_code']) && $_POST['color_code'] == 'Yellow' ? 'selected' : ''); ?>>Yellow</option>
                          <option value="Green" data-route-area="Free Zone & Zone 4" <?php echo (isset($_POST['color_code']) && $_POST['color_code'] == 'Green' ? 'selected' : ''); ?>>Green</option>
                        </select>
                      </div>
                      <div class="col-4 px-5">
                        <label for="route_area" class="form-label">Route Area</label>
                        <input type="text" class="form-control" id="route_area" name="route_area" placeholder="Select Color Code First" readonly required data-toggle="tooltip" data-bs-placement="right" title="Please choose a Color Code to determine the Route Area for the tricycle." value="<?php echo isset($_POST['route_area']) ? $_POST['route_area'] : ''; ?>">
                      </div>
                    </div>

                    <div class="col-12 d-flex mb-5">
                      <div class="col-4 px-5">
                        <label for="make_model" class="form-label">Make Model</label>
                        <input type="text" class="form-control" id="make_model" name="make_model" value="<?php echo isset($_POST['make_model']) ? $_POST['make_model'] : ''; ?>" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="make_model_expiry_date" class="form-label">Model Expiry Date</label>
                        <input type="date" class="form-control text-uppercase" id="make_model_expiry_date" name="make_model_expiry_date" value="<?php echo isset($_POST['make_model_expiry_date']) ? $_POST['make_model_expiry_date'] : ''; ?>" required>
                      </div>
                    </div>

                    <div class="col-12 d-flex mb-2">
                      <div class="col-4 px-5">
                        <label for="motor_number" class="form-label">Motor Number</label>
                        <input type="text" class="form-control" id="motor_number" name="motor_number" value="<?php echo isset($_POST['motor_number']) ? $_POST['motor_number'] : ''; ?>" min="0" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="insurer" class="form-label">Insurer</label>
                        <input type="text" class="form-control" id="insurer" name="insurer" value="<?php echo isset($_POST['insurer']) ? $_POST['insurer'] : ''; ?>" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="chasis_number" class="form-label">Chasis Number</label>
                        <input type="text" class="form-control" id="chasis_number" name="chasis_number" value="<?php echo isset($_POST['chasis_number']) ? $_POST['chasis_number'] : ''; ?>" min="0" required>
                      </div>
                    </div>

                    <div class="col-12 d-flex mb-5">
                      <div class="col-4 px-5">
                        <label for="coc_no" class="form-label">C.O.C Number</label>
                        <input type="text" class="form-control" id="coc_no" name="coc_no" value="<?php echo isset($_POST['coc_no']) ? $_POST['coc_no'] : ''; ?>" min="0" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="coc_no_expiry_date" class="form-label">C.O.C Expiry Date</label>
                        <input type="date" class="form-control text-uppercase" id="coc_no_expiry_date" name="coc_no_expiry_date" value="<?php echo isset($_POST['coc_no_expiry_date']) ? $_POST['coc_no_expiry_date'] : ''; ?>" required>
                      </div>
                    </div>

                    <div class="col-12 d-flex mb-2">
                      <?php if (!empty($tricycles)): ?>
                        <div class="col-4 px-5">
                          <label for="tricycle_id" class="form-label">Tricycle CIN</label>
                          <select class="form-control" id="tricycle_id" name="tricycle_id">
                            <option <?php echo (!isset($_POST['tricycle_id'])) ? 'selected' : ''; ?> disabled>Please Select Here</option>
                            <?php foreach ($tricycles as $tricycle): ?>
                              <option value="<?php echo $tricycle['tricycle_id']; ?>" <?php echo (isset($_POST['tricycle_id']) && $_POST['tricycle_id'] == $tricycle['tricycle_id']) ? 'selected' : ''; ?>>
                                <?php echo $tricycle['plate_no']; ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-4 px-5">
                          <label for="lto_cr_no" class="form-label">LTO CR Number</label>
                          <input type="text" class="form-control" id="lto_cr_no" name="lto_cr_no" value="<?php echo isset($_POST['lto_cr_no']) ? $_POST['lto_cr_no'] : ''; ?>" required>
                        </div>
                        <div class="col-4 px-5">
                          <label for="lto_or_no" class="form-label">LTO OR Number</label>
                          <input type="text" class="form-control" id="lto_or_no" name="lto_or_no" value="<?php echo isset($_POST['lto_or_no']) ? $_POST['lto_or_no'] : ''; ?>" required>
                        </div>
                      <?php else: ?>
                        <div class="col-4 px-5">
                          <label for="tricycle_id" class="form-label">Tricycle CIN</label>
                          <input type="text" class="form-control" id="tricycle_id" name="tricycle_id" value="<?php echo isset($_POST['tricycle_id']) ? $_POST['tricycle_id'] : ''; ?>" min="0" disabled>
                        </div>
                        <div class="col-4 px-5">
                          <label for="lto_cr_no" class="form-label">LTO CR Number</label>
                          <input type="text" class="form-control" id="lto_cr_no" name="lto_cr_no" value="<?php echo isset($_POST['lto_cr_no']) ? $_POST['lto_cr_no'] : ''; ?>" disabled>
                        </div>
                        <div class="col-4 px-5">
                          <label for="lto_or_no" class="form-label">LTO OR Number</label>
                          <input type="text" class="form-control" id="lto_or_no" name="lto_or_no" value="<?php echo isset($_POST['lto_or_no']) ? $_POST['lto_or_no'] : ''; ?>" disabled>
                        </div>
                      <?php endif; ?>
                    </div>

                    <div class="col-12 d-flex mb-2">
                      <?php if (!empty($tricycles)): ?>
                        <div class="col-4 px-5">
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
                        <div class="col-4 px-5">
                          <label for="driver_license_no" class="form-label">Driver License Number</label>
                          <input type="text" class="form-control" id="driver_license_no" name="driver_license_no" value="<?php echo isset($_POST['driver_license_no']) ? $_POST['driver_license_no'] : ''; ?>">
                        </div>
                        <div class="col-4 px-5">
                          <label for="driver_license_expiry_date" class="form-label">License Expiry Date</label>
                          <input type="date" class="form-control text-uppercase" id="driver_license_expiry_date" name="driver_license_expiry_date" value="<?php echo isset($_POST['driver_license_expiry_date']) ? $_POST['driver_license_expiry_date'] : ''; ?>">
                        </div>
                      <?php else: ?>
                        <div class="col-4 px-5">
                          <label for="driver_id" class="form-label">Name of Driver</label>
                          <input type="text" class="form-control" id="driver_id" name="driver_id" value="<?php echo isset($_POST['driver_id']) ? $_POST['driver_id'] : ''; ?>" disabled>
                        </div>
                        <div class="col-4 px-5">
                          <label for="driver_license_no" class="form-label">Driver License Number</label>
                          <input type="text" class="form-control" id="driver_license_no" name="driver_license_no" value="<?php echo isset($_POST['driver_license_no']) ? $_POST['driver_license_no'] : ''; ?>" disabled>
                        </div>
                        <div class="col-4 px-5">
                          <label for="driver_license_expiry_date" class="form-label">License Expiry Date</label>
                          <input type="date" class="form-control text-uppercase" id="driver_license_expiry_date" name="driver_license_expiry_date" value="<?php echo isset($_POST['driver_license_expiry_date']) ? $_POST['driver_license_expiry_date'] : ''; ?>" disabled>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>

                <div id="newFranchiseFormContainer" class="form-container">
                  <?php include('app/views/appointments_form/new_franchise.php'); ?>
                </div>
                <div id="renewalOfFranchiseFormContainer" class="form-container">
                  <?php include('app/views/appointments_form/renewal_of_franchise.php'); ?>
                </div>
                <div id="transferOfOwnershipFormContainer" class="form-container">
                  <?php include('app/views/appointments_form/transfer_of_ownership.php'); ?>
                </div>
                <div id="changeOfMotorcycleFormContainer" class="form-container">
                  <?php include('app/views/appointments_form/change_of_motorcycle.php'); ?>
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

  $(document).ready(function() {
    // Initial form visibility based on selected appointment type
    showHideForms();

    // Handle appointment type change
    $('#appointment_type').change(function() {
      showHideForms();
    });

    $('#transferType').change(function() {
      showHideForms();
    });

    // Handle form submission
    $('#appointmentForm').submit(function(e) {
      // Submit only the visible form
      var visibleForm = $('#appointmentForm .form-container:visible form');
      visibleForm.submit();
    });

    // Function to show/hide forms based on appointment type
    function showHideForms() {
      var selectedAppointmentType = $('#appointment_type').val();
      var selectedTransferType = $('#transferType').val();
      
      $('#appointmentForm .form-container').hide();
      $('#appointmentForm .form-container, #deceasedOwnerSection, #intentOfTransferSection').hide();

      // Show the form container based on the selected appointment type
      if (selectedAppointmentType === 'New Franchise') {
        $('#newFranchiseFormContainer').show();
      } else if (selectedAppointmentType === 'Renewal of Franchise') {
        $('#renewalOfFranchiseFormContainer').show();
      } else if (selectedAppointmentType === 'Transfer of Ownership') {
        $('#transferOfOwnershipFormContainer').show();
        $('#transferTypeSection').show();
        if (selectedTransferType === 'deceased_owner') {
          $('#deceasedOwnerSection').show();
        } else if (selectedTransferType === 'intent_of_transfer') {
          $('#intentOfTransferSection').show();
        }
      } else if (selectedAppointmentType === 'Change of Motorcycle') {
        $('#changeOfMotorcycleFormContainer').show();
      }
    }
  });
</script>
