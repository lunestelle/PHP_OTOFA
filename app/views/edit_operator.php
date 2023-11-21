<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">edit operator</h6>
    </div>
    <div class="col-lg-12 mt-4">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4">
            <div id="newDriverForm">
              <form class="default-form" method="POST" action="">
                <input type="hidden" name="operator_id" value="<?php echo $operatorId; ?>">
                <div class="content-container mt-2 p-3">
                  <h6 class="pl-2 text-uppercase">Operator information</h6>
                  <div class="container">
                      <div class="d-flex justify-content-center">
                        <div class="row px-3">
                          <div class="col-12">
                            <div class="row mt-3">
                              <div class="col-4">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($first_name) ? $first_name : ''; ?>" required>
                              </div>
                              <div class="col-4">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>" required>
                              </div>
                              <div class="col-4">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>" required>
                              </div>
                            </div>
                          </div>

                          <div class="col-12">
                            <div class="row mt-3">
                              <div class="col-4">
                              <label for="email" class="form-label">Email</label>                            <input type="text" class="form-control" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                              </div>
                              <div class="col-4">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($address) ? $address : ''; ?>" required>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>

                <div class="text-end my-3">
                  <button type="submit" class="sidebar-btnContent">Save</button>
                </div>
                <div class="text-end my-3">
                  <a href="./operators"><button class="sidebar-btnContent" style="margin-right:10px;">Back</button></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>