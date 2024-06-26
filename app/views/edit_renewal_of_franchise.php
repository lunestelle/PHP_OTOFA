<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="step-buttons">
    <div class="accordion" id="accordionExample">
      <div class="row">
        <div class="steps d-flex">
          <progress id="progress" value="0" max="100" class="center-progress"></progress>
          <div class="step-item">
            <button class="step-button text-center" type="button" data-toggle="collapse"
                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="showStep(1)">
                1
            </button>
            <p class="step-buttons-label">Appointment Information</p>
          </div>
          <div class="step-item">
            <button class="step-button text-center collapsed" type="button" data-toggle="collapse"
                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" onclick="showStep(2)">
                2
            </button>
            <p class="step-buttons-label">Tricycle Application Form</p>
          </div>
          <div class="step-item">
            <button class="step-button text-center collapsed" type="button" data-toggle="collapse"
                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" onclick="showStep(3)">
                3
            </button>
            <p class="step-buttons-label">MTOP Requirements Images</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 text-uppercase nav-top" id="mainAppointmentForm">
      <h6 class="title-head">Edit<span class="mx-1" style="color:#ff8356;">Renewal of Franchise</span> Appointment</h6>
    </div>
    <div class="col-lg-12">
      <?php if ($userRole === 'operator'): ?>  
        <div class="row">
          <div class="col-12 mx-auto text-center mt-4">
            <p id="assessmentFeeText" class="text-muted fw-bold fst-italic" style="padding: 10px; border: 1px solid #ff8356; background-color: #fff9ea; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"></p>
          </div>
        </div>
      <?php endif; ?>

      <form class="default-form" method="POST" action="" id="appointmentForm" enctype="multipart/form-data">
        <div id="editAppointmentForm">
          <!-- *** STEP 1 *** -->
          <section id="step-1">
            <div class="content-container mb-3">
              <div class="row px-3 p-3">
                <div class="col-12 d-flex mb-2">
                  <div class="col-4 px-5">
                    <label for="name" class="form-label">Full Name</label>
                    <div class="input-group">
                      <input type="text" class="form-control phone-no" style="cursor: pointer;" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default appointment full name. This field is read-only. To update, please go to Manage Profile.">
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-4 px-5">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <div class="input-group">
                      <span class="input-group-text">+63</span>
                      <input type="text" class="form-control phone-no" id="phone_number" name="phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default phone number. This field is read-only. To update, please go to Manage Profile.">
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-4 px-5">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                      <input type="email" class="form-control phone-no" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default email address. This field is read-only. To update, please go to Manage Profile.">
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-12 d-flex">
                  <div class="col-4 px-5">
                    <label for="appointment_type" class="form-label">Appointment Type</label>
                    <div class="input-group">
                      <input type="text" class="form-control phone-no" style="cursor: pointer;" id="appointment_type" name="appointment_type" value="<?php echo isset($appointment_type) ? $appointment_type : ''; ?>" readonly data-toggle="tooltip" data-bs-placement="top" title="Default appointment type. This field is read-only.">
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-4 px-5">
                    <label for="appointment_date" class="form-label">Preferred Date</label>
                    <div class="input-group">
                      <input type="text" class="form-control phone-no" style="cursor: pointer;" id="appointment_date" name="appointment_date" value="<?php echo isset($appointment_date) ? $appointment_date : ''; ?>" readonly data-toggle="tooltip" data-bs-placement="top" title="Default appointment date. This field is read-only.">
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-4 px-5">
                    <label for="appointment_time" class="form-label">Preferred Time</label>
                    <div class="input-group">
                      <?php
                      function formatAppointmentTime($appointment_time) {
                          // Convert appointment time to timestamp
                          $timestamp = strtotime($appointment_time);

                          // Format the appointment time to include AM/PM
                          $formatted_time = date("h:i A", $timestamp); // "h" for 12-hour format, "A" for AM/PM

                          return $formatted_time;
                      }

                      // Check if appointment_time is set before formatting
                      $appointment_time_value = isset($appointment_time) ? formatAppointmentTime($appointment_time) : '';
                      ?>
                      <input type="text" class="form-control phone-no" style="cursor: pointer;" id="appointment_time" name="appointment_time" value="<?php echo $appointment_time_value; ?>" readonly data-toggle="tooltip" data-bs-placement="top" title="Default appointment time. This field is read-only.">
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-12 d-flex mt-3">
                  <div class="col-4 px-4">
                    <?php if (hasAnyPermission(['Can approve appointments', 'Can decline appointments', 'Can on process appointments', 'Can completed appointments'], $permissions)): ?>
                      <label for="status" class="form-label">Status</label>
                      <select class="form-control appointment-status-select fw-bold" id="status" name="status">
                        <option value="" disabled>Select Appointment Status</option>
                        <?php if ($status === 'Pending'): ?>
                          <option value="Pending" selected disabled>Pending</option>
                          <?php if (hasPermission('Can approve appointments', $permissions)) { ?>
                            <option value="Approved">Approved</option>
                          <?php } ?>
                          <?php if (hasPermission('Can decline appointments', $permissions)) { ?>
                            <option value="Declined">Declined</option>
                          <?php } ?>
                        <?php elseif ($status === "Approved"): ?>
                          <option value="Approved" selected disabled>Approved</option>
                          <?php if (hasPermission('Can on process appointments', $permissions)) { ?>
                            <option value="On Process">On Process</option>
                          <?php } ?>
                        <?php elseif ($status === "On Process"): ?>
                          <option value="On Process" selected disabled>On Process</option>
                          <?php if (hasPermission('Can completed appointments', $permissions)) { ?>
                            <option value="Completed">Completed</option>
                          <?php } ?>
                        <?php endif; ?>
                      </select>
                    <?php else: ?>
                      <input type="hidden" name="status" value="<?php echo isset($status) ? $status : ''; ?>">
                    <?php endif; ?>
                  </div>

                  <?php if (hasPermission('Can decline appointments', $permissions)) { ?>
                    <div class="col-8 px-5" id="rejection-comments-container" style="display: none;">
                      <label for="comments" class="form-label">Declined Reason / Comment</label>
                      <textarea class="form-control text-start" id="comments" name="comments" style="width: 580px;" rows="3"><?php echo isset($comments) ? $comments : ''; ?></textarea>
                    </div>
                  <?php } ?>
                                    
                  <script>
                    $(document).ready(function () {
                      function toggleCommentsVisibility() {
                        const selectedStatus = $('#status').val();
                        const showComments = selectedStatus === 'Declined';
                        $('#rejection-comments-container').toggle(showComments);
                      }

                      toggleCommentsVisibility();

                      // Trigger toggle when the status dropdown value changes
                      $('#status').change(function () {
                        toggleCommentsVisibility();
                      });
                    });
                  </script>
                </div>
              </div>
            </div>
            <div class="text-end mt-3">
              <button type="button" class="sidebar-btnContent" onclick="showStep(2)">Next</button>
            </div>
          </section>

          <!-- *** STEP 2 *** -->
          <section id="step-2" style="display: none;">
            <div class="content-container mt-1">
              <div class="row px-3 p-3">
                <div class="col-12 d-flex mb-2">
                  <div class="col-4 px-5">
                    <label for="operator_name" class="form-label">Name of Operator</label>
                    <div class="input-group">
                      <input type="text" class="form-control phone-no" style="cursor: pointer;" id="operator_name" name="operator_name" value="<?php echo isset($operator_name) ? $operator_name : ''; ?>" readonly data-toggle="tooltip" data-bs-placement="top" title="Default operator name. This field is read-only. To update, please go to Manage Profile.">
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-4 px-5">
                    <label for="tricycle_phone_number" class="form-label">Phone Number</label>
                    <div class="input-group">
                      <span class="input-group-text">+63</span>
                      <input type="text" class="form-control phone-no" id="tricycle_phone_number" name="tricycle_phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($tricycle_phone_number) ? $tricycle_phone_number : ''; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default phone number. This field is read-only. To update, please go to Manage Profile.">
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-4 px-5">
                    <label for="address" class="form-label">Address</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($address) ? $address : ''; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default address. This field is read-only. To update, please go to Manage Profile.">
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="col-12 d-flex mb-2">
                  <div class="col-4 px-5">
                    <label for="mtop_no" class="form-label">MTOP Number</label>
                    <input type="text" class="form-control" id="mtop_no" name="mtop_no" value="<?php echo isset($mtop_no) ? $mtop_no : ''; ?>" min="0" required>
                  </div>
                  <div class="col-4 px-5">
                    <label for="color_code" class="form-label">Color Code</label>
                    <select class="form-control" id="color_code" name="color_code" required>
                      <option selected disabled>Please Select Here</option>
                      <option value="Red" data-route-area="Free Zone / Zone 1" <?php echo (isset($color_code) && $color_code == 'Red' ? 'selected' : ''); ?>>Red</option>
                      <option value="Blue" data-route-area="Free Zone & Zone 2" <?php echo (isset($color_code) && $color_code == 'Blue' ? 'selected' : ''); ?>>Blue</option>
                      <option value="Yellow" data-route-area="Free Zone & Zone 3" <?php echo (isset($color_code) && $color_code == 'Yellow' ? 'selected' : ''); ?>>Yellow</option>
                      <option value="Green" data-route-area="Free Zone & Zone 4" <?php echo (isset($color_code) && $color_code == 'Green' ? 'selected' : ''); ?>>Green</option>
                    </select>
                  </div>
                  <div class="col-4 px-5">
                    <label for="route_area" class="form-label">Route Area</label>
                    <div class="input-group">
                      <input type="text" class="form-control" style="cursor:pointer;" id="route_area" name="route_area" placeholder="Select Color Code First" data-toggle="tooltip" data-bs-placement="top" title="Please choose a Color Code to determine the Route Area for the tricycle. This field is read-only." value="<?php echo isset($route_area) ? $route_area : ''; ?>" readonly>
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="col-12 d-flex mb-5">
                  <div class="col-4 px-5">
                    <label for="make_model" class="form-label">Make Model</label>
                    <input type="text" class="form-control" id="make_model" name="make_model" value="<?php echo isset($make_model) ? $make_model : ''; ?>" required>
                  </div>
                  <div class="col-4 px-5">
                    <label for="make_model_year_acquired" class="form-label">Model Year Acquired</label>
                    <input type="text" class="form-control" id="make_model_year_acquired" name="make_model_year_acquired" value="<?php echo isset($make_model_year_acquired) ? $make_model_year_acquired : ''; ?>" required>
                  </div>
                  <div class="col-4 px-5">
                    <label for="make_model_expiry_date" class="form-label">Model Expiry Date</label>
                    <input type="date" class="form-control" id="make_model_expiry_date" name="make_model_expiry_date" value="<?php echo isset($make_model_expiry_date) ? $make_model_expiry_date : ''; ?>" required>
                  </div>
                </div>

                <div class="col-12 d-flex mb-2">
                  <div class="col-4 px-5">
                    <label for="motor_number" class="form-label">Motor Number</label>
                    <input type="text" class="form-control" id="motor_number" name="motor_number" value="<?php echo isset($motor_number) ? $motor_number : ''; ?>" min="0" required>
                  </div>
                  <div class="col-4 px-5">
                    <label for="insurer" class="form-label">Insurer</label>
                    <input type="text" class="form-control" id="insurer" name="insurer" value="<?php echo isset($insurer) ? $insurer : ''; ?>" required>
                  </div>
                  <?php if (!empty($cin_number)): ?>
                    <div class="col-4 px-5">
                      <label for="tricycle_cin_number_id" class="form-label">Tricycle CIN</label>
                      <div class="input-group">
                        <input type="text" class="form-control" style="cursor: pointer;" id="tricycle_cin_number_id" name="tricycle_cin_number_id" value="<?= $cin_number ?>" data-toggle="tooltip" data-bs-placement="top" title="Default tricycle CIN." readonly required>
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                          <i class="fa-solid fa-info-circle"></i>
                        </span>
                      </div>
                    </div>
                  <?php else: ?>
                    <div class="col-4 px-5">
                      <label for="tricycle_cin_number_id" class="form-label">Tricycle CIN</label>
                      <div class="input-group">
                        <input type="text" class="form-control" style="cursor: pointer;" id="tricycle_cin_number_id" name="tricycle_cin_number_id" value="" data-toggle="tooltip" data-bs-placement="top" title="No available Tricycle CIN numbers." readonly disabled>
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                          <i class="fa-solid fa-info-circle"></i>
                        </span>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>

                <div class="col-12 d-flex mb-5">
                  <div class="col-4 px-5">
                    <label for="coc_no" class="form-label">C.O.C Number</label>
                    <input type="text" class="form-control" id="coc_no" name="coc_no" value="<?php echo isset($coc_no) ? $coc_no : ''; ?>" min="0" required>
                  </div>
                  <div class="col-4 px-5">
                    <label for="coc_no_expiry_date" class="form-label">C.O.C Expiry Date</label>
                    <input type="date" class="form-control" id="coc_no_expiry_date" name="coc_no_expiry_date" value="<?php echo isset($coc_no_expiry_date) ? $coc_no_expiry_date : ''; ?>" required>
                  </div>
                </div>

                <div class="col-12 d-flex mb-2">
                  <?php if (!empty($cin_number)): ?>
                    <div class="col-4 px-5">
                      <label for="lto_cr_no" class="form-label">LTO CR Number</label>
                      <input type="text" class="form-control" id="lto_cr_no" name="lto_cr_no" value="<?= isset($lto_cr_no) ? $lto_cr_no : ''; ?>" min="0" required>
                    </div>
                    <div class="col-4 px-5">
                      <label for="lto_or_no" class="form-label">LTO OR Number</label>
                      <input type="text" class="form-control" id="lto_or_no" name="lto_or_no" value="<?= isset($lto_or_no) ? $lto_or_no : ''; ?>" required>
                    </div>
                    <?php if (!empty($driverData)): ?>
                      <div class="col-4 px-5">
                        <label for="driver_id" class="form-label">Name of Driver</label>
                        <div class="input-group">
                          <input type="text" class="form-control" style="cursor: pointer;" id="driver_id" name="driver_id" value="<?= $driver_name ?>" data-toggle="tooltip" data-bs-placement="top" title="Default Driver Name." readonly required>
                          <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                            <i class="fa-solid fa-info-circle"></i>
                          </span>
                        </div>
                      </div>
                    <?php else: ?>
                      <div class="col-4 px-5">
                        <label for="driver_id" class="form-label">Name of Driver</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="driver_id" style="cursor: pointer;" name="driver_id" value="<?= $driver_name ?>" data-toggle="tooltip" data-bs-placement="top" title="Selected Tricycle CIN has no driver." readonly required>
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
                      <input type="text" class="form-control" id="driver_id" name="driver_id" value="" data-toggle="tooltip" data-bs-placement="top" title="No tricycle drivers are currently available for selection." readonly disabled>
                    </div>
                  <?php endif; ?>
                </div>

                <div class="col-12 d-flex mb-2">
                  <div class="col-4 px-5">
                    <label for="driver_license_no" class="form-label">Driver License Number</label>
                    <div class="input-group">
                      <input type="text" class="form-control" style="cursor: pointer;" id="driver_license_no" name="driver_license_no" value="<?= $driver_license_no ?>" data-toggle="tooltip" data-bs-placement="top" title="Default Driver License No." readonly required>
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-4 px-5">
                    <label for="driver_license_expiry_date" class="form-label">Driver License Expiry Date</label>
                    <div class="input-group">
                      <input type="text" class="form-control" style="cursor: pointer;" id="driver_license_expiry_date" name="driver_license_expiry_date" value="<?= $driver_license_expiry_date ?>" data-toggle="tooltip" data-bs-placement="top" title="Default Driver License Expiry Date." readonly required>
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-3">
              <button type="button" class="sidebar-btnContent-1 text-start" onclick="showStep(1)">Previous</button>
              <button type="button" class="sidebar-btnContent text-end" onclick="showStep(3)">Next</button>
            </div>
          </section>

          <!-- *** STEP 3 *** -->
          <section id="step-3" style="display: none;">
            <div class="content-container mt-1 mb-3">
              <div class="row px-3 p-3">
                <div class="col-12 d-flex mb-2">
                  <div class="text-center col-4 px-4">
                    <label for="tc_lto_certificate_of_registration" class="form-label">LTO Certificate of Registration (TC)</label>
                    <?php
                      if (isset($tc_lto_certificate_of_registration_path) && $tc_lto_certificate_of_registration_path) {
                        echo '<div class="image-container position-relative">';
                        echo '<img src="' . $tc_lto_certificate_of_registration_path . '" class="img-fluid rounded fixed-height-image" id="tc_lto_certificate_of_registration" alt="LTO Certificate of Registration (TC)">';
                        echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="tc_lto_certificate_of_registration" data-original-image="' . $tc_lto_certificate_of_registration_path . '" data-mtop-id="' . $mtop_requirement_id . '"></button>';
                        echo '</div>';
                      } else {
                        echo '<div class="image-container">';
                        echo '<input class="form-control" type="file" name="tc_lto_certificate_of_registration" id="tc_lto_certificate_of_registration-input" accept="image/*" required>';
                        echo '</div>';
                      }
                    ?>
                    <?php
                      echo '<input type="hidden" name="original_tc_lto_certificate_of_registration" value="' . ($tc_lto_certificate_of_registration_path ?? '') . '">';
                    ?>
                  </div>
                  <div class="text-center col-4 px-4">
                    <label for="tc_lto_official_receipt" class="form-label">LTO Official Receipt (TC)</label>
                    <?php
                      if (isset($tc_lto_official_receipt_path) && $tc_lto_official_receipt_path) {
                        echo '<div class="image-container position-relative">';
                        echo '<img src="' . $tc_lto_official_receipt_path . '" class="img-fluid rounded fixed-height-image" id="tc_lto_official_receipt" alt="LTO Official Receipt (TC)">';
                        echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="tc_lto_official_receipt" data-original-image="' . $tc_lto_official_receipt_path . '" data-mtop-id="' . $mtop_requirement_id . '"></button>';
                        echo '</div>';
                      } else {
                        echo '<div class="image-container">';
                        echo '<input class="form-control" type="file" name="tc_lto_official_receipt" id="tc_lto_official_receipt-input" accept="image/*" required>';
                        echo '</div>';
                      }
                    ?>
                    <?php
                      echo '<input type="hidden" name="original_tc_lto_official_receipt" value="' . ($tc_lto_official_receipt_path ?? '') . '">';
                    ?>
                  </div>
                  <div class="text-center col-4 px-4">
                    <label for="tc_plate_authorization" class="form-label">Plate Authorization (TC) (If no Plate Number)</label>
                    <?php
                      if (isset($tc_plate_authorization_path) && $tc_plate_authorization_path) {
                        echo '<div class="image-container position-relative">';
                        echo '<img src="' . $tc_plate_authorization_path . '" class="img-fluid rounded fixed-height-image" id="tc_plate_authorization" alt="Plate Authorization (TC) (If no Plate Number)">';
                        echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="tc_plate_authorization" data-original-image="' . $tc_plate_authorization_path . '" data-mtop-id="' . $mtop_requirement_id . '"></button>';
                        echo '</div>';
                      } else {
                        echo '<div class="image-container">';
                        echo '<input class="form-control" type="file" name="tc_plate_authorization" id="tc_plate_authorization-input" accept="image/*" required>';
                        echo '</div>';
                      }
                    ?>
                    <?php
                      echo '<input type="hidden" name="original_tc_plate_authorization" value="' . ($tc_plate_authorization_path ?? '') . '">';
                    ?>
                  </div>
                </div>
                <div class="col-12 d-flex mb-2">
                  <div class="text-center col-4 px-4">
                    <label for="tc_renewed_insurance_policy" class="form-label">Renewed Insurance Policy (TC)</label>
                    <?php
                      if (isset($tc_renewed_insurance_policy_path) && $tc_renewed_insurance_policy_path) {
                        echo '<div class="image-container position-relative">';
                        echo '<img src="' . $tc_renewed_insurance_policy_path . '" class="img-fluid rounded fixed-height-image" id="tc_renewed_insurance_policy" alt="Renewed Insurance Policy (TC)">';
                        echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="tc_renewed_insurance_policy" data-original-image="' . $tc_renewed_insurance_policy_path . '" data-mtop-id="' . $mtop_requirement_id . '"></button>';
                        echo '</div>';
                      } else {
                        echo '<div class="image-container">';
                        echo '<input class="form-control" type="file" name="tc_renewed_insurance_policy" id="tc_renewed_insurance_policy-input" accept="image/*" required>';
                        echo '</div>';
                      }
                    ?>
                    <?php
                      echo '<input type="hidden" name="original_tc_renewed_insurance_policy" value="' . ($tc_renewed_insurance_policy_path ?? '') . '">';
                    ?>
                  </div>
                  <div class="text-center col-4 px-4">
                    <label for="latest_franchise" class="form-label">Latest Franchise</label>
                    <?php
                      if (isset($latest_franchise_path) && $latest_franchise_path) {
                        echo '<div class="image-container position-relative">';
                        echo '<img src="' . $latest_franchise_path . '" class="img-fluid rounded fixed-height-image" id="latest_franchise" alt="Latest Franchise">';
                        echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="latest_franchise" data-original-image="' . $latest_franchise_path . '" data-mtop-id="' . $mtop_requirement_id . '"></button>';
                        echo '</div>';
                      } else {
                        echo '<div class="image-container">';
                        echo '<input class="form-control" type="file" name="latest_franchise" id="unit_latest_franchise-input" accept="image/*" required>';
                        echo '</div>';
                      }
                    ?>
                    <?php
                      echo '<input type="hidden" name="original_latest_franchise" value="' . ($latest_franchise_path ?? '') . '">';
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-3">
              <button type="button" class="sidebar-btnContent-1 text-start" onclick="showStep(2)">Previous</button>
              <button type="submit" class="sidebar-btnContent" name="update_renewal_franchise" id="update_renewal_franchise">Update</button>            
              <a href="./appointments" class="cancel-btn">Cancel</a>
            </div>
          </section>
        </div>
      </form>
    </div>
  </div>
</main>

<!-- Delete Image Modal -->
<div class="modal fade" id="deleteImageModal" tabindex="-1" aria-labelledby="deleteImageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteImageModalLabel">Delete Image Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
        <input type="hidden" name="mtop_id" id="mtopIdInput">
        <input type="hidden" name="image_type" id="imageTypeInput">
        <input type="hidden" name="original_image_path" id="originalImagePathInput">
        <div class="modal-body text-center">
          <p class="pt-1 mt-1">Are you sure you want to delete this image?</p>
          <img src="" id="imagePreview" style="max-width: 100%; max-height: 300px;">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" name="confirm_delete_image">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    function updateAssessmentFee() {
      let selectedColorCode = $("#color_code").val();
      let selectedRouteArea = $("#color_code").find(":selected").data("route-area");
      $("#route_area").val(selectedRouteArea);

      let assessmentFeeText = "";

      switch (selectedRouteArea) {
        case "Free Zone / Zone 1":
          assessmentFeeText = "The assessment fee for processing your tricycle application within the Free Zone or Zone 1 Route is ₱430.00.";
          break;
        case "Free Zone & Zone 2":
        case "Free Zone & Zone 3":
        case "Free Zone & Zone 4":
          assessmentFeeText = "The assessment fee for processing your tricycle application within the " + selectedRouteArea + " Route is ₱1,030.00.";
          break;
        default:
          assessmentFeeText = "Please select a route area to view the assessment fee.";
      }

      let tricycleStatuses = <?php echo json_encode($tricycle_statuses); ?>;

      let renewalNotice = tricycleStatuses.some(status => status == "Expired Renewal (1st Notice)" || status == "Expired Renewal (2nd Notice)" || status == "Expired Renewal (3rd Notice)");
      if (renewalNotice) {
        let penaltyFee = "";
        switch (selectedRouteArea) {
          case "Free Zone / Zone 1":
            penaltyFee = " Additionally, there is a penalty fee of ₱122.50 for late renewal.";
            break;
          case "Free Zone & Zone 2":
          case "Free Zone & Zone 3":
          case "Free Zone & Zone 4":
            penaltyFee = " Additionally, there is a penalty fee of ₱272.50 for late renewal.";
            break;
          default:
            penaltyFee = "";
        }
        assessmentFeeText += " " + penaltyFee;
      }

      $("#assessmentFeeText").text(assessmentFeeText);
    }

    updateAssessmentFee();

    $("#color_code").change(function () {
      updateAssessmentFee();
    });

    let errorMessage = $(".flash-message.error");
    if (errorMessage.length > 0) {
      document.getElementById("mainAppointmentForm").scrollIntoView({
        behavior: "smooth",
        block: "start"
      });
    }
  });

  function showStep(step) {
    const stepButtons = document.querySelectorAll('.step-button');
    const progress = document.querySelector('#progress');
    const stepButtonsContainer = document.getElementById('stepButtons');

    // Hide all steps except the current one
    for (let i = 1; i <= 3; i++) {
      document.getElementById('step-' + i).style.display = 'none';
    }
    document.getElementById('step-' + step).style.display = 'block';

    // Update progress bar value based on the current step
    progress.setAttribute('value', (step - 1) * 50);

    // Remove 'active' class from all step buttons
    stepButtons.forEach((button) => {
      button.classList.remove('active');
    });

    // Add 'active' class to the clicked step button
    stepButtons[step - 1].classList.add('active');

    // Add 'done' class to previous step buttons
    for (let i = 0; i < step - 1; i++) {
      stepButtons[i].classList.add('done');
    }

    // Remove 'done' class from subsequent step buttons
    for (let i = step; i < stepButtons.length; i++) {
      stepButtons[i].classList.remove('done');
    }

    // Scroll to the step buttons container
    if (stepButtonsContainer) {
      stepButtonsContainer.scrollIntoView({ behavior: 'smooth' });
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    // Event listener for the Next button
    const nextButton = document.getElementById('nextButton');
    if (nextButton) {
      nextButton.addEventListener('click', () => {
        const activeStepButton = document.querySelector('.step-button.active');
        const nextStepButton = activeStepButton.nextElementSibling;
        if (nextStepButton) {
          const nextStep = parseInt(nextStepButton.textContent);
          showStep(nextStep);
        }
      });
    }

    // Event listener for the Previous button
    const prevButton = document.getElementById('prevButton');
    if (prevButton) {
      prevButton.addEventListener('click', () => {
        const activeStepButton = document.querySelector('.step-button.active');
        const prevStepButton = activeStepButton.previousElementSibling;
        if (prevStepButton) {
          const prevStep = parseInt(prevStepButton.textContent);
          showStep(prevStep);
        }
      });
    }
  });

  document.addEventListener('DOMContentLoaded', function () {
    var deleteImageModal = document.getElementById('deleteImageModal');
    deleteImageModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var imageType = button.getAttribute('data-image-type');
      var originalImagePath = button.getAttribute('data-original-image');
      var mtopId = button.getAttribute('data-mtop-id');

      // Update the modal's hidden input values
      var mtopIdInput = deleteImageModal.querySelector('#mtopIdInput');
      var imageTypeInput = deleteImageModal.querySelector('#imageTypeInput');
      var originalImagePathInput = deleteImageModal.querySelector('#originalImagePathInput');
      mtopIdInput.value = mtopId;
      imageTypeInput.value = imageType;
      originalImagePathInput.value = originalImagePath;

      // Update the image preview
      var imagePreview = deleteImageModal.querySelector('#imagePreview');
      imagePreview.src = originalImagePath;
    });
  });
</script>