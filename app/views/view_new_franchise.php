<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">View Appointment</h6>
    </div>
    <div class="col-lg-12 mx-auto">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4">
            <div>
              <div class="content-container">
                <div class="bckgrnd pt-2">
                  <h6 class="pl-2 text-uppercase text-center text-dark fs-6">Appointment Details</h6>
                </div>
                <div class="container mt-3">
                  <div class="d-flex justify-content-center">
                    <div class="row px-3">
                      <div class="col-md-3">
                        <div class="row mt-3">
                          <p> <span class="fw-bolder mr-5 text-uppercase">Full Name:</span> 
                          <p><span class="fw-bolder mr-5 text-uppercase">Phone Number:</span> 
                          <p><span class="fw-bolder mr-5 text-uppercase">Preferred Date:</span> 
                          <p><span class="fw-bolder mr-5 text-uppercase">Status:</span> 
                          <hr>
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
                          </div>
                          <div class="col-md-6">
                            <?php echo ($appointment->email); ?></p>
                            <?php echo ucwords(strtolower($appointment->appointment_type)); ?></p>
                            <?php echo strtoupper($appointment_time); ?></p>
                          </div>
                        </div>
                      </div>                        
                    </div>
                  </div>
                </div>
              </div>

              <div class="content-container mt-4">
                <div class="bckgrnd pt-2">
                  <h6 class="pl-2 text-uppercase text-center text-dark fs-6">Tricycle Application Form Details</h6>
                </div>
                <div class="container mt-3">
                  <div class="d-flex justify-content-center">
                    <div class="row px-3">
                      <div class="col-md-3">
                        <div class="row mt-3">
                          <p> <span class="fw-bolder mr-5 text-uppercase">Name of Operator:</span> 
                          <p><span class="fw-bolder mr-5 text-uppercase">Phone Number:</span>
                          <p><span class="fw-bolder mr-5 text-uppercase">Color Code:</span>
                          <p><span class="fw-bolder mr-5 text-uppercase">Make Model:</span>
                          <p><span class="fw-bolder mr-5 text-uppercase">Motor Number:</span>
                          <p><span class="fw-bolder mr-5 text-uppercase">C.O.C Number:</span>
                          <hr>
                        </div>
                      </div>
                      <div class="col-md-3 mt-3">
                        <?php echo ucwords(strtolower($tricycleApplication->operator_name)); ?></p>
                        <?php echo ($tricycleApplication->tricycle_phone_number); ?></p>
                        <?php echo ucwords(strtolower($tricycleApplication->color_code)); ?></p>
                        <?php echo ucwords(strtolower($tricycleApplication->make_model)); ?></p>
                        <?php echo ucwords(strtolower($tricycleApplication->motor_number)); ?></p>
                        <?php echo ucwords(strtolower($tricycleApplication->coc_no)); ?></p>
                      </div>
                      <div class="col-md-6">
                        <div class="row mt-3">
                          <div class="col-md-6">
                            <p><span class="fw-bolder mr-5 text-uppercase">Address:</span>
                            <p><span class="fw-bolder mr-5 text-uppercase">MTOP Number:</span> 
                            <p><span class="fw-bolder mr-5 text-uppercase">Route Area:</span>
                            <p><span class="fw-bolder mr-5 text-uppercase">Model Expiry Date:</span>
                            <p><span class="fw-bolder mr-5 text-uppercase">Insurer:</span>
                            <p><span class="fw-bolder mr-5 text-uppercase">C.O.C Expiry Date:</span>
                          </div>
                          <div class="col-md-6">
                            <p style="overflow: hidden; white-space: nowrap;"><?php echo ucwords(strtolower($tricycleApplication->address)); ?></p>
                            <?php echo strtoupper($tricycleApplication->mtop_no); ?></p>
                            <?php echo ($tricycleApplication->route_area); ?></p>
                            <?php echo ($tricycleApplication->make_model_expiry_date); ?></p>
                            <p class="text-capitalize"><?php echo ($tricycleApplication->insurer); ?></p>
                            <?php echo ($tricycleApplication->coc_no_expiry_date); ?></p>
                          </div>
                        </div>
                      </div>                        
                    </div>
                  </div>
                </div>
              </div>

              <div class="content-container mt-4">
                <div class="bckgrnd pt-2">
                  <h6 class="pl-2 text-uppercase text-center text-dark fs-6">MTOP Requirements Images</h6>
                </div>
                <div class="row justify-content-evenly px-3 p-3">
                  <?php
                    function displayImage($imagePath, $imageAlt) {
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

              <div>
                <a href="./appointments" class="sidebar-btnContent text-white px-3 mt-4">Back</a>
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
</script>