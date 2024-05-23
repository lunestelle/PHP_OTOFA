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
      <h6 class="title-head">Edit<span class="mx-1" style="color:#ff8356;">New Franchise</span> Appointment</h6>
    </div>
    <div class="col-lg-12">
      <form class="default-form" method="POST" action="" id="appointmentForm" enctype="multipart/form-data">
        <div id="editAppointmentForm">
          <!-- *** STEP 1 *** -->
          <section id="step-1">
            <div class="content-container mb-3">
              <div class="row px-3 p-3">
                <div class="col-12 d-flex mb-2">
                  <div class="col-4 px-4">
                    <label for="name" class="form-label">Full Name</label>
                    <div class="input-group">
                      <input type="text" class="form-control phone-no" style="cursor: pointer;" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default appointment full name. This field is read-only. To update, please go to Manage Profile.">
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-4 px-4">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <div class="input-group">
                      <span class="input-group-text">+63</span>
                      <input type="text" class="form-control phone-no" id="phone_number" name="phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default phone number. This field is read-only. To update, please go to Manage Profile.">
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-4 px-4">
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
                  <div class="col-4 px-4">
                    <label for="appointment_type" class="form-label">Appointment Type</label>
                    <div class="input-group">
                      <input type="text" class="form-control phone-no" style="cursor: pointer;" id="appointment_type" name="appointment_type" value="<?php echo isset($appointment_type) ? $appointment_type : ''; ?>" readonly data-toggle="tooltip" data-bs-placement="top" title="Default appointment type. This field is read-only.">
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-4 px-4">
                    <label for="appointment_date" class="form-label">Preferred Date</label>
                    <div class="input-group">
                      <input type="text" class="form-control phone-no" style="cursor: pointer;" id="appointment_date" name="appointment_date" value="<?php echo isset($appointment_date) ? $appointment_date : ''; ?>" readonly data-toggle="tooltip" data-bs-placement="top" title="Default appointment date. This field is read-only.">
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-4 px-4">
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
                        <option value="" selected disabled>Select Appointment Status</option>
                        <?php if ($status === 'Pending'): ?>
                          <option value="Pending" <?php echo (isset($status) && $status === 'Pending') ? 'selected' : ''; ?> disabled>Pending</option>
                          <?php if (hasPermission('Can approve appointments', $permissions)) { ?>
                            <option value="Approved" <?php echo (isset($status) && $status === 'Approved') ? 'selected' : ''; ?>>Approved</option>
                          <?php } ?>
                          <?php if (hasPermission('Can decline appointments', $permissions)) { ?>
                            <option value="Declined" <?php echo (isset($status) && $status === 'Declined') ? 'selected' : ''; ?>>Declined</option>
                          <?php } ?>
                        <?php elseif ($status === "Approved"): ?>
                          <option value="Approved" <?php echo (isset($status) && $status === 'Approved') ? 'selected' : ''; ?> disabled>Approved</option>
                          <?php if (hasPermission('Can on process appointments', $permissions)) { ?>
                            <option value="On Process" <?php echo (isset($status) && $status === 'On Process') ? 'selected' : ''; ?>>On Process</option>
                          <?php } ?>
                        <?php elseif ($status === "On Process"): ?>
                          <option value="On Process" <?php echo (isset($status) && $status === 'On Process') ? 'selected' : ''; ?> disabled>On Process</option>
                          <?php if (hasPermission('Can completed appointments', $permissions)) { ?>
                            <option value="Completed" <?php echo (isset($status) && $status === 'Completed') ? 'selected' : ''; ?>>Completed</option>
                          <?php } ?>
                        <?php endif; ?>
                      </select>
                    <?php else: ?>
                      <input type="hidden" name="status" value="<?php echo isset($status) ? $status : ''; ?>">
                    <?php endif; ?>
                  </div>
                  <?php if ($userRole === 'admin'): ?>
                    <div class="col-8 px-5" id="rejection-comments-container" style="display: none;">
                      <label for="comments" class="form-label">Rejection Comments</label>
                      <textarea class="form-control text-start" id="comments" name="comments" style="width: 580px;" rows="3"><?php echo isset($comments) ? $comments : ''; ?></textarea>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="text-end mt-3">
              <button type="button" class="sidebar-btnContent" onclick="showStep(2)">Next</button>
            </div>
          </section>

          <!-- *** STEP 2 *** -->
          <section id="step-2" style="display: none;">
            <?php if ($userRole === 'operator'): ?>  
              <div class="row">
                <div class="col-12 mx-auto text-center mt-4">
                  <p id="assessmentFeeText" class="text-muted fw-bold fst-italic" style="padding: 10px; border: 1px solid #ff8356; background-color: #fff9ea; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"></p>
                </div>
              </div>
            <?php endif; ?>
            <button class="collapsible fw-bold fs-5 d-flex" id="step2btnform1" onclick="toggleForm('step2form1', 'step2form2')">
              <p class="fs-6">FORM I</p>
              <span class="float-right"><i class="fa-solid fa-circle-chevron-down"></i></span>
            </button>
            <?php if (isset($tricycleApplicationData[0])): ?>
              <?php $tricycleData1 = $tricycleApplicationData[0]; ?>
              <div class="content content-form active-content content-container mt-2 mb-3" id="step2form1">
                <div class="row px-3 p-3">
                  <div class="col-12 d-flex mb-2">
                    <div class="col-4 px-4">
                      <label for="operator_name1" class="form-label">Name of Operator</label>
                      <div class="input-group">
                        <input type="text" class="form-control phone-no" style="cursor: pointer;" id="operator_name1" name="operator_name1" value="<?php echo isset($tricycleData1->operator_name) ? $tricycleData1->operator_name : ''; ?>" readonly data-toggle="tooltip" data-bs-placement="top" title="Default operator name. This field is read-only. To update, please go to Manage Profile.">
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                          <i class="fa-solid fa-info-circle"></i>
                        </span>
                      </div>
                    </div>
                    <div class="col-4 px-4">
                      <label for="tricycle_phone_number1" class="form-label">Phone Number</label>
                      <div class="input-group">
                        <span class="input-group-text">+63</span>
                        <input type="text" class="form-control phone-no" id="tricycle_phone_number1" name="tricycle_phone_number1" placeholder="e.g., 9123456789" value="<?php echo isset($tricycle_phone_number_1) ? $tricycle_phone_number_1 : ''; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default phone number. This field is read-only. To update, please go to Manage Profile.">
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                          <i class="fa-solid fa-info-circle"></i>
                        </span>
                      </div>
                    </div>
                    <div class="col-4 px-4">
                      <label for="address1" class="form-label">Address</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="address1" name="address1" value="<?php echo isset($tricycleData1->address) ? $tricycleData1->address : ''; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default address. This field is read-only. To update, please go to Manage Profile.">
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                          <i class="fa-solid fa-info-circle"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 d-flex mb-2">
                    <div class="col-4 px-4">
                      <label for="mtop_no1" class="form-label">MTOP Number</label>
                      <input type="text" class="form-control" id="mtop_no1" name="mtop_no1" value="<?php echo isset($tricycleData1->mtop_no) ? $tricycleData1->mtop_no : ''; ?>" min="0" required>
                    </div>
                    <div class="col-4 px-4">
                      <label for="color_code1" class="form-label">Color Code</label>
                      <select class="form-control" id="color_code1" name="color_code1" required>
                        <option selected disabled>Please Select Here</option>
                        <option value="Red" data-route-area1="Free Zone / Zone 1" <?php echo (isset($tricycleData1->color_code) && $tricycleData1->color_code == 'Red' ? 'selected' : ''); ?>>Red</option>
                        <option value="Blue" data-route-area1="Free Zone & Zone 2" <?php echo (isset($tricycleData1->color_code) && $tricycleData1->color_code == 'Blue' ? 'selected' : ''); ?>>Blue</option>
                        <option value="Yellow" data-route-area1="Free Zone & Zone 3" <?php echo (isset($tricycleData1->color_code) && $tricycleData1->color_code == 'Yellow' ? 'selected' : ''); ?>>Yellow</option>
                        <option value="Green" data-route-area1="Free Zone & Zone 4" <?php echo (isset($tricycleData1->color_code) && $tricycleData1->color_code == 'Green' ? 'selected' : ''); ?>>Green</option>
                      </select>
                    </div>
                    <div class="col-4 px-4">
                      <label for="route_area1" class="form-label">Route Area</label>
                      <div class="input-group">
                        <input type="text" class="form-control" style="cursor:pointer;" id="route_area1" name="route_area1" placeholder="Select Color Code First" data-toggle="tooltip" data-bs-placement="top" title="Please choose a Color Code to determine the Route Area for the tricycle. This field is read-only." value="<?php echo isset($tricycleData1->route_area) ? $tricycleData1->route_area : ''; ?>" readonly>
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                          <i class="fa-solid fa-info-circle"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 d-flex mb-1">
                    <div class="col-4 px-4">
                      <label for="make_model1" class="form-label">Make Model</label>
                      <input type="text" class="form-control" id="make_model1" name="make_model1" value="<?php echo isset($tricycleData1->make_model) ? $tricycleData1->make_model : ''; ?>" required>
                    </div>
                    <div class="col-4 px-4">
                      <label for="make_model_year_acquired1" class="form-label">Model Year Acquired</label>
                      <input type="text" class="form-control" id="make_model_year_acquired1" name="make_model_year_acquired1" value="<?php echo isset($tricycleData1->make_model_year_acquired) ? $tricycleData1->make_model_year_acquired : ''; ?>" required>
                    </div>
                    <div class="col-4 px-4">
                      <label for="make_model_expiry_date1" class="form-label">Model Expiry Date</label>
                      <input type="date" class="form-control" id="make_model_expiry_date1" name="make_model_expiry_date1" value="<?php echo isset($tricycleData1->make_model_expiry_date) ? $tricycleData1->make_model_expiry_date : ''; ?>" required>
                    </div>
                  </div>

                  <div class="col-12 d-flex mb-2">
                    <div class="col-4 px-4">
                      <label for="motor_number1" class="form-label">Motor Number</label>
                      <input type="text" class="form-control" id="motor_number1" name="motor_number1" value="<?php echo isset($tricycleData1->motor_number) ? $tricycleData1->motor_number : ''; ?>" min="0" required>
                    </div>
                    <div class="col-4 px-4">
                      <label for="insurer1" class="form-label">Insurer</label>
                      <input type="text" class="form-control" id="insurer1" name="insurer1" value="<?php echo isset($tricycleData1->insurer) ? $tricycleData1->insurer : ''; ?>" required>
                    </div>
                    <div class="col-4 px-4">
                      <label for="coc_no1" class="form-label">C.O.C Number</label>
                      <input type="text" class="form-control" id="coc_no1" name="coc_no1" value="<?php echo isset($tricycleData1->coc_no) ? $tricycleData1->coc_no : ''; ?>" min="0" required>
                    </div>
                  </div>

                  <div class="col-12 d-flex mb-5">
                    <div class="col-4 px-4">
                      <label for="coc_no_expiry_date1" class="form-label">C.O.C Expiry Date</label>
                      <input type="date" class="form-control" id="coc_no_expiry_date1" name="coc_no_expiry_date1" value="<?php echo isset($tricycleData1->coc_no_expiry_date) ? $tricycleData1->coc_no_expiry_date : ''; ?>" required>
                    </div>
                    <?php if ($userRole === 'admin'): ?>
                      <div class="col-4 px-4">
                        <label for="tricycle_cin_number_id1" class="form-label">Tricycle CIN</label>
                        <?php if (!empty($availableCinNumbers)): ?>
                          <select class="form-control" id="tricycle_cin_number_id1" name="tricycle_cin_number_id1" required>
                            <option selected disabled>Please Select Here</option>
                            <?php if (!empty($tricycleData1->tricycle_cin_number_id)): ?>
                              <option value="<?= $tricycleData1->tricycle_cin_number_id ?>" selected>
                                <?= isset($cinNumbersById[$tricycleData1->tricycle_cin_number_id]) ? $cinNumbersById[$tricycleData1->tricycle_cin_number_id] : '' ?>
                              </option>
                            <?php endif; ?>

                            <?php foreach ($availableCinNumbers as $cinNumberId => $cinNumber): ?>
                              <?php if ($cinNumberId !== $tricycleData1->tricycle_cin_number_id): ?>
                                <option value="<?= $cinNumberId ?>">
                                  <?= $cinNumber ?>
                                </option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        <?php else: ?>
                          <div class="input-group">
                            <input type="text" class="form-control phone-no" style="cursor: pointer;" id="tricycle_cin_number_id1" name="tricycle_cin_number_id1" value="No available CIN numbers" readonly data-toggle="tooltip" data-bs-placement="top" title="There are no CIN numbers available for New Franchise">
                            <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                              <i class="fa-solid fa-info-circle"></i>
                            </span>
                          </div>
                        <?php endif; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <?php if ($userRole === 'operator'): ?>  
              <div class="row assessmentFeeContainer2">
                <div class="col-12 mx-auto text-center mt-4">
                  <p id="assessmentFeeText2" class="text-muted fw-bold fst-italic" style="padding: 10px; border: 1px solid #ff8356; background-color: #fff9ea; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"></p>
                </div>
              </div>
            <?php endif; ?>
            <button class="collapsible fw-bold fs-5 d-flex" id="step2btnform2" onclick="toggleForm('step2form2', 'step2form1')">
              <p class="fs-6">FORM II</p>
              <span class="float-right"><i class="fa-solid fa-circle-chevron-down"></i></span>
            </button>
            <?php if (isset($tricycleApplicationData[1])): ?>
              <?php $tricycleData2 = $tricycleApplicationData[1]; ?>
              <div class="content content-form active-content content-container mt-2 mb-3" id="step2form2">
                <div class="row px-3 p-3">
                  <div class="col-12 d-flex mb-2">
                    <div class="col-4 px-4">
                      <label for="operator_name2" class="form-label">Name of Operator</label>
                      <div class="input-group">
                        <input type="text" class="form-control phone-no" style="cursor: pointer;" id="operator_name2" name="operator_name2" value="<?php echo isset($tricycleData2->operator_name) ? $tricycleData2->operator_name : ''; ?>" readonly data-toggle="tooltip" data-bs-placement="top" title="Default operator name. This field is read-only. To update, please go to Manage Profile.">
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                          <i class="fa-solid fa-info-circle"></i>
                        </span>
                      </div>
                    </div>
                    <div class="col-4 px-4">
                      <label for="tricycle_phone_number2" class="form-label">Phone Number</label>
                      <div class="input-group">
                        <span class="input-group-text">+63</span>
                        <input type="text" class="form-control phone-no" id="tricycle_phone_number2" name="tricycle_phone_number2" placeholder="e.g., 9123456789" value="<?php echo isset($tricycle_phone_number_2) ? $tricycle_phone_number_2 : ''; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default phone number. This field is read-only. To update, please go to Manage Profile.">
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                          <i class="fa-solid fa-info-circle"></i>
                        </span>
                      </div>
                    </div>
                    <div class="col-4 px-4">
                      <label for="address2" class="form-label">Address</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="address2" name="address2" value="<?php echo isset($tricycleData2->address) ? $tricycleData2->address : ''; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default address. This field is read-only. To update, please go to Manage Profile.">
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                          <i class="fa-solid fa-info-circle"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 d-flex mb-2">
                    <div class="col-4 px-4">
                      <label for="mtop_no2" class="form-label">MTOP Number</label>
                      <input type="text" class="form-control" id="mtop_no2" name="mtop_no2" value="<?php echo isset($tricycleData2->mtop_no) ? $tricycleData2->mtop_no : ''; ?>" min="0" required>
                    </div>
                    <div class="col-4 px-4">
                      <label for="color_code2" class="form-label">Color Code</label>
                      <select class="form-control" id="color_code2" name="color_code2" required>
                        <option selected disabled>Please Select Here</option>
                        <option value="Red" data-route-area2="Free Zone / Zone 1" <?php echo (isset($tricycleData2->color_code) && $tricycleData2->color_code == 'Red' ? 'selected' : ''); ?>>Red</option>
                        <option value="Blue" data-route-area2="Free Zone & Zone 2" <?php echo (isset($tricycleData2->color_code) && $tricycleData2->color_code == 'Blue' ? 'selected' : ''); ?>>Blue</option>
                        <option value="Yellow" data-route-area2="Free Zone & Zone 3" <?php echo (isset($tricycleData2->color_code) && $tricycleData2->color_code == 'Yellow' ? 'selected' : ''); ?>>Yellow</option>
                        <option value="Green" data-route-area2="Free Zone & Zone 4" <?php echo (isset($tricycleData2->color_code) && $tricycleData2->color_code == 'Green' ? 'selected' : ''); ?>>Green</option>
                      </select>
                    </div>
                    <div class="col-4 px-4">
                      <label for="route_area2" class="form-label">Route Area</label>
                      <div class="input-group">
                        <input type="text" class="form-control" style="cursor:pointer;" id="route_area2" name="route_area2" placeholder="Select Color Code First" data-toggle="tooltip" data-bs-placement="top" title="Please choose a Color Code to determine the Route Area for the tricycle. This field is read-only." value="<?php echo isset($tricycleData2->route_area) ? $tricycleData2->route_area : ''; ?>" readonly>
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                          <i class="fa-solid fa-info-circle"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 d-flex mb-1">
                    <div class="col-4 px-4">
                      <label for="make_model2" class="form-label">Make Model</label>
                      <input type="text" class="form-control" id="make_model2" name="make_model2" value="<?php echo isset($tricycleData2->make_model) ? $tricycleData2->make_model : ''; ?>" required>
                    </div>
                    <div class="col-4 px-4">
                      <label for="make_model_year_acquired2" class="form-label">Model Year Acquired</label>
                      <input type="text" class="form-control" id="make_model_year_acquired2" name="make_model_year_acquired2" value="<?php echo isset($tricycleData2->make_model_year_acquired) ? $tricycleData2->make_model_year_acquired : ''; ?>" required>
                    </div>
                    <div class="col-4 px-4">
                      <label for="make_model_expiry_date2" class="form-label">Model Expiry Date</label>
                      <input type="date" class="form-control" id="make_model_expiry_date2" name="make_model_expiry_date2" value="<?php echo isset($tricycleData2->make_model_expiry_date) ? $tricycleData2->make_model_expiry_date : ''; ?>" required>
                    </div>
                  </div>

                  <div class="col-12 d-flex mb-2">
                    <div class="col-4 px-4">
                      <label for="motor_number2" class="form-label">Motor Number</label>
                      <input type="text" class="form-control" id="motor_number2" name="motor_number2" value="<?php echo isset($tricycleData2->motor_number) ? $tricycleData2->motor_number : ''; ?>" min="0" required>
                    </div>
                    <div class="col-4 px-4">
                      <label for="insurer2" class="form-label">Insurer</label>
                      <input type="text" class="form-control" id="insurer2" name="insurer2" value="<?php echo isset($tricycleData2->insurer) ? $tricycleData2->insurer : ''; ?>" required>
                    </div>
                    <div class="col-4 px-4">
                      <label for="coc_no2" class="form-label">C.O.C Number</label>
                      <input type="text" class="form-control" id="coc_no2" name="coc_no2" value="<?php echo isset($tricycleData2->coc_no) ? $tricycleData2->coc_no : ''; ?>" min="0" required>
                    </div>
                  </div>

                  <div class="col-12 d-flex mb-5">
                    <div class="col-4 px-4">
                      <label for="coc_no_expiry_date2" class="form-label">C.O.C Expiry Date</label>
                      <input type="date" class="form-control" id="coc_no_expiry_date2" name="coc_no_expiry_date2" value="<?php echo isset($tricycleData2->coc_no_expiry_date) ? $tricycleData2->coc_no_expiry_date : ''; ?>" required>
                    </div>
                    <?php if ($userRole === 'admin'): ?>
                      <div class="col-4 px-4">
                        <label for="tricycle_cin_number_id2" class="form-label">Tricycle CIN</label>
                        <?php if (!empty($availableCinNumbers)): ?>
                          <select class="form-control" id="tricycle_cin_number_id2" name="tricycle_cin_number_id2" required>
                            <option selected disabled>Please Select Here</option>
                            <?php if (!empty($tricycleData2->tricycle_cin_number_id)): ?>
                              <option value="<?= $tricycleData2->tricycle_cin_number_id ?>" selected>
                                <?= isset($cinNumbersById[$tricycleData2->tricycle_cin_number_id]) ? $cinNumbersById[$tricycleData2->tricycle_cin_number_id] : '' ?>
                              </option>
                            <?php endif; ?>

                            <?php foreach ($availableCinNumbers as $cinNumberId => $cinNumber): ?>
                              <?php if ($cinNumberId !== $tricycleData2->tricycle_cin_number_id): ?>
                                <option value="<?= $cinNumberId ?>">
                                  <?= $cinNumber ?>
                                </option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        <?php else: ?>
                          <div class="input-group">
                            <input type="text" class="form-control phone-no" style="cursor: pointer;" id="tricycle_cin_number_id2" name="tricycle_cin_number_id2" value="No available CIN numbers" readonly data-toggle="tooltip" data-bs-placement="top" title="There are no CIN numbers available for New Franchise">
                            <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                              <i class="fa-solid fa-info-circle"></i>
                            </span>
                          </div>
                        <?php endif; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <div class="mt-3">
              <button type="button" class="sidebar-btnContent-1 text-start" onclick="showStep(1)">Previous</button>
              <button type="button" class="sidebar-btnContent text-end" onclick="showStep(3)">Next</button>
            </div>
          </section>
                
          <!-- *** STEP 3 *** -->
          <section id="step-3" style="display: none;">
            <?php if ($userRole === 'operator'): ?>  
              <div class="row assessmentFeeContainer3">
                <div class="col-12 mx-auto text-center mt-4">
                  <p id="assessmentFeeText3" class="text-muted fw-bold fst-italic" style="padding: 10px; border: 1px solid #ff8356; background-color: #fff9ea; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"></p>
                </div>
              </div>
            <?php endif; ?>

            <div class="px-3 pt-2">
              <p class="text-muted fw-bold fst-italic"><span class="text-danger">Note: </span>Please make sure the images are clear and upload all the necessary requirements.</p>
            </div>
            <button class="collapsible fw-bold fs-5 d-flex active-button" id="step3btnform1" onclick="toggleForm('step3form1', 'step3form2')">
              <p class="fs-6">FORM I</p>
              <span class="float-right"><i class="fa-solid fa-circle-chevron-down"></i></span>
            </button>
            <?php if (isset($mtopRequirementData[0])): ?>
              <?php $mtopData1 = $mtopRequirementData[0]; ?>
              <div class="content-3 content-form-3 active-content content-container mt-2 mb-3" id="step3form1">
                <div class="row px-3 p-4">
                  <div class="col-12 d-flex mb-3">
                    <div class="col-4 px-4">
                      <label for="mc_lto_certificate_of_registration" class="form-label">LTO Certificate of Registration (MC of New Unit)</label>
                      <?php
                        if (isset($mtopData1->mc_lto_certificate_of_registration_path) && $mtopData1->mc_lto_certificate_of_registration_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData1->mc_lto_certificate_of_registration_path . '" class="img-fluid rounded fixed-height-image" id="mc_lto_certificate_of_registration" alt="LTO Certificate of Registration (MC of New Unit)">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="mc_lto_certificate_of_registration" data-original-image="' . $mtopData1->mc_lto_certificate_of_registration_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="mc_lto_certificate_of_registration" id="mc_lto_certificate_of_registration-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_mc_lto_certificate_of_registration" value="' . ($mtopData1->mc_lto_certificate_of_registration_path ?? '') . '">';
                      ?>
                    </div>
                    <div class="col-4 px-4">
                      <label for="mc_lto_official_receipt" class="form-label">LTO Official Receipt (MC of New Unit)</label>
                      <?php
                        if (isset($mtopData1->mc_lto_official_receipt_path) && $mtopData1->mc_lto_official_receipt_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData1->mc_lto_official_receipt_path . '" class="img-fluid rounded fixed-height-image" id="mc_lto_official_receipt" alt="LTO Official Receipt (MC of New Unit)">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="mc_lto_official_receipt" data-original-image="' . $mtopData1->mc_lto_official_receipt_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="mc_lto_official_receipt" id="mc_lto_official_receipt-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_mc_lto_official_receipt" value="' . ($mtopData1->mc_lto_official_receipt_path ?? '') . '">';
                      ?>
                    </div>
                    <div class="col-4 px-4">
                      <label for="mc_plate_authorization" class="form-label">Plate Authorization (MC of New Unit)</label>
                      <?php
                        if (isset($mtopData1->mc_lto_official_receipt_path) && $mtopData1->mc_lto_official_receipt_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData1->mc_lto_official_receipt_path . '" class="img-fluid rounded fixed-height-image" id="mc_plate_authorization" alt="Plate Authorization (MC of New Unit)">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="mc_plate_authorization" data-original-image="' . $mtopData1->mc_lto_official_receipt_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="mc_plate_authorization" id="mc_plate_authorization-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_mc_plate_authorization" value="' . ($mtopData1->mc_lto_official_receipt_path ?? '') . '">';
                      ?>
                    </div>
                  </div>
                  <div class="col-12 d-flex mb-3">
                    <div class="col-4 px-4">
                      <label for="tc_insurance_policy" class="form-label">Insurance Policy (TC) (New Owner)</label>
                      <?php
                        if (isset($mtopData1->tc_insurance_policy_path) && $mtopData1->tc_insurance_policy_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData1->tc_insurance_policy_path . '" class="img-fluid rounded fixed-height-image" id="tc_insurance_policy" alt="Insurance Policy (TC) (New Owner)">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="tc_insurance_policy" data-original-image="' . $mtopData1->tc_insurance_policy_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="tc_insurance_policy" id="tc_insurance_policy-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_tc_insurance_policy" value="' . ($mtopData1->tc_insurance_policy_path ?? '') . '">';
                      ?>
                    </div>
                    <div class="col-4 px-4">
                      <label for="unit_front_view_image" class="form-label">Picture of New Unit (Front View)</label>
                      <?php
                        if (isset($mtopData1->unit_front_view_image_path) && $mtopData1->unit_front_view_image_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData1->unit_front_view_image_path . '" class="img-fluid rounded fixed-height-image" id="unit_front_view_image" alt="Picture of New Unit (Front View)">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="unit_front_view_image" data-original-image="' . $mtopData1->unit_front_view_image_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="unit_front_view_image" id="unit_unit_front_view_image-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_unit_front_view_image" value="' . ($mtopData1->unit_front_view_image_path ?? '') . '">';
                      ?>
                    </div>
                    <div class="col-4 px-4">
                      <label for="unit_side_view_image" class="form-label">Picture of New Unit (Side View)</label>
                      <?php
                        if (isset($mtopData1->unit_side_view_image_path) && $mtopData1->unit_side_view_image_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData1->unit_side_view_image_path . '" class="img-fluid rounded fixed-height-image" id="unit_side_view_image" alt="Picture of New Unit (Side View)">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="unit_side_view_image" data-original-image="' . $mtopData1->unit_side_view_image_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="unit_side_view_image" id="unit_side_view_image-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_unit_side_view_image" value="' . ($mtopData1->unit_side_view_image_path ?? '') . '">';
                      ?>
                    </div>
                  </div>
                  <div class="col-12 d-flex mb-3">
                    <div class="col-4 px-4">
                      <label for="sketch_location_of_garage" class="form-label">Sketch Location of Garage</label>
                      <?php
                        if (isset($mtopData1->sketch_location_of_garage_path) && $mtopData1->sketch_location_of_garage_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData1->sketch_location_of_garage_path . '" class="img-fluid rounded fixed-height-image" id="sketch_location_of_garage" alt="Sketch Location of Garage">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="sketch_location_of_garage" data-original-image="' . $mtopData1->sketch_location_of_garage_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="sketch_location_of_garage" id="sketch_location_of_garage-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_sketch_location_of_garage" value="' . ($mtopData1->sketch_location_of_garage_path ?? '') . '">';
                      ?>
                    </div>
                    <div class="col-4 px-4">
                      <label for="affidavit_of_income_tax_return" class="form-label">Affidavit of No Income or Latest Income Tax Return</label>
                      <?php
                        if (isset($mtopData1->affidavit_of_income_tax_return_path) && $mtopData1->affidavit_of_income_tax_return_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData1->affidavit_of_income_tax_return_path . '" class="img-fluid rounded fixed-height-image" id="affidavit_of_income_tax_return" alt="Affidavit of No Income or Latest Income Tax Return">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="affidavit_of_income_tax_return" data-original-image="' . $mtopData1->affidavit_of_income_tax_return_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="affidavit_of_income_tax_return" id="affidavit_of_income_tax_return-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_affidavit_of_income_tax_return" value="' . ($mtopData1->affidavit_of_income_tax_return_path ?? '') . '">';
                      ?>
                    </div>
                    <div class="col-4 px-4">
                      <label for="driver_cert_safety_driving_seminar" class="form-label">Driver's Certificate of Safety Driving Seminar</label>
                      <?php
                        if (isset($mtopData1->driver_cert_safety_driving_seminar_path) && $mtopData1->driver_cert_safety_driving_seminar_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData1->driver_cert_safety_driving_seminar_path . '" class="img-fluid rounded fixed-height-image" id="driver_cert_safety_driving_seminar" alt="Driver\'s Certificate of Safety Driving Seminar">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="driver_cert_safety_driving_seminar" data-original-image="' . $mtopData1->driver_cert_safety_driving_seminar_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="driver_cert_safety_driving_seminar" id="driver_cert_safety_driving_seminar-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_driver_cert_safety_driving_seminar" value="' . ($mtopData1->driver_cert_safety_driving_seminar_path ?? '') . '">';
                      ?>
                    </div>
                  </div>
                  <div class="col-12 d-flex mb-3">
                    <div class="col-4 px-4">
                      <label for="proof_of_id" class="form-label">Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)</label>
                      <?php
                        if (isset($mtopData1->proof_of_id_path) && $mtopData1->proof_of_id_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData1->proof_of_id_path . '" class="img-fluid rounded fixed-height-image" id="proof_of_id" alt="Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="proof_of_id" data-original-image="' . $mtopData1->proof_of_id_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="proof_of_id" id="proof_of_id-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_proof_of_id" value="' . ($mtopData1->proof_of_id_path ?? '') . '">';
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <?php if ($userRole === 'operator'): ?>  
              <div class="row assessmentFeeContainer4">
                <div class="col-12 mx-auto text-center mt-4">
                  <p id="assessmentFeeText4" class="text-muted fw-bold fst-italic" style="padding: 10px; border: 1px solid #ff8356; background-color: #fff9ea; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"></p>
                </div>
              </div>
            <?php endif; ?>
            <button class="collapsible fw-bold fs-5 d-flex" id="step3btnform2" onclick="toggleForm('step3form2', 'step3form1')">
              <p class="fs-6">FORM II</p>
              <span class="float-right"><i class="fa-solid fa-circle-chevron-down"></i></span>
            </button>
            <?php if (isset($mtopRequirementData[1])): ?>
              <?php $mtopData2 = $mtopRequirementData[1]; ?>
              <div class="content-3 content-form-3 content-container mt-2 mb-3" id="step3form2"  style="display:none;">
                <div class="row px-3 p-4">
                  <div class="col-12 d-flex mb-3">
                    <div class="col-4 px-4">
                      <label for="mc_lto_certificate_of_registration" class="form-label">LTO Certificate of Registration (MC of New Unit)</label>
                      <?php
                        if (isset($mc_lto_certificate_of_registration_path) && $mc_lto_certificate_of_registration_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mc_lto_certificate_of_registration_path . '" class="img-fluid rounded fixed-height-image" id="mc_lto_certificate_of_registration" alt="LTO Certificate of Registration (MC of New Unit)">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="mc_lto_certificate_of_registration" data-original-image="' . $mc_lto_certificate_of_registration_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="mc_lto_certificate_of_registration" id="mc_lto_certificate_of_registration-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_mc_lto_certificate_of_registration" value="' . ($mc_lto_certificate_of_registration_path ?? '') . '">';
                      ?>
                    </div>
                    <div class="col-4 px-4">
                      <label for="mc_lto_official_receipt" class="form-label">LTO Official Receipt (MC of New Unit)</label>
                      <?php
                        if (isset($mc_lto_official_receipt_path) && $mc_lto_official_receipt_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mc_lto_official_receipt_path . '" class="img-fluid rounded fixed-height-image" id="mc_lto_official_receipt" alt="LTO Official Receipt (MC of New Unit)">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="mc_lto_official_receipt" data-original-image="' . $mc_lto_official_receipt_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="mc_lto_official_receipt" id="mc_lto_official_receipt-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_mc_lto_official_receipt" value="' . ($mc_lto_official_receipt_path ?? '') . '">';
                      ?>
                    </div>
                    <div class="col-4 px-4">
                      <label for="mc_plate_authorization" class="form-label">Plate Authorization (MC of New Unit)</label>
                      <?php
                        if (isset($mc_plate_authorization_path) && $mc_plate_authorization_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mc_plate_authorization_path . '" class="img-fluid rounded fixed-height-image" id="mc_plate_authorization" alt="Plate Authorization (MC of New Unit)">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="mc_plate_authorization" data-original-image="' . $mc_plate_authorization_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="mc_plate_authorization" id="mc_plate_authorization-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_mc_plate_authorization" value="' . ($mc_plate_authorization_path ?? '') . '">';
                      ?>
                    </div>
                  </div>
                  <div class="col-12 d-flex mb-3">
                    <div class="col-4 px-4">
                      <label for="tc_insurance_policy" class="form-label">Insurance Policy (TC) (New Owner)</label>
                      <?php
                        if (isset($mtopData2->tc_insurance_policy_path) && $mtopData2->tc_insurance_policy_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData2->tc_insurance_policy_path . '" class="img-fluid rounded fixed-height-image" id="tc_insurance_policy" alt="Insurance Policy (TC) (New Owner)">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="tc_insurance_policy" data-original-image="' . $mtopData2->tc_insurance_policy_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="tc_insurance_policy" id="tc_insurance_policy-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_tc_insurance_policy" value="' . ($mtopData2->tc_insurance_policy_path ?? '') . '">';
                      ?>
                    </div>
                    <div class="col-4 px-4">
                      <label for="unit_front_view_image" class="form-label">Picture of New Unit (Front View)</label>
                      <?php
                        if (isset($mtopData2->unit_front_view_image_path) && $mtopData2->unit_front_view_image_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData2->unit_front_view_image_path . '" class="img-fluid rounded fixed-height-image" id="unit_front_view_image" alt="Picture of New Unit (Front View)">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="unit_front_view_image" data-original-image="' . $mtopData2->unit_front_view_image_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="unit_front_view_image" id="unit_unit_front_view_image-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_unit_front_view_image" value="' . ($mtopData2->unit_front_view_image_path ?? '') . '">';
                      ?>
                    </div>
                    <div class="col-4 px-4">
                      <label for="unit_side_view_image" class="form-label">Picture of New Unit (Side View)</label>
                      <?php
                        if (isset($mtopData2->unit_side_view_image_path) && $mtopData2->unit_side_view_image_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData2->unit_side_view_image_path . '" class="img-fluid rounded fixed-height-image" id="unit_side_view_image" alt="Picture of New Unit (Side View)">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="unit_side_view_image" data-original-image="' . $mtopData2->unit_side_view_image_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="unit_side_view_image" id="unit_side_view_image-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_unit_side_view_image" value="' . ($mtopData2->unit_side_view_image_path ?? '') . '">';
                      ?>
                    </div>
                  </div>
                  <div class="col-12 d-flex mb-3">
                    <div class="col-4 px-4">
                      <label for="sketch_location_of_garage" class="form-label">Sketch Location of Garage</label>
                      <?php
                        if (isset($mtopData2->sketch_location_of_garage_path) && $mtopData2->sketch_location_of_garage_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData2->sketch_location_of_garage_path . '" class="img-fluid rounded fixed-height-image" id="sketch_location_of_garage" alt="Sketch Location of Garage">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="sketch_location_of_garage" data-original-image="' . $mtopData2->sketch_location_of_garage_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="sketch_location_of_garage" id="sketch_location_of_garage-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_sketch_location_of_garage" value="' . ($mtopData2->sketch_location_of_garage_path ?? '') . '">';
                      ?>
                    </div>
                    <div class="col-4 px-4">
                      <label for="affidavit_of_income_tax_return" class="form-label">Affidavit of No Income or Latest Income Tax Return</label>
                      <?php
                        if (isset($mtopData2->affidavit_of_income_tax_return_path) && $mtopData2->affidavit_of_income_tax_return_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData2->affidavit_of_income_tax_return_path . '" class="img-fluid rounded fixed-height-image" id="affidavit_of_income_tax_return" alt="Affidavit of No Income or Latest Income Tax Return">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="affidavit_of_income_tax_return" data-original-image="' . $mtopData2->affidavit_of_income_tax_return_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="affidavit_of_income_tax_return" id="affidavit_of_income_tax_return-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_affidavit_of_income_tax_return" value="' . ($mtopData2->affidavit_of_income_tax_return_path ?? '') . '">';
                      ?>
                    </div>
                    <div class="col-4 px-4">
                      <label for="driver_cert_safety_driving_seminar" class="form-label">Driver's Certificate of Safety Driving Seminar</label>
                      <?php
                        if (isset($mtopData2->driver_cert_safety_driving_seminar_path) && $mtopData2->driver_cert_safety_driving_seminar_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData2->driver_cert_safety_driving_seminar_path . '" class="img-fluid rounded fixed-height-image" id="driver_cert_safety_driving_seminar" alt="Driver\'s Certificate of Safety Driving Seminar">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="driver_cert_safety_driving_seminar" data-original-image="' . $mtopData2->driver_cert_safety_driving_seminar_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="driver_cert_safety_driving_seminar" id="driver_cert_safety_driving_seminar-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_driver_cert_safety_driving_seminar" value="' . ($mtopData2->driver_cert_safety_driving_seminar_path ?? '') . '">';
                      ?>
                    </div>
                  </div>
                  <div class="col-12 d-flex mb-3">
                    <div class="col-4 px-4">
                      <label for="proof_of_id" class="form-label">Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)</label>
                      <?php
                        if (isset($mtopData2->proof_of_id_path) && $mtopData2->proof_of_id_path) {
                          echo '<div class="image-container position-relative">';
                          echo '<img src="' . $mtopData2->proof_of_id_path . '" class="img-fluid rounded fixed-height-image" id="proof_of_id" alt="Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)">';
                          echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="proof_of_id" data-original-image="' . $mtopData2->proof_of_id_path . '"></button>';
                          echo '</div>';
                        } else {
                          echo '<div class="image-container">';
                          echo '<input class="form-control" type="file" name="proof_of_id" id="proof_of_id-input" accept="image/*" required>';
                          echo '</div>';
                        }
                      ?>
                      <?php
                        echo '<input type="hidden" name="original_proof_of_id" value="' . ($mtopData2->proof_of_id_path ?? '') . '">';
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <div class="mt-3">
              <button type="button" class="sidebar-btnContent-1 text-start" onclick="showStep(2)">Previous</button>
              <button type="submit" class="sidebar-btnContent" name="update_new_franchise" id="update_new_franchise">Update</button>
              <a href="./appointments" class="cancel-btn">Cancel</a>
            </div>
          </section>
        </div>
      </form>
    </div>
  </div>
</main>

<!-- Confirmation Modal -->
<div class="modal fade" id="deleteImageModal" tabindex="-1" aria-labelledby="deleteImageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteImageModalLabel">Delete Image Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this image?
      </div>
      <div class="modal-footer">
        <form method="POST" action="">
          <input type="hidden" name="image_type" id="imageTypeInput">
          <input type="hidden" name="original_image_path" id="originalImagePathInput">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" name="confirm_delete_image">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="public/assets/js/appointments_form_toggle2.js"></script>
<script>
  $(document).ready(function () {
    function updateAssessmentFee(colorCodeId, routeAreaDataAttr, containerId) {
      let selectedRouteArea = $(colorCodeId).find(":selected").data(routeAreaDataAttr);
      let assessmentFeeText = "";

      switch (selectedRouteArea) {
        case "Free Zone / Zone 1":
          assessmentFeeText = "The assessment fee for processing your tricycle application within the Free Zone or Zone 1 route is ₱430.00.";
          break;
        case "Free Zone & Zone 2":
        case "Free Zone & Zone 3":
        case "Free Zone & Zone 4":
          assessmentFeeText = "The assessment fee for processing your tricycle application within the " + selectedRouteArea + " route is ₱1,030.00.";
          break;
        default:
          assessmentFeeText = "Please select a route area to view the assessment fee.";
      }

      // Display the assessment fee text and toggle visibility of assessment fee container
      $(containerId).text(assessmentFeeText.trim());
      if (assessmentFeeText.trim() === "") {
        $(containerId).closest(".assessmentFeeContainer").hide();
      } else {
        $(containerId).closest(".assessmentFeeContainer").show();
      }
    }

    $("#color_code, #color_code2").change(function () {
      let colorCodeId = "#" + $(this).attr("id");
      let routeAreaDataAttr = (colorCodeId === "#color_code") ? "route-area" : "route-area2";
      let containerId = (colorCodeId === "#color_code") ? "#assessmentFeeText, #assessmentFeeText3" : "#assessmentFeeText2, #assessmentFeeText4";
      updateAssessmentFee(colorCodeId, routeAreaDataAttr, containerId);
    });

    // Hide the assessment fee container initially
    $(".assessmentFeeContainer").hide();

    // Scroll to the main appointment form in case of error
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

    // Add 'active' class to the clicked step button and all preceding step buttons
    for (let i = 0; i < step; i++) {
      stepButtons[i].classList.add('active');
    }

    // Scroll to the step buttons container if it exists
    if (stepButtonsContainer) {
      stepButtonsContainer.scrollIntoView({ behavior: 'smooth' });
    }

    // Maintain active state of forms
    const activeForm = document.querySelector('.content.active-content');
    if (activeForm) {
      activeForm.style.display = 'block';
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
</script>