{{sidebar}}

<div class="content">
  <div class="row">
    <div class="col-12 title-head text-uppercase">
      <h6>Add New Driver</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <div class="container pt-4">
            <div id="newDriverForm">
            <form class="default-form" method="POST" action="">
                <div class="content-container mt-2 p-3">
                <h6 class="pl-2 text-uppercase">Driver information</h6>
                  <div class="row px-3">
                    <div class="col-12 d-flex justify-content-between">
                      <div>
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($first_name) ? $first_name : ''; ?>" required>
                      </div>

                      <div>
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>" required>
                      </div>

                      <div>
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo isset($middle_name) ? $middle_name : ''; ?>" required>
                      </div>
                    </div>

                    <div class="col-12 d-flex justify-content-between mt-3">
                      <div>
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($address) ? $address : ''; ?>" required>
                      </div>

                      <div>
                        <label for="phone_no" class="form-label">Phone No.</label>
                        <input type="text" class="form-control" id="phone_no" name="phone_no" value="<?php echo isset($phone_no) ? $phone_no : ''; ?>" required>
                      </div>

                      <div>
                        <label for="birth_date" class="form-label">Birth Date</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo isset($birth_date) ? $birth_date : ''; ?>" required>
                      </div>
                    </div> 

                    <div class="col-12 d-flex justify-content-between mt-3">
                      <div>
                        <label for="license_no" class="form-label">License No.</label>
                        <input type="text" class="form-control" id="license_no" name="license_no" value="<?php echo isset($license_no) ? $license_no : ''; ?>" required>
                      </div>

                      <div>
                        <label for="license_validity" class="form-label">License Validity</label>
                        <input type="text" class="form-control" id="license_validity" name="license_validity" value="<?php echo isset($license_validity) ? $license_validity : ''; ?>" required>
                      </div>

                      <div>
                        <label for="tricycle_id" class="form-label">Plate No.</label>
                        <select class="form-control" id="tricycle_id" name="tricycle_id" required>
                          <option <?php echo (!isset($tricycle_id)) ? 'selected' : ''; ?> disabled>Please Select Here</option>
                          <?php foreach ($tricycles as $tricycle): ?>
                            <option value="<?php echo $tricycle['tricycle_id']; ?>" <?php echo (isset($tricycle_id) && $tricycle_id == $tricycle['tricycle_id']) ? 'selected' : ''; ?>>
                              <?php echo $tricycle['plate_no']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>

                    <div class="btn-submit-driver">
                      <button type="submit" class="sidebar-btnContent">Add Driver</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>