<?php
$_SESSION['prev_page'] = $_SERVER['HTTP_REFERER'];

$backUrl = isset($_SESSION['prev_page']) ? $_SESSION['prev_page'] : './drivers';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">view driver</h6>
    </div>
    <div class="col-lg-12 mt-4">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4">
            <div id="newDriverForm">
              <div class="content-container mt-2 pb-3">
                <div class="bckgrnd pt-2">
                  <h6 class="pl-2 text-uppercase text-center text-dark fs-6"><?php echo isset($full_name) ? $full_name : ''; ?> Information</h6>
                </div>
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
                          <div class="col-4">
                            <p class="form-label">Tricycle Plate Number</p>
                            <div class="form-control">
                              <?php echo isset($tricycle_plate_number) && !empty($tricycle_plate_number) ? $tricycle_plate_number : 'No Chosen Tricycle'; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="text-end my-3">
                <a href="<?php echo $backUrl; ?>"><button class="sidebar-btnContent">Back</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>