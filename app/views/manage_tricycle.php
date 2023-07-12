{{sidebar}}

<div class="content">
  <div class="row">
    <div class="col-12 title-head text-uppercase">
      <h6 class="add">Add New Tricycle</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12 pt-2">
          <div id="newTricycleForm">
            <form>
              <div class="content-container mt-2 p-3">
                <h6 class="pl-2">MOTOR UNIT</h6>
                <div class="row px-3">
                  <div class="col-12 d-flex justify-content-between">
                    <div>
                      <label for="model" class="form-label">Model</label>
                      <input type="text" class="form-control" id="model" name="model" required>
                    </div>

                    <div>
                      <label for="yearAcquired" class="form-label">Year Acquired</label>
                      <input type="text" class="form-control" id="yearAcquired" name="yearAcquired" required>
                    </div>

                    <div>
                      <label for="colorCode" class="form-label">Color Code</label>
                      <input type="text" class="form-control" id="colorCode" name="colorCode" required>
                    </div>

                    <div>
                      <label for="routeArea" class="form-label">Route Area</label>
                      <input type="text" class="form-control" id="routeArea" name="routeArea" required>
                    </div>
                  </div>

                  <div class="col-12 d-flex justify-content-between pt-3">
                    <div>
                      <label for="driversName" class="form-label">Driver's Name</label>
                      <input type="text" class="form-control" id="driversName" name="driversName" required>
                    </div>

                    <div>
                      <label for="orNo" class="form-label">OR No.</label>
                      <input type="text" class="form-control" id="orNo" name="orNo" required>
                    </div>

                    <div>
                      <label for="orDate" class="form-label">OR Date</label>
                      <input type="date" class="form-control" id="orDate" name="orDate" required>
                    </div>

                    <div>
                      <label for="tricycleStatus" class="form-label">Tricycle Status</label>
                      <input type="text" class="form-control" id="tricycleStatus" name="tricycleStatus" required>
                    </div>
                  </div>
                </div>

                <h6 class="pl-2 pt-3">DOCUMENTS</h6>
                <div class="row px-3">
                  <div class="col-8 d-flex justify-content-between">
                    <div>
                      <label for="tricycleOperatorPermit" class="form-label">Tricycle Operator Permit</label>
                      <input type="file" class="form-control form-documents" id="tricycleOperatorPermit" name="tricycleOpetatorPermit" required>
                    </div>

                    <div>
                      <label for="tricycleImages" class="form-label">Tricycle Images (Front, Back, & Sides)</label>
                      <input type="file" class="form-control form-documents" id="tricycleImages" name="tricycleImages" required>
                    </div>
                  </div>
                </div>

                <div class="row px-3 pt-4">
                  <div class="col-8 d-flex justify-content-between">
                    <div>
                      <label for="certificateOfRegistration" class="form-label">Certificate of Registration (CR)</label>
                      <input type="file" class="form-control form-documents" id="officialReceipt" name="or" required>
                    </div> 
                  
                    <div>
                      <label for="officialReceipt" class="form-label">Official Receipt (OR)</label>
                      <input type="file" class="form-control form-documents" id="officialReceipt" name="or" required>
                    </div>
                  </div>
                </div>

                <div class="btn-submit text-end">
                  <button type="submit" class="sidebar-btnContent">Add Tricycle</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
