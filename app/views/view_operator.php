<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 title-head text-uppercase">
      <h6>View Operator</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4">
            <div id="newDriverForm">
              <div class="content-container mt-2 p-3">
                <h6 class="pl-2 text-uppercase">Operator Information</h6>
                <div class="container">
                  <div class="d-flex justify-content-center">
                    <div class="row px-3">
                      <div class="col-md-4">
                        <div class="profile-photo-container text-center mt-3">
                          <?php if(!empty($profile_photo_path)): ?>
                            <img src="<?php echo $profile_photo_path; ?>" class="img-fluid rounded-circle" alt="Profile Photo">
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="row">
                          <div class="col-6">
                            <p class="form-label">First Name</p>
                            <div class="form-control">
                              <?php echo !empty($first_name) ? $first_name : '----------------'; ?>
                            </div>
                          </div>
                          <div class="col-6">
                            <p class="form-label">Last Name</p>
                            <div class="form-control">
                              <?php echo !empty($last_name) ? $last_name : '----------------'; ?>
                            </div>
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-6">
                            <p class="form-label">Phone Number</p>
                            <div class="form-control">
                              <?php echo !empty($phone_number) ? $phone_number : '----------------'; ?>
                            </div>
                          </div>
                          <div class="col-6">
                            <p class="form-label">Email</p>
                            <div class="form-control">
                              <?php echo !empty($email) ? $email : '----------------'; ?>
                            </div>
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-12">
                            <p class="form-label">Address</p>
                            <div class="form-control">
                              <?php echo !empty($address) ? $address : '----------------'; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="text-end my-3">
                <a href="./operators"><button class="sidebar-btnContent">Back</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>