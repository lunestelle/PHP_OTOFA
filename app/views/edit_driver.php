<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Edit Driver</h6>
    </div>
    <div class="col-lg-12 mt-2">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4">
            <div id="newDriverForm">
              <form class="default-form" method="POST" action="">
                <div class="content-container mx-1 mt-3 pb-4">
                  <div class="bckgrnd pt-2">
                    <h6 class="pl-2 text-uppercase text-center text-light fs-6">Driver Information</h6>
                  </div>
                  <div class="container">
                    <div class="d-flex justify-content-center">
                      <div class="row px-3">
                        <div class="col-12">
                          <div class="row mt-3">
                            <div class="col-4">
                              <label for="first_name" class="form-label">First Name</label>
                              <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($driverData['first_name']) ? ($driverData['first_name']) : ''; ?>" required>
                            </div>

                            <div class="col-4">
                              <label for="last_name" class="form-label">Last Name</label>
                              <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($driverData['last_name']) ? $driverData['last_name'] : ''; ?>" required>
                            </div>

                            <div class="col-4">
                              <label for="middle_name" class="form-label">Middle Name</label>
                              <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo isset($driverData['middle_name']) ? $driverData['middle_name'] : ''; ?>" required>
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="row mt-3">
                            <div class="col-4">
                              <label for="address" class="form-label">Address</label>
                              <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($driverData['address']) ? $driverData['address'] : ''; ?>" required>
                            </div>

                            <div class="col-4">
                              <div class="form-group">
                                <label for="phone_no" class="form-label">Phone No.</label>
                                <div class="input-group">
                                  <span class="input-group-text">+63</span>
                                  <input type="text" class="form-control phone-no" id="phone_no" name="phone_no" placeholder="e.g., 9123456789" value="<?php echo isset($driverData['phone_no']) ? $driverData['phone_no'] : ''; ?>" required>
                                </div>
                              </div>
                            </div>


                            <div class="col-4">
                              <label for="birth_date" class="form-label">Birth Date</label>
                              <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo isset($driverData['birth_date']) ? $driverData['birth_date'] : ''; ?>" required>
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="row mt-3">
                            <div class="col-4">
                              <label for="license_no" class="form-label">License Number</label>
                              <input type="text" class="form-control" id="license_no" name="license_no" value="<?php echo isset($driverData['license_no']) ? $driverData['license_no'] : ''; ?>" required>
                            </div>

                            <div class="col-4">
                              <label for="license_expiry_date" class="form-label">License Expiry Date</label>
                              <input type="date" class="form-control" id="license_expiry_date" name="license_expiry_date" value="<?php echo isset($driverData['license_expiry_date']) ? $driverData['license_expiry_date'] : ''; ?>" required>
                            </div>                             
                            <?php if (!empty($tricycleCinNumbers)): ?>
                              <div class="col-4">
                                <label for="tricycle_cin_number_id" class="form-label">Tricycle CIN</label>
                                <select class="form-control" id="tricycle_cin_number_id" name="tricycle_cin_number_id" required>
                                  <option value="" disabled <?= empty($selectedCinNumberId) ? 'selected' : ''; ?>>Please Select Here</option>
                                  <?php foreach ($tricycleCinNumbers as $cinNumberId => $cinData): ?>
                                    <option value="<?= $cinNumberId ?>" <?= ($cinNumberId == $selectedCinNumberId) ? 'selected' : ''; ?>>
                                      <?= $cinData['cin_number'] ?>
                                    </option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            <?php else: ?>
                              <div class="col-4">
                                <label for="tricycle_cin_number_id" class="form-label">Tricycle CIN</label>
                                <input type="text" class="form-control" id="tricycle_cin_number_id" name="tricycle_cin_number_id" value="" data-toggle="tooltip" data-bs-placement="top" title="No available Tricycle CIN numbers." readonly disabled>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="row mt-3">
                            <div class="col-4">
                              <label for="status" class="form-label">Status</label>
                              <select class="form-control appointment-status-select fw-bold" id="status" name="status">
                                <option value="" selected disabled>Select Driver Status</option>
                                <?php if ($isActive): ?>
                                  <!-- If the driver is active, show Active as the first option -->
                                  <option value="Active" <?php echo (in_array('Active', $statuses)) ? 'selected' : ''; ?> disabled>Active</option>
                                  <option value="Inactive" <?php echo (in_array('Inactive', $statuses)) ? 'selected' : ''; ?>>Inactive</option>
                                <?php else: ?>
                                  <!-- If the driver is inactive or no active status, show Inactive as the first option -->
                                  <option value="Inactive" <?php echo (in_array('Inactive', $statuses)) ? 'selected' : ''; ?> disabled>Inactive</option>
                                  <option value="Active" <?php echo (in_array('Active', $statuses)) ? 'selected' : ''; ?>>Active</option>
                                <?php endif; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-end my-3">
                  <button type="submit" class="sidebar-btnContent">Update</button>
                  <a href="./drivers" class="cancel-btn">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>