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
              <div class="content-container mt-2 p-3">
              <h6 class="pl-2 text-uppercase">Driver information</h6>
                <div class="container">
                  <div class="d-flex justify-content-center">
                    <div class="row px-3">
                      <div class="col-12">
                        <div class="row mt-3">
                          <div class="col-4">
                            <p class="form-label">First Name</p>
                            <div class="form-control">
                              <?php echo isset($first_name) ? $first_name : ''; ?>
                            </div>
                          </div>
                          <div class="col-4">
                            <p class="form-label">Last Name</p>
                            <div class="form-control">
                              <?php echo isset($last_name) ? $last_name : ''; ?>
                            </div>
                          </div>
                          <div class="col-4">
                            <p class="form-label">Middle Name</p>
                            <div class="form-control">
                              <?php echo isset($middle_name) ? $middle_name : ''; ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="row mt-3">
                          <div class="col-4">
                            <p class="form-label">Address</p>
                            <div class="form-control">
                              <?php echo isset($address) ? $address : ''; ?>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                              <p class="form-label">Phone No.</p>
                              <div class="form-control">
                                <?php echo isset($phone_no) ? $phone_no : ''; ?>
                              </div>
                            </div>
                          </div>
                          <div class="col-4">
                            <p class="form-label">Birth Date</p>
                            <div class="form-control">
                              <?php echo isset($birth_date) ? $birth_date : ''; ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="row mt-3">
                          <div class="col-4">
                            <p class="form-label">License No.</p>
                            <div class="form-control">
                              <?php echo isset($license_no) ? $license_no : ''; ?>
                            </div>
                          </div>
                          <div class="col-4">
                            <p class="form-label">License Validity</p>
                            <div class="form-control">
                              <?php echo isset($license_validity) ? $license_validity : ''; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

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