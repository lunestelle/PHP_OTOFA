<?php
$_SESSION['prev_page'] = $_SERVER['HTTP_REFERER'];

$backUrl = isset($_SESSION['prev_page']) ? $_SESSION['prev_page'] : './users';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">View User</h6>
    </div>
    <div class="col-lg-12 mt-4">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4 pb-3">
            <div id="newDriverForm">
              <div class="content-container mt-2 pb-3">
                <div class="bckgrnd pt-1">
                  <h6 class="pl-2 text-uppercase text-center text-dark fs-6"><?php echo isset($full_name) ? $full_name : ''; ?> Information</h6>
                </div>
                <div class="container">
                  <div class="d-flex">
                    <div class="row px-3">
                      <div class="col-12">
                        <div class="row mt-3">
                          <div class="col-6 px-5">
                            <p class="form-label">First Name</p>
                            <div class="form-control" style="width:100% !important;">
                              <?php echo isset($first_name) ? $first_name : ''; ?>
                            </div>
                          </div>
                          <div class="col-6 px-5">
                            <p class="form-label">Last Name</p>
                            <div class="form-control" style="width:100% !important;">
                              <?php echo isset($last_name) ? $last_name : ''; ?>
                            </div>
                          </div>
                          
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="row mt-3">
                          <div class="col-6 px-5">
                            <p class="form-label">Role</p>
                            <div class="form-control text-capitalize" style="width:100% !important;">
                              <?php echo isset($role) ? $role : ''; ?>
                            </div>
                          </div>
                          <div class="col-6 px-5">
                            <p class="form-label">Email</p>
                            <div class="form-control" style="width:100% !important;">
                              <?php echo isset($email) ? $email : ''; ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-12 pb-3">
                        <div class="row mt-3">
                          <div class="col-6 px-5">
                            <p class="form-label">Address</p>
                            <div class="form-control" style="width:100% !important;">
                              <?php echo isset($address) ? $address : ''; ?>
                            </div>
                          </div>
                          <div class="col-6 px-5">
                            <div class="form-group">
                              <p class="form-label">Phone No.</p>
                              <div class="form-control" style="width:100% !important;">
                                <?php echo isset($phone_number) ? $phone_number : ''; ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


                    </div>
                  </div>
                </div>
              </div>

              <div class="content-container mt-5">
                <div class="bckgrnd pt-1">
                  <h6 class="pl-2 text-uppercase text-center text-dark fs-6">Permissions</h6>
                </div>
                <div class="container">
                  <div class="d-flex">
                    <div class="row px-3 mt-3 pt-1">
                      <?php if (!empty($permissions)) : ?>
                        <?php if (count($permissions) === 1) : ?>
                          <div class="col-12 text-center">
                            <ul class="list-styled">
                              <?php foreach ($permissions as $permission) : ?>
                                <li><?php echo ucfirst($permission); ?></li>
                              <?php endforeach; ?>
                            </ul>
                          </div>
                        <?php elseif (count($permissions) > 1) : ?>
                          <?php foreach ($permissions as $permission) : ?>
                            <div class="col-6 px-1">
                              <ul class="list-styled">
                                <li><?php echo ucfirst($permission); ?></li>
                              </ul>
                            </div>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      <?php else : ?>
                        <div class="col-12 px-5">
                          <p class="text-muted">This user has no specific permissions.</p>
                        </div>
                      <?php endif; ?>
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