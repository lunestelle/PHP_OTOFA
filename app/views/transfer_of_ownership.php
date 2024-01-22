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
                        <div class="input-group">
                          <input type="text" class="form-control phone-no" style="cursor: pointer;" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $fullName; ?>" data-toggle="tooltip" data-bs-placement="top" title="Default operator name. This field is read-only. To update, please go to Manage Profile." readonly>
                          <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="Default operator name. This field is read-only. To update, please go to Manage Profile.">
                            <i class="fa-solid fa-info-circle"></i>
                          </span>
                        </div>
                      </div>
                      <div class="col-4 px-5">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <div class="input-group">
                          <span class="input-group-text">+63</span>
                          <input type="text" class="form-control phone-no" style="cursor: pointer;" id="phone_number" name="phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['phone_number']) ? $_POST['phone_number'] : $userPhoneNo; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default phone number. This field is read-only. To update, please go to Manage Profile.">
                          <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                            <i class="fa-solid fa-info-circle"></i>
                          </span>
                        </div>
                      </div>
                      <div class="col-4 px-5">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                          <input type="email" class="form-control phone-no text-lowercase" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $userEmail; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default email address. This field is read-only. To update, please go to Manage Profile.">
                          <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                            <i class="fa-solid fa-info-circle"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 d-flex mb-1">
                      <div class="col-4 px-5">
                        <label for="appointment_type" class="form-label">Appointment Type</label>
                        <div class="input-group">
                          <input type="text" class="form-control" style="cursor: pointer;" id="appointment_type" name="appointment_type" value="Transfer of Ownership" data-toggle="tooltip" data-bs-placement="top" title="Default appointment type. This field is read-only." readonly>
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
                    <div class="col-12 d-flex mb-2">
                      <div class="col-4 px-5">
                        <label for="transfer_type" class="form-label">Transfer Type</label>
                        <div class="input-group">
                          <input type="text" class="form-control" style="cursor: pointer;" id="transfer_type" name="transfer_type" value="None" data-toggle="tooltip" data-bs-placement="top" title="Default transfer type. This field is read-only." readonly>
                          <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                            <i class="fa-solid fa-info-circle"></i>
                          </span>
                        </div>
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
                        <div class="input-group">
                          <input type="text" class="form-control phone-no" style="cursor: pointer;" id="operator_name" name="operator_name" value="<?php echo isset($_POST['operator_name']) ? $_POST['operator_name'] : $fullName; ?>" data-toggle="tooltip" data-bs-placement="top" title="Default operator name. This field is read-only. To update, please go to Manage Profile." readonly>
                          <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="Default operator name. This field is read-only. To update, please go to Manage Profile.">
                            <i class="fa-solid fa-info-circle"></i>
                          </span>
                        </div>
                      </div>
                      <div class="col-4 px-5">
                        <label for="tricycle_phone_number" class="form-label">Phone Number</label>
                        <div class="input-group">
                          <span class="input-group-text">+63</span>
                          <input type="text" class="form-control phone-no" style="cursor: pointer;" id="tricycle_phone_number" name="tricycle_phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['tricycle_phone_number']) ? $_POST['tricycle_phone_number'] : $userPhoneNo; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default phone number. This field is read-only. To update, please go to Manage Profile.">
                          <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                            <i class="fa-solid fa-info-circle"></i>
                          </span>
                        </div>
                      </div>
                      <div class="col-4 px-5">
                        <label for="address" class="form-label">Address</label>
                        <div class="input-group">
                          <input type="text" class="form-control" style="cursor: pointer;" id="address" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : $userAddress; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default address. This field is read-only. To update, please go to Manage Profile.">
                          <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                            <i class="fa-solid fa-info-circle"></i>
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 d-flex mb-2">
                      <div class="col-4 px-5">
                        <label for="mtop_no" class="form-label">MTOP Number</label>
                        <input type="text" class="form-control" id="mtop_no" name="mtop_no" value="<?= isset($_POST['mtop_no']) ? $_POST['mtop_no'] : $existingTricycleApplicationData->mtop_no; ?>" min="0" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="color_code" class="form-label">Color Code</label>
                        <select class="form-control" id="color_code" name="color_code" required>
                          <option selected disabled>Please Select Here</option>
                          <option value="Red" data-route-area="Free Zone / Zone 1" <?= (isset($_POST['color_code']) && $_POST['color_code'] == 'Red') ? 'selected' : (($existingTricycleApplicationData->color_code == 'Red') ? 'selected' : ''); ?>>Red</option>
                          <option value="Blue" data-route-area="Free Zone & Zone 2" <?= (isset($_POST['color_code']) && $_POST['color_code'] == 'Blue') ? 'selected' : (($existingTricycleApplicationData->color_code == 'Blue') ? 'selected' : ''); ?>>Blue</option>
                          <option value="Yellow" data-route-area="Free Zone & Zone 3" <?= (isset($_POST['color_code']) && $_POST['color_code'] == 'Yellow') ? 'selected' : (($existingTricycleApplicationData->color_code == 'Yellow') ? 'selected' : ''); ?>>Yellow</option>
                          <option value="Green" data-route-area="Free Zone & Zone 4" <?= (isset($_POST['color_code']) && $_POST['color_code'] == 'Green') ? 'selected' : (($existingTricycleApplicationData->color_code == 'Green') ? 'selected' : ''); ?>>Green</option>
                        </select>
                      </div>
                      <div class="col-4 px-5">
                        <label for="route_area" class="form-label">Route Area</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="route_area" name="route_area" style="cursor:pointer;" placeholder="Select Color Code First" data-toggle="tooltip" data-bs-placement="top" title="Please choose a Color Code to determine the Route Area for the tricycle. This field is read-only." value="<?= (isset($_POST['route_area']) ? $_POST['route_area'] : ($existingTricycleApplicationData->route_area ?? '')); ?>" readonly required>
                          <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                            <i class="fa-solid fa-info-circle"></i>
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 d-flex mb-5">
                      <div class="col-4 px-5">
                        <label for="make_model" class="form-label">Make Model</label>
                        <input type="text" class="form-control" id="make_model" name="make_model" value="<?= (isset($_POST['make_model']) ? $_POST['make_model'] : ($existingTricycleApplicationData->make_model ?? '')); ?>" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="make_model_year_acquired" class="form-label">Model Year Acquired</label>
                        <input type="text" class="form-control text-uppercase" id="make_model_year_acquired" name="make_model_year_acquired" value="<?= (isset($_POST['make_model_year_acquired']) ? $_POST['make_model_year_acquired'] : ($existingTricycleApplicationData->make_model_year_acquired ?? '')); ?>" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="make_model_expiry_date" class="form-label">Model Expiry Date</label>
                        <input type="date" class="form-control text-uppercase" id="make_model_expiry_date" name="make_model_expiry_date" value="<?= (isset($_POST['make_model_expiry_date']) ? $_POST['make_model_expiry_date'] : ($existingTricycleApplicationData->make_model_expiry_date ?? '')); ?>" required>
                      </div>
                    </div>

                    <div class="col-12 d-flex mb-2">
                      <div class="col-4 px-5">
                        <label for="motor_number" class="form-label">Motor Number</label>
                        <input type="text" class="form-control" id="motor_number" name="motor_number" value="<?= (isset($_POST['motor_number']) ? $_POST['motor_number'] : ($existingTricycleApplicationData->motor_number ?? '')); ?>" min="0" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="insurer" class="form-label">Insurer</label>
                        <input type="text" class="form-control" id="insurer" name="insurer" value="<?= (isset($_POST['insurer']) ? $_POST['insurer'] : ($existingTricycleApplicationData->insurer ?? '')); ?>" required>
                      </div>
                      <?php if (!empty($cin_number)): ?>
                        <div class="col-4 px-5">
                          <label for="tricycle_cin_number_id" class="form-label">Tricycle CIN</label>                          
                          <div class="input-group">
                            <input type="text" class="form-control" id="tricycle_cin_number_id" name="tricycle_cin_number_id" value="<?= $cin_number ?>" data-toggle="tooltip" data-bs-placement="top" title="Default tricycle CIN." readonly required>
                            <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                              <i class="fa-solid fa-info-circle"></i>
                            </span>
                          </div>
                        </div>
                      <?php else: ?>
                        <div class="col-4 px-5">
                          <label for="tricycle_cin_number_id" class="form-label">Tricycle CIN</label>
                          <input type="text" class="form-control" id="tricycle_cin_number_id" name="tricycle_cin_number_id" value="" data-toggle="tooltip" data-bs-placement="top" title="No available Tricycle CIN numbers." readonly disabled>
                        </div>
                      <?php endif; ?>
                    </div>

                    <div class="col-12 d-flex mb-5">
                      <div class="col-4 px-5">
                        <label for="coc_no" class="form-label">C.O.C Number</label>
                        <input type="text" class="form-control" id="coc_no" name="coc_no" value="<?= (isset($existingTricycleApplicationData->coc_no) ? $existingTricycleApplicationData->coc_no : (isset($_POST['coc_no']) ? $_POST['coc_no'] : '')); ?>" min="0" required>
                      </div>
                      <div class="col-4 px-5">
                        <label for="coc_no_expiry_date" class="form-label">C.O.C Expiry Date</label>
                        <input type="date" class="form-control text-uppercase" id="coc_no_expiry_date" name="coc_no_expiry_date" value="<?= (isset($existingTricycleApplicationData->coc_no_expiry_date) ? $existingTricycleApplicationData->coc_no_expiry_date : (isset($_POST['coc_no_expiry_date']) ? $_POST['coc_no_expiry_date'] : '')); ?>" required>
                      </div>
                    </div>

                    <div class="col-12 d-flex mb-2">
                      <?php if (!empty($cin_number)): ?>
                        <div class="col-4 px-5">
                          <label for="lto_cr_no" class="form-label">LTO CR Number</label>
                          <input type="text" class="form-control" id="lto_cr_no" name="lto_cr_no" value="<?= (isset($existingTricycleApplicationData->lto_cr_no) ? $existingTricycleApplicationData->lto_cr_no : (isset($_POST['lto_cr_no']) ? $_POST['lto_cr_no'] : '')); ?>" required>
                        </div>
                        <div class="col-4 px-5">
                          <label for="lto_or_no" class="form-label">LTO OR Number</label>
                          <input type="text" class="form-control text-uppercase" id="lto_or_no" name="lto_or_no" value="<?= (isset($existingTricycleApplicationData->lto_or_no) ? $existingTricycleApplicationData->lto_or_no : (isset($_POST['lto_or_no']) ? $_POST['lto_or_no'] : '')); ?>" required>
                        </div>

                        <?php if (!empty($driverData)): ?>
                          <div class="col-4 px-5">
                            <label for="driver_id" class="form-label">Name of Driver</label>
                            <div class="input-group">
                              <input type="text" class="form-control" id="driver_id" name="driver_id" value="<?= $driver_name ?>" data-toggle="tooltip" data-bs-placement="top" title="Default Driver Name." readonly required>
                              <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                                <i class="fa-solid fa-info-circle"></i>
                              </span>
                            </div>
                          </div>
                        <?php else: ?>
                          <div class="col-4 px-5">
                            <label for="driver_id" class="form-label">Name of Driver</label>
                            <div class="input-group">
                              <input type="text" class="form-control" id="driver_id" name="driver_id" value="<?= $driver_name ?>" data-toggle="tooltip" data-bs-placement="top" title="Selected Tricycle CIN has no driver." readonly required>
                              <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                                <i class="fa-solid fa-info-circle"></i>
                              </span>
                            </div>
                          </div>
                        <?php endif; ?>
                      <?php else: ?>
                        <div class="col-4 px-5">
                          <label for="lto_cr_no" class="form-label">LTO CR Number</label>
                          <input type="text" class="form-control" id="lto_cr_no" name="lto_cr_no" value="" data-toggle="tooltip" data-bs-placement="top" title="No Tricycle CIN has been selected." readonly disabled>
                        </div>
                        <div class="col-4 px-5">
                          <label for="lto_or_no" class="form-label">LTO OR Number</label>
                          <input type="date" class="form-control text-uppercase" id="lto_or_no" name="lto_or_no" value="" data-toggle="tooltip" data-bs-placement="top" title="No Tricycle CIN has been selected." readonly disabled>
                        </div>
                        <div class="col-4 px-5">
                          <label for="driver_id" class="form-label">Name of Driver</label>
                          <input type="text" class="form-control phone-no" style="cursor: pointer;" id="operator_name" name="operator_name" value="" data-toggle="tooltip" data-bs-placement="top" title="No tricycle drivers are currently available for selection." readonly disabled>
                        </div>
                      <?php endif; ?>
                    </div>

                    <div class="col-12 d-flex mb-2">
                      <?php if (!empty($driverData)): ?>
                        <div class="col-4 px-5">
                          <label for="driver_license_no" class="form-label">Driver License Number</label>
                          <input type="text" class="form-control" id="driver_license_no" name="driver_license_no" value="<?= (isset($existingTricycleApplicationData->driver_license_no) ? $existingTricycleApplicationData->driver_license_no : (isset($_POST['driver_license_no']) ? $_POST['driver_license_no'] : '')); ?>" required>
                        </div>
                        <div class="col-4 px-5">
                          <label for="driver_license_expiry_date" class="form-label">License Expiry Date</label>
                          <input type="date" class="form-control text-uppercase" id="driver_license_expiry_date" name="driver_license_expiry_date" value="<?= (isset($existingTricycleApplicationData->driver_license_expiry_date) ? $existingTricycleApplicationData->driver_license_expiry_date : (isset($_POST['driver_license_expiry_date']) ? $_POST['driver_license_expiry_date'] : '')); ?>" required>
                        </div>
                      <?php else: ?>
                        <div class="col-4 px-5">
                          <label for="driver_license_no" class="form-label">Driver License Number</label>
                          <input type="text" class="form-control" id="driver_license_no" name="driver_license_no" value="" data-toggle="tooltip" data-bs-placement="top" title="Selected Tricycle CIN has no driver." readonly disabled>
                        </div>
                        <div class="col-4 px-5">
                          <label for="driver_license_expiry_date" class="form-label">License Expiry Date</label>
                          <input type="date" class="form-control text-uppercase" id="driver_license_expiry_date" name="driver_license_expiry_date" value="" data-toggle="tooltip" data-bs-placement="top" title="Selected Tricycle CIN has no driver." readonly disabled>
                        </div>
                      <?php endif; ?>
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
                        <label for="mc_lto_certificate_of_registration" class="form-label">LTO Certificate of Registration (MC of New Unit)</label>
                        <input type="file" class="form-control" id="mc_lto_certificate_of_registration" name="mc_lto_certificate_of_registration" accept="image/*" required/>
                      </div>
                      <div class="text-center col-4 px-4">
                        <label for="mc_lto_official_receipt" class="form-label">LTO Official Receipt (MC of New Unit)</label>
                        <input type="file" class="form-control" id="mc_lto_official_receipt" name="mc_lto_official_receipt" accept="image/*" required/>
                      </div>
                      <div class="text-center col-4 px-4">
                        <label for="mc_plate_authorization" class="form-label">Plate Authorization (MC of New Unit)</label>
                        <input type="file" class="form-control" id="mc_plate_authorization" name="mc_plate_authorization" accept="image/*" required/>
                      </div>
                    </div>
                    <div class="col-12 d-flex mb-2">
                      <div class="text-center col-4 px-4">
                        <label for="tc_insurance_policy" class="form-label">Insurance Policy (TC) (New Owner)</label>
                        <input type="file" class="form-control" id="tc_insurance_policy" name="tc_insurance_policy" accept="image/*" required/>
                      </div>
                      <div class="text-center col-4 px-4">
                        <label for="unit_front_view_image" class="form-label">Picture of New Unit (Front View)</label>
                        <input type="file" class="form-control" id="unit_front_view_image" name="unit_front_view_image" accept="image/*" required/>
                      </div>
                      <div class="text-center col-4 px-4">
                        <label for="unit_side_view_image" class="form-label">Picture of New Unit (Side View)</label>
                        <input type="file" class="form-control" id="unit_side_view_image" name="unit_side_view_image" accept="image/*" required/>
                      </div>
                    </div>
                    <div class="col-12 d-flex mb-2">
                      <div class="text-center col-4 px-4">
                        <label for="sketch_location_of_garage" class="form-label">Sketch Location of Garage</label>
                        <input type="file" class="form-control" id="sketch_location_of_garage" name="sketch_location_of_garage" accept="image/*" required/>
                      </div>
                      <div class="text-center col-4 px-4">
                        <label for="latest_franchise" class="form-label">Latest Franchise</label>
                        <input type="file" class="form-control" id="latest_franchise" name="latest_franchise" accept="image/*" required/>
                      </div>
                      <div class="text-center col-4 px-4">
                        <label for="driver_cert_safety_driving_seminar" class="form-label">Driver's Certificate of Safety Driving Seminar</label>
                        <input type="file" class="form-control" id="driver_cert_safety_driving_seminar" name="driver_cert_safety_driving_seminar" accept="image/*" required/>
                      </div>
                    </div>
                    <div class="col-12 d-flex">
                      <div class="text-center col-4 px-4">
                        <label for="proof_of_id" class="form-label">Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)</label>
                        <input type="file" class="form-control" id="proof_of_id" name="proof_of_id" accept="image/*" required/>
                      </div>
                      <div class="text-center col-4 px-4">
                        <label for="affidavit_of_income_tax_return" class="form-label">Affidavit of No Income <br> or Latest Income Tax Return</label>
                        <input type="file" class="form-control" id="affidavit_of_income_tax_return" name="affidavit_of_income_tax_return" accept="image/*" required/>
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