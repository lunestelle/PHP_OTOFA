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

  <div class="col-12 text-uppercase nav-top" id="mainAppointmentForm">
    <h6 class="title-head">Schedule <span class="mx-2" style="color:#ff8356;">New Franchise</span> Appointment</h6>
  </div>
  <?php if ($userRole === 'operator'): ?>  
    <div class="row assessmentFeeContainer">
      <div class="col-12 mx-auto text-center mt-1">
        <p id="assessmentFeeText" class="text-muted fw-bold fst-italic" style="padding: 10px; border: 1px solid #ff8356; background-color: #fff9ea; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"></p>
      </div>
    </div>
  <?php endif; ?>
  
  <form class="default-form" method="POST" action="" enctype="multipart/form-data" id="appointmentForm">
    <section id="step-3" style="display: none;">
      <div class="row">
        <div class="col-12 text-uppercase nav-top" id="mainAppointmentForm">
          <h6 class="title-head">Schedule <span class="mx-2" style="color:#ff8356;">New Franchise</span> Appointment</h6>
        </div>
        <div class="col-lg-12 mt-5">
          <div class="content-container">
            <!-- <div class="bckgrnd pt-2">
                <h6 class="text-uppercase text-center text-light fs-6">MTOP Requirements Images</h6>
            </div> -->
          <div class="px-3 pt-2 mt-2">
              <p class="text-muted fw-bold fst-italic"><span class="text-danger">Note: </span>Please ensure all uploaded images are clear for better processing.</p>
          </div>
          <div class="row px-3 p-2 justify-content-center">
            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-4">
                <label for="mc_lto_certificate_of_registration" class="form-label appointment-label">LTO Certificate of Registration (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_lto_certificate_of_registration" name="mc_lto_certificate_of_registration" accept="image/*" required/>
              </div>
              <div class="col-4 px-4">
                <label for="mc_lto_official_receipt" class="form-label appointment-label">LTO Official Receipt (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_lto_official_receipt" name="mc_lto_official_receipt" accept="image/*" required/>
              </div>
              <div class="col-4 px-4">
                <label for="mc_plate_authorization" class="form-label appointment-label">Plate Authorization (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_plate_authorization" name="mc_plate_authorization" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-4 mt-3">
                <label for="tc_insurance_policy" class="form-label appointment-label">Insurance Policy (TC) (New Owner)</label>
                <input type="file" class="form-control" id="tc_insurance_policy" name="tc_insurance_policy" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3">
                <label for="unit_front_view_image" class="form-label appointment-label">Picture of New Unit (Front View)</label>
                <input type="file" class="form-control" id="unit_front_view_image" name="unit_front_view_image" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3">
                <label for="unit_side_view_image" class="form-label appointment-label">Picture of New Unit (Side View)</label>
                <input type="file" class="form-control" id="unit_side_view_image" name="unit_side_view_image" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-4 mt-3 tricycle-fields">
                <label for="sketch_location_of_garage" class="form-label appointment-label">Sketch Location of Garage</label>
                <input type="file" class="form-control" id="sketch_location_of_garage" name="sketch_location_of_garage" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3 tricycle-fields">
                <label for="affidavit_of_income_tax_return" class="form-label appointment-label">Affidavit of No Income or Latest Income Tax Return</label>
                <input type="file" class="form-control" id="affidavit_of_income_tax_return" name="affidavit_of_income_tax_return" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3 tricycle-fields">
                <label for="driver_cert_safety_driving_seminar" class="form-label appointment-label">Driver's Certificate of Safety Driving Seminar</label>
                <input type="file" class="form-control" id="driver_cert_safety_driving_seminar" name="driver_cert_safety_driving_seminar" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="col-4 pb-4 px-4 mt-3 tricycle-fields">
                <label for="proof_of_id" class="form-label appointment-label">Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)</label>
                <input type="file" class="form-control" id="proof_of_id" name="proof_of_id" accept="image/*" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="my-3 mt-3">
          <button type="button" class="text-start sidebar-btnContent-1" onclick="showStep(2)">Previous</button>
          <button type="submit" class="text-end sidebar-btnContent" name="schedule_appointment" id="scheduleAppointmentBtn">Schedule Appointment</button>
        </div>
      </div>
    </section>

    <section id="step-2" style="display: none;">
      <div class="row">
        <!-- <div class="col-12 text-uppercase nav-top" id="mainAppointmentForm">
            <h6 class="title-head">Schedule New Appointmentrm</h6>
        </div> -->
        <div class="col-lg-12 mt-5">
          <div class="content-container">
            <!-- <div class="bckgrnd pt-2">
              <h6 class="text-uppercase text-center text-light fs-6">Tricycle Application Form</h6>
            </div> -->
            <div class="col-12 d-flex mb-1 mt-2">
              <div class="col-4 px-5 mt-3">
                <label for="operator_name" class="form-label">Name of Operator</label>
                <div class="input-group">
                  <input type="text" class="form-control phone-no" style="cursor: pointer;" id="operator_name" name="operator_name" value="<?php echo isset($_POST['operator_name']) ? $_POST['operator_name'] : $fullName; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default operator name. This field is read-only. To update, please go to Manage Profile.">
                  <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                    <i class="fa-solid fa-info-circle"></i>
                  </span>
                </div>
              </div>
              <div class="col-4 px-5 mt-3">
                <label for="tricycle_phone_number" class="form-label">Phone Number</label>
                <div class="input-group">
                  <span class="input-group-text">+63</span>
                  <input type="text" class="form-control phone-no" style="cursor: pointer;" id="tricycle_phone_number" name="tricycle_phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['tricycle_phone_number']) ? $_POST['tricycle_phone_number'] : $userPhoneNo; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default phone number. This field is read-only. To update, please go to Manage Profile.">
                  <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                    <i class="fa-solid fa-info-circle"></i>
                  </span>
                </div>
              </div>
              <div class="col-4 px-5 mt-3">
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
                <label for="make_model_year_acquired" class="form-label">Model Year Acquired</label>
                <input type="text" class="form-control text-uppercase" id="make_model_year_acquired" name="make_model_year_acquired" value="<?php echo isset($_POST['make_model_year_acquired']) ? $_POST['make_model_year_acquired'] : ''; ?>" required>
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
          <div class="mt-3">
            <button type="button" class="sidebar-btnContent-1 text-start" onclick="showStep(1)">Previous</button>
            <button type="button" class="sidebar-btnContent text-end" onclick="showStep(3)">Next</button>
          </div>    
        </div>
      </div>
    </section>

    <section id="step-1">
      <div class="row">
        <!-- <div class="col-12 text-uppercase nav-top" id="mainAppointmentForm">
            <h6 class="title-head">Schedule New Appointment</h6>
        </div> -->
        <div class="col-lg-12 mt-5">
          <div class="content-container pb-3">
              <!-- <div class="bckgrnd pt-2">
                  <h6 class="text-uppercase text-center text-light fs-6">Appointment Information</h6>
              </div>           -->
              <div class="col-12 d-flex mb-1">
                <div class="col-4 px-5 my-3">
                  <label for="name" class="form-label">Full Name</label>
                  <div class="input-group">
                    <input type="text" class="form-control phone-no" style="cursor: pointer;" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $fullName; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default appointment full name. This field is read-only. To update, please go to Manage Profile.">
                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                      <i class="fa-solid fa-info-circle"></i>
                    </span>
                  </div>
                </div>
                <div class="col-4 px-5 my-3">
                  <label for="phone_number" class="form-label">Phone Number</label>
                  <div class="input-group">
                    <span class="input-group-text">+63</span>
                    <input type="text" class="form-control phone-no" style="cursor: pointer;" id="phone_number" name="phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['phone_number']) ? $_POST['phone_number'] : $userPhoneNo; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default phone number. This field is read-only. To update, please go to Manage Profile.">
                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                      <i class="fa-solid fa-info-circle"></i>
                    </span>
                  </div>
                </div>
                <div class="col-4 px-5 my-3">
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
                    <input type="text" class="form-control" style="cursor: pointer;" id="appointment_type" name="appointment_type" value="New Franchise" data-toggle="tooltip" data-bs-placement="top" title="Default appointment type. This field is read-only." readonly>
                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                      <i class="fa-solid fa-info-circle"></i>
                    </span>
                  </div>
                </div>
                <div class="col-4 px-5">
                  <label for="appointment_date" class="form-label">Preferred Date</label>
                  <div class="input-group">
                    <input type="text" class="form-control" style="cursor: pointer;" id="appointment_date" name="appointment_date" value="<?php echo isset($_POST['appointment_date']) ? $_POST['appointment_date'] : (isset($_GET['appointmentDate']) ? $_GET['appointmentDate'] : ''); ?>" data-toggle="tooltip" data-bs-placement="top" title="Default appointment date. This field is read-only." readonly>
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
                    ?>
                    <input type="text" class="form-control" style="cursor: pointer;" id="appointment_time" name="appointment_time" value="<?php echo isset($_POST['appointment_time']) ? formatAppointmentTime($_POST['appointment_time']) : (isset($_GET['appointmentTime']) ? formatAppointmentTime($_GET['appointmentTime']) : ''); ?>" data-toggle="tooltip" data-bs-placement="top" title="Default appointment date. This field is read-only." readonly>
                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                      <i class="fa-solid fa-info-circle"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-end mt-3">
            <button type="button" class="sidebar-btnContent" onclick="showStep(2)">Next</button>
          </div>
        </div>
      </div>
    </section>
  </form>
</main>

<script>
    $(document).ready(function () {
    // Function to toggle the visibility of assessment fee container
    function toggleAssessmentFeeContainer() {
      let assessmentText = $("#assessmentFeeText").text().trim();
      if (assessmentText === "") {
        $(".assessmentFeeContainer").hide();
      } else {
        $(".assessmentFeeContainer").show();
      }
    }

    $("#color_code").change(function () {
      let selectedColorCode = $(this).val();
      let selectedRouteArea = $("#color_code").find(":selected").data("route-area");
      $("#route_area").val(selectedRouteArea);

      // Update assessment fee text based on the selected route area
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

      // Display the assessment fee text
      $("#assessmentFeeText").text(assessmentFeeText);

      // Toggle visibility of assessment fee container
      toggleAssessmentFeeContainer();
    });

    // Hide the assessment fee container initially
    toggleAssessmentFeeContainer();

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
        for (let i = 1; i <= 3; i++) {
            document.getElementById('step-' + i).style.display = 'none';
        }
        document.getElementById('step-' + step).style.display = 'block';

        // Remove 'active' class from all step buttons
        document.querySelectorAll('.step-button').forEach((button) => {
            button.classList.remove('active');
        });

        // Add 'active' class to the clicked step button
        document.querySelector('.step-button[data-target="#step-' + step + '"]').classList.add('active');
    }

    const stepButtons = document.querySelectorAll('.step-button');
    const progress = document.querySelector('#progress');

    Array.from(stepButtons).forEach((button, index) => {
        button.addEventListener('click', () => {
            progress.setAttribute('value', index * 100 / (stepButtons.length - 1)); // there are 3 buttons. 2 spaces.

            stepButtons.forEach((item, secindex) => {
                if (index > secindex) {
                    item.classList.add('done');
                }
                if (index < secindex) {
                    item.classList.remove('done');
                }
            });

            // Add 'active' class to the clicked step button
            button.classList.add('active');
        });
    });
</script>