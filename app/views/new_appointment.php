<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content" id="formContainer">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Schedule New Appointment</h6>
    </div>
    <div class="col-lg-12 mt-4">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4">
            <div id="newAppointmentForm">
              <div class="content-container mt-2 p-3" style="<?php echo ($currentSection === 0) ? 'display: block;' : 'display: none;'; ?>">
                <h6 class="pl-2 text-uppercase text-center">Appointment Information</h6>
                <form class="default-form" method="POST" action="" id="appointmentInformationForm">
                  <div class="container">
                    <div class="d-flex justify-content-center">
                      <div class="row px-3">
                        <div class="col-12 p-4">
                          <div class="row mt-3">
                            <div class="col-6">
                              <label for="name" class="form-label">Full Name</label>
                              <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>
                            </div>

                            <div class="col-6">
                              <label for="phone_number" class="form-label">Phone Number</label>
                              <div class="input-group">
                                <span class="input-group-text">+63</span>
                                <input type="text" class="form-control phone-no" id="phone_number" name="phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['phone_number']) ? $_POST['phone_number'] : ''; ?>" required>
                              </div>
                            </div>
                          </div>
                        
                            
                          <div class="col-12">
                            <div class="row mt-4">
                              <div class="col-6">
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

                              <div class="col-6">
                                <label for="email" class="form-label">Email (Optional)</label>
                                <div class="input-group">
                                  <input type="email" class="form-control phone-no" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                                </div>
                              </div>
                            </div>
                          </div>

                        <div class="col-12">
                          <div class="row mt-4">
                            <div class="col-6">
                              <label for="appointment_date" class="form-label">Preferred Date</label>
                              <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="<?php echo isset($_POST['appointment_date']) ? $_POST['appointment_date'] : ''; ?>" required>
                            </div>

                            <div class="col-6">
                              <label for="appointment_time" class="form-label">Preferred Time</label>
                              <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="<?php echo isset($_POST['appointment_time']) ? $_POST['appointment_time'] : ''; ?>" required>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

              <div class="content-container p-3" style="<?php echo ($currentSection === 1) ? 'display: block;' : 'display: none;'; ?>">
                <h6 class="pl-2 text-uppercase">Tricycle Application Form</h6>
                <form class="default-form" method="POST" action="" id="tricycleApplicationForm">
                  <div class="container">
                    <div class="d-flex justify-content-center">
                      <div class="row px-3">
                        <div class="col-12">
                          <div class="row mt-3">
                            <div class="col-4">
                              <label for="operator_name" class="form-label">Name of Operator</label>
                              <input type="text" class="form-control" id="operator_name" name="operator_name" value="<?php echo isset($_POST['operator_name']) ? $_POST['operator_name'] : ''; ?>" required>
                            </div>

                            <div class="col-4">
                              <label for="tricycle_phone_number" class="form-label">Contact</label>
                              <div class="input-group">
                                <span class="input-group-text">+63</span>
                                <input type="text" class="form-control phone-no" id="tricycle_phone_number" name="tricycle_phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['tricycle_phone_number']) ? $_POST['tricycle_phone_number'] : ''; ?>" required>
                              </div>
                            </div>

                            <div class="col-4">
                              <label for="address" class="form-label">Address</label>
                              <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>" required>
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="row mt-3">
                            <div class="col-4">
                              <label for="mtop_no" class="form-label">MTOP Number</label>
                              <input type="text" class="form-control" id="mtop_no" name="mtop_no" value="<?php echo isset($_POST['mtop_no']) ? $_POST['mtop_no'] : ''; ?>" min="0" required>
                            </div>

                            <div class="col-4">
                              <label for="route_area" class="form-label">Route / Zone</label>
                              <select class="form-control" id="route_area" name="route_area" required>
                                <option selected disabled>Please Select Here</option>
                                <option value="Free Zone / Zone 1" data-color-code="Red">Free Zone / Zone 1</option>
                                <option value="Free Zone & Zone 2" data-color-code="Green">Free Zone & Zone 2</option>
                                <option value="Free Zone & Zone 3" data-color-code="Yellow">Free Zone & Zone 3</option>
                                <option value="Free Zone & Zone 4" data-color-code="Blue">Free Zone & Zone 4</option>
                              </select>
                            </div>

                            <div class="col-4">
                              <label for="color_code" class="form-label">Color Code</label>
                              <input type="text" class="form-control" id="color_code" name="color_code" placeholder="Please select a route/zone" value="<?php echo isset($_POST['color_code']) ? ($_POST['color_code']) : ''; ?>" readonly required>
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="row mt-3">
                            <div class="col-4">
                              <label for="make_model" class="form-label">Make Model</label>
                              <input type="text" class="form-control" id="make_model" name="make_model" value="<?php echo isset($_POST['make_model']) ? $_POST['make_model'] : ''; ?>" required>
                            </div>

                            <div class="col-4">
                              <label for="make_model_expiry_date" class="form-label">Model Expiry Date</label>
                              <input type="date" class="form-control" id="make_model_expiry_date" name="make_model_expiry_date" value="<?php echo isset($_POST['make_model_expiry_date']) ? $_POST['make_model_expiry_date'] : ''; ?>" required>
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="row mt-5">
                            <div class="col-4">
                              <label for="motor_number" class="form-label">Motor Number</label>
                              <input type="text" class="form-control" id="motor_number" name="motor_number" value="<?php echo isset($_POST['motor_number']) ? $_POST['motor_number'] : ''; ?>" min="0" required>
                            </div>

                            <div class="col-4">
                              <label for="insurer" class="form-label">Insurer</label>
                              <input type="text" class="form-control" id="insurer" name="insurer" value="<?php echo isset($_POST['insurer']) ? $_POST['insurer'] : ''; ?>" required>
                            </div>

                            <div class="col-4">
                              <label for="chasis_number" class="form-label">Chasis Number</label>
                              <input type="text" class="form-control" id="chasis_number" name="chasis_number" value="<?php echo isset($_POST['chasis_number']) ? $_POST['chasis_number'] : ''; ?>" min="0" required>
                            </div>

                            <div class="col-4 mt-3">
                              <label for="coc_no" class="form-label">C.O.C Number</label>
                              <input type="text" class="form-control" id="coc_no" name="coc_no" value="<?php echo isset($_POST['coc_no']) ? $_POST['coc_no'] : ''; ?>" min="0" required>
                            </div>

                            <div class="col-4 mt-3">
                              <label for="coc_no_expiry_date" class="form-label">C.O.C Expiry Date</label>
                              <input type="date" class="form-control" id="coc_no_expiry_date" name="coc_no_expiry_date" value="<?php echo isset($_POST['coc_no_expiry_date']) ? $_POST['coc_no_expiry_date'] : ''; ?>" required>
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="row mt-5">
                            <div class="col-4">
                              <label for="plate_number" class="form-label">Plate Number</label>
                              <input type="text" class="form-control" id="plate_number" name="plate_number" value="<?php echo isset($_POST['plate_number']) ? $_POST['plate_number'] : ''; ?>" min="0" required>
                            </div>

                            <div class="col-4">
                              <label for="lto_cr_no" class="form-label">LTO CR Number</label>
                              <input type="text" class="form-control" id="lto_cr_no" name="lto_cr_no" value="<?php echo isset($_POST['lto_cr_no']) ? $_POST['lto_cr_no'] : ''; ?>" required>
                            </div>

                            <div class="col-4">
                              <label for="lto_or_no" class="form-label">LTO OR Number</label>
                              <input type="text" class="form-control" id="lto_or_no" name="lto_or_no" value="<?php echo isset($_POST['lto_or_no']) ? $_POST['lto_or_no'] : ''; ?>" required>
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="row mt-3">
                            <div class="col-4">
                              <label for="driver_name" class="form-label">Name of Driver</label>
                              <input type="text" class="form-control" id="driver_name" name="driver_name" value="<?php echo isset($_POST['driver_name']) ? $_POST['driver_name'] : ''; ?>" required>
                            </div>

                            <div class="col-4">
                              <label for="driver_license_no" class="form-label">Driver License Number</label>
                              <input type="text" class="form-control" id="driver_license_no" name="driver_license_no" value="<?php echo isset($_POST['driver_license_no']) ? $_POST['driver_license_no'] : ''; ?>" required>
                            </div>

                            <div class="col-4">
                              <label for="driver_license_expiry_date" class="form-label">License Expiry Date</label>
                              <input type="date" class="form-control" id="driver_license_expiry_date" name="driver_license_expiry_date" value="<?php echo isset($_POST['driver_license_expiry_date']) ? $_POST['driver_license_expiry_date'] : ''; ?>" required>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <div class="text-end my-5">
                <button type="button" class="d-none" id="submitBothFormsButton">Submit Both Forms</button>
                <button type="button" class="sidebar-btnContent sched-button d-none">Schedule Appointment</button>
                <button type="button" class="sidebar-btnContent next-button d-none mt-5 px-4">Next</button>
                <button type="button" class="sidebar-btnContent prev-button d-none" style="margin-right: 10px;">Previous</button> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const formSections = document.querySelectorAll(".content-container");
    const nextButtons = document.querySelectorAll(".next-button");
    const prevButtons = document.querySelectorAll(".prev-button");
    const schedButton = document.querySelector(".sched-button");
    const submitButton = document.getElementById("submitBothFormsButton");
    const routeArea = document.getElementById("route_area");
    const colorCodeInput = document.getElementById("color_code");

    let currentSectionIndex = <?php echo $currentSection; ?>;

    function showSection(index) {
      formSections.forEach((section, idx) => {
        section.style.display = idx === index ? "block" : "none";
      });

      if (index === 0) {
        nextButtons[0].classList.remove("d-none");
        prevButtons[0].classList.add("d-none");
        schedButton.classList.add("d-none");
      } else if (index === formSections.length - 1) {
        nextButtons[0].classList.add("d-none");
        prevButtons[0].classList.remove("d-none");
        schedButton.classList.remove("d-none");
      } else {
        nextButtons[0].classList.remove("d-none");
        prevButtons[0].classList.remove("d-none");
        schedButton.classList.add("d-none");
      }
    }

    nextButtons[0].addEventListener("click", function (event) {
      event.preventDefault();

      const formData = new FormData(document.getElementById("appointmentInformationForm"));
      formData.append('formType', 'appointmentForm');

      $.ajax({
        url: "new_appointment",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
          if (response.status === 'error') {
            showFlashMessage(response.msg, 'error');         
          } else if (response.status === 'success') {
            currentSectionIndex = Math.min(currentSectionIndex + 1, formSections.length - 1);
            showSection(currentSectionIndex);
            updateURL(currentSectionIndex);
          }
        },
        error: function (error) {
          console.log(error);
          document.getElementById("formContainer").scrollIntoView({
              behavior: "smooth",
              block: "start"
            });
          showFlashMessage("An error occurred", 'error'); 
        }
      });
    });

    schedButton.addEventListener("click", function (event) {
      event.preventDefault();
      
      const triycleApplicationForm = document.getElementById("tricycleApplicationForm");
      const formData = new FormData(triycleApplicationForm);
      formData.append('formType', 'tricycleApplicationForm');

      $.ajax({
        url: "new_appointment",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
          if (response.status === 'error') {
            document.getElementById("formContainer").scrollIntoView({
              behavior: "smooth",
              block: "start"
            });
            showFlashMessage(response.msg, 'error');         
          } else if (response.status === 'success') {
            const appointmentForm = document.getElementById("appointmentInformationForm");
            const tricycleForm = document.getElementById("tricycleApplicationForm");
            
            const combinedFormData = new FormData();
            combinedFormData.append('appointmentInformationForm', new FormData(appointmentForm));
            combinedFormData.append('tricycleApplicationForm', new FormData(tricycleForm));
            combinedFormData.append('formType', 'bothForms');
            
            $.ajax({
              url: "new_appointment",
              method: "POST",
              data: combinedFormData,
              processData: false,
              contentType: false,
              dataType: 'json',
              success: function (response) {
                if (response.status === 'error') {
                  document.getElementById("formContainer").scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                  });
                  showFlashMessage(response.msg, 'error');
                  window.location.href = response.redirect_url;
                } else if (response.status === 'success') {
                  showFlashMessage(response.msg, response.status);
                }
              },
              error: function (error) {
                console.log(error);
                document.getElementById("formContainer").scrollIntoView({
                  behavior: "smooth",
                  block: "start"
                });
                showFlashMessage("An error occurred (both forms submission", 'error'); 
              }
            });
          }
        },
        error: function (error) {
          console.log(error);
          document.getElementById("formContainer").scrollIntoView({
            behavior: "smooth",
            block: "start"
          });
          showFlashMessage("An error occurred", 'error'); 
        }
      });
    });

    prevButtons[0].addEventListener("click", function (event) {
      event.preventDefault();
      currentSectionIndex = Math.max(currentSectionIndex - 1, 0);
      showSection(currentSectionIndex);
      updateURL(currentSectionIndex);
    });

    function updateURL(sectionIndex) {
      const newURL = window.location.origin + window.location.pathname + "?section=" + sectionIndex;
      window.history.pushState(null, "", newURL);
    }

    routeArea.addEventListener("change", function () {
      const selectedRouteArea = $(this).find(":selected");
      const colorCode = selectedRouteArea.data("color-code");
      colorCodeInput.value = colorCode;
    });

    showSection(currentSectionIndex);

    function showFlashMessage(message, type) {
      const flashMessage = document.getElementById("flashMessage");
      flashMessage.textContent = message;
      flashMessage.className = `flash-message ${type}`;
      flashMessage.style.display = "block";

      setTimeout(function () {
        flashMessage.style.display = "none";
      }, 5000);
    }
  });

  window.addEventListener('beforeunload', function (event) {
  window.location.href = 'new_appointment';
});

</script>