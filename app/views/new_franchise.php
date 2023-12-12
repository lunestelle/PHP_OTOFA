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
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $fullName; ?>" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <div class="input-group">
                          <span class="input-group-text">+63</span>
                          <input type="text" class="form-control phone-no" id="phone_number" name="phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['phone_number']) ? $_POST['phone_number'] : $userPhoneNo; ?>" required>
                        </div>
                      </div>
                      <div class="col-4 px-5">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                          <input type="email" class="form-control phone-no text-lowercase" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $userEmail; ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 d-flex mb-1">
                      <div class="col-4 px-5">
                        <label for="appointment_type" class="form-label">Appointment Type</label>
                        <div class="input-group">
                          <input type="text" class="form-control" style="cursor: pointer;" id="appointment_type" name="appointment_type" value="New Franchise" data-toggle="tooltip" data-bs-placement="top" title="Default appointment type. This field is read-only." readonly>
                          <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                            <i class="fa-solid fa-info-circle"></i>
                          </span>
                        </div>
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
                        <input type="text" class="form-control" id="operator_name" name="operator_name" value="<?php echo isset($_POST['operator_name']) ? $_POST['operator_name'] : $fullName; ?>" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="tricycle_phone_number" class="form-label">Phone Number</label>
                        <div class="input-group">
                          <span class="input-group-text">+63</span>
                          <input type="text" class="form-control phone-no" id="tricycle_phone_number" name="tricycle_phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['tricycle_phone_number']) ? $_POST['tricycle_phone_number'] : $userPhoneNo; ?>" required>
                        </div>
                      </div>
                      <div class="col-4 px-5">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : $userAddress; ?>" required>
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
                        <div class="input-group">
                          <input type="text" class="form-control" id="route_area" name="route_area" style="cursor:pointer;" placeholder="Select Color Code First" data-toggle="tooltip" data-bs-placement="top" title="Please choose a Color Code to determine the Route Area for the tricycle. This field is read-only." value="<?php echo isset($_POST['route_area']) ? $_POST['route_area'] : ''; ?>" readonly required>
                          <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                            <i class="fa-solid fa-info-circle"></i>
                          </span>
                        </div>
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
                        <label for="coc_no" class="form-label">C.O.C Number</label>
                        <input type="text" class="form-control" id="coc_no" name="coc_no" value="<?php echo isset($_POST['coc_no']) ? $_POST['coc_no'] : ''; ?>" min="0" required>
                      </div>
                    </div>

                    <div class="col-12 d-flex mb-5" id="coc_expiry_field">
                      <div class="col-4 px-5">
                        <label for="coc_no_expiry_date" class="form-label">C.O.C Expiry Date</label>
                        <input type="date" class="form-control text-uppercase" id="coc_no_expiry_date" name="coc_no_expiry_date" value="<?php echo isset($_POST['coc_no_expiry_date']) ? $_POST['coc_no_expiry_date'] : ''; ?>" required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="content-container mt-2 mb-3">
                  <div class="bckgrnd pt-2">
                    <h6 class="text-uppercase text-center text-light fs-6">MTOP Requirements Images</h6>
                  </div>
                  <div class="px-3 pt-2 mt-2">
                    <p class="text-muted fw-bold fst-italic"><span class="text-danger">Note: </span>Please ensure all uploaded images are clear for better processing.</p>
                  </div>
                  <div class="row px-3 p-4">
                    <div class="col-12 d-flex mb-2">
                      <div class="text-center col-4 px-4">
                        <label for="mc_lto_certificate_of_registration" class="form-label appointment-label">LTO Certificate of Registration (MC of New Unit)</label>
                        <input type="file" class="form-control" id="mc_lto_certificate_of_registration" name="mc_lto_certificate_of_registration" accept="image/*" required/>
                      </div>
                      <div class="text-center col-4 px-4">
                        <label for="mc_lto_official_receipt" class="form-label appointment-label">LTO Official Receipt (MC of New Unit)</label>
                        <input type="file" class="form-control" id="mc_lto_official_receipt" name="mc_lto_official_receipt" accept="image/*" required/>
                      </div>
                      <div class="text-center col-4 px-4">
                        <label for="mc_plate_authorization" class="form-label appointment-label">Plate Authorization (MC of New Unit)</label>
                        <input type="file" class="form-control" id="mc_plate_authorization" name="mc_plate_authorization" accept="image/*" required/>
                      </div>
                    </div>
                    <div class="col-12 d-flex mb-2">
                      <div class="text-center col-4 px-4 mt-3">
                        <label for="tc_insurance_policy" class="form-label appointment-label">Insurance Policy (TC) (New Owner)</label>
                        <input type="file" class="form-control" id="tc_insurance_policy" name="tc_insurance_policy" accept="image/*" required/>
                      </div>
                      <div class="text-center col-4 px-4 mt-3">
                        <label for="unit_front_view_image" class="form-label appointment-label">Picture of New Unit (Front View)</label>
                        <input type="file" class="form-control" id="unit_front_view_image" name="unit_front_view_image" accept="image/*" required/>
                      </div>
                      <div class="text-center col-4 px-4 mt-3">
                        <label for="unit_side_view_image" class="form-label appointment-label">Picture of New Unit (Side View)</label>
                        <input type="file" class="form-control" id="unit_side_view_image" name="unit_side_view_image" accept="image/*" required/>
                      </div>
                    </div>
                    <div class="col-12 d-flex mb-2">
                      <div class="text-center col-4 px-4 mt-3 tricycle-fields">
                        <label for="sketch_location_of_garage" class="form-label appointment-label">Sketch Location of Garage</label>
                        <input type="file" class="form-control" id="sketch_location_of_garage" name="sketch_location_of_garage" accept="image/*" required/>
                      </div>
                      <div class="text-center col-4 px-4 mt-3 tricycle-fields">
                        <label for="affidavit_of_income_tax_return" class="form-label appointment-label">Affidavit of No Income or Latest Income Tax Return</label>
                        <input type="file" class="form-control" id="affidavit_of_income_tax_return" name="affidavit_of_income_tax_return" accept="image/*" required/>
                      </div>
                      <div class="text-center col-4 px-4 mt-3 tricycle-fields">
                        <label for="driver_cert_safety_driving_seminar" class="form-label appointment-label">Driver's Certificate of Safety Driving Seminar</label>
                        <input type="file" class="form-control" id="driver_cert_safety_driving_seminar" name="driver_cert_safety_driving_seminar" accept="image/*" required/>
                      </div>
                    </div>
                    <div class="col-12 d-flex mb-2">
                      <div class="text-center col-4 px-4 mt-3 tricycle-fields">
                        <label for="proof_of_id" class="form-label appointment-label">Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)</label>
                        <input type="file" class="form-control" id="proof_of_id" name="proof_of_id" accept="image/*" required/>
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