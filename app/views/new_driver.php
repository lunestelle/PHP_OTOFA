<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Add new driver</h6>
    </div>
    <div class="col-lg-12 mt-2">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4">
            <div id="newDriverForm">
              <form class="default-form" method="POST" action="">
                <div class="content-container mt-2 pb-3">
                  <div class="bckgrnd pt-2">
                    <h6 class="pl-2 text-uppercase text-center text-light fs-6">Driver Information</h6>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-12">
                        <div class="row mt-3">
                          <div class="col-4 px-5">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($first_name) ? $first_name : ''; ?>" required>
                          </div>

                          <div class="col-4 px-5">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>" required>
                          </div>

                          <div class="col-4 px-5">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo isset($middle_name) ? $middle_name : ''; ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="row mt-3">
                          <div class="col-4 px-5">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($address) ? $address : ''; ?>" required>
                          </div>

                          <div class="col-4 px-5">
                            <div class="form-group">
                              <label for="phone_no" class="form-label">Phone No.</label>
                              <div class="input-group">
                                <span class="input-group-text">+63</span>
                                <input type="text" class="form-control phone-no" id="phone_no" name="phone_no" placeholder="e.g., 9123456789" value="<?php echo isset($phone_no) ? $phone_no : ''; ?>" required>
                              </div>
                            </div>
                          </div>


                          <div class="col-4 px-5">
                            <label for="birth_date" class="form-label">Birth Date</label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo isset($birth_date) ? $birth_date : ''; ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="row mt-3">
                          <div class="col-4 px-5">
                            <label for="license_no" class="form-label">License Number</label>
                            <input type="text" class="form-control" id="license_no" name="license_no" value="<?php echo isset($license_no) ? $license_no : ''; ?>" required>
                          </div>

                          <div class="col-4 px-5">
                            <label for="license_expiry_date" class="form-label">License Expiry Date</label>
                            <input type="date" class="form-control" id="license_expiry_date" name="license_expiry_date" value="<?php echo isset($license_expiry_date) ? $license_expiry_date : ''; ?>" required>
                          </div>
                          <?php if (!empty($tricycleCinNumbers)): ?>
                            <div class="col-4 px-5">
                              <label for="tricycle_cin_number_id" class="form-label">Tricycle CIN</label>
                              <select class="form-control" id="tricycle_cin_number_id" name="tricycle_cin_number_id" required>
                                <option selected disabled>Please Select Here</option>
                                <?php foreach ($tricycleCinNumbers as $cinNumberId => $cinData): ?>
                                  <option value="<?= $cinNumberId ?>"><?= $cinData['cin_number'] ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          <?php else: ?>
                            <div class="col-4 px-5">
                              <label for="tricycle_cin_number_id" class="form-label">Tricycle CIN</label>
                              <input type="text" class="form-control" id="tricycle_cin_number_id" name="tricycle_cin_number_id" value="" data-toggle="tooltip" data-bs-placement="top" title="No available Tricycle CIN numbers." readonly disabled>
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="text-end my-3">
                  <button type="submit" class="sidebar-btnContent">Add Driver</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>