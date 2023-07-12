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
              <form>
                <div class="content-container mt-2 p-3">
                <h6 class="pl-2 text-uppercase">Driver information</h6>
                  <div class="row px-3">
                    <div class="col-12 d-flex justify-content-between">
                      <div>
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                      </div>

                      <div>
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                      </div>

                      <div>
                        <label for="middleName" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middleName" name="middleName" required>
                      </div>
                    </div>

                    <div class="col-12 d-flex justify-content-between mt-3">
                      <div>
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                      </div>

                      <div>
                        <label for="phoneNo" class="form-label">Phone No.</label>
                        <input type="text" class="form-control" id="phoneNo" name="phoneNo" required>
                      </div>

                      <div>
                        <label for="birthdate" class="form-label">Birth Date</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                      </div>
                    </div> 

                    <div class="col-12 d-flex justify-content-between mt-3">
                      <div>
                        <label for="licenseNo" class="form-label">License No.</label>
                        <input type="text" class="form-control" id="licenseNo" name="licenseNo" required>
                      </div>

                      <div>
                        <label for="licenseValidity" class="form-label">License Validity</label>
                        <input type="text" class="form-control" id="licenseValidity" name="licenseValidity" required>
                      </div>

                      <div>
                        <label for="plateNo" class="form-label">Plate No.</label>
                        <input type="text" class="form-control" id="plateNo" name="plateNo" required>
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