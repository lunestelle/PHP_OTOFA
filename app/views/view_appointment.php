<?php
  function displayImage($imagePath, $imageAlt)
  {
    if ($imagePath) {
      echo '<div class="col-md-4 text-center mb-3 p-2">';
      echo '<p class="form-label fw-semibold">' . $imageAlt . '</p>';
      echo '<div class="image-container position-relative" data-bs-toggle="modal" data-bs-target="#exampleModal">';
      echo '<img src="' . $imagePath . '" class="img-fluid rounded fixed-height-image" alt="' . $imageAlt . '">';
      echo '</div>';
      echo '</div>';
    } else {
      echo '<div class="col-md-4 text-center mb-3 p-2">';
      echo '<p class="form-label">' . $imageAlt . ' Image not available</p>';
      echo '</div>';
    }
  }
?>

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
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">View Appointment</h6>
    </div>
    <div class="col-lg-12 mx-auto">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4">
            <!-- *** STEP 1 *** -->
            <section id="step-1">
              <div class="content-container">
                <div class="container mt-3">
                  <div class="d-flex justify-content-center">
                    <div class="row px-3">
                      <div class="col-md-3">
                        <div class="row mt-3">
                          <p> <span class="fw-bolder mr-5 text-uppercase">Full Name:</span> 
                          <p><span class="fw-bolder mr-5 text-uppercase">Phone Number:</span> 
                          <p><span class="fw-bolder mr-5 text-uppercase">Preferred Date:</span> 
                          <p><span class="fw-bolder mr-5 text-uppercase">Status:</span> 
                        </div>
                      </div>
                      <div class="col-md-3 mt-3">
                        <?php echo ucwords(strtolower($appointment->name)); ?></p>
                        <?php echo ($appointment->phone_number); ?></p>
                        <?php echo strtoupper($appointment->appointment_date); ?></p>
                        <?php echo ucwords(strtolower($appointment->status)); ?></p>
                      </div>
                      <div class="col-md-6">
                        <div class="row mt-3">
                          <div class="col-md-6">
                            <p><span class="fw-bolder mr-5 text-uppercase">Email:</span>
                            <p><span class="fw-bolder mr-5 text-uppercase">Appointment Type:</span>
                            <p><span class="fw-bolder mr-5 text-uppercase">Preferred Time:</span> 
                            <?php if (!empty($appointment->transfer_type) && $appointment->appointment_type === "Transfer of Ownership"): ?>
                              <p><span class="fw-bolder mr-5 text-uppercase">Transfer Type:</span>
                            <?php endif; ?>
                          </div>
                          <div class="col-md-6">
                            <?php echo ($appointment->email); ?></p>
                            <?php echo ucwords(strtolower($appointment->appointment_type)); ?></p>
                            <?php echo strtoupper($appointment_time); ?></p>
                            <?php if (!empty($appointment->transfer_type) && $appointment->appointment_type === "Transfer of Ownership"): ?>
                              <?php echo ucwords(strtolower($appointment->transfer_type)); ?></p>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>                        
                    </div>
                  </div>
                </div>
              </div>

              <?php if (strtolower($appointment->status) == 'rejected' && !empty($appointment->comments)): ?>
                <div class="content-container mt-4">
                  <div class="bckgrnd pt-2">
                    <h6 class="pl-2 text-uppercase text-center text-dark fs-6">Appointment Rejection Comment</h6>
                  </div>
                  <div class="container">
                    <div class="d-flex justify-content-center">
                      <div class="row px-3">
                        <div class="col-md-12 text-start rejection-comment ">
                          <p class="rejection-comment "><?php echo $appointment->comments; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
              <div class="text-end mt-3">
                <button type="button" class="sidebar-btnContent" onclick="showStep(2)">Next</button>
              </div>
            </section>
                    
            <!-- *** STEP 2 *** -->
            <section id="step-2" style="display: none;">
              <div class="content-container mt-4">
                <div class="container mt-3">
                  <div class="d-flex justify-content-center">
                    <div class="row px-3">
                      <div class="col-md-3">
                        <div class="row mt-3">
                          <p> <span class="fw-bolder mr-5 text-uppercase">Name of Operator:</span> 
                          <p><span class="fw-bolder mr-5 text-uppercase">Phone Number:</span>
                          <p><span class="fw-bolder mr-5 text-uppercase">Color Code:</span>
                          <p><span class="fw-bolder mr-5 text-uppercase">Make Model:</span>
                          <p><span class="fw-bolder mr-5 text-uppercase">Model Year Acquired:</span>
                          <p><span class="fw-bolder mr-5 text-uppercase">C.O.C Number:</span>
                          <p><span class="fw-bolder mr-5 text-uppercase">Tricycle CIN:</span>
                          <?php if (!empty($tricycleApplication->lto_or_no)): ?>
                            <p><span class="fw-bolder mr-5 text-uppercase">LTO OR Number:</span>
                          <?php endif; ?>
                          <?php if (!empty($driver_license_no)): ?>
                            <p><span class="fw-bolder mr-5 text-uppercase">Driver License Number:</span>
                          <?php endif; ?>
                          <?php if (!empty($driver_license_expiry_date) && $driver_license_expiry_date != "0000-00-00"): ?>
                            <p><span class="fw-bolder mr-5 text-uppercase">License Expiry Date:</span>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="col-md-3 mt-3">
                        <?php echo ucwords(strtolower($tricycleApplication->operator_name)); ?></p>
                        <?php echo ($tricycleApplication->tricycle_phone_number); ?></p>
                        <?php echo ucwords(strtolower($tricycleApplication->color_code)); ?></p>
                        <?php echo ucwords(strtolower($tricycleApplication->make_model)); ?></p>
                        <?php echo($tricycleApplication->make_model_year_acquired); ?></p>
                        <?php echo ucwords(strtolower($tricycleApplication->coc_no)); ?></p>
                        <?php echo $tricycle_cin; ?></p>
                        <?php if (!empty($tricycleApplication->lto_or_no)): ?>
                          <?php echo $tricycleApplication->lto_or_no; ?></p>
                        <?php endif; ?>
                        <?php if (!empty($driver_license_no)): ?>
                          <?php echo  $driver_license_no; ?></p>
                        <?php endif; ?>
                        <?php if (!empty($driver_license_expiry_date && $driver_license_expiry_date != "0000-00-00")): ?>
                          <?php echo ($driver_license_expiry_date); ?></p>
                        <?php endif; ?>
                      </div>
                      <div class="col-md-6">
                        <div class="row mt-3">
                          <div class="col-md-6">
                            <p><span class="fw-bolder mr-5 text-uppercase">Address:</span>
                            <p><span class="fw-bolder mr-5 text-uppercase">MTOP Number:</span> 
                            <p><span class="fw-bolder mr-5 text-uppercase">Route Area:</span>
                            <p><span class="fw-bolder mr-5 text-uppercase">Model Expiry Date:</span>
                            <p><span class="fw-bolder mr-5 text-uppercase">Motor Number:</span>
                            <p><span class="fw-bolder mr-5 text-uppercase">C.O.C Expiry Date:</span>
                            <p><span class="fw-bolder mr-5 text-uppercase">Insurer:</span>
                            <?php if (!empty($tricycleApplication->lto_cr_no)): ?>
                              <p><span class="fw-bolder mr-5 text-uppercase">LTO CR Number:</span>
                            <?php endif; ?>
                            <?php if ($appointment->appointment_type === "New Franchise" && $appointment->status == "Pending" && !empty($driver_name)) : ?>

                            <?php else : ?>
                              <?php if (!empty($driver_name)) : ?>
                                <p><span class="fw-bolder mr-5 text-uppercase">Name of Driver:</span>
                              <?php endif; ?>
                            <?php endif; ?>
                          </div>
                          <div class="col-md-6">
                            <p style="overflow: hidden; white-space: nowrap;"><?php echo ucwords(strtolower($tricycleApplication->address)); ?></p>
                            <?php echo strtoupper($tricycleApplication->mtop_no); ?></p>
                            <?php echo ($tricycleApplication->route_area); ?></p>
                            <?php echo ($tricycleApplication->make_model_expiry_date); ?></p>
                            <?php echo ucwords(strtolower($tricycleApplication->motor_number)); ?></p>
                            <?php echo ($tricycleApplication->coc_no_expiry_date); ?></p>
                            <?php echo ($tricycleApplication->insurer); ?></p>
                            <?php if (!empty($tricycleApplication->lto_cr_no)): ?>
                              <?php echo ($tricycleApplication->lto_cr_no); ?></p>
                            <?php endif; ?>
                            <?php if ($appointment->appointment_type === "New Franchise" && $appointment->status == "Pending" && !empty($driver_name)) : ?>
                            <?php else : ?>
                              <?php if (!empty($driver_name)) : ?>
                                <?php echo ($driver_name); ?></p>
                              <?php endif; ?>
                            <?php endif; ?>
                          </div>
                        </div>
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
              <?php if ($appointment->appointment_type === "New Franchise") { ?>
                <div class="content-container mt-4">
                  <div class="row justify-content-evenly px-3 p-3">
                    <?php
                      displayImage($mtopRequirement->mc_lto_certificate_of_registration_path, 'LTO Certificate of Registration (MC of New Unit)');
                      displayImage($mtopRequirement->mc_lto_official_receipt_path, 'LTO Official Receipt (MC of New Unit)');
                      displayImage($mtopRequirement->mc_plate_authorization_path, 'Plate Authorization (MC of New Unit)');
                      displayImage($mtopRequirement->tc_insurance_policy_path, 'Insurance Policy (TC) (New Owner)');
                      displayImage($mtopRequirement->unit_front_view_image_path, 'Picture of New Unit (Front View)');
                      displayImage($mtopRequirement->unit_side_view_image_path, 'Picture of New Unit (Side View)');
                      displayImage($mtopRequirement->sketch_location_of_garage_path, 'Sketch Location of Garage');
                      displayImage($mtopRequirement->affidavit_of_income_tax_return_path, 'Affidavit of No Income or Latest Income Tax Return');
                      displayImage($mtopRequirement->driver_cert_safety_driving_seminar_path, 'Driver\'s Certificate of Safety Driving Seminar');
                      displayImage($mtopRequirement->proof_of_id_path, 'Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)');
                    ?>
                  </div>
                </div>
              <?php } elseif ($appointment->appointment_type === "Renewal of Franchise") { ?>
                <div class="content-container mt-4">
                  <div class="row justify-content-evenly px-3 p-3">
                    <?php
                      displayImage($mtopRequirement->tc_lto_certificate_of_registration_path, 'LTO Certificate of Registration (TC)');
                      displayImage($mtopRequirement->tc_lto_official_receipt_path, 'LTO Official Receipt (TC)');
                      displayImage($mtopRequirement->tc_plate_authorization_path, 'Plate Authorization (TC)');
                      displayImage($mtopRequirement->tc_renewed_insurance_policy_path, 'Renewed Insurance Policy (TC)');
                      displayImage($mtopRequirement->latest_franchise_path, 'Latest Franchise (TC)');
                    ?>
                  </div>
                </div>
              <?php } elseif ($appointment->appointment_type === "Change of Motorcycle") { ?>
                <div class="content-container mt-4">
                  <div class="row justify-content-evenly px-3 p-3">
                    <div class="text-center">
                      <h6>Old Unit</h6>
                    </div>
                    <?php
                      displayImage($mtopRequirement->or_of_return_plate_path, 'OR of Return Plate');
                      displayImage($mtopRequirement->tc_lto_certificate_of_registration_path, 'LTO Certificate of Registration (TC)');
                      displayImage($mtopRequirement->tc_lto_official_receipt_path, 'LTO Official Receipt (TC)');
                      displayImage($mtopRequirement->latest_franchise_path, 'Latest Franchise (TC)');
                    ?>
                  </div>
                  <div class="row justify-content-evenly px-3 p-3">
                    <div class="text-center">
                      <h6>New Unit</h6>
                    </div>
                    <?php
                      displayImage($mtopRequirement->mc_lto_certificate_of_registration_path, 'LTO Certificate of Registration (MC)');
                      displayImage($mtopRequirement->mc_lto_official_receipt_path, 'LTO Official Receipt (MC)');
                      displayImage($mtopRequirement->mc_plate_authorization_path, 'Plate Authorization (MC of New Unit)');
                      displayImage($mtopRequirement->tc_insurance_policy_path, 'Insurance Policy (TC)');
                      displayImage($mtopRequirement->unit_front_view_image_path, 'Picture of New Unit (Front View)');
                      displayImage($mtopRequirement->unit_side_view_image_path, 'Picture of New Unit (Side View)');
                    ?>
                  </div>
                </div>
              <?php } elseif ($appointment->appointment_type === "Transfer of Ownership") { ?>
              <div class="content-container mt-4">
                <div class="bckgrnd pt-2">
                  <h6 class="pl-2 text-uppercase text-center text-dark fs-6">MTOP Requirements Images</h6>
                </div>
                <div class="row justify-content-evenly px-3 p-3">
                  <?php
                    displayImage($mtopRequirement->mc_lto_certificate_of_registration_path, 'LTO Certificate of Registration (MC of New Unit)');
                    displayImage($mtopRequirement->mc_lto_official_receipt_path, 'LTO Official Receipt (MC of New Unit)');
                    displayImage($mtopRequirement->mc_plate_authorization_path, 'Plate Authorization (MC of New Unit)');
                    displayImage($mtopRequirement->tc_insurance_policy_path, 'Insurance Policy (TC) (New Owner)');
                    displayImage($mtopRequirement->latest_franchise_path, 'Latest Franchise (TC)');
                    displayImage($mtopRequirement->proof_of_id_path, 'Proof of ID / Residence');
                    displayImage($mtopRequirement->sketch_location_of_garage_path, 'Sketch Location of Garage');
                    displayImage($mtopRequirement->affidavit_of_income_tax_return_path, 'Affidavit of No Income or Latest Income Tax Return');
                    displayImage($mtopRequirement->driver_cert_safety_driving_seminar_path, 'Driver\'s Certificate of Safety Driving Seminar');
                    displayImage($mtopRequirement->unit_front_view_image_path, 'Picture of New Unit (Front View)');
                    displayImage($mtopRequirement->unit_side_view_image_path, 'Picture of New Unit (Side View)');
                  ?>

                  <?php if ($appointment->transfer_type === "Transfer of Ownership from Deceased Owner" && !empty($mtopRequirement->death_certificate_path) && !empty($mtopRequirement->agreement_amongst_heirs_path)) { ?>
                    <div class="row justify-content-evenly px-3 p-3">
                      <div class="text-center">
                        <h6>Additional Requirements</h6>
                      </div>
                      <?php
                        displayImage($mtopRequirement->death_certificate_path, 'Death Certificate');
                        displayImage($mtopRequirement->agreement_amongst_heirs_path, 'Agreement Amongst Heirs');
                      ?>
                    </div>
                    <?php } elseif ($appointment->transfer_type === "Intent of Transfer" && !empty($mtopRequirement->deed_of_donation_or_deed_of_sale_path)) { ?>
                      <div class="row justify-content-evenly px-3 p-3">
                        <div class="text-center">
                          <h6>Additional Requirement</h6>
                        </div>
                        <?php
                          displayImage($mtopRequirement->deed_of_donation_or_deed_of_sale_path, 'Deed of Donation or Deed of Sale');
                        ?>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <?php } ?>
              <div class="mt-3">
                <button type="button" class="sidebar-btnContent-1 text-start" onclick="showStep(2)">Previous</button>
                <a href="./appointments" class="sidebar-btnContent text-white px-3 mt-4">Back</a>
              </div>
            </section>

              <!-- Bootstrap Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header border-0">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-auto">
                      <img src="" class="img-fluid" id="modalImage" alt="Enlarged Image">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  document.querySelectorAll('.image-container').forEach(function (container) {
    container.addEventListener('click', function () {
      var imageSrc = this.querySelector('img').src;
      document.getElementById('modalImage').src = imageSrc;
    });
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
    stepButtonsContainer.scrollIntoView({ behavior: 'smooth' });
  }

  // Event listener for the Next button
  document.getElementById('nextButton').addEventListener('click', () => {
    const activeStepButton = document.querySelector('.step-button.active');
    const nextStepButton = activeStepButton.nextElementSibling;

    if (nextStepButton) {
      const nextStep = parseInt(nextStepButton.textContent);
      showStep(nextStep);
    }
  });

  // Event listener for the Previous button
  document.getElementById('prevButton').addEventListener('click', () => {
    const activeStepButton = document.querySelector('.step-button.active');
    const prevStepButton = activeStepButton.previousElementSibling;

    if (prevStepButton) {
      const prevStep = parseInt(prevStepButton.textContent);
      showStep(prevStep);
    }
  });
</script>