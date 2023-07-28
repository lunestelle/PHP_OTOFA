<div class="container-fluid">
  <div class="row">
    {{sidebar}} 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
      <div class="row">
        <div class="col-12 title-head text-uppercase">
          <h6>View Driver </h6>
        </div>
        <div class="col-lg-12">
          <div class="row">
            <div class="col-12 pt-2">
              <div class="container pt-4">
                <div id="newDriverForm">
                  <form class="default-form" method="POST" action="">
                    <div class="content-container mt-2 p-3">
                    <h6 class="pl-2 text-uppercase">Driver information</h6>
                      <div class="container">
                        <div class="d-flex justify-content-center">
                          <div class="row px-3">
                            <div class="col-12">
                              <div class="row mt-3">
                                <div class="col-4">
                                  <label for="first_name" class="form-label">First Name</label>
                                  <input disabled type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($first_name) ? $first_name : ''; ?>" required>
                                </div>

                                <div class="col-4">
                                  <label for="last_name" class="form-label">Last Name</label>
                                  <input disabled type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>" required>
                                </div>

                                <div class="col-4">
                                  <label for="middle_name" class="form-label">Middle Name</label>
                                  <input disabled type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo isset($middle_name) ? $middle_name : ''; ?>" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-12">
                              <div class="row mt-3">
                                <div class="col-4">
                                  <label for="address" class="form-label">Address</label>
                                  <input disabled type="text" class="form-control" id="address" name="address" value="<?php echo isset($address) ? $address : ''; ?>" required>
                                </div>

                                <div class="col-4">
                                  <div class="form-group">
                                    <label for="phone_no" class="form-label">Phone No.</label>
                                    <div class="input-group">
                                      <span class="input-group-text">+63</span>
                                      <input disabled type="text" class="form-control phone-no" id="phone_no" name="phone_no" placeholder="e.g., 9123456789" value="<?php echo isset($phone_no) ? $phone_no : ''; ?>" required>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-4">
                                  <label for="birth_date" class="form-label">Birth Date</label>
                                  <input disabled type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo isset($birth_date) ? $birth_date : ''; ?>" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-12">
                              <div class="row mt-3">
                                <div class="col-4">
                                  <label for="license_no" class="form-label">License No.</label>
                                  <input disabled type="text" class="form-control" id="license_no" name="license_no" value="<?php echo isset($license_no) ? $license_no : ''; ?>" required>
                                </div>

                                <div class="col-4">
                                  <label for="license_validity" class="form-label">License Validity</label>
                                  <input disabled type="text" class="form-control" id="license_validity" name="license_validity" value="<?php echo isset($license_validity) ? $license_validity : ''; ?>" required>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <div class="text-end my-3">
                    <a href="./drivers"><button class="sidebar-btnContent">Back</button></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>