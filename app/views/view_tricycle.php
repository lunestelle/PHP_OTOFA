<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">View Tricycle</h6>
    </div>
    <div class="col-lg-12 mt-4">
      <div class="row">
        <div class="col-12 pt-2">
          <div id="newTricycleForm">
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

                <div class="col-12 d-flex justify-content-between pt-2">
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
                    <p for="or_date" class="form-label">Insurer</p>
                    <div class="form-control">
                      <?php echo isset($tricycleApplicationData->insurer) ? $tricycleApplicationData->insurer : ''; ?>
                    </div>
                  </div>
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
                </div>

                <div class="col-12 d-flex justify-content-between pt-2">
                  <?php if (!empty($tricycleApplicationData->lto_cr_no) && !empty($tricycleApplicationData->lto_or_no) && !empty($driver_name)): ?>
                    <div>
                      <p for="coc_no_expiry_date" class="form-label">COC Expiry Date</p>
                      <div class="form-control">
                      <?php echo isset($tricycleApplicationData->coc_no_expiry_date) ? $tricycleApplicationData->coc_no_expiry_date : ''; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php if (!empty($tricycleApplicationData->lto_cr_no)): ?>
                    <div>
                      <p for="lto_cr_no" class="form-label">LTO CR Number</p>
                      <div class="form-control">
                      <?php echo isset($tricycleApplicationData->lto_cr_no) ? $tricycleApplicationData->lto_cr_no : ''; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php if (!empty($tricycleApplicationData->lto_or_no)): ?>
                    <div>
                      <p for="lto_or_no" class="form-label">LTO OR Number</p>
                      <div class="form-control">
                      <?php echo isset($tricycleApplicationData->lto_or_no) ? $tricycleApplicationData->lto_or_no : ''; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php if (!empty($driver_name)): ?>
                    <div>
                      <p for="driver_id" class="form-label">Name of Driver</p>
                      <div class="form-control">
                        <?php echo $driver_name; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>

                <div class="col-12 d-flex pt-2">
                  <?php if (!empty($tricycleApplicationData->driver_license_no)): ?>
                    <div class="col-3 pr-3">
                      <p for="driver_license_no" class="form-label">Driver License Number</p>
                      <div class="form-control">
                        <?php echo isset($tricycleApplicationData->driver_license_no) ? $tricycleApplicationData->driver_license_no : ''; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php if (!empty($tricycleApplicationData->driver_license_expiry_date) && $tricycleApplicationData->driver_license_expiry_date != "0000-00-00"): ?>
                    <div class="col-3 px-3">
                      <p for="driver_license_expiry_date" class="form-label">License Expiry Date</p>
                      <div class="form-control">
                        <?php echo isset($tricycleApplicationData->driver_license_expiry_date) ? $tricycleApplicationData->driver_license_expiry_date : ''; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php if (empty($tricycleApplicationData->driver_license_no) && !empty($statuses)): ?>
                    <div class="col-12 d-flex justify-content-between pt-2">
                      <div>
                        <p for="coc_no_expiry_date" class="form-label">COC Expiry Date</p>
                        <div class="form-control">
                          <?php echo isset($tricycleApplicationData->coc_no_expiry_date) ? $tricycleApplicationData->coc_no_expiry_date : ''; ?>
                        </div>
                      </div>
                      <div>
                        <p for="status" class="form-label">Tricycle Status</p>
                        <div class="form-control">
                          <?php echo isset($statuses) ? $statuses : ''; ?>
                        </div>
                      </div>
                      <div>
                        <p for="status" class="form-label"></p>
                        <div class="form-control" style="background: none; color: none; border: none;"></div>
                      </div>
                      <div>
                        <p for="status" class="form-label"></p>
                        <div class="form-control" style="background: none; color: none; border: none;"></div>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php if (!empty($tricycleApplicationData->driver_license_no) && (!empty($tricycleApplicationData->driver_license_expiry_date) && $tricycleApplicationData->driver_license_expiry_date != "0000-00-00") && !empty($statuses)) : ?>
                    <div class="col-3 px-4 mx-1">
                      <p for="status" class="form-label">Tricycle Status</p>
                      <div class="form-control">
                        <?php echo isset($statuses) ? $statuses : ''; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <?php if (!empty($mtopNewFranchiseData)) : ?>
              <div class="content-container mt-4">
                <div class="bckgrnd pt-2">
                  <h6 class="pl-2 text-uppercase text-center text-dark fs-6">NEW FRANCHISE MTOP REQUIREMENTS IMAGES</h6>
                </div>
                <div class="row justify-content-evenly px-3 p-3">
                  <?php
                    function displayImage($imagePath, $imageAlt) {
                      if ($imagePath) {
                        echo '<div class="col-md-4 text-center">';
                        echo '<p class="form-label fw-semibold fs-6 pt-1 mt-1" style="font-size: 14px !important;">' . $imageAlt . '</p>';
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

                    displayImage($mtopNewFranchiseData->mc_lto_certificate_of_registration_path, 'LTO Certificate of Registration (MC of New Unit)');
                    displayImage($mtopNewFranchiseData->mc_lto_official_receipt_path, 'LTO Official Receipt (MC of New Unit)');
                    displayImage($mtopNewFranchiseData->mc_plate_authorization_path, 'Plate Authorization (MC of New Unit)');
                    displayImage($mtopNewFranchiseData->tc_insurance_policy_path, 'Insurance Policy (TC) (New Owner)');
                    displayImage($mtopNewFranchiseData->unit_front_view_image_path, 'Picture of New Unit (Front View)');
                    displayImage($mtopNewFranchiseData->unit_side_view_image_path, 'Picture of New Unit (Side View)');
                    displayImage($mtopNewFranchiseData->sketch_location_of_garage_path, 'Sketch Location of Garage');
                    displayImage($mtopNewFranchiseData->affidavit_of_income_tax_return_path, 'Affidavit of No Income or Latest Income Tax Return');
                    displayImage($mtopNewFranchiseData->driver_cert_safety_driving_seminar_path, 'Driver\'s Certificate of Safety Driving Seminar');
                    displayImage($mtopNewFranchiseData->proof_of_id_path, 'Proof of ID /Residence <br> (Voters/Birth/Baptismal/Marriage Cert.)');
                  ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if (!empty($mtopRenewalFranchiseData)) : ?>
              <div class="content-container mt-4">
                <div class="bckgrnd pt-2">
                  <h6 class="pl-2 text-uppercase text-center text-dark fs-6">RENEWAL OF FRANCHISE MTOP REQUIREMENTS IMAGES</h6>
                </div>
                <div class="row justify-content-evenly px-3 p-3">
                  <?php
                    displayImage($mtopRenewalFranchiseData->tc_lto_certificate_of_registration_path, 'LTO Certificate of Registration (TC)');
                    displayImage($mtopRenewalFranchiseData->tc_lto_official_receipt_path, 'LTO Official Receipt (TC)');
                    displayImage($mtopRenewalFranchiseData->tc_plate_authorization_path, 'Plate Authorization (TC)');
                    displayImage($mtopRenewalFranchiseData->tc_renewed_insurance_policy_path, 'Renewed Insurance Policy (TC)');
                    displayImage($mtopRenewalFranchiseData->latest_franchise_path, 'Latest Franchise (TC)');
                  ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if (!empty($mtopChangeMotorcycleData)) : ?>
              <div class="content-container mt-4">
                <div class="bckgrnd pt-2">
                  <h6 class="pl-2 text-uppercase text-center text-dark fs-6">CHANGE MOTORCYCLE MTOP REQUIREMENTS IMAGES</h6>
                </div>
                <div class="row justify-content-evenly px-3 p-3">
                  <div class="text-center">
                    <h6>Old Unit</h6>
                  </div>
                  <?php
                    displayImage($mtopChangeMotorcycleData->or_of_return_plate_path, 'OR of Return Plate');
                    displayImage($mtopChangeMotorcycleData->tc_lto_certificate_of_registration_path, 'LTO Certificate of Registration (TC)');
                    displayImage($mtopChangeMotorcycleData->tc_lto_official_receipt_path, 'LTO Official Receipt (TC)');
                    displayImage($mtopChangeMotorcycleData->latest_franchise_path, 'Latest Franchise (TC)');
                  ?>
                </div>
                <div class="row justify-content-evenly px-3 p-3">
                  <div class="text-center">
                    <h6>New Unit</h6>
                  </div>
                  <?php
                    displayImage($mtopChangeMotorcycleData->mc_lto_certificate_of_registration_path, 'LTO Certificate of Registration (MC)');
                    displayImage($mtopChangeMotorcycleData->mc_lto_official_receipt_path, 'LTO Official Receipt (MC)');
                    displayImage($mtopChangeMotorcycleData->mc_plate_authorization_path, 'Plate Authorization (MC of New Unit)');
                    displayImage($mtopChangeMotorcycleData->tc_insurance_policy_path, 'Insurance Policy (TC)');
                    displayImage($mtopChangeMotorcycleData->unit_front_view_image_path, 'Picture of New Unit (Front View)');
                    displayImage($mtopChangeMotorcycleData->unit_side_view_image_path, 'Picture of New Unit (Side View)');
                  ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if (!empty($mtopTransferOwnershipData)) : ?>
              <div class="content-container mt-4">
                <div class="bckgrnd pt-2">
                  <h6 class="pl-2 text-uppercase text-center text-dark fs-6">TRANSFER OF OWNERSHIP MTOP REQUIREMENTS IMAGES (NO TRANSFER TYPE)</h6>
                </div>
                <div class="row justify-content-evenly px-3 p-3">
                  <?php
                    displayImage($mtopTransferOwnershipData->mc_lto_certificate_of_registration_path, 'LTO Certificate of Registration (MC of New Unit)');
                    displayImage($mtopTransferOwnershipData->mc_lto_official_receipt_path, 'LTO Official Receipt (MC of New Unit)');
                    displayImage($mtopTransferOwnershipData->mc_plate_authorization_path, 'Plate Authorization (MC of New Unit)');
                    displayImage($mtopTransferOwnershipData->tc_insurance_policy_path, 'Insurance Policy (TC) (New Owner)');
                    displayImage($mtopTransferOwnershipData->latest_franchise_path, 'Latest Franchise (TC)');
                    displayImage($mtopTransferOwnershipData->proof_of_id_path, 'Proof of ID / Residence');
                    displayImage($mtopTransferOwnershipData->sketch_location_of_garage_path, 'Sketch Location of Garage');
                    displayImage($mtopTransferOwnershipData->affidavit_of_income_tax_return_path, 'Affidavit of No Income or Latest Income Tax Return');
                    displayImage($mtopTransferOwnershipData->unit_front_view_image_path, 'Picture of New Unit (Front View)');
                    displayImage($mtopTransferOwnershipData->unit_side_view_image_path, 'Picture of New Unit (Side View)');
                    displayImage($mtopTransferOwnershipData->driver_cert_safety_driving_seminar_path, 'Driver\'s Certificate of Safety Driving Seminar');
                  ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if (!empty($mtopIntentTransferData)) : ?>
              <div class="content-container mt-4">
                <div class="bckgrnd pt-2">
                  <h6 class="pl-2 text-uppercase text-center text-dark fs-6">TRANSFER OF OWNERSHIP MTOP REQUIREMENTS IMAGES (INTENT OF TRANSFER)</h6>
                </div>
                <div class="row justify-content-evenly px-3 p-3">
                  <?php
                    displayImage($mtopIntentTransferData->mc_lto_certificate_of_registration_path, 'LTO Certificate of Registration (MC of New Unit)');
                    displayImage($mtopIntentTransferData->mc_lto_official_receipt_path, 'LTO Official Receipt (MC of New Unit)');
                    displayImage($mtopIntentTransferData->mc_plate_authorization_path, 'Plate Authorization (MC of New Unit)');
                    displayImage($mtopIntentTransferData->tc_insurance_policy_path, 'Insurance Policy (TC) (New Owner)');
                    displayImage($mtopIntentTransferData->latest_franchise_path, 'Latest Franchise (TC)');
                    displayImage($mtopIntentTransferData->proof_of_id_path, 'Proof of ID / Residence');
                    displayImage($mtopIntentTransferData->sketch_location_of_garage_path, 'Sketch Location of Garage');
                    displayImage($mtopIntentTransferData->affidavit_of_income_tax_return_path, 'Affidavit of No Income or Latest Income Tax Return');
                    displayImage($mtopIntentTransferData->unit_front_view_image_path, 'Picture of New Unit (Front View)');
                    displayImage($mtopIntentTransferData->unit_side_view_image_path, 'Picture of New Unit (Side View)');
                    displayImage($mtopIntentTransferData->driver_cert_safety_driving_seminar_path, 'Driver\'s Certificate of Safety Driving Seminar');
                  ?>
                </div>

                <div class="row justify-content-evenly px-3 p-3">
                  <div class="text-center">
                    <h6>Additional Requirement</h6>
                  </div>
                  <?php
                    displayImage($mtopIntentTransferData->deed_of_donation_or_deed_of_sale_path, 'Deed of Donation or Deed of Sale');
                  ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if (!empty($mtopTransferFromDeceasedData)) : ?>
              <div class="content-container mt-4">
                <div class="bckgrnd pt-2">
                  <h6 class="pl-2 text-uppercase text-center text-dark fs-6">TRANSFER OF OWNERSHIP MTOP REQUIREMENTS IMAGES (TRANSFER OF OWNERSHIP FROM DECEASED OWNER)</h6>
                </div>
                <div class="row justify-content-evenly px-3 p-3">
                  <?php
                    displayImage($mtopTransferFromDeceasedData->mc_lto_certificate_of_registration_path, 'LTO Certificate of Registration (MC of New Unit)');
                    displayImage($mtopTransferFromDeceasedData->mc_lto_official_receipt_path, 'LTO Official Receipt (MC of New Unit)');
                    displayImage($mtopTransferFromDeceasedData->mc_plate_authorization_path, 'Plate Authorization (MC of New Unit)');
                    displayImage($mtopTransferFromDeceasedData->tc_insurance_policy_path, 'Insurance Policy (TC) (New Owner)');
                    displayImage($mtopTransferFromDeceasedData->latest_franchise_path, 'Latest Franchise (TC)');
                    displayImage($mtopTransferFromDeceasedData->proof_of_id_path, 'Proof of ID / Residence');
                    displayImage($mtopTransferFromDeceasedData->sketch_location_of_garage_path, 'Sketch Location of Garage');
                    displayImage($mtopTransferFromDeceasedData->affidavit_of_income_tax_return_path, 'Affidavit of No Income or Latest Income Tax Return');
                    displayImage($mtopTransferFromDeceasedData->unit_front_view_image_path, 'Picture of New Unit (Front View)');
                    displayImage($mtopTransferFromDeceasedData->unit_side_view_image_path, 'Picture of New Unit (Side View)');
                    displayImage($mtopTransferFromDeceasedData->driver_cert_safety_driving_seminar_path, 'Driver\'s Certificate of Safety Driving Seminar');
                  ?>
                </div>

                <div class="row justify-content-evenly px-3 p-3">
                  <div class="text-center">
                    <h6>Additional Requirement</h6>
                  </div>
                  <?php
                    displayImage($mtopTransferFromDeceasedData->death_certificate_path, 'Death Certificate');
                    displayImage($mtopTransferFromDeceasedData->agreement_amongst_heirs_path, 'Agreement Amongst Heirs');
                  ?>
                </div>
              </div>
            <?php endif; ?>

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

            <div id="taripaTableContainer" class="content-container mt-4">
              <div class="bckgrnd pt-2">
                <?php
                    $taripaTitle = isset($recentYear) ? $recentYear . ' TARIPA' : '';
                ?>
                <h6 class="pl-2 text-uppercase text-center text-dark fs-6">
                  <?php echo $taripaTitle; ?>
                </h6>
              </div>
              <div class="row px-3 p-4">
                <table class="table-bordered table-hover text-center" id="systemTable">
                  <thead>
                    <tr>
                      <th class="text-white text-center" style="background-color:#090C1B !important;">Barangay</th>
                      <th class="text-white text-center" style="background-color:#090C1B !important;">Regular Fare</th>
                      <th class="text-white text-center" style="background-color:#090C1B !important;">Discounted Fare</th>
                    </tr>
                </thead>
                  <tbody>
                    <?php foreach ($recentTaripaData as $taripa): ?>
                      <tr>
                        <td><?php echo $taripa['barangay']; ?></td>
                        <td><?php echo '₱' . number_format($taripa['regular_fare'], 2); ?></td>
                        <td><?php echo '₱' . number_format($taripa['discounted_fare'], 2); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="text-end my-3">
              <a href="tricycles"><button class="sidebar-btnContent">Back</button></a>
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