{{sidebar}}

<div class="content">
  <div class="row">
    <div class="col-12 title-head text-uppercase">
      <h6>New Driver</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <div class="container pt-4">
            <div id="newDriverForm">
              <form>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="birthdate" class="form-label">Birth Date</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="address" name="address" required>
                </div>

                <div class="mb-3">
                  <label for="phoneNo" class="form-label">Phone No.</label>
                  <input type="text" class="form-control" id="phoneNo" name="phoneNo" required>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="licenseNo" class="form-label">License No.</label>
                    <input type="text" class="form-control" id="licenseNo" name="licenseNo" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="licenseValidity" class="form-label">License Validity</label>
                    <input type="text" class="form-control" id="licenseValidity" name="licenseValidity" required>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="plateNo" class="form-label">Plate No.</label>
                  <input type="text" class="form-control" id="plateNo" name="plateNo" required>
                </div>

                <div class="text-end">
                  <button type="submit" class="btn btn-primary">Add Driver</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>