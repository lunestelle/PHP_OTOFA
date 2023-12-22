<div id="print-content" class="print-content row">
  <div class="col-lg-12 mx-auto mt-2">
    <div class="row">
      <div class="col-12">
        <div class="container-1">
          <div class="text-center header-print" style="font-size: 12px;">
            <p>Republic of the Philippines</p>
            <p>Office of the City Mayor</p>
            <p class="fw-bold">Transportation Development Franchising and Regulatory Office</p>
            <p>Ormoc city</p>
          </div>
          <div class="mt-2">
            <h5>TRICYCLE APPLICATION FORM</h5>
          </div>
          <div class="application-form col-12 mt-3">
            <div class="d-flex">
              <div class="col-8">
                <p><span class="label">Name of Operator:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->operator_name) ? ucwords(strtolower($tricycleApplication->operator_name)) : ''; ?></span></p>
              </div>
              <div class="col-4">
                <p><span class="label">Contact:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->tricycle_phone_number) ? $tricycleApplication->tricycle_phone_number : ''; ?></span></p>
              </div>
            </div>
            <div class="d-flex">
              <div class="col-12">
                <p><span class="label">Address:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->address) ? ucwords(strtolower($tricycleApplication->address)) : ''; ?></span></p>
              </div>
            </div>
            <div class="d-flex">
              <div class="col-3">
                <p><span class="label">MTOP No:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->mtop_no) ? $tricycleApplication->mtop_no : ''; ?></span></p>
              </div>
              <div class="col-5">
                <p><span class="label">Route/Zone:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->route_area) ? ucwords(strtolower($tricycleApplication->route_area)) : ''; ?></span></p>
              </div>
              <div class="col-4">
                <p><span class="label">Make Model:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->make_model) ? ucwords(strtolower($tricycleApplication->make_model)) : ''; ?></span></p>
              </div>
            </div>
            <div class="d-flex">
              <div class="col-4">
                <p><span class="label">Expiry Date:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->make_model_expiry_date) ? ($tricycleApplication->make_model_expiry_date) : ''; ?></span></p>
              </div>
              <div class="col-4">
                <p><span class="label">Color Code:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->color_code) ? ucwords(strtolower($tricycleApplication->color_code)) : ''; ?></span></p>
              </div>
              <div class="col-4">
                <p><span class="label">Motor Number:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->motor_number) ? ($tricycleApplication->motor_number) : ''; ?></span></p>
              </div>
            </div>
            <div class="d-flex">
              <div class="col-8">
                <p><span class="label">Insurer:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->insurer) ? ($tricycleApplication->insurer) : ''; ?></span></p>
              </div>
              <div class="col-4">
                <p><span class="label">Chasis Number:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->chasis_no) ? ($tricycleApplication->chasis_no) : ''; ?></span></p>
              </div>
            </div>
            <div class="d-flex">
              <div class="col-4">
                <p><span class="label">C.O.C No.:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->coc_no) ? ($tricycleApplication->coc_no) : ''; ?></span></p>
              </div>
              <div class="col-4">
                <p><span class="label">Expiry Date:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->coc_no_expiry_date) ? ($tricycleApplication->coc_no_expiry_date) : ''; ?></span></p>
              </div>
              <div class="col-4">
                <p><span class="label">Plate Number:</span> <span class="form-input-line"><?php echo isset($cin) ? ($cin) : ''; ?></span></p>
              </div>
            </div>
            <div class="d-flex">
              <div class="col-5">
                <p><span class="label">LTO CR No.:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->lto_cr_no) ? ($tricycleApplication->lto_cr_no) : ''; ?></span></p>
              </div>
              <div class="col-2">
              </div>
              <div class="col-4 ms-3">
                <div class="ms-5">
                  <input type="checkbox" id="newCheckbox" <?php echo ($appointment_type == 'New Franchise' || $appointment_type == 'NEW') ? 'checked' : ''; ?>>
                  <label for="newCheckbox">New</label>
                  <input type="checkbox" id="renewalCheckbox" <?php echo ($appointment_type == 'Renewal of Franchise' || $appointment_type == 'RENEWAL') ? 'checked' : ''; ?>>
                  <label for="renewalCheckbox">Renewal</label>
                </div>
              </div>
            </div>
            <div class="d-flex">
              <div class="col-5">
                <p><span class="label">LTO OR No.:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->lto_or_no) ? ($tricycleApplication->lto_or_no) : ''; ?></span></p>
              </div>
              <div class="col-7">
              </div>
            </div>
            <div class="d-flex">
              <div class="col-5">
                <p><span class="label">Name of Driver:</span> <span class="form-input-line"><?php echo isset($driver_name) ? ($driver_name) : ''; ?></span></p>
              </div>
              <div class="col-7">
              </div>
            </div>
            <div class="d-flex">
              <div class="col-5">
                <p><span class="label">Driver's License:</span> <span class="form-input-line"><?php echo isset($tricycleApplication->driver_license_no) ? ($tricycleApplication->driver_license_no) : ''; ?></span></p>
              </div>
              <div class="col-5">
                <?php
                  $expiryDate = isset($tricycleApplication->driver_license_expiry_date) ? $tricycleApplication->driver_license_expiry_date : '';

                  $expiryDate = ($expiryDate === '0000-00-00') ? '' : $expiryDate;
                ?>
                <p><span class="label">Expiry Date:</span> <span class="form-input-line"><?php echo $expiryDate; ?></span></p>
              </div>
            </div>
          </div>
        </div>
        <div class="container-1 mt-2">
          <small class=" fw-bold" style="text-align: justify; font-size: 11px; display: block; text-align-last: left;">
            <span class="mx-5">  I DECLARE, under penalties of perjury, that this application has been made in good faith, verified by me, and to the best of my knowledge and belief, is true and correct, pursuant to the provision of the Ormoc City Tax Ordinance 34-92 and Ordinance 153-99 as amended and the regulation issued under authority thereof.</span>
          </small>
          <div class="d-flex">
            <div class="col-12 mt-3">
              <div class="row">
                <div class="col-6"></div>
                <div class="col-6">
                  _____________________________________________________________________________
                  <p class="signature">Signature Of Operator/Applicant over Printed Name</p>
                </div>
              </div>
            </div>
          </div>
       </div>
       <div class="lh-1 mt-3">
          <h5>TRICYCLE PERMIT SAFETY INSPECTION REPORT</h5>
          <small>Physical condition of tricycle unit</small>
       </div>
       <div class="d-flex inspection-report">
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4"></div>
            <div class="col-4">SATISFACTORY</div>
            <div class="col-4">UNSATISFACTORY</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">1 Motor</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">2 CHASSIS</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">3 HEAD LIGHT</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">4 INTERNAL LIGHT</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">5 SIDE CAR BODY LIGHT</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">6 TAIL LIGHT</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">7 PLATE LIGHT</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">8 SIGNAL LIGHTS</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">9 BRAKES</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">10 HORN</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">11 TIRES</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">12 MUFFLER</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">13 GRABAGE BIN</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">14 SIDE CAR BODY PAINT</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">15 UPHOLSTERY</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">16 WINDSHIELD</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">17 TARIPA</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">18 CIN</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">19 REAR STEEL HUB</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">20 SIDE MIRRORS</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">21 REFLECTORS</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">22 BUMPER</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12 mt-3">
            <div class="row mx-5">
            <div class="col-4 text-start">23 CHAIN GUARD</div>
            <div class="col-4">___________________________________________</div>
            <div class="col-4">___________________________________________</div>
          </div>
          <div class="col-12">
            <div class="row mx-5 mt-5">
            <div class="">REMARKS:  _________________________________________________________________________________________________________________________________________________________________________________________________________________________________________</div> 
          </div>
          <div class="col-12">
            <div class="row mx-5 mt-4">
              <p class="fw-bold fs-6">CERTIFICATE OF ROADWORTHINESS</p>
              <p>This is to certify that the above mentioned motorized tricycle has passed inspection and evaluation test procedure.</p>
            </div>
          </div>
          <div class="col-12">
            <div class="row mx-5 mt-4">
              <div class="col-4"></div>
              <div class="col-4"></div>
              <div class="col-4 text-start">Inspected by:
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="row mx-5 mt-4">
              <div class="col-4"></div>
              <div class="col-4"></div>
              <div class="col-2">___________________________________________________________
                <p class="mt-2">  TDFRO</p>
              </div>
            </div>
          </div>
        </div>
       </div>
      </div>
    </div>
  </div>
</div>
