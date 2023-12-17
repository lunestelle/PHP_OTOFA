<div class="content-container mt-2">
  <div class="bckgrnd pt-2">
    <h6 class="pl-2 text-uppercase text-center text-dark fs-6">Motor Unit</h6>
  </div>
  <div class="row px-3 p-4">
    <div class="col-12 d-flex justify-content-between pt-2">
      <div>
        <p class="form-label">Operator's Name</p>
        <div class="form-control">
          <?php echo isset($tricycleApplicationData->operator_name) ? $tricycleApplicationData->operator_name : ''; ?>
        </div>
      </div>
      <div>
        <p class="form-label">Operator's Address</p>
        <div class="form-control">
          <?php echo isset($tricycleApplicationData->address) ? $tricycleApplicationData->address : ''; ?>
        </div>
      </div>
      <div>
        <p for="color_code" class="form-label">Phone Number</p>
        <div class="form-control">
          <?php echo isset($tricycleApplicationData->tricycle_phone_number) ? $tricycleApplicationData->tricycle_phone_number : ''; ?>
        </div>
      </div>
      <div>
        <p class="form-label">MTOP Number</p>
        <div class="form-control">
          <?php echo isset($tricycleApplicationData->mtop_no) ? $tricycleApplicationData->mtop_no : ''; ?>
        </div>
      </div>
    </div>

    <div class="col-12 d-flex justify-content-between">
      <div>
        <p class="form-label">Tricycle CIN</p>
        <div class="form-control">
          <?php echo isset($cin) ? $cin : ''; ?>
        </div>
      </div>
      <div>
        <p class="form-label">Make Model</p>
        <div class="form-control">
          <?php echo isset($tricycleApplicationData->make_model) ? $tricycleApplicationData->make_model : ''; ?>
        </div>
      </div>
      <div>
        <p for="year_acquired" class="form-label">Model Expiry Date</p>
        <div class="form-control">
          <?php echo isset($tricycleApplicationData->make_model_expiry_date) ? $tricycleApplicationData->make_model_expiry_date : ''; ?>
        </div>
      </div>
      <div>
        <p class="form-label">Motor Number</p>
        <div class="form-control">
          <?php echo isset($tricycleApplicationData->motor_number) ? $tricycleApplicationData->motor_number : ''; ?>
        </div>
      </div>
    </div>

    <div class="col-12 d-flex justify-content-between pt-2">
      <div>
        <p for="or_date" class="form-label">Color Code</p>
        <div class="form-control">
          <?php echo isset($tricycleApplicationData->color_code) ? $tricycleApplicationData->color_code : ''; ?>
        </div>
      </div>
      <div>
        <p for="or_date" class="form-label">Route Area</p>
        <div class="form-control">
          <?php echo isset($tricycleApplicationData->route_area) ? $tricycleApplicationData->route_area : ''; ?>
        </div>
      </div>
      <div>
        <p for="or_date" class="form-label">COC Number</p>
        <div class="form-control">
          <?php echo isset($tricycleApplicationData->coc_no) ? $tricycleApplicationData->coc_no : ''; ?>
        </div>
      </div>
      <div>
        <p for="or_date" class="form-label">COC Expiry Date</p>
        <div class="form-control">
        <?php echo isset($tricycleApplicationData->coc_no_expiry_date) ? $tricycleApplicationData->coc_no_expiry_date : ''; ?>
        </div>
      </div>
    </div>

    <div class="col-12 d-flex justify-content-between pt-2">
      <div>
        <p for="or_date" class="form-label">Tricycle Status</p>
        <div class="form-control">
          <?php echo isset($status) ? $status : ''; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="content-container mt-4">
  <div class="bckgrnd pt-2">
    <h6 class="pl-2 text-uppercase text-center text-dark fs-6">MTOP REQUIREMENTS IMAGES</h6>
  </div>

  <div class="row justify-content-evenly px-3 p-3">
    <?php
      function displayImage($imagePath, $imageAlt) {
        if ($imagePath) {
          echo '<div class="col-md-4 text-center">';
          echo '<p class="form-label fw-semibold fs-6">' . $imageAlt . '</p>';
          echo '<div class="image-container position-relative" data-bs-toggle="modal" data-bs-target="#exampleModal">';
          echo '<img src="' . $imagePath . '" class="img-fluid rounded fixed-height-image" alt="' . $imageAlt . '">';
          echo '</div>';
          echo '</div>';
        } else {
          echo '<div class="col-md-4 text-center">';
          echo '<p class="form-label">' . $imageAlt . ' Image not available</p>';
          echo '</div>';
        }
      }

      displayImage($mtopData->mc_lto_certificate_of_registration_path, 'LTO Certificate of Registration (MC of New Unit)');
      displayImage($mtopData->mc_lto_official_receipt_path, 'LTO Official Receipt (MC of New Unit)');
      displayImage($mtopData->mc_plate_authorization_path, 'Plate Authorization (MC of New Unit)');
      displayImage($mtopData->tc_insurance_policy_path, 'Insurance Policy (TC) (New Owner)');
      displayImage($mtopData->unit_front_view_image_path, 'Picture of New Unit (Front View)');
      displayImage($mtopData->unit_side_view_image_path, 'Picture of New Unit (Side View)');
      displayImage($mtopData->sketch_location_of_garage_path, 'Sketch Location of Garage');
      displayImage($mtopData->affidavit_of_income_tax_return_path, 'Affidavit of No Income or Latest Income Tax Return');
      displayImage($mtopData->driver_cert_safety_driving_seminar_path, 'Driver\'s Certificate of Safety Driving Seminar');
      displayImage($mtopData->proof_of_id_path, 'Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)');
    ?>
  </div>
</div>