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

  <form class="default-form" method="POST" action="" enctype="multipart/form-data" id="appointmentForm">
    <!-- *** STEP 3 *** -->
    <section id="step-3" style="display: none;">
      <div class="col-lg-12">
        <div class="px-3 pt-1 mt-3">
          <p class="text-muted fw-bold fst-italic"><span class="text-danger">Note: </span>Please make sure the images are clear and upload all the necessary requirements.</p>
        </div>

        <?php if ($userRole === 'operator'): ?>  
          <div class="row assessmentFeeContainer4">
            <div class="col-12 mx-auto text-center mt-2">
              <p id="assessmentFeeText4" class="text-muted fw-bold fst-italic" style="padding: 10px; border: 1px solid #ff8356; background-color: #fff9ea; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"></p>
            </div>
          </div>
        <?php endif; ?>

        <button type="button" class="collapsible fw-bold fs-5 d-flex active-button" id="step3btnform1" onclick="toggleForm('step3form1', ['step3form2', 'step3form3'])">
          <p class="fs-6">FORM I</p>
          <span class="float-right"><i class="fa-solid fa-circle-chevron-down"></i></span>
        </button>
        <div class="content-3 content-form-3 active-content content-container mt-2 mb-3" id="step3form1">
          <div class="row px-3 p-2 justify-content-center">
            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-4">
                <label for="mc_lto_certificate_of_registration1" class="form-label appointment-label">LTO Certificate of Registration (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_lto_certificate_of_registration1" name="mc_lto_certificate_of_registration1" accept="image/*" required/>
              </div>
              <div class="col-4 px-4">
                <label for="mc_lto_official_receipt1" class="form-label appointment-label">LTO Official Receipt (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_lto_official_receipt1" name="mc_lto_official_receipt1" accept="image/*" required/>
              </div>
              <div class="col-4 px-4">
                <label for="mc_plate_authorization1" class="form-label appointment-label">Plate Authorization (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_plate_authorization1" name="mc_plate_authorization1" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-4 mt-3">
                <label for="tc_insurance_policy1" class="form-label appointment-label">Insurance Policy (TC) (New Owner)</label>
                <input type="file" class="form-control" id="tc_insurance_policy1" name="tc_insurance_policy1" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3">
                <label for="unit_front_view_image1" class="form-label appointment-label">Picture of New Unit (Front View)</label>
                <input type="file" class="form-control" id="unit_front_view_image1" name="unit_front_view_image1" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3">
                <label for="unit_side_view_image1" class="form-label appointment-label">Picture of New Unit (Side View)</label>
                <input type="file" class="form-control" id="unit_side_view_image1" name="unit_side_view_image1" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-4 mt-3 tricycle-fields">
                <label for="sketch_location_of_garage1" class="form-label appointment-label">Sketch Location of Garage</label>
                <input type="file" class="form-control" id="sketch_location_of_garage1" name="sketch_location_of_garage1" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3 tricycle-fields">
                <label for="affidavit_of_income_tax_return1" class="form-label appointment-label">Affidavit of No Income or Latest Income Tax Return</label>
                <input type="file" class="form-control" id="affidavit_of_income_tax_return1" name="affidavit_of_income_tax_return1" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3 tricycle-fields">
                <label for="driver_cert_safety_driving_seminar1" class="form-label appointment-label">Driver's Certificate of Safety Driving Seminar</label>
                <input type="file" class="form-control" id="driver_cert_safety_driving_seminar1" name="driver_cert_safety_driving_seminar1" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="col-4 pb-4 px-4 mt-3 tricycle-fields">
                <label for="proof_of_id1" class="form-label appointment-label">Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)</label>
                <input type="file" class="form-control" id="proof_of_id1" name="proof_of_id1" accept="image/*" required/>
              </div>
            </div>
          </div>
        </div>

        <?php if ($userRole === 'operator'): ?>  
          <div class="row assessmentFeeContainer5">
            <div class="col-12 mx-auto text-center mt-4">
              <p id="assessmentFeeText5" class="text-muted fw-bold fst-italic" style="padding: 10px; border: 1px solid #ff8356; background-color: #fff9ea; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"></p>
            </div>
          </div>
        <?php endif; ?>
        <button type="button" class="collapsible fw-bold fs-5 d-flex" id="step3btnform2" onclick="toggleForm('step3form2', ['step3form1', 'step3form3'])">
          <p class="fs-6">FORM II</p>
          <span class="float-right"><i class="fa-solid fa-circle-chevron-down"></i></span>
        </button>
        <div class="content-3 content-form-3 content-container mt-2 mb-3" id="step3form2"  style="display:none;">
          <div class="row px-3 p-2 justify-content-center">
            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-4">
                <label for="mc_lto_certificate_of_registration2" class="form-label appointment-label">LTO Certificate of Registration (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_lto_certificate_of_registration2" name="mc_lto_certificate_of_registration2" accept="image/*" required/>
              </div>
              <div class="col-4 px-4">
                <label for="mc_lto_official_receipt2" class="form-label appointment-label">LTO Official Receipt (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_lto_official_receipt2" name="mc_lto_official_receipt2" accept="image/*" required/>
              </div>
              <div class="col-4 px-4">
                <label for="mc_plate_authorization2" class="form-label appointment-label">Plate Authorization (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_plate_authorization2" name="mc_plate_authorization2" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-4 mt-3">
                <label for="tc_insurance_policy2" class="form-label appointment-label">Insurance Policy (TC) (New Owner)</label>
                <input type="file" class="form-control" id="tc_insurance_policy2" name="tc_insurance_policy2" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3">
                <label for="unit_front_view_image2" class="form-label appointment-label">Picture of New Unit (Front View)</label>
                <input type="file" class="form-control" id="unit_front_view_image2" name="unit_front_view_image2" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3">
                <label for="unit_side_view_image2" class="form-label appointment-label">Picture of New Unit (Side View)</label>
                <input type="file" class="form-control" id="unit_side_view_image2" name="unit_side_view_image2" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-4 mt-3 tricycle-fields">
                <label for="sketch_location_of_garage2" class="form-label appointment-label">Sketch Location of Garage</label>
                <input type="file" class="form-control" id="sketch_location_of_garage2" name="sketch_location_of_garage2" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3 tricycle-fields">
                <label for="affidavit_of_income_tax_return2" class="form-label appointment-label">Affidavit of No Income or Latest Income Tax Return</label>
                <input type="file" class="form-control" id="affidavit_of_income_tax_return2" name="affidavit_of_income_tax_return2" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3 tricycle-fields">
                <label for="driver_cert_safety_driving_seminar2" class="form-label appointment-label">Driver's Certificate of Safety Driving Seminar</label>
                <input type="file" class="form-control" id="driver_cert_safety_driving_seminar2" name="driver_cert_safety_driving_seminar2" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="col-4 pb-4 px-4 mt-3 tricycle-fields">
                <label for="proof_of_id2" class="form-label appointment-label">Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)</label>
                <input type="file" class="form-control" id="proof_of_id2" name="proof_of_id2" accept="image/*" required/>
              </div>
            </div>
          </div>
        </div>

        <?php if ($userRole === 'operator'): ?>  
          <div class="row assessmentFeeContainer6">
            <div class="col-12 mx-auto text-center mt-4">
              <p id="assessmentFeeText6" class="text-muted fw-bold fst-italic" style="padding: 10px; border: 1px solid #ff8356; background-color: #fff9ea; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"></p>
            </div>
          </div>
        <?php endif; ?>
        <button type="button" class="collapsible fw-bold fs-5 d-flex" id="step3btnform3" onclick="toggleForm('step3form3', ['step3form1', 'step3form2'])">
          <p class="fs-6">FORM III</p>
          <span class="float-right"><i class="fa-solid fa-circle-chevron-down"></i></span>
        </button>
        <div class="content-3 content-form-3 content-container mt-2 mb-3" id="step3form3"  style="display:none;">
          <div class="row px-3 p-2 justify-content-center">
            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-4">
                <label for="mc_lto_certificate_of_registration3" class="form-label appointment-label">LTO Certificate of Registration (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_lto_certificate_of_registration3" name="mc_lto_certificate_of_registration3" accept="image/*" required/>
              </div>
              <div class="col-4 px-4">
                <label for="mc_lto_official_receipt3" class="form-label appointment-label">LTO Official Receipt (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_lto_official_receipt3" name="mc_lto_official_receipt3" accept="image/*" required/>
              </div>
              <div class="col-4 px-4">
                <label for="mc_plate_authorization3" class="form-label appointment-label">Plate Authorization (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_plate_authorization3" name="mc_plate_authorization3" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-4 mt-3">
                <label for="tc_insurance_policy3" class="form-label appointment-label">Insurance Policy (TC) (New Owner)</label>
                <input type="file" class="form-control" id="tc_insurance_policy3" name="tc_insurance_policy3" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3">
                <label for="unit_front_view_image3" class="form-label appointment-label">Picture of New Unit (Front View)</label>
                <input type="file" class="form-control" id="unit_front_view_image3" name="unit_front_view_image3" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3">
                <label for="unit_side_view_image3" class="form-label appointment-label">Picture of New Unit (Side View)</label>
                <input type="file" class="form-control" id="unit_side_view_image3" name="unit_side_view_image3" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-4 mt-3 tricycle-fields">
                <label for="sketch_location_of_garage3" class="form-label appointment-label">Sketch Location of Garage</label>
                <input type="file" class="form-control" id="sketch_location_of_garage3" name="sketch_location_of_garage3" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3 tricycle-fields">
                <label for="affidavit_of_income_tax_return3" class="form-label appointment-label">Affidavit of No Income or Latest Income Tax Return</label>
                <input type="file" class="form-control" id="affidavit_of_income_tax_return3" name="affidavit_of_income_tax_return3" accept="image/*" required/>
              </div>
              <div class="col-4 px-4 mt-3 tricycle-fields">
                <label for="driver_cert_safety_driving_seminar3" class="form-label appointment-label">Driver's Certificate of Safety Driving Seminar</label>
                <input type="file" class="form-control" id="driver_cert_safety_driving_seminar3" name="driver_cert_safety_driving_seminar3" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="col-4 pb-4 px-4 mt-3 tricycle-fields">
                <label for="proof_of_id3" class="form-label appointment-label">Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)</label>
                <input type="file" class="form-control" id="proof_of_id3" name="proof_of_id3" accept="image/*" required/>
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

    <!-- *** STEP 2 *** -->
    <section id="step-2" style="display: none;" class="mt-4">
      <?php if ($userRole === 'operator'): ?>  
        <div class="row assessmentFeeContainer">
          <div class="col-12 mx-auto text-center mt-4">
            <p id="assessmentFeeText" class="text-muted fw-bold fst-italic" style="padding: 10px; border: 1px solid #ff8356; background-color: #fff9ea; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"></p>
          </div>
        </div>
      <?php endif; ?>
      <button type="button" class="collapsible fw-bold fs-5 d-flex" id="step2btnform1" onclick="toggleForm('step2form1', ['step2form2', 'step2form3'])">
        <p class="fs-6">FORM I</p>
        <span class="float-right"><i class="fa-solid fa-circle-chevron-down"></i></span>
      </button>
      
      <div class="content content-form active-content content-container mt-2 mb-3" id="step2form1">
        <div class="row px-3 p-3">
          <div class="col-12 d-flex mb-1">
            <div class="col-4 px-5">
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
      </div>

      <?php if ($userRole === 'operator'): ?>  
        <div class="row assessmentFeeContainer2">
          <div class="col-12 mx-auto text-center mt-4">
            <p id="assessmentFeeText2" class="text-muted fw-bold fst-italic" style="padding: 10px; border: 1px solid #ff8356; background-color: #fff9ea; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"></p>
          </div>
        </div>
      <?php endif; ?>
      <button type="button" class="collapsible fw-bold fs-5 d-flex" id="step2btnform2" onclick="toggleForm('step2form2', ['step2form1', 'step2form3'])">
        <p class="fs-6">FORM II</p>
        <span class="float-right"><i class="fa-solid fa-circle-chevron-down"></i></span>
      </button>
      <div class="content content-form content-container mt-2 mb-3" id="step2form2"  style="display:none;">
        <div class="row px-3 p-3">
          <div class="col-12 d-flex mb-1">
            <div class="col-4 px-5">
              <label for="operator_name2" class="form-label">Name of Operator</label>
              <div class="input-group">
                <input type="text" class="form-control phone-no" style="cursor: pointer;" id="operator_name2" name="operator_name2" value="<?php echo isset($_POST['operator_name2']) ? $_POST['operator_name2'] : $fullName; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default operator name. This field is read-only. To update, please go to Manage Profile.">
                <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                  <i class="fa-solid fa-info-circle"></i>
                </span>
              </div>
            </div>
            <div class="col-4 px-5 mt-3">
              <label for="tricycle_phone_number2" class="form-label">Phone Number</label>
              <div class="input-group">
                <span class="input-group-text">+63</span>
                <input type="text" class="form-control phone-no" style="cursor: pointer;" id="tricycle_phone_number2" name="tricycle_phone_number2" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['tricycle_phone_number2']) ? $_POST['tricycle_phone_number2'] : $userPhoneNo; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default phone number. This field is read-only. To update, please go to Manage Profile.">
                <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                  <i class="fa-solid fa-info-circle"></i>
                </span>
              </div>
            </div>
            <div class="col-4 px-5 mt-3">
              <label for="address2" class="form-label">Address</label>
              <div class="input-group">
                <input type="text" class="form-control" style="cursor: pointer;" id="address2" name="address2" value="<?php echo isset($_POST['address2']) ? $_POST['address2'] : $userAddress; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default address. This field is read-only. To update, please go to Manage Profile.">
                <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                  <i class="fa-solid fa-info-circle"></i>
                </span>
              </div>
            </div>
          </div>

          <div class="col-12 d-flex mb-2">
            <div class="col-4 px-5">
              <label for="mtop_no2" class="form-label">MTOP Number</label>
              <input type="text" class="form-control" id="mtop_no2" name="mtop_no2" value="<?php echo isset($_POST['mtop_no2']) ? $_POST['mtop_no2'] : ''; ?>" min="0" required>
            </div>
            <div class="col-4 px-5">
              <label for="color_code2" class="form-label">Color Code</label>
              <select class="form-control" id="color_code2" name="color_code2" required>
                <option selected disabled>Please Select Here</option>
                <option value="Red" data-route-area2="Free Zone / Zone 1" <?php echo (isset($_POST['color_code2']) && $_POST['color_code2'] == 'Red' ? 'selected' : ''); ?>>Red</option>
                <option value="Blue" data-route-area2="Free Zone & Zone 2" <?php echo (isset($_POST['color_code2']) && $_POST['color_code2'] == 'Blue' ? 'selected' : ''); ?>>Blue</option>
                <option value="Yellow" data-route-area2="Free Zone & Zone 3" <?php echo (isset($_POST['color_code2']) && $_POST['color_code2'] == 'Yellow' ? 'selected' : ''); ?>>Yellow</option>
                <option value="Green" data-route-area2="Free Zone & Zone 4" <?php echo (isset($_POST['color_code2']) && $_POST['color_code2'] == 'Green' ? 'selected' : ''); ?>>Green</option>
              </select>
            </div>
            <div class="col-4 px-5">
              <label for="route_area2" class="form-label">Route Area</label>
              <div class="input-group">
                <input type="text" class="form-control" id="route_area2" name="route_area2" style="cursor:pointer;" placeholder="Select Color Code First" data-toggle="tooltip" data-bs-placement="top" title="Please choose a Color Code to determine the Route Area for the tricycle. This field is read-only." value="<?php echo isset($_POST['route_area2']) ? $_POST['route_area2'] : ''; ?>" readonly required>
                <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                  <i class="fa-solid fa-info-circle"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 d-flex mb-5">
            <div class="col-4 px-5">
              <label for="make_model2" class="form-label">Make Model</label>
              <input type="text" class="form-control" id="make_model2" name="make_model2" value="<?php echo isset($_POST['make_model2']) ? $_POST['make_model2'] : ''; ?>" required>
            </div>
            <div class="col-4 px-5">
              <label for="make_model_year_acquired2" class="form-label">Model Year Acquired</label>
              <input type="text" class="form-control text-uppercase" id="make_model_year_acquired2" name="make_model_year_acquired2" value="<?php echo isset($_POST['make_model_year_acquired2']) ? $_POST['make_model_year_acquired2'] : ''; ?>" required>
            </div>
            <div class="col-4 px-5">
              <label for="make_model_expiry_date2" class="form-label">Model Expiry Date</label>
              <input type="date" class="form-control text-uppercase" id="make_model_expiry_date2" name="make_model_expiry_date2" value="<?php echo isset($_POST['make_model_expiry_date2']) ? $_POST['make_model_expiry_date2'] : ''; ?>" required>
            </div>
          </div>
          <div class="col-12 d-flex mb-2">
            <div class="col-4 px-5">
              <label for="motor_number2" class="form-label">Motor Number</label>
              <input type="text" class="form-control" id="motor_number2" name="motor_number2" value="<?php echo isset($_POST['motor_number2']) ? $_POST['motor_number2'] : ''; ?>" min="0" required>
            </div>
            <div class="col-4 px-5">
              <label for="insurer2" class="form-label">Insurer</label>
              <input type="text" class="form-control" id="insurer2" name="insurer2" value="<?php echo isset($_POST['insurer2']) ? $_POST['insurer2'] : ''; ?>" required>
            </div>
            <div class="col-4 px-5">
              <label for="coc_no2" class="form-label">C.O.C Number</label>
              <input type="text" class="form-control" id="coc_no2" name="coc_no2" value="<?php echo isset($_POST['coc_no2']) ? $_POST['coc_no2'] : ''; ?>" min="0" required>
            </div>
          </div>
          <div class="col-12 d-flex mb-5" id="coc_expiry_field">
            <div class="col-4 px-5">
              <label for="coc_no_expiry_date2" class="form-label">C.O.C Expiry Date</label>
              <input type="date" class="form-control text-uppercase" id="coc_no_expiry_date2" name="coc_no_expiry_date2" value="<?php echo isset($_POST['coc_no_expiry_date2']) ? $_POST['coc_no_expiry_date2'] : ''; ?>" required>
            </div>
          </div>
        </div>
      </div>

      <?php if ($userRole === 'operator'): ?>  
        <div class="row assessmentFeeContainer3">
          <div class="col-12 mx-auto text-center mt-4">
            <p id="assessmentFeeText3" class="text-muted fw-bold fst-italic" style="padding: 10px; border: 1px solid #ff8356; background-color: #fff9ea; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"></p>
          </div>
        </div>
      <?php endif; ?>
      <button type="button" class="collapsible fw-bold fs-5 d-flex" id="step2btnform3" onclick="toggleForm('step2form3', ['step2form1', 'step2form2'])">
        <p class="fs-6">FORM III</p>
        <span class="float-right"><i class="fa-solid fa-circle-chevron-down"></i></span>
      </button>
      <div class="content content-form content-container mt-2 mb-3" id="step2form3"  style="display:none;">
        <div class="row px-3 p-3">
          <div class="col-12 d-flex mb-1">
            <div class="col-4 px-5">
              <label for="operator_name3" class="form-label">Name of Operator</label>
              <div class="input-group">
                <input type="text" class="form-control phone-no" style="cursor: pointer;" id="operator_name3" name="operator_name3" value="<?php echo isset($_POST['operator_name3']) ? $_POST['operator_name3'] : $fullName; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default operator name. This field is read-only. To update, please go to Manage Profile.">
                <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                  <i class="fa-solid fa-info-circle"></i>
                </span>
              </div>
            </div>
            <div class="col-4 px-5 mt-3">
              <label for="tricycle_phone_number3" class="form-label">Phone Number</label>
              <div class="input-group">
                <span class="input-group-text">+63</span>
                <input type="text" class="form-control phone-no" style="cursor: pointer;" id="tricycle_phone_number3" name="tricycle_phone_number3" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['tricycle_phone_number3']) ? $_POST['tricycle_phone_number3'] : $userPhoneNo; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default phone number. This field is read-only. To update, please go to Manage Profile.">
                <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                  <i class="fa-solid fa-info-circle"></i>
                </span>
              </div>
            </div>
            <div class="col-4 px-5 mt-3">
              <label for="address3" class="form-label">Address</label>
              <div class="input-group">
                <input type="text" class="form-control" style="cursor: pointer;" id="address3" name="address3" value="<?php echo isset($_POST['address3']) ? $_POST['address3'] : $userAddress; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default address. This field is read-only. To update, please go to Manage Profile.">
                <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                  <i class="fa-solid fa-info-circle"></i>
                </span>
              </div>
            </div>
          </div>

          <div class="col-12 d-flex mb-2">
            <div class="col-4 px-5">
              <label for="mtop_no3" class="form-label">MTOP Number</label>
              <input type="text" class="form-control" id="mtop_no3" name="mtop_no3" value="<?php echo isset($_POST['mtop_no3']) ? $_POST['mtop_no3'] : ''; ?>" min="0" required>
            </div>
            <div class="col-4 px-5">
              <label for="color_code3" class="form-label">Color Code</label>
              <select class="form-control" id="color_code3" name="color_code3" required>
                <option selected disabled>Please Select Here</option>
                <option value="Red" data-route-area3="Free Zone / Zone 1" <?php echo (isset($_POST['color_code3']) && $_POST['color_code3'] == 'Red' ? 'selected' : ''); ?>>Red</option>
                <option value="Blue" data-route-area3="Free Zone & Zone 2" <?php echo (isset($_POST['color_code3']) && $_POST['color_code3'] == 'Blue' ? 'selected' : ''); ?>>Blue</option>
                <option value="Yellow" data-route-area3="Free Zone & Zone 3" <?php echo (isset($_POST['color_code3']) && $_POST['color_code3'] == 'Yellow' ? 'selected' : ''); ?>>Yellow</option>
                <option value="Green" data-route-area3="Free Zone & Zone 4" <?php echo (isset($_POST['color_code3']) && $_POST['color_code3'] == 'Green' ? 'selected' : ''); ?>>Green</option>
              </select>
            </div>
            <div class="col-4 px-5">
              <label for="route_area3" class="form-label">Route Area</label>
              <div class="input-group">
                <input type="text" class="form-control" id="route_area3" name="route_area3" style="cursor:pointer;" placeholder="Select Color Code First" data-toggle="tooltip" data-bs-placement="top" title="Please choose a Color Code to determine the Route Area for the tricycle. This field is read-only." value="<?php echo isset($_POST['route_area3']) ? $_POST['route_area3'] : ''; ?>" readonly required>
                <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                  <i class="fa-solid fa-info-circle"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 d-flex mb-5">
            <div class="col-4 px-5">
              <label for="make_model3" class="form-label">Make Model</label>
              <input type="text" class="form-control" id="make_model3" name="make_model3" value="<?php echo isset($_POST['make_model3']) ? $_POST['make_model3'] : ''; ?>" required>
            </div>
            <div class="col-4 px-5">
              <label for="make_model_year_acquired3" class="form-label">Model Year Acquired</label>
              <input type="text" class="form-control text-uppercase" id="make_model_year_acquired3" name="make_model_year_acquired3" value="<?php echo isset($_POST['make_model_year_acquired3']) ? $_POST['make_model_year_acquired3'] : ''; ?>" required>
            </div>
            <div class="col-4 px-5">
              <label for="make_model_expiry_date3" class="form-label">Model Expiry Date</label>
              <input type="date" class="form-control text-uppercase" id="make_model_expiry_date3" name="make_model_expiry_date3" value="<?php echo isset($_POST['make_model_expiry_date3']) ? $_POST['make_model_expiry_date3'] : ''; ?>" required>
            </div>
          </div>
          <div class="col-12 d-flex mb-2">
            <div class="col-4 px-5">
              <label for="motor_number3" class="form-label">Motor Number</label>
              <input type="text" class="form-control" id="motor_number3" name="motor_number3" value="<?php echo isset($_POST['motor_number3']) ? $_POST['motor_number3'] : ''; ?>" min="0" required>
            </div>
            <div class="col-4 px-5">
              <label for="insurer3" class="form-label">Insurer</label>
              <input type="text" class="form-control" id="insurer3" name="insurer3" value="<?php echo isset($_POST['insurer3']) ? $_POST['insurer3'] : ''; ?>" required>
            </div>
            <div class="col-4 px-5">
              <label for="coc_no3" class="form-label">C.O.C Number</label>
              <input type="text" class="form-control" id="coc_no3" name="coc_no3" value="<?php echo isset($_POST['coc_no3']) ? $_POST['coc_no3'] : ''; ?>" min="0" required>
            </div>
          </div>
          <div class="col-12 d-flex mb-5" id="coc_expiry_field">
            <div class="col-4 px-5">
              <label for="coc_no_expiry_date3" class="form-label">C.O.C Expiry Date</label>
              <input type="date" class="form-control text-uppercase" id="coc_no_expiry_date3" name="coc_no_expiry_date3" value="<?php echo isset($_POST['coc_no_expiry_date3']) ? $_POST['coc_no_expiry_date3'] : ''; ?>" required>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-3">
        <button type="button" class="sidebar-btnContent-1 text-start" onclick="showStep(1)">Previous</button>
        <button type="button" class="sidebar-btnContent text-end" onclick="showStep(3)">Next</button>
      </div>    
   </section>

   <!-- *** STEP 1 *** -->
    <section id="step-1">
      <div class="content-container mt-2 mb-3 pb-3">
        <div class="row px-2 p-3">
          <div class="col-12 d-flex mb-1">
            <div class="col-4 px-5 mt-2 mb-4">
              <label for="name" class="form-label">Full Name</label>
              <div class="input-group">
                <input type="text" class="form-control phone-no" style="cursor: pointer;" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $fullName; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default appointment full name. This field is read-only. To update, please go to Manage Profile.">
                <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                  <i class="fa-solid fa-info-circle"></i>
                </span>
              </div>
            </div>
            <div class="col-4 px-5 mt-2 mb-4">
              <label for="phone_number" class="form-label">Phone Number</label>
              <div class="input-group">
                <span class="input-group-text">+63</span>
                <input type="text" class="form-control phone-no" style="cursor: pointer;" id="phone_number" name="phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['phone_number']) ? $_POST['phone_number'] : $userPhoneNo; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default phone number. This field is read-only. To update, please go to Manage Profile.">
                <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                  <i class="fa-solid fa-info-circle"></i>
                </span>
              </div>
            </div>
            <div class="col-4 px-5 mt-2 mb-4">
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
    </section>
  </form>
</main>
<script src="public/assets/js/appointments_form_toggle3.js"></script>
<script>
  $(document).ready(function () {
    // Function to toggle the visibility of assessment fee container
    function toggleAssessmentFeeContainer(assessmentFeeText, assessmentFeeContainer) {
      if (assessmentFeeText.trim() === "") {
        $(assessmentFeeContainer).hide();
      } else {
        $(assessmentFeeContainer).show();
      }
    }

    $("#color_code, #color_code2, #color_code3").change(function () {
      let selectedColorCode = $(this).val();
      let selectedRouteArea = $(this).find(":selected").data("route-area") || 
                              $(this).find(":selected").data("route-area2") || 
                              $(this).find(":selected").data("route-area3");

      // Determine which assessmentFeeText and assessmentFeeContainer to update based on the element ID
      let assessmentFeeTextSelector = "";
      let assessmentFeeContainer = "";
      let routeAreaSelector = "";
      
      switch ($(this).attr("id")) {
        case "color_code":
          assessmentFeeTextSelector = "#assessmentFeeText, #assessmentFeeText4";
          assessmentFeeContainer = ".assessmentFeeContainer, .assessmentFeeContainer4";
          routeAreaSelector = "#route_area";
          break;
        case "color_code2":
          assessmentFeeTextSelector = "#assessmentFeeText2, #assessmentFeeText5";
          assessmentFeeContainer = ".assessmentFeeContainer2, .assessmentFeeContainer5";
          routeAreaSelector = "#route_area2";
          break;
        case "color_code3":
          assessmentFeeTextSelector = "#assessmentFeeText3, #assessmentFeeText6";
          assessmentFeeContainer = ".assessmentFeeContainer3, .assessmentFeeContainer6";
          routeAreaSelector = "#route_area3";
          break;
      }

      // Update the corresponding route_area field
      $(routeAreaSelector).val(selectedRouteArea);

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
      $(assessmentFeeTextSelector).text(assessmentFeeText);

      // Toggle visibility of assessment fee container
      toggleAssessmentFeeContainer(assessmentFeeText, assessmentFeeContainer);
    });

    // Initial hide of assessment fee containers
    $(".assessmentFeeContainer, .assessmentFeeContainer2, .assessmentFeeContainer3, .assessmentFeeContainer4, .assessmentFeeContainer5, .assessmentFeeContainer6").hide();

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

    // Update active state of forms when step buttons are clicked
    const stepButtons = document.querySelectorAll('.step-button');
    if (stepButtons) {
      stepButtons.forEach(button => {
        button.addEventListener('click', () => {
          const step = parseInt(button.textContent);
          showStep(step);
        });
      });
    }
  });
</script>