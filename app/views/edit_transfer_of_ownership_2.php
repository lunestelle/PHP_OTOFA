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
    <h6 class="title-head">Schedule <span class="mx-2" style="color:#ff8356;">Transfer of Ownership</span> Appointment</h6>
  </div>

  <form class="default-form" method="POST" action="" enctype="multipart/form-data" id="appointmentForm">
    <!-- *** STEP 3 *** -->
    <section id="step-3" style="display: none;">
      <div class="col-lg-12">
        <div class="px-3 pt-1 mt-3">
          <p class="text-muted fw-bold fst-italic"><span class="text-danger">Note: </span>Please make sure the images are clear and upload all the necessary requirements.</p>
        </div>

        <?php if ($userRole === 'operator'): ?>  
          <div class="row assessmentFeeContainer3">
            <div class="col-12 mx-auto text-center mt-2">
              <p id="assessmentFeeText3" class="text-muted fw-bold fst-italic" style="padding: 10px; border: 1px solid #ff8356; background-color: #fff9ea; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"></p>
            </div>
          </div>
        <?php endif; ?>

        <button type="button" class="collapsible fw-bold fs-5 d-flex active-button" id="step3btnform1" onclick="toggleForm('step3form1', 'step3form2')">
          <p class="fs-6">FORM I</p>
          <span class="float-right"><i class="fa-solid fa-circle-chevron-down"></i></span>
        </button>
        <div class="content-3 content-form-3 active-content content-container mt-2 mb-3" id="step3form1">
          <div class="row px-3 p-2 justify-content-center">
            <div class="col-12 d-flex mb-2">
              <div class="text-center col-4 px-4">
                <label for="mc_lto_certificate_of_registration2" class="form-label">LTO Certificate of Registration (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_lto_certificate_of_registration2" name="mc_lto_certificate_of_registration2" accept="image/*" required/>
              </div>
              <div class="text-center col-4 px-4">
                <label for="mc_lto_official_receipt2" class="form-label">LTO Official Receipt (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_lto_official_receipt2" name="mc_lto_official_receipt2" accept="image/*" required/>
              </div>
              <div class="text-center col-4 px-4">
                <label for="mc_plate_authorization2" class="form-label">Plate Authorization (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_plate_authorization2" name="mc_plate_authorization2" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="text-center col-4 px-4">
                <label for="tc_insurance_policy2" class="form-label">Insurance Policy (TC) (New Owner)</label>
                <input type="file" class="form-control" id="tc_insurance_policy2" name="tc_insurance_policy2" accept="image/*" required/>
              </div>
              <div class="text-center col-4 px-4">
                <label for="unit_front_view_image2" class="form-label">Picture of New Unit (Front View)</label>
                <input type="file" class="form-control" id="unit_front_view_image2" name="unit_front_view_image2" accept="image/*" required/>
              </div>
              <div class="text-center col-4 px-4">
                <label for="unit_side_view_image2" class="form-label">Picture of New Unit (Side View)</label>
                <input type="file" class="form-control" id="unit_side_view_image2" name="unit_side_view_image2" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="text-center col-4 px-4">
                <label for="sketch_location_of_garage2" class="form-label">Sketch Location of Garage</label>
                <input type="file" class="form-control" id="sketch_location_of_garage2" name="sketch_location_of_garage2" accept="image/*" required/>
              </div>
              <div class="text-center col-4 px-4">
                <label for="latest_franchise2" class="form-label">Latest Franchise</label>
                <input type="file" class="form-control" id="latest_franchise2" name="latest_franchise2" accept="image/*" required/>
              </div>
              <div class="text-center col-4 px-4">
                <label for="driver_cert_safety_driving_seminar2" class="form-label">Driver's Certificate of Safety Driving Seminar</label>
                <input type="file" class="form-control" id="driver_cert_safety_driving_seminar2" name="driver_cert_safety_driving_seminar2" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex">
              <div class="text-center col-4 px-4">
                <label for="proof_of_id2" class="form-label">Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)</label>
                <input type="file" class="form-control" id="proof_of_id2" name="proof_of_id2" accept="image/*" required/>
              </div>
              <div class="text-center col-4 px-4">
                <label for="affidavit_of_income_tax_return2" class="form-label">Affidavit of No Income <br> or Latest Income Tax Return</label>
                <input type="file" class="form-control" id="affidavit_of_income_tax_return2" name="affidavit_of_income_tax_return2" accept="image/*" required/>
              </div>
            </div>
          </div>
        </div>

        <?php if ($userRole === 'operator'): ?>  
          <div class="row assessmentFeeContainer4">
            <div class="col-12 mx-auto text-center mt-4">
              <p id="assessmentFeeText4" class="text-muted fw-bold fst-italic" style="padding: 10px; border: 1px solid #ff8356; background-color: #fff9ea; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"></p>
            </div>
          </div>
        <?php endif; ?>
        <button type="button" class="collapsible fw-bold fs-5 d-flex" id="step3btnform2" onclick="toggleForm('step3form2', 'step3form1')" style="display:none;">
          <p class="fs-6">FORM II</p>
          <span class="float-right"><i class="fa-solid fa-circle-chevron-down"></i></span>
        </button>
        <div class="content-3 content-form-3 content-container mt-2 mb-3" id="step3form2"  style="display:none;">
          <div class="row px-3 p-2 justify-content-center">
            <div class="col-12 d-flex mb-2">
              <div class="text-center col-4 px-4">
                <label for="mc_lto_certificate_of_registration1" class="form-label">LTO Certificate of Registration (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_lto_certificate_of_registration1" name="mc_lto_certificate_of_registration1" accept="image/*" required/>
              </div>
              <div class="text-center col-4 px-4">
                <label for="mc_lto_official_receipt1" class="form-label">LTO Official Receipt (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_lto_official_receipt1" name="mc_lto_official_receipt1" accept="image/*" required/>
              </div>
              <div class="text-center col-4 px-4">
                <label for="mc_plate_authorization1" class="form-label">Plate Authorization (MC of New Unit)</label>
                <input type="file" class="form-control" id="mc_plate_authorization1" name="mc_plate_authorization1" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="text-center col-4 px-4">
                <label for="tc_insurance_policy1" class="form-label">Insurance Policy (TC) (New Owner)</label>
                <input type="file" class="form-control" id="tc_insurance_policy1" name="tc_insurance_policy1" accept="image/*" required/>
              </div>
              <div class="text-center col-4 px-4">
                <label for="unit_front_view_image1" class="form-label">Picture of New Unit (Front View)</label>
                <input type="file" class="form-control" id="unit_front_view_image1" name="unit_front_view_image1" accept="image/*" required/>
              </div>
              <div class="text-center col-4 px-4">
                <label for="unit_side_view_image1" class="form-label">Picture of New Unit (Side View)</label>
                <input type="file" class="form-control" id="unit_side_view_image1" name="unit_side_view_image1" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex mb-2">
              <div class="text-center col-4 px-4">
                <label for="sketch_location_of_garage1" class="form-label">Sketch Location of Garage</label>
                <input type="file" class="form-control" id="sketch_location_of_garage1" name="sketch_location_of_garage1" accept="image/*" required/>
              </div>
              <div class="text-center col-4 px-4">
                <label for="latest_franchise1" class="form-label">Latest Franchise</label>
                <input type="file" class="form-control" id="latest_franchise1" name="latest_franchise1" accept="image/*" required/>
              </div>
              <div class="text-center col-4 px-4">
                <label for="driver_cert_safety_driving_seminar1" class="form-label">Driver's Certificate of Safety Driving Seminar</label>
                <input type="file" class="form-control" id="driver_cert_safety_driving_seminar1" name="driver_cert_safety_driving_seminar1" accept="image/*" required/>
              </div>
            </div>
            <div class="col-12 d-flex">
              <div class="text-center col-4 px-4">
                <label for="proof_of_id1" class="form-label">Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)</label>
                <input type="file" class="form-control" id="proof_of_id1" name="proof_of_id1" accept="image/*" required/>
              </div>
              <div class="text-center col-4 px-4">
                <label for="affidavit_of_income_tax_return1" class="form-label">Affidavit of No Income <br> or Latest Income Tax Return</label>
                <input type="file" class="form-control" id="affidavit_of_income_tax_return1" name="affidavit_of_income_tax_return1" accept="image/*" required/>
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
      <button type="button" class="collapsible fw-bold fs-5 d-flex" id="step2btnform1" onclick="toggleForm('step2form1', 'step2form2')">
        <p class="fs-6">FORM I</p>
        <span class="float-right"><i class="fa-solid fa-circle-chevron-down"></i></span>
      </button>
      <?php if (isset($tricycleApplicationData[1])): ?>
        <?php $tricycleApplicationData2 = $tricycleApplicationData[1]; ?>
        <div class="content content-form active-content content-container mt-2 mb-3" id="step2form1">
          <div class="row px-3 p-3">
            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-5">
                <label for="operator_name2" class="form-label">Name of Operator</label>
                <div class="input-group">
                  <input type="text" class="form-control phone-no" style="cursor: pointer;" id="operator_name2" name="operator_name2" value="<?php echo isset($_POST['operator_name']) ? $_POST['operator_name'] : $fullName; ?>" data-toggle="tooltip" data-bs-placement="top" title="Default operator name. This field is read-only. To update, please go to Manage Profile." readonly>
                  <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="Default operator name. This field is read-only. To update, please go to Manage Profile.">
                    <i class="fa-solid fa-info-circle"></i>
                  </span>
                </div>
              </div>
              <div class="col-4 px-5">
                <label for="tricycle_phone_number2" class="form-label">Phone Number</label>
                <div class="input-group">
                  <span class="input-group-text">+63</span>
                  <input type="text" class="form-control phone-no" style="cursor: pointer;" id="tricycle_phone_number2" name="tricycle_phone_number2" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['tricycle_phone_number']) ? $_POST['tricycle_phone_number'] : $userPhoneNo; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default phone number. This field is read-only. To update, please go to Manage Profile.">
                  <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                    <i class="fa-solid fa-info-circle"></i>
                  </span>
                </div>
              </div>
              <div class="col-4 px-5">
                <label for="address2" class="form-label">Address</label>
                <div class="input-group">
                  <input type="text" class="form-control" style="cursor: pointer;" id="address2" name="address2" value="<?php echo isset($_POST['address']) ? $_POST['address'] : $userAddress; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default address. This field is read-only. To update, please go to Manage Profile.">
                  <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                    <i class="fa-solid fa-info-circle"></i>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-5">
                <label for="mtop_no2" class="form-label">MTOP Number</label>
                <input type="text" class="form-control" id="mtop_no2" name="mtop_no2" value="<?= isset($_POST['mtop_no']) ? $_POST['mtop_no'] : $tricycleApplicationData2->mtop_no; ?>" min="0" required>
              </div>
              <div class="col-4 px-5">
                <label for="color_code2" class="form-label">Color Code</label>
                <select class="form-control" id="color_code2" name="color_code2" required>
                  <option selected disabled>Please Select Here</option>
                  <option value="Red" data-route-area2="Free Zone / Zone 2" <?= (isset($_POST['color_code']) && $_POST['color_code'] == 'Red') ? 'selected' : (($tricycleApplicationData2->color_code == 'Red') ? 'selected' : ''); ?>>Red</option>
                  <option value="Blue" data-route-area2="Free Zone & Zone 2" <?= (isset($_POST['color_code']) && $_POST['color_code'] == 'Blue') ? 'selected' : (($tricycleApplicationData2->color_code == 'Blue') ? 'selected' : ''); ?>>Blue</option>
                  <option value="Yellow" data-route-area2="Free Zone & Zone 3" <?= (isset($_POST['color_code']) && $_POST['color_code'] == 'Yellow') ? 'selected' : (($tricycleApplicationData2->color_code == 'Yellow') ? 'selected' : ''); ?>>Yellow</option>
                  <option value="Green" data-route-area2="Free Zone & Zone 4" <?= (isset($_POST['color_code']) && $_POST['color_code'] == 'Green') ? 'selected' : (($tricycleApplicationData2->color_code == 'Green') ? 'selected' : ''); ?>>Green</option>
                </select>
              </div>
              <div class="col-4 px-5">
                <label for="route_area2" class="form-label">Route Area</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="route_area2" name="route_area2" style="cursor:pointer;" placeholder="Select Color Code First" data-toggle="tooltip" data-bs-placement="top" title="Please choose a Color Code to determine the Route Area for the tricycle. This field is read-only." value="<?= (isset($_POST['route_area']) ? $_POST['route_area'] : ($tricycleApplicationData2->route_area ?? '')); ?>" readonly required>
                  <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                    <i class="fa-solid fa-info-circle"></i>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-12 d-flex mb-5">
              <div class="col-4 px-5">
                <label for="make_model2" class="form-label">Make Model</label>
                <input type="text" class="form-control" id="make_model2" name="make_model2" value="<?= (isset($_POST['make_model']) ? $_POST['make_model'] : ($tricycleApplicationData2->make_model ?? '')); ?>" required>
              </div>
              <div class="col-4 px-5">
                <label for="make_model_year_acquired2" class="form-label">Model Year Acquired</label>
                <input type="text" class="form-control text-uppercase" id="make_model_year_acquired2" name="make_model_year_acquired2" value="<?= (isset($_POST['make_model_year_acquired']) ? $_POST['make_model_year_acquired'] : ($tricycleApplicationData2->make_model_year_acquired ?? '')); ?>" required>
              </div>
              <div class="col-4 px-5">
                <label for="make_model_expiry_date2" class="form-label">Model Expiry Date</label>
                <input type="date" class="form-control text-uppercase" id="make_model_expiry_date2" name="make_model_expiry_date2" value="<?= (isset($_POST['make_model_expiry_date']) ? $_POST['make_model_expiry_date'] : ($tricycleApplicationData2->make_model_expiry_date ?? '')); ?>" required>
              </div>
            </div>

            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-5">
                <label for="motor_number2" class="form-label">Motor Number</label>
                <input type="text" class="form-control" id="motor_number2" name="motor_number2" value="<?= (isset($_POST['motor_number']) ? $_POST['motor_number'] : ($tricycleApplicationData2->motor_number ?? '')); ?>" min="0" required>
              </div>
              <div class="col-4 px-5">
                <label for="insurer2" class="form-label">Insurer</label>
                <input type="text" class="form-control" id="insurer2" name="insurer2" value="<?= (isset($_POST['insurer']) ? $_POST['insurer'] : ($tricycleApplicationData2->insurer ?? '')); ?>" required>
              </div>
              <?php if (!empty($tricycleApplicationData2['cin_number'])): ?>
                <div class="col-4 px-5">
                  <label for="tricycle_cin_number_id2" class="form-label">Tricycle CIN</label>                          
                  <div class="input-group">
                    <input type="text" class="form-control" id="tricycle_cin_number_id2" name="tricycle_cin_number_id2" value="<?= $tricycleApplicationData2['cin_number'] ?>" data-toggle="tooltip" data-bs-placement="top" title="Default tricycle CIN." readonly required>
                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                      <i class="fa-solid fa-info-circle"></i>
                    </span>
                  </div>
                </div>
              <?php else: ?>
                <div class="col-4 px-5">
                  <label for="tricycle_cin_number_id2" class="form-label">Tricycle CIN</label>
                  <input type="text" class="form-control" id="tricycle_cin_number_id2" name="tricycle_cin_number_id2" value="" data-toggle="tooltip" data-bs-placement="top" title="No available Tricycle CIN numbers." readonly disabled>
                </div>
              <?php endif; ?>

            </div>

            <div class="col-12 d-flex mb-5">
              <div class="col-4 px-5">
                <label for="coc_no2" class="form-label">C.O.C Number</label>
                <input type="text" class="form-control" id="coc_no2" name="coc_no2" value="<?= (isset($tricycleApplicationData2->coc_no) ? $tricycleApplicationData2->coc_no : (isset($_POST['coc_no']) ? $_POST['coc_no'] : '')); ?>" min="0" required>
              </div>
              <div class="col-4 px-5">
                <label for="coc_no_expiry_date2" class="form-label">C.O.C Expiry Date</label>
                <input type="date" class="form-control text-uppercase" id="coc_no_expiry_date2" name="coc_no_expiry_date2" value="<?= (isset($tricycleApplicationData2->coc_no_expiry_date) ? $tricycleApplicationData2->coc_no_expiry_date : (isset($_POST['coc_no_expiry_date']) ? $_POST['coc_no_expiry_date'] : '')); ?>" required>
              </div>
            </div>

            <div class="col-12 d-flex mb-2">
              <?php if (!empty($tricycleApplicationData2['cin_number'])): ?>
                <div class="col-4 px-5">
                  <label for="lto_cr_no2" class="form-label">LTO CR Number</label>
                  <input type="text" class="form-control" id="lto_cr_no2" name="lto_cr_no2" value="<?= (isset($tricycleApplicationData2->lto_cr_no) ? $tricycleApplicationData2->lto_cr_no : (isset($_POST['lto_cr_no']) ? $_POST['lto_cr_no'] : '')); ?>" required>
                </div>
                <div class="col-4 px-5">
                  <label for="lto_or_no2" class="form-label">LTO OR Number</label>
                  <input type="text" class="form-control text-uppercase" id="lto_or_no2" name="lto_or_no2" value="<?= (isset($tricycleApplicationData2->lto_or_no) ? $tricycleApplicationData2->lto_or_no : (isset($_POST['lto_or_no']) ? $_POST['lto_or_no'] : '')); ?>" required>
                </div>

                <?php if (!empty($tricycleApplicationData2['driverData'][0])): ?>
                  <?php $driver = $tricycleApplicationData2['driverData'][0]; ?>
                  <div class="col-4 px-5">
                    <label for="driver_id1" class="form-label">Name of Driver</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="driver_id1" name="driver_id1" value="<?= $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name ?>" data-toggle="tooltip" data-bs-placement="top" title="Default Driver Name." readonly required>
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                <?php else: ?>
                  <div class="col-4 px-5">
                    <label for="driver_id1" class="form-label">Name of Driver</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="driver_id1" name="driver_id1" value="Selected Tricycle CIN has no driver." data-toggle="tooltip" data-bs-placement="top" title="Selected Tricycle CIN has no driver." readonly required>
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                <?php endif; ?>
              <?php else: ?>
                <div class="col-4 px-5">
                  <label for="lto_cr_no2" class="form-label">LTO CR Number</label>
                  <input type="text" class="form-control" id="lto_cr_no2" name="lto_cr_no2" value="" data-toggle="tooltip" data-bs-placement="top" title="No Tricycle CIN has been selected." readonly disabled>
                </div>
                <div class="col-4 px-5">
                  <label for="lto_or_no2" class="form-label">LTO OR Number</label>
                  <input type="date" class="form-control text-uppercase" id="lto_or_no2" name="lto_or_no2" value="" data-toggle="tooltip" data-bs-placement="top" title="No Tricycle CIN has been selected." readonly disabled>
                </div>
                <div class="col-4 px-5">
                  <label for="driver_id2" class="form-label">Name of Driver</label>
                  <input type="text" class="form-control phone-no" style="cursor: pointer;" id="driver_id2" name="driver_id2" value="" data-toggle="tooltip" data-bs-placement="top" title="No tricycle drivers are currently available for selection." readonly disabled>
                </div>
              <?php endif; ?>
            </div>

            <div class="col-12 d-flex mb-2">
              <?php if (!empty($tricycleApplicationData2['driverData'][0])): ?>
                <?php $driver = $tricycleApplicationData2['driverData'][0]; ?>
                <div class="col-4 px-5">
                  <label for="driver_license_no1" class="form-label">Driver License Number</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="driver_license_no1" name="driver_license_no1" value="<?= $driver->license_no ?>" data-toggle="tooltip" data-bs-placement="top" title="Default Driver License No." readonly required>
                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                      <i class="fa-solid fa-info-circle"></i>
                    </span>
                  </div>
                </div>
                <div class="col-4 px-5">
                  <label for="driver_license_expiry_date1" class="form-label">License Expiry Date</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="driver_license_expiry_date1" name="driver_license_expiry_date1" value="<?= $driver->license_expiry_date ?>" data-toggle="tooltip" data-bs-placement="top" title="Default Driver License Expiry Date" readonly required>
                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                      <i class="fa-solid fa-info-circle"></i>
                    </span>
                  </div>
                </div>
              <?php else: ?>
                <div class="col-4 px-5">
                  <label for="driver_license_no1" class="form-label">Driver License Number</label>
                  <input type="text" class="form-control" id="driver_license_no1" name="driver_license_no1" value="" data-toggle="tooltip" data-bs-placement="top" title="Selected Tricycle CIN has no driver." readonly disabled>
                </div>
                <div class="col-4 px-5">
                  <label for="driver_license_expiry_date1" class="form-label">License Expiry Date</label>
                  <input type="date" class="form-control text-uppercase" id="driver_license_expiry_date1" name="driver_license_expiry_date1" value="" data-toggle="tooltip" data-bs-placement="top" title="Selected Tricycle CIN has no driver." readonly disabled>
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
      <button type="button" class="collapsible fw-bold fs-5 d-flex" id="step2btnform2" onclick="toggleForm('step2form2', 'step2form1')">
        <p class="fs-6">FORM II</p>
        <span class="float-right"><i class="fa-solid fa-circle-chevron-down"></i></span>
      </button>
      <?php if (isset($tricycleApplicationData[0])): ?>
        <?php $tricycleApplicationData1 = $tricycleApplicationData[0]; ?>
        <div class="content content-form content-container mt-2 mb-3" id="step2form2"  style="display:none;">
          <div class="row px-3 p-3">
            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-5">
                <label for="operator_name1" class="form-label">Name of Operator</label>
                <div class="input-group">
                  <input type="text" class="form-control phone-no" style="cursor: pointer;" id="operator_name1" name="operator_name1" value="<?php echo isset($_POST['operator_name']) ? $_POST['operator_name'] : $fullName; ?>" data-toggle="tooltip" data-bs-placement="top" title="Default operator name. This field is read-only. To update, please go to Manage Profile." readonly>
                  <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="Default operator name. This field is read-only. To update, please go to Manage Profile.">
                    <i class="fa-solid fa-info-circle"></i>
                  </span>
                </div>
              </div>
              <div class="col-4 px-5">
                <label for="tricycle_phone_number1" class="form-label">Phone Number</label>
                <div class="input-group">
                  <span class="input-group-text">+63</span>
                  <input type="text" class="form-control phone-no" style="cursor: pointer;" id="tricycle_phone_number1" name="tricycle_phone_number1" placeholder="e.g., 9123456789" value="<?php echo isset($_POST['tricycle_phone_number']) ? $_POST['tricycle_phone_number'] : $userPhoneNo; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default phone number. This field is read-only. To update, please go to Manage Profile.">
                  <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                    <i class="fa-solid fa-info-circle"></i>
                  </span>
                </div>
              </div>
              <div class="col-4 px-5">
                <label for="address1" class="form-label">Address</label>
                <div class="input-group">
                  <input type="text" class="form-control" style="cursor: pointer;" id="address1" name="address1" value="<?php echo isset($_POST['address']) ? $_POST['address'] : $userAddress; ?>" required readonly data-toggle="tooltip" data-bs-placement="top" title="Default address. This field is read-only. To update, please go to Manage Profile.">
                  <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                    <i class="fa-solid fa-info-circle"></i>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-5">
                <label for="mtop_no1" class="form-label">MTOP Number</label>
                <input type="text" class="form-control" id="mtop_no1" name="mtop_no1" value="<?= isset($_POST['mtop_no']) ? $_POST['mtop_no'] : $tricycleApplicationData1->mtop_no; ?>" min="0" required>
              </div>
              <div class="col-4 px-5">
                <label for="color_code1" class="form-label">Color Code</label>
                <select class="form-control" id="color_code1" name="color_code1" required>
                  <option selected disabled>Please Select Here</option>
                  <option value="Red" data-route-area1="Free Zone / Zone 1" <?= (isset($_POST['color_code']) && $_POST['color_code'] == 'Red') ? 'selected' : (($tricycleApplicationData1->color_code == 'Red') ? 'selected' : ''); ?>>Red</option>
                  <option value="Blue" data-route-area1="Free Zone & Zone 1" <?= (isset($_POST['color_code']) && $_POST['color_code'] == 'Blue') ? 'selected' : (($tricycleApplicationData1->color_code == 'Blue') ? 'selected' : ''); ?>>Blue</option>
                  <option value="Yellow" data-route-area1="Free Zone & Zone 3" <?= (isset($_POST['color_code']) && $_POST['color_code'] == 'Yellow') ? 'selected' : (($tricycleApplicationData1->color_code == 'Yellow') ? 'selected' : ''); ?>>Yellow</option>
                  <option value="Green" data-route-area1="Free Zone & Zone 4" <?= (isset($_POST['color_code']) && $_POST['color_code'] == 'Green') ? 'selected' : (($tricycleApplicationData1->color_code == 'Green') ? 'selected' : ''); ?>>Green</option>
                </select>
              </div>
              <div class="col-4 px-5">
                <label for="route_area1" class="form-label">Route Area</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="route_area1" name="route_area1" style="cursor:pointer;" placeholder="Select Color Code First" data-toggle="tooltip" data-bs-placement="top" title="Please choose a Color Code to determine the Route Area for the tricycle. This field is read-only." value="<?= (isset($_POST['route_area']) ? $_POST['route_area'] : ($tricycleApplicationData1->route_area ?? '')); ?>" readonly required>
                  <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                    <i class="fa-solid fa-info-circle"></i>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-12 d-flex mb-5">
              <div class="col-4 px-5">
                <label for="make_model1" class="form-label">Make Model</label>
                <input type="text" class="form-control" id="make_model1" name="make_model1" value="<?= (isset($_POST['make_model']) ? $_POST['make_model'] : ($tricycleApplicationData1->make_model ?? '')); ?>" required>
              </div>
              <div class="col-4 px-5">
                <label for="make_model_year_acquired1" class="form-label">Model Year Acquired</label>
                <input type="text" class="form-control text-uppercase" id="make_model_year_acquired1" name="make_model_year_acquired1" value="<?= (isset($_POST['make_model_year_acquired']) ? $_POST['make_model_year_acquired'] : ($tricycleApplicationData1->make_model_year_acquired ?? '')); ?>" required>
              </div>
              <div class="col-4 px-5">
                <label for="make_model_expiry_date1" class="form-label">Model Expiry Date</label>
                <input type="date" class="form-control text-uppercase" id="make_model_expiry_date1" name="make_model_expiry_date1" value="<?= (isset($_POST['make_model_expiry_date']) ? $_POST['make_model_expiry_date'] : ($tricycleApplicationData1->make_model_expiry_date ?? '')); ?>" required>
              </div>
            </div>

            <div class="col-12 d-flex mb-2">
              <div class="col-4 px-5">
                <label for="motor_number1" class="form-label">Motor Number</label>
                <input type="text" class="form-control" id="motor_number1" name="motor_number1" value="<?= (isset($_POST['motor_number']) ? $_POST['motor_number'] : ($tricycleApplicationData1->motor_number ?? '')); ?>" min="0" required>
              </div>
              <div class="col-4 px-5">
                <label for="insurer1" class="form-label">Insurer</label>
                <input type="text" class="form-control" id="insurer1" name="insurer1" value="<?= (isset($_POST['insurer']) ? $_POST['insurer'] : ($tricycleApplicationData1->insurer ?? '')); ?>" required>
              </div>
              <?php if (!empty($tricycleApplicationData1['cin_number'])): ?>
                <div class="col-4 px-5">
                  <label for="tricycle_cin_number_id1" class="form-label">Tricycle CIN</label>                          
                  <div class="input-group">
                    <input type="text" class="form-control" id="tricycle_cin_number_id1" name="tricycle_cin_number_id1" value="<?= $tricycleApplicationData1['cin_number'] ?>" data-toggle="tooltip" data-bs-placement="top" title="Default tricycle CIN." readonly required>
                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                      <i class="fa-solid fa-info-circle"></i>
                    </span>
                  </div>
                </div>
              <?php else: ?>
                <div class="col-4 px-5">
                  <label for="tricycle_cin_number_id1" class="form-label">Tricycle CIN</label>
                  <input type="text" class="form-control" id="tricycle_cin_number_id1" name="tricycle_cin_number_id1" value="" data-toggle="tooltip" data-bs-placement="top" title="No available Tricycle CIN numbers." readonly disabled>
                </div>
              <?php endif; ?>
            </div>

            <div class="col-12 d-flex mb-5">
              <div class="col-4 px-5">
                <label for="coc_no1" class="form-label">C.O.C Number</label>
                <input type="text" class="form-control" id="coc_no1" name="coc_no1" value="<?= (isset($tricycleApplicationData1->coc_no) ? $tricycleApplicationData1->coc_no : (isset($_POST['coc_no']) ? $_POST['coc_no'] : '')); ?>" min="0" required>
              </div>
              <div class="col-4 px-5">
                <label for="coc_no_expiry_date1" class="form-label">C.O.C Expiry Date</label>
                <input type="date" class="form-control text-uppercase" id="coc_no_expiry_date1" name="coc_no_expiry_date1" value="<?= (isset($tricycleApplicationData1->coc_no_expiry_date) ? $tricycleApplicationData1->coc_no_expiry_date : (isset($_POST['coc_no_expiry_date']) ? $_POST['coc_no_expiry_date'] : '')); ?>" required>
              </div>
            </div>

            <div class="col-12 d-flex mb-2">
              <?php if (!empty($tricycleApplicationData1['cin_number'])): ?>
                <div class="col-4 px-5">
                  <label for="lto_cr_no1" class="form-label">LTO CR Number</label>
                  <input type="text" class="form-control" id="lto_cr_no1" name="lto_cr_no1" value="<?= (isset($tricycleApplicationData1->lto_cr_no) ? $tricycleApplicationData1->lto_cr_no : (isset($_POST['lto_cr_no']) ? $_POST['lto_cr_no'] : '')); ?>" required>
                </div>
                <div class="col-4 px-5">
                  <label for="lto_or_no1" class="form-label">LTO OR Number</label>
                  <input type="text" class="form-control text-uppercase" id="lto_or_no1" name="lto_or_no1" value="<?= (isset($tricycleApplicationData1->lto_or_no) ? $tricycleApplicationData1->lto_or_no : (isset($_POST['lto_or_no']) ? $_POST['lto_or_no'] : '')); ?>" required>
                </div>

                <?php if (!empty($tricycleApplicationData1['driverData'][0])): ?>
                  <?php $driver = $tricycleApplicationData1['driverData'][0]; ?>
                  <div class="col-4 px-5">
                    <label for="driver_id1" class="form-label">Name of Driver</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="driver_id1" name="driver_id1" value="<?= $driver->first_name . ' ' . $driver->middle_name . ' ' . $driver->last_name ?>" data-toggle="tooltip" data-bs-placement="top" title="Default Driver Name." readonly required>
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                <?php else: ?>
                  <div class="col-4 px-5">
                    <label for="driver_id1" class="form-label">Name of Driver</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="driver_id1" name="driver_id1" value="Selected Tricycle CIN has no driver." data-toggle="tooltip" data-bs-placement="top" title="Selected Tricycle CIN has no driver." readonly required>
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                        <i class="fa-solid fa-info-circle"></i>
                      </span>
                    </div>
                  </div>
                <?php endif; ?>
              <?php else: ?>
                <div class="col-4 px-5">
                  <label for="lto_cr_no1" class="form-label">LTO CR Number</label>
                  <input type="text" class="form-control" id="lto_cr_no1" name="lto_cr_no1" value="" data-toggle="tooltip" data-bs-placement="top" title="No Tricycle CIN has been selected." readonly disabled>
                </div>
                <div class="col-4 px-5">
                  <label for="lto_or_no1" class="form-label">LTO OR Number</label>
                  <input type="date" class="form-control text-uppercase" id="lto_or_no1" name="lto_or_no1" value="" data-toggle="tooltip" data-bs-placement="top" title="No Tricycle CIN has been selected." readonly disabled>
                </div>
                <div class="col-4 px-5">
                  <label for="driver_id1" class="form-label">Name of Driver</label>
                  <input type="text" class="form-control phone-no" style="cursor: pointer;" id="driver_id1" name="driver_id1" value="" data-toggle="tooltip" data-bs-placement="top" title="No tricycle drivers are currently available for selection." readonly disabled>
                </div>
              <?php endif; ?>
            </div>

            <div class="col-12 d-flex mb-2">
              <?php if (!empty($tricycleApplicationData1['driverData'][0])): ?>
                <?php $driver = $tricycleApplicationData1['driverData'][0]; ?>
                <div class="col-4 px-5">
                  <label for="driver_license_no1" class="form-label">Driver License Number</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="driver_license_no1" name="driver_license_no1" value="<?= $driver->license_no ?>" data-toggle="tooltip" data-bs-placement="top" title="Default Driver License No." readonly required>
                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                      <i class="fa-solid fa-info-circle"></i>
                    </span>
                  </div>
                </div>
                <div class="col-4 px-5">
                  <label for="driver_license_expiry_date1" class="form-label">License Expiry Date</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="driver_license_expiry_date1" name="driver_license_expiry_date1" value="<?= $driver->license_expiry_date ?>" data-toggle="tooltip" data-bs-placement="top" title="Default Driver License Expiry Date" readonly required>
                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                      <i class="fa-solid fa-info-circle"></i>
                    </span>
                  </div>
                </div>
              <?php else: ?>
                <div class="col-4 px-5">
                  <label for="driver_license_no1" class="form-label">Driver License Number</label>
                  <input type="text" class="form-control" id="driver_license_no1" name="driver_license_no1" value="" data-toggle="tooltip" data-bs-placement="top" title="Selected Tricycle CIN has no driver." readonly disabled>
                </div>
                <div class="col-4 px-5">
                  <label for="driver_license_expiry_date1" class="form-label">License Expiry Date</label>
                  <input type="date" class="form-control text-uppercase" id="driver_license_expiry_date1" name="driver_license_expiry_date1" value="" data-toggle="tooltip" data-bs-placement="top" title="Selected Tricycle CIN has no driver." readonly disabled>
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

   <!-- *** STEP 1 *** -->
    <section id="step-1">
      <div class="content-container mt-2 mb-3 pb-3">
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
              <label for="transfer_type" class="form-label">Transfer Type</label>
              <div class="input-group">
                <input type="text" class="form-control" style="cursor: pointer;" id="transfer_type" name="transfer_type" value="<?php echo isset($transfer_type) ? $transfer_type : ''; ?>" data-toggle="tooltip" data-bs-placement="top" title="Default transfer type. This field is read-only." readonly>
                <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                  <i class="fa-solid fa-info-circle"></i>
                </span>
              </div>
            </div>
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
  </form>
</main>
<script src="public/assets/js/appointments_form_toggle2.js"></script>
<script>
  $(document).ready(function () {
    function updateAssessmentFee1() {
      let selectedColorCode = $("#color_code1").val();
      let selectedRouteArea = $("#color_code1").find(":selected").data("route-area1");
      $("#route_area1").val(selectedRouteArea);

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

      $("#assessmentFeeText2").text(assessmentFeeText);
      $("#assessmentFeeText4").text(assessmentFeeText);
    }

    updateAssessmentFee1();

    $("#color_code1").change(function () {
      updateAssessmentFee1();
    });

    function updateAssessmentFee2() {
      let selectedColorCode = $("#color_code2").val();
      let selectedRouteArea = $("#color_code2").find(":selected").data("route-area2");
      $("#route_area2").val(selectedRouteArea);

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

      $("#assessmentFeeText").text(assessmentFeeText);
      $("#assessmentFeeText3").text(assessmentFeeText);
    }

    updateAssessmentFee2();

    $("#color_code2").change(function () {
      updateAssessmentFee2();
    });

    const step3form1 = document.getElementById('step3form1');
    const step3form2 = document.getElementById('step3form2');
    const step2form1 = document.getElementById('step2form1');
    const step2form2 = document.getElementById('step2form2');

    if (document.getElementById('assessmentFeeText') && document.getElementById('assessmentFeeText2') && document.getElementById('assessmentFeeText3') && document.getElementById('assessmentFeeText4')) {
      if ((step2form1 && step3form1 && step2form1.style.display === "block") || (step3form1 && step3form1.style.display === "block")) {
        updateAssessmentFee1();
        document.getElementById("assessmentFeeText2").style.display = "none";
        document.getElementById("assessmentFeeText4").style.display = "none";
      }
      
      if ((step2form2 && step3form2 && step2form2.style.display === "block") || (step3form2 && step3form2.style.display === "block")) {
        updateAssessmentFee2();
        document.getElementById("assessmentFeeText").style.display = "none";
        document.getElementById("assessmentFeeText3").style.display = "none";
      } 
    }
    
    // Initial hide of assessment fee containers
    $("#assessmentFeeText2, #assessmentFeeText4").hide();

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